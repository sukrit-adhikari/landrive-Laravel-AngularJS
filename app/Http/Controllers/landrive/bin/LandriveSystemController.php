<?php namespace App\Http\Controllers\Landrive\Bin;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Landrive\Bin\LandriveUserStorageController;

class LandriveSystemController extends Controller {


  public static function getFullSystemPath($driveName , $path){
    $drives = LandriveUserStorageController::getUserDrives();
    $fullPath = $drives[$driveName]['root'] . '\\' . $path;

    return $fullPath;

  }

}