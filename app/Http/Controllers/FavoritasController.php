<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movies;

class FavoritasController extends Controller{
	//funcion que devuelve todas las peliculas favoritas
    public function index(){
    	//$byuser=Movies::where('user',1)->get();
        return view('favoritas',['ar'=>json_encode(Movies::all())]);
	}
	//funcion para guardar los datos en la bd
    public function store(Request $request){
        $input=$request->all();
		extract($input);
		Movies::create(array(
            'idmovie'=>$movid,
            'user'=>0,
            'titulo'=>$title,
            'sinopsis'=>$sinopsis,
            'imagen'=>$imagen
        ));
    }
	//funcion para eliminar una pelicula
	public function delete(Request $request,$id){
        $mov=Movies::findOrFail($id);
        $mov->delete();
    }
}
