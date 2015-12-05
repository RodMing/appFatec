<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GcmModel extends Model {

	private $registrationId;
	private $newRegistrationId;
	protected $table = 'gcm_register';
    protected $fillable = ['registration_id'];
    public $timestamps = false;

	public function __construct(
		$registrationId = '',
		$newRegistrationId = ''
	) {
		$this->registrationId = $registrationId;
		$this->newRegistrationId = $newRegistrationId;
	}
	
	public function getRegistrationId()
	{
		return $this->registrationId;
	}

	public function setRegistrationId($registrationId)
	{
		$this->registrationId = $registrationId;
	}
	
	public function getNewRegistrationId()
	{
		return $this->newRegistrationId;
	}

	public function setNewRegistrationId($newRegistrationId)
	{
		$this->newRegistrationId = $newRegistrationId;
	}
}
