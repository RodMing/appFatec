<?php
namespace App;

use PHP_GCM\Sender;
use PHP_GCM\Message;
use DB;

class Gcm {
	public function send($mensagem)
	{
		$sender = new Sender(
			env('SENDER_ID')
		);

		$message = new Message(
			'',
			[
				'message' => $mensagem
			]
		);

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

			    if ($result->getErrorCode()) {
			    	$errors[$cliente->RegistrationId] = $result->getErrorCode();
			    } else {
			    	$success[] = $cliente->RegistrationId;
			    }
			}

		} catch (\Exception $e) {
		    dd($e);
		}

		return [
			'erro' => $errors,
			'sucesso' => $success
		];
	}

	private function getAllClientes()
	{
		return DB::select("SELECT RegistrationId FROM Cliente");
	}
}
