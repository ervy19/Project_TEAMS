<?php

class Training extends Eloquent {

	protected $table ='trainings';

	protected $fillable = array('title', 'theme_topic', 'venue', 'isTrainingPlan', 'isActive');

	protected $guarded = 'id';

	protected $appended = array('is_consecutive','start_date','end_date', 'all_date');

	public function getIsConsecutiveAttribute()
	{
		$dates = DB::table('training_schedules')
						->where('training_id','=',$this->id)
						->get();

		$isConsecutive = true;

		if($dates[0] && count($dates) > 1)
		{
			$i = 0;
			$j = 1;
			while ( $j < count($dates) && $isConsecutive)
			{
				$date1 = new DateTime($dates[$i]->date_scheduled);
				$date2 = new DateTime($dates[$j]->date_scheduled);

				$date_difference = date_diff($date1,$date2)->format('%a');

				if( $date_difference != 1)
				{
					$isConsecutive = false;
				}

				$i++;
				$j++;
			}
			
		}

		return $isConsecutive;
	}

	public function getStartDateAttribute()
	{
		$start_date = DB::table('training_schedules')
						->where('training_id','=',$this->id)
						->where('isStartDate','=',true)
						->first();

		if($start_date)
		{
			return $start_date->date_scheduled;
		}
		else
		{
			return '';
		}
	}

	public function getEndDateAttribute()
	{
		$end_date = DB::table('training_schedules')
						->where('training_id','=',$this->id)
						->where('isEndDate','=',true)
						->first();

		if($end_date)
		{
			return $end_date->date_scheduled;
		}
		else
		{
			return '';
		}
	}

	public function getAllDateAttribute()
	{
		$schedules = DB::table('training_schedules')
							->where('training_id','=',$this->id)
							->get();

		return $schedules;
	}

	public function internal_training() {
		return $this->hasOne('Internal_Training');
	}

	public function external_training() {
		return $this->hasOne('External_Training');
	}

}

?>