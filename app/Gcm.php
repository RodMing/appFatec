<?php
namespace App;

class Gcm {
	public function enviar(array $registrationIDs)
	{
		$tam = ceil(count($registrationIDs) / 1000); // GCM PERMITE APENAS 1000 REGISTROS POR ENVIO
		for($i = $c = 0; $i < $tam; $i++){
			
			$gcmIds = array();
			for($j = 0; $j < 1000 && isset($registrationIDs[$j + $c]); $j++){
				$gcmIds[] = $registrationIDs[$j + $c];
			}
			$c += 1000;
		
			
			// PAYLOAD DATA
				$data = array(
					'title' => 'Teste GCM ('.rand(0,20000).')',
					'author' => 'Adriano',
					'time' => date('Y-m-d H:i:s'),
					'message' => 'Novo post'
				);

			// SET POST VARIABLES
				$fields = array(
					'registration_ids' => $gcmIds,
					'collapse_key' => 'my_type',
					'delay_while_idle'=> false,
					'time_to_live' => (60*60*24),
					'restricted_package_name' => 'br.exemplogcm',
					'dry_run' => false,
					'data' => $data
				);
								
			// HEADER
				$headers = array(
					'Authorization: key=' . env('SENDER_ID'),
					'Content-Type: application/json'
				);

			dd($this->makeCurl(
				dev('GCM_URL'),
				$headers,
				$fields
			));
		}
	}

	private function makeCurl($url, array $headers, array $fields)
	{
		// OPEN CONNECTION
			$ch = curl_init();

		// SET CURL
			curl_setopt( $ch, CURLOPT_URL, $url);
			curl_setopt( $ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);


		// SEND POST
			$result = curl_exec($ch);
		// CLOSE CONNECTION
			curl_close($ch);

		return $result;
	}
}
