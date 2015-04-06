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

    if($path != null){
      $directories = Storage::disk($drive)->directories($path);
      $files = Storage::disk($drive)->files($path);
    }else{
      $directories = Storage::disk($drive)->directories();
      $files = Storage::disk($drive)->files();
    }


    $all = [
            $drive =>  [
                        'files' => $files,
                        'directories' => $directories,
                       ]
           ];

    return $all;

  }

  public function createFile($detail = []){
    $requestParameters = $detail;

    // Check Valid request i.e contains all the parameters required
    // Check Valid Drive
    // Check Valid Path
    // Check Permission
    // Check If file/Directory already Exists

    $filePath = $requestParameters['path'].'\\'.$requestParameters['name'];

    $message = '';

    if(!Storage::disk($requestParameters['drive'])->exists($filePath)){

      $result  = Storage::disk($requestParameters['drive'])
        ->put($requestParameters['path'].'\\'.$requestParameters['name'],$requestParameters['content']);

      if($result){
        $message = 'Created.';
        return ['success' => 1, 'message' => $message];
      }

    }else{
      $message = 'Already exists.';
    }

    return ['success' => 0, 'message' => $message];
  }

  public function createDirectory($detail = []){

  }

  public function download(){

  }

}