<?php

class Employee extends Eloquent {

	protected $table ='employees';

	protected $fillable = array('employee_number', 'last_name', 'given_name', 'middle_initial', 'email', 'age', 'tenure', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('full_name');

	public function getFullNameAttribute()
    {
        return ucfirst($this->given_name) . ' ' . ucfirst($this->middle_initial) . '. ' . ucfirst($this->last_name);
    }

	public function employee_designation() {
		return $this->hasMany('Employee_Designation');
	}

	public function educational_attainment() {
		return $this->hasMany('Educational_Attainment');
	}

	public function IT_attendance() {
		return $this->belongsToMany('IT_Attendance');
	}

	public function getDesignationsAttribute()
	{
		$employee_designations = Employee_Designation::where('employee_id','=',$this->id)
									->get();

		if(!$employee_designations->isEmpty())
		{
			return $employee_designations;
		}
		else
		{
			return '';
		}
	}

	/*public function getTrainingsAttendedAttribute()
	{



		if(!$->isEmpty())
		{
			return $;
		}
		else
		{
			return '';
		}
	}*/
}

?>