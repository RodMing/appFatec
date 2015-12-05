<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GcmModel extends Model {
	protected $table = 'gcm_register';
    protected $fillable = ['registration_id'];
    public $timestamps = false;
}
