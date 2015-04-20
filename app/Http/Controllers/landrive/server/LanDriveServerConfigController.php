<?php namespace App\Http\Controllers;

class LanDriveServerConfigController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

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
		return view('landriveserverconfig' , ['config' => $this->decorateConfiguration(Config('landrive'))]);
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
