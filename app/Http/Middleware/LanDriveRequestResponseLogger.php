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

      $requestCode = time().rand(1,100).rand(100,999);

      DB::table('landrivelog')->insert(
        [
         'requestcode' => $requestCode,
         'datetime' => date('Y/m/d H:i:s'),
         'url' => Request::url(),
         'clientipaddress' => $_SERVER['REMOTE_ADDR'],
         'requestorresponse' => 'request',
         'header' => serialize(apache_request_headers()),
         'data' => serialize(Input::all()),
        ]
      );

      $response =  $next($request);



      DB::table('landrivelog')->insert(
        [
          'requestcode' => $requestCode,
          'datetime' => date('Y/m/d H:i:s'),
          'url' => Request::url(),
          'clientipaddress' => $_SERVER['REMOTE_ADDR'],
          'requestorresponse' => 'response',
          'header' => serialize([]),
          'data' => serialize([]),
        ]
      );

      return $response;

	}

}
