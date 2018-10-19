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
		 if (Auth::check()) {
			 $next = DB::table('walkins')->latest('created_at')->get();
			 $worklog = new Worklog();
			 $worklog->user_id = Auth::user()->getAuthIdentifier();
			 $worklog->walkin_id = $next[0]->id;
			 $worklog->service_time = $next[0]->service_time;

			 $worklog->save();
		 }

		 return view('worklog.index');
	 }
}
