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
		// get all records of the 'walkins' table
		 $next = DB::table('walkins')->oldest('created_at')->get();

		 // get the user input into the instanse of the Worklog class
		 $record = new Worklog($request->all());

		 // check if the record with entered email is already in the current worklogs table:
		 $extRecord = DB::table('worklogs')->where('email', '=', $record->email)->get();
		 if ($extRecord) {
			 DB::table('worklogs')
				 ->where('email', '=', $record->email)
				 ->update(['walkin_id' => $next[0]->id,
					 			'service_time' => $next[0]->service_time]);
		 }
		 else {
			 $record->walkin_id = $next[0]->id;
			 $record->service_time = $next[0]->service_time;
			 $record->save();
		 }

		 // delete the first-in-line customer from the queue (walkins table)
		 DB::table('walkins')->where('created_at', '=', $next[0]->created_at)->delete();

		 return view('worklog.index');
	 }
}
