<?php

class AdminController extends BaseController {


	public function showAdmin() {

		$hosts = Host::lists('first_name', 'id');
		$groups = array('0' => 'Sin Grupo') + Group::lists('id', 'id') + array('new' => 'Nuevo Grupo');
		$invitations = Invite::orderBy('last_name', 'ASC')->get();
		return View::make('admin.index')->with('hosts', $hosts)->with('groups', $groups)->with('invitations', $invitations);

	}

	public function saveInvites() {

		$invites = Input::get('data');

		foreach( $invites as $invite ) {

			if( (!$invite['id'] && $invite['remove'] == 'true') || ( $invite['nombre'] == '' ) ) continue;

			$inviteObj = null;

			if( $invite['id'] ) {

				$inviteObj = Invite::find( $invite['id'] );

				if( $invite['remove'] == 'true' ) {
					$inviteObj->delete();
					continue;
				}

			}
			else {

				$inviteObj = new Invite();

			}

			$inviteObj->first_name = $invite['nombre'];
			$inviteObj->last_name = $invite['apellido'];
			$inviteObj->email = $invite['email'];


			if( $invite['group_id'] ) {
				$group = Group::find($invite['group_id']);
				$inviteObj->group()->associate( $group );
			}

			$host = Host::find($invite['host_id']);
			$inviteObj->host()->associate( $host );

			$inviteObj->save();

		}

	}

}
