<?php namespace App\Http\Controllers\Landrive\Bin;

use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Controller;

class LandriveUserStorageController extends Controller {


  public static function getUserDrives(){
    return Config::get('filesystems.disks');
  }

}