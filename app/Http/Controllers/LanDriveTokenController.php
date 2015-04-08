<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

class LanDriveTokenController extends Controller {

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {

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
   *
   */
  public function getToken(){

    $tokenGenerated = ['status' => 0 , 'Message' => "Authentication failed!" , "Token" => ""];

    $inputs = Input::all();

    if(!isset($inputs['name'])){
      return $tokenGenerated;
    }
    if(!isset($inputs['password'])){
      return $tokenGenerated;
    }

    $name = $inputs['name'];
    $password = ($inputs['password']);

    $userQueryResult = DB::select('SELECT password FROM users WHERE name = :name LIMIT 1', ['name' => $name]);

    if(!$userQueryResult){
      return $tokenGenerated;
    }

    if(Hash::check($password,$userQueryResult[0]->password)){
      $tokenGeneratedString = $this->getNewToken($name.rand(100,9999).$password.time());
      $this->updateToken($name, $tokenGeneratedString);
      $tokenGenerated = ['Status' => 1, "Message" => "New token generated.", "Token" => $tokenGeneratedString];
    }

    return $tokenGenerated;

  }


  private function getNewToken($data = ""){

    $string = Hash::make($data);

    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

     $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

    return $string;

  }

  private function updateToken($userName , $newToken = "" ){

    User::where('name', '=', $userName)->update(['landriveAccessToken' => $newToken]);

  }

  public function revokeToken(){
    $name = Input::get('landriveusername');

    User::where('name', '=', $name)->update(['landriveAccessToken' => ""]);

    return ['Status' => '1' , 'Message' => 'Token is reset.'];

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