<?php
namespace App;

use PHP_GCM\Sender;
use PHP_GCM\Message;

class Gcm{
	public function send(string $mensagem)
	{
		$sender = new Sender('AIzaSyAZrGXSd_KQ-NFfCdZxNhar6MthsNEX1x0');
		$message = new Message('', ['message'=>$mensagem]);
		try {
		    $result = $sender->send(
		    	$message,
		    	\App::make('App\Usuario')->first()->registerId,
		    	10
		    );
		} catch (\InvalidArgumentException $e) {
		    dd($e);
		} catch (\PHP_GCM\InvalidRequestException $e) {
		    dd($e);
		} catch (\Exception $e) {
		    dd($e);
		}
		dd($result);
	}
}
