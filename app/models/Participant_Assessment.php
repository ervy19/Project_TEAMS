<?php

class Participant_Assessment extends Eloquent {

	protected $table ='participant_assessments';

	protected $fillable = array('type', 'rating', 'verbal_interpretation', 'remarks', 'it_participant_id', 'isActive');

	protected $guarded = 'id';

	protected $appends = array('has_response');

	public function it_participant() {
		return $this->belongsTo('IT_Participant');
	}

	public function getHasResponseAttribute()
	{
		$responses = Assessment_Response::where('participant_assessment_id','=',$this->id)
						->where('isActive','=',true)
						->first();

		if($responses)
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
}

?>