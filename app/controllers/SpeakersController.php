<?php

class SpeakersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($internal_training_id)
	{			
		$internaltraining = Training::find($internal_training_id);

		$speakers = Speaker::where('internal_training_id', '=', $internal_training_id)->get();

		if(Request::ajax()){
			return Response::json(['data' => $speakers]);
		}
		else
		{
			return View::make('internal_trainings.speakers')
				->with('speakers', $speakers)
				->with('internal_training', $internaltraining);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('speakers.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($internal_training_id)
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
         if ($validator->fails()) {
         	return Response::json([
         		'success' => false,
         		'errors' => $validator->errors()->toArray()]
         	);
             /*return Redirect::to('campuses')
                 ->withErrors($validator)
                 ->withInput(Input::except('password'));*/
         } else {
            // store
            $speakers = new Speaker;
            $speakers->name = Input::get('name');
            $speakers->topic = Input::get('topic');
            $speakers->educational_background = Input::get('educational_background');
            $speakers->work_background = Input::get('work_background');
            $speakers->internal_training_id = $internal_training_id;
            $speakers->save();

            return Response::json(['success' => true]);
            // redirect
            //Session::flash('message', 'Successfully created Campus!');
            //return Redirect::to('campuses')->with('message', '<div class="alert alert-success">Campus successfully added.</div>');
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$campuses = Campus::find($id);

		return View::make('campuses.show')
			->with('campuses', $campuses );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($internal_training_id,$speaker_id)
	{
		$speaker = Speaker::where('internal_training_id','=',$internal_training_id)
					->where('id','=',$speaker_id)
					->first();

		return Response::json([
			'success' => true,
			'result' => $speaker
			]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name' => 'required|max:255', 
            'educational_background' => 'required|max:255',
            'work_background' => 'required|max:255'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Response::json([
        		'success' => false,
        		'errors' => $validator->errors()->toArray()]
        	);
        } else {
            // store
           	$speakers = Speaker::find($id);
            $speakers->name = Input::get('name');
            $speakers->topic = Input::get('topic');
            $speakers->educational_background = Input::get('educational_background');
            $speakers->work_background = Input::get('work_background');
            $speakers->internal_training_id = 1;
            $speakers->save();
            return Response::json(['success' => true]);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$speakers = Speaker::find($id);
        $speakers->delete();

        return Response::json(['success' => true]);
    }

}
