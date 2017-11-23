@extends('layouts.master')
@section('populares')
	<h1 class="mov_title">Popular movies</h1>
	<!--se inicializa con la funcion showData-->
	<div ng-app="movies_app" ng-controller="moviesCtrl" ng-init="showData()">
		<div class="row row_flex">
			<!--<input ng-model="q" id="search" class="form-control" placeholder="Search movie">-->
			<div class="col-xs-1 col-md-1 paging">
				<button class="c_page" ng-disabled="curPage == 0" ng-click="curPage=curPage-1"><span class="glyphicon glyphicon-triangle-left"></span></button>
			</div>
			<div class="col-xs-10 col-md-10">
				<div class="row row_flex">
					<!--usamos ng-repeat para crear dinamicamente el dom de cada pelicula-->
					<div ng-repeat="datalist in datalists | pagination: curPage * pageSize | limitTo: pageSize" class="col-xs-6 col-md-6">
						<div class="thumbnail" style="height: 100%;">
							<img src="http://image.tmdb.org/t/p/w185/[[datalist.imagen]]" alt="[[datalist.titulo]]">
							<div class="caption">
								<h3 class="inline name_movie">[[datalist.titulo]]</h3>
								<a id="m_[[datalist.id]]" ng-click="favoritas(datalist.id,datalist.titulo,datalist.imagen,datalist.sinopsis)" ng-class="{'star_a':true,'star-active': (fav.indexOf(datalist.id)>-1)}" title="Favorite"><span class="glyphicon glyphicon-star right"></span></a>
								<p align="justify" class="synopsis"><b>Synopsis: </b>[[datalist.sinopsis]]</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-1 col-md-1 paging">
				<button class="c_page" ng-disabled="curPage >= datalists.length/pageSize - 1" ng-click="curPage = curPage+1"><span class="glyphicon glyphicon-triangle-right"></span></button>
			</div>
		</div>
	</div>
	<script>
		//se cambian las dobles llaves de Angular por doble corchete para evitar confusiones
		var app=angular.module('movies_app',['ngAnimate'], function($interpolateProvider){
			$interpolateProvider.startSymbol('[[');
			$interpolateProvider.endSymbol(']]');
		});
		//se define el controler
		app.controller('moviesCtrl',function($scope,$http,$window){
			$scope.fav=<?php echo $mov?>;
			//funcion para mostrar los datos y paginarlos
			$scope.showData=function(){
				$scope.width=$window.innerWidth;
        		$scope.height=$window.innerHeight;
        		if($scope.width<=500)
					$scope.pageSize=1;
				else
					$scope.pageSize=2;
        		angular.element($window).bind('resize', function(){
	            	$scope.$apply(function(){
	                	$scope.width=$window.innerWidth;
	                	$scope.height=$window.innerHeight;
	                	if($scope.width<=500)
						$scope.pageSize=1;
					else
						$scope.pageSize=2;
	                });
        		});
        		$scope.curPage=0;
				$scope.datalists=<?php echo $result?>;
				$scope.numberOfPages=function(){
					return Math.ceil($scope.datalists.length / $scope.pageSize);
				};
			}
			//funcion que manda a llamar la api para insercion de datos en la bd
			$scope.favoritas=function(id,titulo,img,sinop){
				if(($scope.fav.indexOf(id)==-1)){
					$scope.fav.push(id);
					$http({
						method:'POST',
						url:'api/favoritas',
						data:{
							movid: id,
							title: titulo,
							sinopsis: sinop,
							imagen: img
						}
					}).then(function successCallback(response){
						console.log(response);
					},function errorCallback(response){
						console.log(response);
					});
				}
			}
		});
		angular.module('movies_app').filter('pagination',function(){
			return function(input,start){
				start=+start;
				return input.slice(start);
			};
		});
		$(document).ready(function(){
			if($('#fav').hasClass('active'))
				$('#fav').removeClass('active');
			$('#pop').addClass('active');
		});
	</script>
@endsection