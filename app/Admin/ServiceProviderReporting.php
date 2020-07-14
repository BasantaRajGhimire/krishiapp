<?php

namespace App\Admin;
use DB;
use Carbon\Carbon;

class ServiceProviderReporting {
    public function graphDelivered(){
        $datas = [];
        $year = date('Y');   
        $com = $this::completedBidPost($year);
        $bd  = $this::biddedPost($year);
        $pt = $this::totalPost($year);
        $datas['completed'] = $com;
        $datas['bidded'] = $bd;
        $datas['total'] = $pt;
        return $datas;
        
    }
    public function completedBidPost($year){
        $completed = DB::table('client_post as cp')
                        ->join('serviceprovider_bid_post as spbp','spbp.post_id','=','cp.id')
                        ->where('cp.status' , 5)
                        ->where('spbp.status', 4)
                        ->where('cp.updated_at','like', $year.'%')
                        ->get(['cp.updated_at'])
                        ->groupBy(function($date) {
                            return Carbon::parse($date->updated_at)->format('m');
                        });
        for($i=1; $i < 13 ;$i++){
            foreach($completed as $k => $d){
                if($i == intVal($k) ){
                    $com[intVal($k)] = $d->count();
                    $i++;
                }
            }
            $com[$i] = 0;
        }
        return $com;
    }

    public function biddedPost($year){
        $bidded = DB::table('client_post as cp')
                    ->join('serviceprovider_bid_post as spbp','spbp.post_id','=','cp.id')
                    ->where('cp.status' , 1)
                    ->where('spbp.status', 1)
                    ->where('cp.updated_at','like', $year.'%')
                    ->get(['cp.updated_at'])
                    ->groupBy(function($date) {
                        return Carbon::parse($date->updated_at)->format('m');
                    });
        for($i=1; $i < 13 ;$i++){
        foreach($bidded as $k => $d){
            if($i == intVal($k) ){
                $bd[intVal($k)] = $d->count();
                $i++;
            }
        }
        $bd[$i] = 0;
        }
        return $bd;
    }

    public function totalPost($year){
        $post = DB::table('client_post as cp')
                    ->where('cp.updated_at','like', $year.'%')
                    ->get(['cp.updated_at'])
                    ->groupBy(function($date) {
                        return Carbon::parse($date->updated_at)->format('m');
                    });
        for($i=1; $i < 13 ;$i++){
        foreach($post as $k => $d){
            if($i == intVal($k) ){
                $bd[intVal($k)] = $d->count();
                $i++;
            }
        }
        $bd[$i] = 0;
        }
        return $bd;
    }
}