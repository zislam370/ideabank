<?php

class Sif_roundsController extends BaseController {

	/**
	 * Sif_round Repository
	 *
	 * @var Sif_round
	 */
	protected $sif_round;

	public function __construct(Sif_round $sif_round)
	{
		$this->sif_round = $sif_round;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    $sif_rounds = $this->sif_round->orderBy('created_at', 'DESC')->paginate(10);

        return View::make('sif_rounds.index', compact('sif_rounds'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('sif_rounds.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$validation = Validator::make($input, Sif_round::$rules);

		if ($validation->passes())
		{
			$this->sif_round->create($input);

			return Redirect::route('sif_rounds');
		}

		return Redirect::route('create/sif_round')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{

		$sif_round = $this->sif_round->find($id);

		if (is_null($sif_round))
		{
			return Redirect::route('sif_rounds');
		}

		return View::make('sif_rounds.edit', compact('sif_round'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit($id)
	{

		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Sif_round::$rules);

        // If validation fails, we'll exit the operation now.
        if ($validation->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validation);
        }
    	$sif_round = $this->sif_round->find($id);

        if ($sif_round->update($input)) {
            // Redirect to the sif_rounds page
            return Redirect::to("sif_rounds/$id/edit")->with('success', Lang::get('sif_rounds/message.update.success'));
        }

        // Redirect to the sif_rounds management page
        return Redirect::to("sif_rounds/$id/edit")->with('error', Lang::get('tweets/message.update.error'));
	}

	/**
     * Delete confirmation for the given group.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $model = 'sif_rounds';
        $confirm_route = $error = null;
        // Check if the sif_rounds exists
        if (is_null($sif_round = $this->sif_round->find($id))) {

            $error = Lang::get('sif_rounds/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/sif_round', array('id'=>$sif_round->id));
        return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{

        $this->sif_round->find($id)->delete();
        // Redirect to the sif_rounds management page
        return Redirect::route('sif_rounds')->with('success', Lang::get('sif_rounds/message.success.delete'));
	}

}
