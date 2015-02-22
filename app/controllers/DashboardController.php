<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$trainings = Training::select(DB::raw('id, title'))
							->where('isActive','=',true)
							->where('isInternalTraining','=',true)
							->where('isTrainingPlan','=',true)
							->get();

		$consecutive_trainings = array();
		$separated_trainings = array();

		foreach ($trainings as $key => $value) {
			if($value->is_consecutive)
			{
				array_push($consecutive_trainings, $value);
			}
			else
			{
				foreach ($value->all_date as $k => $v) {
					array_push($separated_trainings, array('id' => $value->id, 'title' => $value->title, 'start' => $v->date_scheduled));
				}				
			}
		}

		if(Auth::user()->hasRole('Admin'))
		{
			$role = 1;

			$user = DB::table('users')->select(DB::raw('*'))
						->leftJoin('hr_accounts','users.id','=','hr_accounts.user_id')
						->where('users.id','=',Auth::user()->id)
						->first();
		}
		else if(Auth::user()->hasRole('HR Admin'))
		{
			$role = 2;

			$user = DB::table('users')->select(DB::raw('*'))
						->leftJoin('hr_accounts','users.id','=','hr_accounts.user_id')
						->where('users.id','=',Auth::user()->id)
						->first();
		}
		else
		{
			$role = 3;

			if(Auth::user()->hasRole('Campus Supervisor'))
			{
				/*$user = DB::table('users')->select(DB::raw('*'))
						->leftJoin('supervisors','users.id','=','supervisors.user_id')
						->rightJoin('department_supervisors','department_supervisors.supervisor_id', '=', 'supervisors.id')
						->where('users.id','=',Auth::user()->id)
						->first();*/
			}
			else if(Auth::user()->hasRole('Program Supervisor'))
			{
				/*$user = DB::table('users')->select(DB::raw('*'))
						->leftJoin('supervisors','users.id','=','supervisors.user_id')
						->rightJoin('department_supervisors','department_supervisors.supervisor_id', '=', 'supervisors.id')
						->where('users.id','=',Auth::user()->id)
						->first();*/
			}
			else if(Auth::user()->hasRole('School_College Supervisor'))
			{
				/*$user = DB::table('users')->select(DB::raw('*'))
						->leftJoin('supervisors','users.id','=','supervisors.user_id')
						->rightJoin('department_supervisors','department_supervisors.supervisor_id', '=', 'supervisors.id')
						->where('users.id','=',Auth::user()->id)
						->first();*/
			}
			else if(Auth::user()->hasRole('Department Supervisor'))
			{
				$user = DB::table('users')->select(DB::raw('*'))
						->leftJoin('supervisors','users.id','=','supervisors.user_id')
						->where('users.id','=',Auth::user()->id)
						->first();
			}
		}

		$notifications = Notification::where('user_id','=',Auth::user()->id)
							->get();

		$name = Auth::user()->name;
		//View::share('name',$name);
		return View::make('dashboard.index')
			->with('role',$role)
			->with('name',$name)
			->with('notifications',$notifications)
			->with('consecutive_trainings',$consecutive_trainings)
			->with('separated_trainings',$separated_trainings);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
