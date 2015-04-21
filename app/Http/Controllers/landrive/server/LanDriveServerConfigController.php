<?php namespace App\Http\Controllers\Landrive\Server;

use App\Http\Controllers\Controller;

class LanDriveServerConfigController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('server\landriveserverconfig' , ['config' => $this->decorateConfiguration(Config('landrive'))]);
	}

    private function decorateConfiguration($config = []){

      $decorated = [];

      foreach($config as $configName => $configValue){
        $type = gettype($configValue);

        $decoreatedConfig = [];

        $decoreatedConfig['config'] = $configValue;
        $decoreatedConfig['type'] = $type;


        $decorated[$configName] = $decoreatedConfig;
      }

      return $decorated;
    }
}
