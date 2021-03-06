<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walkin extends Model
{
    protected $fillable = [
		 'customer_name',
		 'service'
	 ];


	/**
	 * we create an additional attribute based on the 'service' value
	 */
	public function setServiceTimeAttribute() {
    	$services = [
			'Traditional Haircut' => 20,
			'Specialty Haircut' => 25,
			'Beard Edge-up' => 10,
			'Full Shave' => 15,
			'Haircut and Beard Edge-up' => 30,
			'Haircut and Full Shave' => 35
		];

    	$this->attributes['service_time'] = (int)$services[$this->attributes['service']];
	 }

	/**
	 * create a query for records that updated earlier than $currTime
	 *
	 * @param $query
	 * @param $currTime
	 * @return mixed
	 */
	public function scopeBefore($query, $currTime) {
		return $query->where('updated_at', '<=', $currTime);
	}

}