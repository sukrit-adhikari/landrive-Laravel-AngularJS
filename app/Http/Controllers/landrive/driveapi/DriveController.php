<?php namespace App\Http\Controllers\Landrive\Driveapi;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

use App\Http\Controllers\Landrive\Bin\LandriveStorageController;

//Verb	      Path	                Action	      Route Name
//_______________________________________________________________________________________________________________________________________
//GET	      /drive	            index	      drive.index   ^^^ List all drives
//GET	      /drive/create	        create	      drive.create  ---
//POST	      /drive	            store	      drive.store   ^^^ Create Folder or File
//GET	      /drive/{drive}	    show	      drive.show    ^^^ Show File (Image Display) or Download File or Download Folder as Zip
//GET	      /drive/{drive}/edit	edit	      drive.edit    ---
//PUT/PATCH	  /drive/{drive}	    update	      drive.update  ^^^ Copy Paste / Cut Paste
//DELETE	  /drive/{drive}	    destroy	      drive.destroy ^^^ Hard Delete / Soft Delete (Rename as DELETED_mypic.jpg)

class DriveController extends Controller {

  private $landriveStorageController;


  public function __construct(){
    $this->landriveStorageController = new LandriveStorageController();

    // Attach MiddleWare //
    $this->middleware('LanDrivePermissionCheckForRequestedAction');
    $this->middleware('LanDriveRequestResponseLogger');
    // End of Attaching Middleware

  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    return $this->landriveStorageController->getUserDrives();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
      return Input::all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(){
      $inputs = Input::all();

      if(!isset($inputs['type'])){
        return ['Status' => 0 , 'Code' => 400 , 'Message' => 'File or directory not given as parameter "type".'];
      }else if($inputs['type'] == 'file'){
        return $this->landriveStorageController->create($inputs , 'file');
      }elseif($inputs['type'] == 'directory'){
        return $this->landriveStorageController->create($inputs , 'directory');
      }

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($drive)
	{
      $inputs = Input::all();

//      $drive = $inputs['drive'];
      $path = isset($inputs['path']) && $inputs['path'] != ''  ? $inputs['path'] : null;

      $info = isset($inputs['info']) && $inputs['info'] == 'y'  ? 'y' : 'n';
      if( $info == 'y' ){
        return $this->landriveStorageController->info($drive,$path);
      }

      $download = isset($inputs['download']) && $inputs['download'] == 'y'  ? 'y' : 'n';
      if( $download == 'y' ){
        $fileName = isset($inputs['filename']) ? $inputs['filename'] && trim($inputs['filename']) != '' : null;
        return $this->landriveStorageController->download($drive,$path,$fileName);
      }

      $image = isset($inputs['image']) && $inputs['image'] == 'y'  ? 'y' : 'n';
      if( $image == 'y' ){
        return $this->landriveStorageController->image($drive,$path);
      }


      return $this->landriveStorageController->getContents($drive,$path);
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
