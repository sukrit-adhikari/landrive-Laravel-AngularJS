<?php namespace App\Http\Controllers;

class LanDriveSPAController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
      // Attach MiddleWare //
      $this->middleware('LanDrivePermissionCheckForRequestedAction');
      $this->middleware('LanDriveRequestResponseLogger');
      // End of Attaching Middleware
    }

	/**
	 * Single Page Application's main page
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('vendor\landrivebrowser\landrivebrowser');
	}

    /**
    * @return \Illuminate\View\View\
    */
    public function getPartialHome(){
      return view('vendor\landrivebrowser\angular\partials\tabs\home');
    }

    /**
    * @return \Illuminate\View\View
    */
    public function getPartialBrowse(){
      return view('vendor\landrivebrowser\angular\partials\main\browse');
    }

    /**
    * @return \Illuminate\View\View
    */
    public function getPartialView(){
      return view('vendor\landrivebrowser\angular\partials\main\view');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getPartialAdd(){
      return view('vendor\landrivebrowser\angular\partials\main\add');
    }


    /**
     * @return \Illuminate\View\View
     */
    public function getPartialLogin(){
      return view('vendor\landrivebrowser\angular\partials\tabs\login');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getPartialLogout(){
      return view('vendor\landrivebrowser\angular\partials\tabs\logout');
    }
}
