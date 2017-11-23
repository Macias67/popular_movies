<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ControllerMovies extends Controller{
    public function getPopular(){
		//obtenemos la lista de las peliculas mas populares
		$curl=curl_init();
		curl_setopt_array($curl,array(
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
		if($err)
		  echo "cURL Error #:" . $err;
		else{
			//se acomoda y filtra el array recibido
			$res=array();
			$response=json_decode($response);
			$l=count($response->results);
			for($i=0;$i<$l;$i++){
				array_push($res,array('id'=>$response->results[$i]->id,'titulo'=>$response->results[$i]->title,'sinopsis'=>$response->results[$i]->overview,'imagen'=>$response->results[$i]->poster_path));
			}
			$res=json_encode($res);
			$ar2=array();
			$ar=DB::select('select idmovie from movies');
			foreach($ar as $v){
				array_push($ar2,$v->idmovie);
			}
			$ar3=json_encode($ar2);
			//se manda a llamar la vista 'popular' y se envian parametros
			return view('popular',['total'=>$l,'result'=>$res,'mov'=>$ar3]);
		}
	}
	/*public function saveFav(Request $request){
		$input=$request->all();
		extract($input);
		DB::insert('insert into favoritas(idmovie,titulo,sinopsis,imagen,fecha) values(?,?,?,?,?)',[$movid,$title,$sinopsis,$imagen,date('Y-m-d')]);
	}*/
}
