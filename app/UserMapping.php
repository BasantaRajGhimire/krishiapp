<?php

namespace App;
use Session;
class UserMapping extends BaseModel
{
     protected $primaryKey='id';

	protected $table = "user_mapping";
	public $timestamps = false;
	protected $fillable = ['user_id','email','mapping_id'];
	protected $rules = ['user_id' => 'string|required',
	'email'=>'string|required',
	'mapping_id'=>'string|required',
	
	];
     

     public function login($email,$mappingid){
        $user = $this::where(['email' => $email, 'mapping_id' => $mappingid])
                ->first();
        if(!empty($user)){
            session([
                    'logged_in'=>true,
                    'user_mapping_id'=>$user->id
                    ]);
                return true;
        }else{
            return false;
        }
    }
     public function logout() {
        Session::flush();
    }   
}
