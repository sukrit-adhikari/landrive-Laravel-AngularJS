<?php namespace App\Http\Controllers;

class LandriveStorageController extends Controller {
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getLandriveStoragePath()
	{
    if(!is_dir(storage_path()."\landrivestorage")){
      if(!mkdir(storage_path()."\landrivestorage")){
        $message = "Error making the main Storage Folder.";
        //App::abort(500, );
        die($message);
      }
    }
    return storage_path()."\landrivestorage";
	}


  public function createUserStorageDirectory($directoryName){

    $mainStorage = $this->getLandriveStoragePath();

  }


}