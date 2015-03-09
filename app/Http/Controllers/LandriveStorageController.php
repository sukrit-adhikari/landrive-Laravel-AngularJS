<?php namespace App\Http\Controllers;

class LandriveStorageController extends Controller {
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getLandriveStoragePath()
	{
    $expectedPath = "f:"."\landrivestorage";
    $message = "Error making the main Storage Folder.";

    if(!is_dir($expectedPath)){
      if(!mkdir($expectedPath)){
        //App::abort(500, );
        die($message);
      }
    }
    return $expectedPath;
	}


  public function createUserStorageDirectory($directoryName){

    $mainStorage = $this->getLandriveStoragePath();

  }


}