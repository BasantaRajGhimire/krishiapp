<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DbLog extends Model
{
    protected $primaryKey='id';
	protected $table = "dblog";
	public $timestamps = true;
	protected $fillable = ['user_id','user_table','action','exception','line_number'];
    
    
    public function storeLog($request, $exception){
        $this->user_id = session('cuserid')??session('suserid')??session('userid');
        $this->action = $request->fullUrl();
        $this->exception = $exception->getMessage();
        $this->user_table = (new Auth)->userTable();
        $this->line_number = $exception->getLine();
        $this->save();
    }
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d M, Y H:i:s');
    }
}
