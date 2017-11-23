@extends('layouts.master')
@section('favoritas')
	<h1 class="mov_title">My Favorites</h1>
	<div ng-app="my_favorites" ng-controller="favCtrl" ng-init="showData()">
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
								<a id="m_[[datalist.id]]" ng-click="delete(datalist.id,$index)" class="star_a star-active" title="Delete"><span class="glyphicon glyphicon-star right"></span></a>
								<p class="f_movie">[[datalist.created_at | date:'medium']]</p>
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
		var app=angular.module('my_favorites',['ngAnimate'], function($interpolateProvider){
			$interpolateProvider.startSymbol('[[');
			$interpolateProvider.endSymbol(']]');
		});
		//se define el controller
		app.controller('favCtrl',function($scope,$http,$window){
			//funcion para mostrar los datos y paginarlos
			$scope.showData=function(){
				$scope.width = $window.innerWidth;
        		$scope.height = $window.innerHeight;
				$scope.curPage=0;
				if($scope.width<=500)
					$scope.pageSize=1;
				else
					$scope.pageSize=2;
				$scope.datalists=<?php echo $ar?>;
				$scope.numberOfPages=function(){
					return Math.ceil($scope.datalists.length / $scope.pageSize);
				};
			}
			//funcion que manda a llamr la api, enviando como parametro el id de la pelicula para eliminarla
			$scope.delete=function(id,index){
				$http({
					method:'delete',
					url:'api/favoritas/'+id
				}).then(function successCallback(response){
					$scope.datalists.splice(index,1);
				},function errorCallback(response){
					console.log(response);
				});
			}
		});
		angular.module('my_favorites').filter('pagination',function(){
			return function(input,start){
				start=+start;
				return input.slice(start);
			};
		});
		if($('#pop').hasClass('active'))
			$('#pop').removeClass('active');
		$('#fav').addClass('active');
	</script>
@endsection