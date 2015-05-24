<?php namespace App\Http\Controllers\Landrive\Response;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

class LandriveResponseController extends Controller {

  private $response ;
  private $defaultMessage = ['200' => 'Success.',
                             '400' => 'Bad request.',
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
    $httpCode = 200;
  }

  public function respond400($message = null, $payload = null){
    $httpCode = 400;
  }

  public function respond401($message = null, $payload = null){
    $httpCode = 401;
  }

  public function respond404($message = null, $payload = null){
    $httpCode = 404;
  }

  public function respond403($message = null, $payload = null){
    $httpCode = 403;
  }

  public function respond500($message = null, $payload = null){
    $httpCode = 500;
  }

}