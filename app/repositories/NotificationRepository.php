<?php

class NotificationRepository {

	public function getAll()
	{
		$notifications = Notification::where('users.id','=',Auth::user()->id)
							->get();

		return $notifications;
	}

	public function getName()
	{
		if(Auth::user()->hasRole('Admin'))
		{
			$user = DB::table('users')->select(DB::raw('*'))
						->leftJoin('hr_accounts','users.id','=','hr_accounts.user_id')
						->where('users.id','=',Auth::user()->id)
						->first();
		}
		else if(Auth::user()->hasRole('HR Admin'))
		{
			$user = DB::table('users')->select(DB::raw('*'))
						->leftJoin('hr_accounts','users.id','=','hr_accounts.user_id')
						->where('users.id','=',Auth::user()->id)
						->first();
		}
		else
		{
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
		
		$name = $user->name;

		return $name;
	}
}