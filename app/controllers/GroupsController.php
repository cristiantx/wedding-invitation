<?php

class GroupsController extends \BaseController {

	/**
	 * Display a listing of groups
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = Group::all();

		return View::make('admin.groups.index', compact('groups'));
	}

	/**
	 * Show the form for creating a new group
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.groups.create');
	}

	/**
	 * Store a newly created group in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		//$validator = Validator::make($data = Input::all(), Group::$rules);

		/*if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}*/

		$group = new Group();
		$group->save();

		return Response::json( array( 'success' => true, 'data' => $group ) );
	}

	/**
	 * Display the specified group.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$group = Group::findOrFail($id);

		return View::make('admin.groups.show', compact('group'));
	}

	/**
	 * Show the form for editing the specified group.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$group = Group::find($id);

		return View::make('admin.groups.edit', compact('group'));
	}

	/**
	 * Update the specified group in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$group = Group::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Group::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$group->update($data);

		return Redirect::route('admin.groups.index');
	}

	/**
	 * Remove the specified group from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Group::destroy($id);

		return Redirect::route('admin.groups.index');
	}

}
