<?php namespace App\Http\Controllers\Landrive\Bin;

use App\Drive;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Landrive\Bin\LandriveUserStorageController;
use COM;

class LandriveSystemController extends Controller {


  public static function getFullSystemPath($driveName , $path){
    $drives = LandriveUserStorageController::getUserDrives();
    $fullPath = $drives[$driveName]['root'] . '\\' . $path;

    return $fullPath;

  }

  public static function getSystemDrives(){


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
            'info' => $driveDetail->DriveLetter . ":\\\ ",
            'root' => ($driveDetail->DriveLetter).':\\',
            'type' => $type[$driveDetail->DriveType]
          ];

        }

      }catch (\PhpSpec\Exception\Exception $e){
        $systemDrives = [];
      }

    }

    return $systemDrives;


  }

  public static function installSystemDrives(){

    $allDrives = self::getSystemDrives();

    Drive::where('driveid', '>', 0)->delete();

    foreach($allDrives as $driveDetail){
      if($driveDetail['type'] == 'Fixed'){ // Only store fixed drives
        $drive = new Drive();
        $drive->alias = $driveDetail['info'];
        $drive->type = $driveDetail['type'];
        $drive->root = $driveDetail['root'];
        $drive->path = '';
        $drive->ownerid = '1';
        $drive->referencedrive = '';
        $drive->save();
      }
    }
  }

}