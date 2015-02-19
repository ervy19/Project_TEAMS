<?php

class Notification extends Eloquent {

	protected $table ='notifications';

	protected $fillable = array('type', 'training_link', 'participant_link', 'user_id', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('employee_name','training_title');

	public function users() {
		return $this->belongsTo('users');
	}

	public function getEmployeeNameAttribute()
	{
		if($this->type == 'pta' || $this->type == 'pte')
		{
			$participant = IT_Participant::find($this->participant_link);

			if($participant)
			{
				return $participant->employee_name;
			}
			else
			{
				return '';
			}
		}
		else if ($this->type == 'et_queue')
		{
			$employee = Employee::find($this->participant_link);

			if($employee)
			{
				return $employee->full_name;
			}
			else
			{
				return '';
			}
		}
		else
		{
			$employee = null;
		}
	}

	public function getTrainingTitleAttribute()
	{
		if($this->type == 'pta' || $this->type == 'pte')
		{
			$training = Training::find($this->training_link);
		}
		else if ($this->type == 'et_queue')
		{
			$training = ET_Queue::find($this->training_link);

		}
		else
		{
			$training = null;
		}

		if($training)
		{
			return $training->title;
		}
		else
		{
			return '';
		}
				
	}
}

?>