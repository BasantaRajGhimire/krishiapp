<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use DB;

class BaseModel extends Model
{
    protected $rules =[];
    public $errors=[];
    protected $searchable=[];
    protected $toFront=[];


    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);
        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }
    
    public function retriveData($input){
        $qry = $this::select();
        if(property_exists($input,'searchOption') ){
            if($input->searchOption === 'all'){
                foreach($this->searchable as $k=>$s){
                    if($k===0){
                        $qry->where($s,'like','%'.$input->searchTerm.'%');
                        continue;
                    }
                    $qry->orWhere($s,'like','%'.$input->searchTerm.'%');
                }
            }else{
                $qry->where($input->searchOption,'like','%'.$input->searchTerm.'%');
            }
        }
        if(property_exists($input,'sortKey') && $input->sortKey !='' &&  property_exists($input,'sortDir') && $input->sortDir !=''){
            $qry->orderBy($input->sortKey,$input->sortDir);
        }
        if(property_exists($input,'perPage') ){
            return $qry->paginate($input->perPage);
        }
        if(count($this->toFront)>0){
            
            return $qry->get($this->toFront);
        }
        return $qry->get();
    }
    
    
    public static function getKeyNumber($table,$keyColumn,$keyCompareColumn,$compareValue){
        $data = DB::select(DB::raw("SELECT MIN(t1.key_no) as key_no
                        FROM 
                        (SELECT 1 AS key_no
                            UNION ALL
                            SELECT (".$keyColumn." + 1) as key_no
                            FROM ".$table." where ".$keyCompareColumn." like '".$compareValue."%'
                        ) t1
                        LEFT OUTER JOIN ".$table." t2
                        ON t1.key_no = t2.".$keyColumn." and t2.".$keyCompareColumn." like'".$compareValue."%'
                        WHERE t2.".$keyCompareColumn." IS NULL;"));
        return $data[0]->key_no;
    }
    
    public function change_2dot($string){
        return preg_replace('/_/', '.', $string,1);
    }
    
    public static function mMaxDay($year,$month){
        $qry = DB::table('date_meta')->select(['maxday'])
                ->where('years','=',$year)
                ->where('months','=',$month)->first();
        return $qry->maxday;
    }
    public function getDistrict($column=[], $where){
        $model = District::where($where)->first();
        return $model;
    }
    public static function nepDate($date=null){
        if(empty($date)){
            $date = date('Y-m-d');
        }
        $q = DB::select(DB::raw("select dbo.getnepdate('".$date."') as nepdate"));
        return $q[0]->nepdate;
    }
    public static function engDate($date){
        $q = DB::select(DB::raw("select dbo.stdengdate('".$date."') as engdate"));
        return $q[0]->engdate;
    }
    
    public static function splitDate($date,$eng=true){
        if($eng==true){
            $d = explode('/',$date);
            $e[0] =$d[2];
            $e[1]= $d[0];
            $e[2]= $d[1];
            return $e;
        }
        else{
            return explode('/',$date);
        }
        
    }
    
    public static function getFiscalYear($nepDate = null){
        if($nepDate == null){
            $nepDate = self::nepDate(date('Y-m-d'));
        }
        $dateParts = self::splitDate($nepDate,false);
        if($dateParts[1] >= 4){
            return $dateParts[0].'/'.($dateParts[0] + 1);
        }else{
            return ($dateParts[0]-1).'/'.$dateParts[0];
        }
    }
    
    //this function changes nepali number to english and english no to nepali
    public static function toggleNumber($n) {
        $langMap = ["०", "१", "२", "३", "४", "५", "६", "७", "८", "९"];
        $num = '';
        $nArray = preg_split('/(.{0})/us', $n, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
        foreach ($nArray as $sn) {
            if (isset($langMap[$sn])) {
                $num .=$langMap[$sn];
            } elseif (in_array($sn, $langMap)) {
                $num .= array_search($sn, $langMap);
            }
            else{
                $num .=$sn;
            }
        }
        return $num;
    }
    public static function getMonth($id,$en=true){
        if($en){
            $q = DB::table('month_list')->select(['monthen'])->where('monthid','=',$id)->first();
            return $q->monthen;
        }else{
            $q = DB::table('month_list')->select(['monthnp'])->where('monthid','=',$id)->first();
            return $q->monthnp;
        }
        
    }
    
    public function getSelectedData($fields,$orderBy=null,$where=null){
        if(!empty($fields) && is_array($fields)){
            $res = $this::select($fields);
            if(!empty($where)){
                if(is_array($where)){
                    foreach($where as $whr){
                        $wh = explode(',',$whr);
                        if(count($wh)==2){
                            $res->{'where'.ucfirst($wh[1])}($wh[0]);
                        }else{
                            $res->where($wh[0],$wh[1],$wh[2]);
                        }
                    }
                }else{
                    $wh = explode(',',$where);
                    $res->where($wh[0],$wh[1],$wh[2]);
                }
            }
            if(!empty($orderBy)){
                $res->orderBy($orderBy);
            }
            $data = $res->get();
            return $data;
        }
    }
    
    public function getSelectedTableData($table,$fields,$orderBy=null,$where=null){
        if(!empty($fields) && is_array($fields)){
            $res = DB::table($table)->select($fields);
            if(!empty($where)){
                if(is_array($where)){
                    foreach($where as $whr){
                        $wh = explode(',',$whr);
                        $res->where($wh[0],$wh[1],$wh[2]);
                        if(count($wh)==2){
                            $res->{'where'.ucfirst($wh[1])}($wh[0]);
                        }else{
                            $res->where($wh[0],$wh[1],$wh[2]);
                        }
                    }
                }else{
                    $wh = explode(',',$where);
                    $res->where($wh[0],$wh[1],$wh[2]);
                }
            }
            if(!empty($orderBy)){
                $res->orderBy($orderBy);
            }
            $data = $res->get();
            
            return $data;
        }
    }
    
    public function copyField($from,$to){
        if($to == ''){
            return $from;
        }
        return $to;
    }
    
    public function fyList(){
        $cfy = BaseModel::getFiscalYear();
        $fys [$cfy]= $cfy.'/'.($cfy+1);
        $dta = DB::table('tblPatrikaAttendance')->select('fiscalyear')->distinct('fiscalyear')->get();
        if(count($dta)>0){
            foreach($dta as $d){
                $fys[$d->fiscalyear]=$d->fiscalyear;
            }
        }
        return $fys;
    }
    public function fyList1(){
        $cfy = BaseModel::getFiscalYear();
        $fys [$cfy]= $cfy;
        $dta = DB::table('tblPatrikaAttendance')->select('fiscalyear')->distinct('fiscalyear')->get();
        if(count($dta)>0){
            foreach($dta as $k => $d){
                $fys[$k]=$d->fiscalyear;
            }
        }
        return $fys;
    }
    
    public function getAstrik(){
        $astrik = [];
        $rules = $this->rules;
        foreach($rules as $k=>$r){
            if($r == 'nullable'){
                continue;
            }elseif(strpos($r, '|') !== false){
                $rarr = explode('|',$r);
                if(in_array('nullable', $rarr)){
                   continue;
                }
            }
            $astrik[]=$k;
        }
        return $astrik;
    }
    public function getDs(){
        $ds= $this->digital;
        return $ds;
    }
    public function getDateandTime($datetime){
        $date = Date('Y-m-d', strtotime($datetime));
        $time = Date('H:i A',strtotime($datetime));
        $date= (new \App\BaseModel())->nepDate($date);
        $data['date'] =$date;
        $data['time'] =$time;
        return $data;
    }
    
    public function parseDS($rawString){
        $array = parse_ini_string($rawString);
        return (object) $array;
    }

}
