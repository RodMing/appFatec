<?php
namespace App;

use DB;

class DaoGcm {		
	
	public function save(GcmModel $gcm){
		$gcm->registration_id = $gcm->getRegistrationId;
		return $gcm->save();
	}
	
	
	public function update(GcmModel $gcm){
		$result = DB::select("SELECT registration_id FROM gcm_register WHERE registration_id LIKE ".$gcm->getRegistrationId());
		foreach ($result as $value) {
			$value->registration_id = $gcm->getNewRegistrationId();
		}

		return $result->save();
	}
	
	
	public function delete(GcmModel $gcm){
		$result = DB::select("SELECT registration_id FROM gcm_register WHERE registration_id LIKE ".$gcm->getRegistrationId());
		if ($result) {
			return $result->delete();
		}

		return false;
	}
	
	
	public function verify(GcmModel $gcm){
		$result = DB::select("SELECT registration_id FROM gcm_register WHERE registration_id LIKE ".$gcm->getRegistrationId());
		return $result->count();
	}
	
	
	public function getAll(){
		$register = [];
		$result = DB::select("SELECT registration_id FROM gcm_register");
		foreach ($result as $value) {
			$register[] = new GcmModel($value->registration_id);
		}

		return $register;
	}
}
