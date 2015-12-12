<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'Home@index');

$app->post('/', 'Cliente@index');

$app->get('notificacao', function(){return redirect('/');});

$app->post('notificacao', 'Notificacao@notificar');