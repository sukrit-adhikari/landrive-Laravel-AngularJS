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
        abort(500, "Error making the main Storage Folder.");
      }
    }
    return storage_path()."\landrivestorage";
	}
}