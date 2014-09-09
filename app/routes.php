<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@home');
Route::get('/ver/{any}', 'HomeController@home');

Route::post('/invitacion/{id}/confirmar', 'HomeController@confirmInvitation');
Route::post('/invitacion/{id}/declinar', 'HomeController@declineInvitation');

Route::group(array('before' => 'auth.basic'), function() {
	Route::get('/invitados', 'AdminController@showAdmin');
	Route::post('/invitados', 'AdminController@saveInvites');
	Route::get('/invitados/lista', 'AdminController@showList');
	Route::post('/invitados/grupo', 'GroupsController@store');
	Route::get('/invitaciones', 'AdminController@listInvitations');
	Route::post('/invitaciones/enviar', 'AdminController@dispatchInvitations');
});

