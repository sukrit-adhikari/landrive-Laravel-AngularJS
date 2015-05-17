<?php namespace App\Http\Controllers\Landrive\Response;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

class LandriveResponseController extends Controller {

  private $response ;
  private $defaultMessage = ['200' => 'Success.',
                             '401' => 'Authentication Failed!',
                             '403' => 'Access denied!',
                             '404' => 'Not Found.',
                             '500' => 'Server encountered some problem.',
                            ];

  public function __construct(){
//    $this->response = new ob
  }

  public function response($responseKey , $responseValue){

  }

  public function respond(){

  }

  public function respond200($Message = null, $payload = null){

  }

  public function respond401($Message = null, $payload = null){

  }

  public function respond404($Message = null, $payload = null){

  }

  public function respond403($Message = null, $payload = null){

  }

  public function respond500($Message = null, $payload = null){

  }

}