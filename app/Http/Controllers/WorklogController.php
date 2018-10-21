<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWorklogRequest;
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

    public function startService(UpdateWorklogRequest $request) {
		 // get the employee id of the currently logged barber
		 $currBarberId = Barber::find(Auth::user()->id));

		 // check if there is any customers in the waitlist
		 if (Walkin::all->isEmpty()) {
		 	$flash_message = 'The waitlist is currently empty.';
		 }

		 // get the next in line customer from the 'walkins' table
		 $nextCustomer = Walkin::latest('updated_at')->get();

		 // check if this employee is already in the current worklogs table
		 $record = Worklog::find($currBarberId)->count() ? Worklog::find($currBarberId) : new Worklog();

		 // get the user input
		 $record->barber_name = $request->input('name');

		 // get all the required data from the walkins table
		 $record->ticket_id = $nextCustomer->id;
		 $record->customer_name = $nextCustomer->customer_name;
		 $record->service_time = $nextCustomer->service_time;

		 $record->save();

		 // delete the first-in-line customer from the queue (walkins table)
		 Walkin::find($nextCustomer->id)->delete();

		 // create a flash message
		 $flash_message = 'Hi ' .$record->barber_name .'!\n'
			 .'Your next customer is' .$record->customer_name .'\n'
			 .$record->customer_name .' needs' .$nextCustomer->service .'\n'
			 .'Approximate service time is ' .$record->service_time;

		 //session()->flash('message', $flash_message);

		 return view('worklog.index')->with([
		 	'flash_message' => $flash_message ]);
	 }
}
