<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walkin extends Model
{
    protected $fillable = [
		 'name',
		 'service'
	 ];


	/**
	 * we create an additional attribute based on the 'service' value
	 */
	public function setServiceTimeAttribute() {
    	$services = [
			'tr_cut' => 20,
			'sp_cut' => 25,
			'beard' => 10,
			'shave' => 15,
			'cut_beard' => 30,
			'cut_shave' => 35
		];

    	$this->attributes['service_time'] = (int)$services[$this->attributes['service']];
	 }
}
