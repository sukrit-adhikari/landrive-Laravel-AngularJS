<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class LanDriveRequestResponseLogger {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
      if(!config('landrive.logrequestresponse')){
        $response =  $next($request);
        return $response;
      }

      $requestCode = time().rand(1,100).rand(100,999);


      $datetime = date('Y/m/d H:i:s');
      $requestURL = Request::url();

      DB::table('landriveaccesslog')->insert(
        [
         'requestcode' => $requestCode,
         'datetime' => $datetime,
         'url' => $requestURL,
         'clientipaddress' => $_SERVER['REMOTE_ADDR'],
         'requestorresponse' => 'request',
         'header' => serialize(apache_request_headers()),
         'data' => serialize(Input::all()),
        ]
      );

      $response =  $next($request);

      DB::table('landriveaccesslog')->insert(
        [
          'requestcode' => $requestCode,
          'datetime' => $datetime,
          'url' => $requestURL,
          'clientipaddress' => $_SERVER['REMOTE_ADDR'],
          'requestorresponse' => 'response',
          'header' =>'' , // serialize([])
          'data' => '', //serialize([])
        ]
      );

      return $response;

	}

}
