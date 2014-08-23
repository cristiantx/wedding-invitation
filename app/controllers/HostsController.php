<?php

class HostsController extends \BaseController {

	/**
	 * Display a listing of hosts
	 *
	 * @return Response
	 */
	public function index()
	{
		$hosts = Host::all();

		return View::make('admin.hosts.index', compact('hosts'));
	}

	/**
	 * Show the form for creating a new host
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.hosts.create');
	}

	/**
	 * Store a newly created host in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Host::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Host::create($data);

		return Redirect::route('admin.hosts.index');
	}

	/**
	 * Display the specified host.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$host = Host::findOrFail($id);

		return View::make('admin.hosts.show', compact('host'));
	}

	/**
	 * Show the form for editing the specified host.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$host = Host::find($id);

		return View::make('admin.hosts.edit', compact('host'));
	}

	/**
	 * Update the specified host in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$host = Host::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Host::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$host->update($data);

		return Redirect::route('admin.hosts.index');
	}

	/**
	 * Remove the specified host from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Host::destroy($id);

		return Redirect::route('admin.hosts.index');
	}

}
