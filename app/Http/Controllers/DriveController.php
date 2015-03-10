<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Exception;

class DriveController extends Controller {


  public function __construct(){
//    $this->mid
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    return $this->getUserDrives();
	}

  /**
   * Get Drives Supplied User Has access to
   * @param null $user
   * @return mixed
   */
  private function getUserDrives($user = null){

    $drives = Config::get('filesystems.disks');

    foreach($drives as $driveName => $driveDetail){
      //$drives[$driveName]['root'] = Crypt::encrypt($drives[$driveName]['root']);
      unset($drives[$driveName]['root']);
      unset($drives[$driveName]['landriveAllAccess']);
      unset($drives[$driveName]['driver']);
    }

    return $drives;
  }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
    $inputs = Input::all();
    $disk = $inputs['disk'];


    $directories = Storage::disk($disk)->directories();
    $files = Storage::disk($disk)->files();

    $all = [
              'files' => $files,
              'directories' => $directories,
           ];

    return $all;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
    //
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
