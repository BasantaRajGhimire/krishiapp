<?php
 
namespace App\Exceptions;
 
use Exception;
use Illuminate\Support\Facades\Auth;
use App\DbLog;
class DBLogData extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report(){
    }
 
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception){
      // dd($exception);
      // $log->user_id = Auth::user()->id;
      // $log->action = $request->fullUrl();
      // $log->exception = $exception;
      // $log->save(); 
      // return \Redirect::back()->with('error', 'Something Went Wrong.');
    }
}