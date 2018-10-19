<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walkin extends Model
{
    protected $fillable = [
		 'name'
	 ];

	/**
	 * We are going to save the service time into the database
	 * @param $value (selected value of the dropdown list)
	 */
	public function setServiceTimeAttribute($value) {
    	$services = [
			'tr_cut' => 20,
			'sp_cut' => 25,
			'beard' => 10,
			'shave' => 15,
			'cut_beard' => 30,
			'cut_shave' => 35
		];

    	$this->attributes['service_time'] = $services[$value];
	 }
}
