<?php

namespace App;

class AplGcm {
	private $dao;
	
	public function __construct()
	{
		$this->dao = new DaoGcm();
	}
	
	public function save($gcm)
	{
		if (!$this->dao->verify($gcm)) {
			return $this->dao->save($gcm);
		}

		return false;
	}
	
	public function update($gcm)
	{
		if ($this->dao->verify($gcm)) {
			$this->delete($gcm);
		}
		
		return $this->dao->update($gcm);
	}
	
	public function delete($gcm)
	{
		return $this->dao->delete($gcm);
	}
	
	public function getAll()
	{
		dd(\App::make('App\Usuario')->all());
	}
}
