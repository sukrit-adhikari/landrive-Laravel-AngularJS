<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;


class LandriveStorageController extends Controller {
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getDefaultLandriveStoragePath()
	{
      $expectedPath = storage_path()."\landrivestorage";
      $message = "Error making the default Storage Folder.";

      if(!is_dir($expectedPath)){
        if(!mkdir($expectedPath)){
          //App::abort(500, );
          die($message);
        }
      }
      return $expectedPath;
  }

  /**
   * Get Drives Supplied User Has access to
   * @param null $user
   * @return mixed
   */
  public function getUserDrives($user = null){

    $drives = Config::get('filesystems.disks');

    foreach($drives as $driveName => $driveDetail){
      //$drives[$driveName]['root'] = Crypt::encrypt($drives[$driveName]['root']);
      unset($drives[$driveName]['root']);
      unset($drives[$driveName]['landriveAllAccess']);
      unset($drives[$driveName]['driver']);
    }

    return $drives;

  }


  public function getContents($drive = null , $path = null ){

    $directories = Storage::disk($drive)->directories();
    $files = Storage::disk($drive)->files();

    $all = [
      'files' => $files,
      'directories' => $directories,
    ];

    return $all;

  }

}