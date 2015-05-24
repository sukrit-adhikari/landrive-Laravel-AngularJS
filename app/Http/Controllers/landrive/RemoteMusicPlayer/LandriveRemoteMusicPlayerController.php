<?php namespace App\Http\Controllers\Landrive\RemoteMusicPlayer;

use App\Http\Controllers\controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class LandriveRemoteMusicPlayerController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

    }

	/**
	 *
	 * Return all the playlist
	 * @return Response
	 */
	public function index(){

      $allRemoteMusicPlayer = DB::table('remotemusicplayer')->get();

      $response = ['Status' => 1 , 'Message' => 'Playlist.' , 'Code' => 200 , 'remotemusicplayer' => $allRemoteMusicPlayer];

      return Response::json($response);

	}

    public function post(){

    }

    public function clearAll(){

    }

    public function clear(){

    }

}
