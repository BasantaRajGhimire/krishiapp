<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Buyer\ClientPost;
use App\ServiceProvider\ServiceProviderBidPost;
use Carbon\Carbon;
use DB;
class BiddingResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bid:result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bid Result update for today.';

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
    public function handle()
    {   
        ClientPost::where('expired_at','<',now())->where('status', 0)->delete();
        ClientPost::where('expired_at','<', now())->where('status',2)->delete();
        $data = ClientPost::select('id')->where('expired_at','<',now())->where('status', 1)->get();
        foreach ($data as $key => $value) {
            $data[$key] = $value['id'];
        }

        ClientPost::whereIn('id',$data)->update(['status' => 4]);
        ServiceProviderBidPost::whereIn('post_id',$data)->update(['status'=>2]);

        // ServiceProviderBidPost::where('status',2)->delete();
        // ServiceProviderBidPost::where('created_at','<',now())->where('status',0)->delete();
        // $data = ClientPost::join('serviceprovider_bid_post as spbp', function ($q){
        //     $q->on('spbp.post_id','=','client_post.id')
        //     ->on('spbp.bid_amount','<=','client_post.estimated_cost');
        // })
        //         ->select('post_id','service_provider_id','client_id','spbp.bid_id','bid_amount')
        //         ->where('client_post.status',1)
        //         ->where('spbp.min_bider',1)
        //         ->where('expired_at','<',now())
        //         ->groupBy('post_id','service_provider_id','client_id','spbp.bid_id','spbp.bid_amount')
        //         ->get();
        // if(!empty($data)){
        //     foreach($data as $d){
        //         $rows[] = [
        //                 'post_id' => $d->post_id,
        //                 'service_provider_id' => $d->service_provider_id,
        //                 'client_id' => $d->client_id,
        //                 'bid_id' => $d->bid_id,
        //                 'amount' => $d->bid_amount,
        //                 ];
        //     }
            //$insert = DB::table('serviceprovider_win_clientpost')->insert($rows);
            //if($insert){
                $this->info($data);
            //}else{
             //   $this->info('Database Error');
            //}
        // }else{
        //     $this->info('No any Data to insert');
        //  }
    }
}
