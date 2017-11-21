<?php

namespace App\Http\Controllers;

/*use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;*/
use App\Http\Controllers\Controller;

class ControllerMovies extends Controller
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function getPopular(){
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.themoviedb.org/3/movie/popular?page=1&api_key=eb9fee2b608ac94d02b59c9c30622e7d",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => "{}",
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err)
		  echo "cURL Error #:" . $err;
		else{
			$res=array();
			$response=json_decode($response);
			$l=count($response->results);
			for($i=0;$i<$l;$i++){
				array_push($res,array('titulo'=>$response->results[$i]->title,'sinopsis'=>$response->results[$i]->overview,'imagen'=>$response->results[$i]->poster_path));
			}
			//echo '<br>'.$total.'<br>';
			//print_r($res);
			return view('popular',['total'=>$l,'result'=>$res]);
		}
	}
}
