<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use PhpSpec\Exception\Exception;


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
  public function getUserDrives($user = null , $getRoot = false){

    $drives = Config::get('filesystems.disks');

    foreach($drives as $driveName => $driveDetail){

      if($getRoot){
        $drives[$driveName]['root'] = Crypt::encrypt($drives[$driveName]['root']);
      }else{
        unset($drives[$driveName]['root']);
      }

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
        return ['success' => 1, 'message' => $message , 'Code' => 200];
      }

    }else{
      $message = 'Problem creating file.';
    }

    return ['success' => 0, 'message' => $message , 'Code' => 500];
  }

  public function createDirectory($detail = []){

  }

  public function download($drive,$path){

    if(!Storage::disk($drive)->exists($path)){
      return ['Status' => 0 , 'Message' => 'Does not exist.' , 'Code' => 404 ];
    }

    $fileContent = Storage::disk($drive)->get($path);

    $tmpName = tempnam(sys_get_temp_dir(), 'lan');
    $file = fopen($tmpName, 'w');

    file_put_contents( $tmpName ,$fileContent);
    fclose($file);

    $downloadName = rand(9,99999);

    header('Content-Description: File Transfer');
//    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename='.$downloadName);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($tmpName));

    ob_clean();
    flush();
    readfile($tmpName);

    unlink($tmpName);

  }

}