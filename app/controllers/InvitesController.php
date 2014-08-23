<?php

class InvitesController extends \BaseController {

	/**
	 * Display a listing of invites
	 *
	 * @return Response
	 */
	public function index()
	{
		$invites = Invite::all();

		return View::make('admin.invites.index', compact('invites'));
	}

	/**
	 * Show the form for creating a new invite
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.invites.create');
	}

	/**
	 * Store a newly created invite in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Invite::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Invite::create($data);

		return Redirect::route('admin.invites.index');
	}

	/**
	 * Display the specified invite.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$invite = Invite::findOrFail($id);

		return View::make('admin.invites.show', compact('invite'));
	}

	/**
	 * Show the form for editing the specified invite.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$invite = Invite::find($id);

		return View::make('admin.invites.edit', compact('invite'));
	}

	/**
	 * Update the specified invite in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$invite = Invite::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Invite::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$invite->update($data);

		return Redirect::route('admin.invites.index');
	}

	/**
	 * Remove the specified invite from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Invite::destroy($id);

		return Redirect::route('admin.invites.index');
	}

}
