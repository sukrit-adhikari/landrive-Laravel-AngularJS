<?php

use App\Http\Controllers\Landrive\Bin\LandriveStorageController;

$FSO = new COM('Scripting.FileSystemObject');
$Drives = $FSO->Drives;
$type = ["Unknown","Removable","Fixed","Network","CD-ROM","RAM Disk"];

$systemDrives = [];

foreach($Drives as $d ){

  $dO = $FSO->GetDrive($d);
  $s = "";
  if($dO->DriveType == 3){
    $n = $dO->Sharename;
  }else if($dO->IsReady){
    $n = $dO->VolumeName;
    $s = drive_size($dO->FreeSpace) . " free of: " . drive_size($dO->TotalSize);
  }else{
    $n = "[Drive not ready]";
  }

  $systemDrives[$dO->DriveLetter] = [
    'driver' => 'local',
    'name' => $type[$dO->DriveType].' '.$s,
    'root' => ($dO->DriveLetter).':\\',
  ];

}

function drive_size($size)
{
  $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
  return $size ? round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
}

$defaultDrives = [

  'My Drive' => [
    'driver' => 'local',
    'name' => 'My Private drive.',
    'root'   => LandriveStorageController::getDefaultLandriveStoragePath(),
  ],


  'Shared' => [
    'driver' => 'local',
    'name' => 'Shared drive.',
    'root'   => LandriveStorageController::getSharedLandriveStoragePath(),
  ],



];


$disks = array_merge($defaultDrives,$systemDrives);

return [

	/*
	|--------------------------------------------------------------------------
	| Default Filesystem Disk
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default filesystem disk that should be used
	| by the framework. A "local" driver, as well as a variety of cloud
	| based drivers are available for your choosing. Just store away!
	|
	| Supported: "local", "s3", "rackspace"
	|
	*/

	'default' => 'local',

	/*
	|--------------------------------------------------------------------------
	| Default Cloud Filesystem Disk
	|--------------------------------------------------------------------------
	|
	| Many applications store files both locally and in the cloud. For this
	| reason, you may specify a default "cloud" driver here. This driver
	| will be bound as the Cloud disk implementation in the container.
	|
	*/

	'cloud' => 's3',

	/*
	|--------------------------------------------------------------------------
	| Filesystem Disks
	|--------------------------------------------------------------------------
	|
	| Here you may configure as many filesystem "disks" as you wish, and you
	| may even configure multiple disks of the same driver. Defaults have
	| been setup for each driver as an example of the required options.
	|
	*/

	'disks' => $disks

];
