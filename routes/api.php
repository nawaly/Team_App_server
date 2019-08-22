<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Album routes == Route::_('',['uses'=>Controller@FunctionName]);
Route::get('albums',['uses'=>'AlbumController@getAlbums']); //return all
Route::post('album/{authorId}',['uses'=>'AlbumController@postAlbum']); //create one
Route::get('album/{albumId}',['uses'=>'AlbumController@getAlbum']); //return one
Route::put('album/{albumId}',['uses'=>'AlbumController@putAlbum']); //update one
Route::delete('album/{albumId}',['uses'=>'AlbumController@deleteAlbum']); //remove one
Route::get('album/cover/{albumid}',['uses'=>'AlbumController@viewFile']);

Route::get('authors',['uses'=>'AuthorController@getAuthors']);
Route::post('author',['uses'=>'AuthorController@postAuthor']);
Route::get('author/{authorId}',['uses'=>'AuthorController@getAuthor']);
Route::put('author/{authorId}',['uses'=>'AuthorController@putAuthor']);
Route::delete('author/{authorId}',['uses'=>'AuthorController@deleteAuthor']);

Route::get('categories',['uses'=>'CategoryController@getCategories']);
Route::post('category',['uses'=>'CategoryController@postCategory']);
Route::get('category/{categoryId}',['uses'=>'CategoryController@getCategory']);
Route::put('category/{categoryId}',['uses'=>'CategoryController@putCategory']);
Route::delete('category/{categoryId}',['uses'=>'CategoryController@deleteCategory']);

Route::get('news',['uses'=>'NewController@getNews']);
Route::post('new',['uses'=>'NewController@postNew']);
Route::get('new/{newId}',['uses'=>'NewController@getNew']);
Route::put('new/{newId}',['uses'=>'NewController@putNew']);
Route::delete('new/{newId}',['uses'=>'NewController@deleteNew']);







