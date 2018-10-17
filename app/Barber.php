<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $fillable = [
    	 'name',
		 'address',
		 'email',
		 'phone',
		 'ast'
	 ];

	/**
	 * A profile is owned by a user
	 * @return mixed
	 */
	public function user() {
    	return $this->belongTo('App\User');
	 }
}
