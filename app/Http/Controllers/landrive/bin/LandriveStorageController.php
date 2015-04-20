<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use PhpSpec\Exception\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


class LandriveStorageController extends Controller {
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getDefaultLandriveStoragePath()
	{
      // If authentication is turned off
      if(!isset($_REQUEST['landriveusername']) || trim($_REQUEST['landriveusername']) == ''){
        $_REQUEST['landriveusername'] = "public";
      }

      $expectedPath = storage_path()."\landrivestorage\\".$_REQUEST['landriveusername'];
      $message = "Error making the default Storage Folder.";

      if(!is_dir($expectedPath)){
        if(!mkdir($expectedPath)){
          //App::abort(500, );
          die($message);
        }
      }
      return $expectedPath;
  }


  public function getSharedLandriveStoragePath()
  {
    $expectedPath = storage_path()."\landrivestorage\public";
    $message = "Error making the shared Storage Folder.";

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

//      if($getRoot){
//        $drives[$driveName]['root'] = Crypt::encrypt($drives[$driveName]['root']);
//      }else{
//        unset($drives[$driveName]['root']);
//      }

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

  public function create($detail = [] , $type){
    $requestParameters = $detail;

    $filePath = $requestParameters['path'].'\\'.$requestParameters['name'];

    $message = 'Problem creating '. $type;

    if(!Storage::disk($requestParameters['drive'])->exists($filePath)){

      if($type == 'file'){
        $result  = Storage::disk($requestParameters['drive'])
          ->put($requestParameters['path'].'\\'.$requestParameters['name'],$requestParameters['content']);

        if($result){
          $message = 'Created.';
          return ['Status' => 1, 'Code' => 200 , 'Message' => $message ];
        }
      }else{

        $result  = Storage::disk($requestParameters['drive'])
          ->createDir($requestParameters['path'].'\\'.$requestParameters['name']);

        if($result){
          $message = 'Created.';
          return ['Status' => 1, 'Code' => 200 , 'Message' => $message ];
        }

      }

    }else{
      // Already Exist
    }

    return ['Status' => 0, 'Code' => 500 , 'Message' => $message ];
  }


  public function download($drive,$path,$fileName){

    if(!Storage::disk($drive)->exists($path)){
      return ['Status' => 0 , 'Message' => 'Does not exist.' , 'Code' => 404 ];
    }

    $fileContent = Storage::disk($drive)->get($path);

    $tmpName = tempnam(sys_get_temp_dir(), 'lan');
    $file = fopen($tmpName, 'w');

    file_put_contents( $tmpName ,$fileContent);
    fclose($file);


    header('Content-Description: File Transfer');
//    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename='.$fileName);
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