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
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('vendor\landrivebrowser\landrivebrowser');
	}

}
