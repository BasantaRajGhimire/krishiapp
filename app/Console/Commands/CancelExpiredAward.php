<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Buyer\ClientPost;
use App\ServiceProvider\ServiceProviderBidPost;
use App\ServiceProvider\User;
use App\Buyer\ClientUsers;
use App\Mails\CancelAwardMail;
use Carbon\Carbon;
use DB;

class CancelExpiredAward extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancel:award';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Canceling Expired Bided Award';

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
    public function handle(CancelAwardMail $mail)
    {
        $pid= [];
        DB::beginTransaction();
        try{
            //$data = [1,5,6,13,14,15];
            $data = DB::table('serviceprovider_win_clientpost')->where('status', 0)->where('expired_at','<',now())->get();
           DB::table('serviceprovider_win_clientpost')->where('expired_at','<',now())->where('status', 0)->update(['status'=> 2]);
            if(count($data) > 0){
                foreach($data as $k => $d){ 
                    $penalty[] = $this::penaltyInsertRow($d);
                    $user = ClientUsers::find($d->client_id);
                    $messages[] = $this::userMessagesRow($user, $d->post_id);                    
                    ServiceProviderBidPost::where('post_id', $d->post_id)->where('service_provider_id', $d->service_provider_id)->update(['status' => 2]);
                    ClientPost::where('id', $d->post_id)->update(['status' => 1,'expired_at' => now()->addDays(2)]);
                    $mail->sendCancelAwardEmail($user, $d->post_id);
                }                
                DB::table('serviceprovider_penalty_for_newbid')->insert($penalty);
                DB::table('support_messages')->insert($messages);
            }
            DB::commit();
            $this->info(response()->json($penalty));
        }catch(\Exception $e){
            DB::rollback();
            $this->info($e);
        }
    }
    public function penaltyInsertRow($vendorid){
        $vendorUser = User::with('UserPenalty')->find($vendorid)->toArray();
        $attempt = $vendorUser['user_penalty']['warning_attempt'] + 1 ?? 1;
        if($attempt <= 3){
            $days = config('constants.penalty.'.$attempt);
            $penalty = [
                    'service_provider_id' => $vendorid,
                    'warning_attempt' => $attempt,
                    'days' => $days,
                    'created_at' => now(),
                    'expired_at' => now()->addDays($days),
            ];
        }
        return $penalty;
    }
    public function userMessagesRow($user, $postid){
        $messages = [
                'user_id' =>$user->id,
                'user_table' => 'C',
                'title' => 'Please award your post to another vendor.',
                'type' => 'Canceled Awarded Post',
                'url' => "client-post/".$postid."?post_token=".$user->remember_token,
        ];
        return $messages;
    }
}
