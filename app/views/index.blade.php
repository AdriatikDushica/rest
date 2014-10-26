@extends('layouts.base')

@section('content')
    <h1 class="page-header">Home</h1>


    <div ng-app="main" ng-controller="mainController">

        <div class="row">
            <div class="col-sm-8">
                <div ng-show="articles.length" class="row">
                    <div ng-repeat="article in articles" class="col-sm-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <any ng-if="article.editing">
                                    <div class="form-group">
                                        <label>Title:</label>
                                        <input type="text" ng-model="article.title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Body:</label>
                                        <textarea ng-model="article.body" class="form-control"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button ng-click="cancelEdit(article)" class="btn btn-default btn-block">cancel</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button ng-click="endEdit(article, $index)" class="btn btn-primary btn-block">update</button>
                                        </div>
                                    </div>
                                </any>
                                <any ng-if="!article.editing">
                                    <h4>@{{ article.title }}</h4>
                                    <p>@{{ article.body }}</p>
                                    <div>
                                        <button ng-click="deleteArticle(article.id, $index)" class="btn btn-danger btn-block">trash</button>
                                        <button ng-click="beginEdit(article, $index)" class="btn btn-default btn-block">edit</button>
                                    </div>
                                </any>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 ng-hide="articles.length" class="text-muted text-center">There are no articles.</h3>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail">
                    <div class="caption">
                        <form>
                            <div class="form-group">
                                <label>Title:</label>
                                <input ng-model="article.title" name="title" type="text" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Body:</label>
                                <textarea ng-model="article.body" class="form-control"></textarea>
                            </div>
                            <input ng-click="addArticle()" type="submit" class="btn btn-success" value="Add">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        angular.module('main', [])
            .controller('mainController', function($scope, $http){

                $scope.articles = [];
                $scope.article = {};

                $scope.resource = new Resource($http, '/articles');

                /*
                * INDEX REQUEST
                * */
                $scope.resource.index(function(result){
                    $scope.articles = result;
                });

                /*
                * DELETE BUTTON
                * */
                $scope.deleteArticle = function(id, index){
                    $scope.resource.destroy(id, function(result){
                        $scope.articles.splice(index, 1);
                    });
                }

                /*
                * ADD BUTTON
                * */
                $scope.addArticle = function(){
                    if($scope.article.title && $scope.article.body){
                        $scope.resource.store($scope.article, function(result){
                            $scope.articles.push(result);
                            $scope.article = {};
                        });
                    } else {
                        alert('Title or Body are empty!');
                    }
                }

                /*
                * EDIT BUTTON
                * */
                $scope.beginEdit = function(article, articleIndex){
                    $scope.articles[articleIndex].editing = true;
                }

                $scope.cancelEdit = function(article){
                    article.editing = false;
                }
                $scope.endEdit = function(article, articleIndex){
                    $scope.resource.update(article, function(result){
                        $scope.articles[articleIndex] = result;
                    });
                }

            });
        ;
    </script>

@stop