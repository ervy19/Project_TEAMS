<?php

class External_Training extends Eloquent {

	protected $table ='external_trainings';

	protected $fillable = array('participation', 'organizer', 'designation_id', 'isActive');

	protected $guarded = 'training_id';

	protected $appends = array('training_type','training_title','requirement_statuses','training_scs');

	public function training() {
		return $this->hasOne('Training');
	}

	public function employee_designation() {
		return $this->belongsToMany('Employee_Designation');
	}

	public function getTrainingTypeAttribute()
	{
		return 'External';
	}


	public function getTrainingTitleAttribute()
	{
		$training = Training::find($this->training_id);

		if($training)
		{
			return $training->title;
		}
		else
		{
			return '';
		}
	}

	public function getRequirementStatusesAttribute()
	{
		return 'Credited';
	}

	public function getTrainingScsAttribute()
	{
		$scs = ET_Addressed_SC::where('external_training_id','=',$this->training_id)
					->where('isActive','=',true)
					->get();

		if(!$scs->isEmpty())
		{

			return $scs;
		}
		else
		{
			return '';
		}
	}
	
}

?>