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
}
