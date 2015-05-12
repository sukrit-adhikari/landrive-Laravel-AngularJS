<?php namespace App\Http\Controllers\Landrive\Token;

use App\Events\AccessTokenWasProvided;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Event;
use App\Http\Controllers\controller;
use App\Commands\PushbulletNotification;

class LanDriveTokenController extends Controller {

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('LanDriveRequestResponseLogger');
  }

  /**
   * Show the application dashboard to the user.
   *
   * @return Response
   */
  public function index()
  {
//    return view('home');
  }

  /**
   * Provides access token to requesting user
   */
  public function getToken(){

    $tokenGenerated = ['Status' => 0 , 'Message' => "Authentication failed!" , "Token" => ""];

    $inputs = Input::all();

    if(!isset($inputs['landriveusername'])){
      return $tokenGenerated;
    }
    if(!isset($inputs['password'])){
      return $tokenGenerated;
    }

    $name = $inputs['landriveusername'];
    $password = ($inputs['password']);

    $userQueryResult = DB::select('SELECT password FROM users WHERE name = :name LIMIT 1', ['name' => $name]);

    if(empty($userQueryResult)){
      return $tokenGenerated;
    }

    if(Hash::check($password,$userQueryResult[0]->password)){
      $tokenGeneratedString = $this->getNewRandomToken($name.rand(100,9999).time());
      $this->updateToken($name, $tokenGeneratedString);
      $tokenGenerated = ['Status' => 1, 'Code' => 200 , "Message" => "New token generated.", "Token" => $tokenGeneratedString];
    }

    $title = 'Landrive Access Granted.';

    $message = "";
    $message.= "User : ".$name."\n\n";
    $message.= "Device : ".Request::header('User-Agent')."\n\n";
    $message.= "Time : " . date('Y-m-d H:i:s')."\n\n";
    $message.= "IP : " .$_SERVER['REMOTE_ADDR']."\n\n";
    $message.= "Access Token : ".$tokenGeneratedString."\n\n";

    $notification = ['title' => $title, 'message' => $message];
    $accessDetail = ['landriveusername' => $name, 'token' => $tokenGeneratedString];

    Event::fire(new AccessTokenWasProvided($accessDetail,$notification));


//    $pbn = new PushbulletNotification($notification);
//
//    $pbn->handle();

    return $tokenGenerated;

  }


  private function getNewRandomToken($data = ""){

    $string = Hash::make(str_shuffle($data));

    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

     $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

    return str_shuffle($string);

  }

  private function updateToken($userName , $newToken = "" ){

    User::where('name', '=', $userName)->update(['landriveAccessToken' => $newToken]);

  }

  public function revokeToken(){
    $name = Input::get('landriveusername');

    User::where('name', '=', $name)->update(['landriveAccessToken' => ""]);

    return ['Status' => '1' , 'Code' => 200 , 'Message' => 'Token is revoked.'];

  }

  public static function requestHasValidToken(){

    $name = Input::get('landriveusername');
    $lanDriveAccessToken = Input::get('landriveaccesstoken');

    if(trim($lanDriveAccessToken) == '' || trim($name) == ''){
      return false;
    }

    $validUser =  User::whereRaw('name = ? and landriveaccesstoken = ?', [$name,$lanDriveAccessToken])->get()->toArray();

    if(empty($validUser)){
      return false;
    }

    return true;
  }




}