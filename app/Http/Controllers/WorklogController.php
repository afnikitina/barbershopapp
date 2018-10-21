<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Barber;
use App\Walkin;
use App\Worklog;


class WorklogController extends Controller
{
	public function index() {
		return view('worklog.index');
	}

	public function create() {
		return view('worklog.create');
	}

    public function startService() {
		 // get the employee id of the currently logged barber
		 $barber = Barber::find(Auth::user());
		 $barberId = $barber->id;

		 // check if there is any customers in the waitlist
		 if (Walkin::all()->isEmpty()) {
		 	$flash_message = 'The waitlist is currently empty.';
		 }

		 // get the next in line customer from the 'walkins' table
		 $nextCustomer = Walkin::latest('updated_at')->get();

		 // check if this employee is already in the current worklogs table
		 $record = Worklog::find($barberId)->count() ? Worklog::find($barberId) : new Worklog();

		 // get all the required data from the walkins table
		 $record->barber_id = $barberId;
		 $record->ticket_id = $nextCustomer->id;
		 $record->service_time = $nextCustomer->service_time;

		 $record->save();

		 $customerName = $nextCustomer->customer_name;
		 $barberName = $barber->name;

		 // create a flash message
		 $flash_message = 'Hi ' .$barber->name .'!\n'
			 .'Your next customer, ' .$nextCustomer->customer_name .', needs ' .$nextCustomer->service .'\n'
			 .'Tne approximate service time is ' .$record->service_time .' minutes';

		 //session()->flash('message', $flash_message);

		 // delete the first-in-line customer from the queue (walkins table)
		 $nextCustomer->delete();

		 return view('worklog.index')->with([
		 	'flash_message' => $flash_message ]);
	 }
}
