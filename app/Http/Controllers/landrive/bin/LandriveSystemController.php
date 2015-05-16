<?php namespace App\Http\Controllers\Landrive\Bin;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Landrive\Bin\LandriveUserStorageController;

class LandriveSystemController extends Controller {


  public static function getFullSystemPath($driveName , $path){
    $drives = LandriveUserStorageController::getUserDrives();
    $fullPath = $drives[$driveName]['root'] . '\\' . $path;

    return $fullPath;

  }

  public static function getSystemDrives(){


  }

  public static function refreshSystemDrives(){
    $systemDrives = [];

    if(class_exists('COM')){
      try{

        $FSO = new COM('Scripting.FileSystemObject');
        $Drives = $FSO->Drives;
        $type = ["Unknown","Removable","Fixed","Network","CD-ROM","RAM Disk"];

        foreach($Drives as $drive ){

          $driveDetail = $FSO->GetDrive($drive);
          $s = "";
          if($driveDetail->DriveType == 3){
            $n = $driveDetail->Sharename;
          }else if($driveDetail->IsReady){
            $n = $driveDetail->VolumeName;
            $s = drive_size($driveDetail->TotalSize - $driveDetail->FreeSpace) . " / " . drive_size($driveDetail->TotalSize);
          }else{
            $n = "[Drive not ready]";
          }

          $systemDrives[$driveDetail->DriveLetter] = [
            'driver' => 'local',
            'info' => $driveDetail->DriveLetter . ":\\\ ",// . $type[$driveDetail->DriveType].' '.$s,
            'root' => ($driveDetail->DriveLetter).':\\',
          ];

        }
      }catch (\PhpSpec\Exception\Exception $e){
        $systemDrives = [];
      }

    }


  }

}