<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function home( $invite_id = false ) {

		$invites = [];

		if( $invite_id ) {
			//$invite = Invite::find( Crypt::decrypt($invite_id) );
			$invite = Invite::find( $invite_id );

			if( $invite->group ) {
				$invites = $invite->group->invites;
			} else {
				$invites = [ $invite ];
			}
		}

		return View::make('hello')->with( 'invites', $invites );

	}

	public function confirmInvitation( $id ) {

		$invitation = Invite::find($id);

		$invitation->declined_on = null;
		$invitation->confirmed_on = new DateTime();
		$invitation->save();

	}

	public function declineInvitation( $id ) {

		$invitation = Invite::find($id);

		$invitation->declined_on = new DateTime();
		$invitation->confirmed_on = null;
		$invitation->save();

	}

}
