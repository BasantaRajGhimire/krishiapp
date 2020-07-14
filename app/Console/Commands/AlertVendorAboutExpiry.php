<?php

namespace App\Console\Commands;

use App\Mails\AwardedBidAboutToExpire;
use App\ServiceProvider\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AlertVendorAboutExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:vendor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alert Vendor that the awarded bid is going to expire';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(AwardedBidAboutToExpire $mail)
    {
        $messages = array();
        DB::beginTransaction();
        try{
            $data = DB::table('serviceprovider_win_clientpost')->where('status', 0)->where('expired_at','>', now()->subDay())->where('expired_at','<',now())->get();
            foreach($data as $k => $d){
                $user = User::find($d->service_provider_id);
                $messages[] = [
                    'user_id' =>$d->service_provider_id,
                    'user_table' => 'V',
                    'title' => 'Awarded bid about to expire.',
                    'type' => 'Awarded Bid About To Expire',
                    'url' => "post/".$d->post_id,
                ];
                /*ServiceProviderBidPost::where('post_id', $d->post_id)->where('service_provider_id', $d->service_provider_id)->update(['status' => 2]);
                ClientPost::where('id', $d->post_id)->update(['status' => 1,'expired_at' => now()->addDays(2)]);*/
                $mail->sendAwardedBidAboutToExpireEmail($user, $d->post_id);
            }
            DB::table('support_messages')->insert($messages);
            DB::commit();
            $this->info(response()->json($messages));
        }catch(\Exception $e){
            DB::rollback();
            $this->info($e);
        }
    }
}
