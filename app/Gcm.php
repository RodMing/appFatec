<?php
namespace App;

use PHP_GCM\Sender;
use PHP_GCM\Message;
use DB;

class Gcm{
	public function send($mensagem)
	{
		$sender = new Sender('AIzaSyAZrGXSd_KQ-NFfCdZxNhar6MthsNEX1x0');
		$message = new Message('', ['message'=>$mensagem]);

		$errors = array();
		$success = array();

		try {
			$clientes = $this->getAllClientes();

			foreach ($clientes as $cliente) {
				$result = $sender->send(
			    	$message,
			    	$cliente->RegistrationId,
			    	10
			    );

			    if (!$result->getErrorCode()) {
			    	$errors[] = $cliente->RegistrationId;
			    } else {
			    	$success[] = $cliente->RegistrationId;
			    }
			}

		} catch (\InvalidArgumentException $e) {
		    dd($e);
		} catch (\PHP_GCM\InvalidRequestException $e) {
		    dd($e);
		} catch (\Exception $e) {
		    dd($e);
		}

		var_export($success);
		dd($errors);
	}

	private function getAllClientes()
	{
		return DB::select("SELECT RegistrationId FROM Cliente");
	}
}
