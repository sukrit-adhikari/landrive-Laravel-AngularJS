<?php namespace App\Http\Controllers;

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

}