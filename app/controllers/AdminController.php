<?php

class AdminController extends BaseController {


	public function showAdmin() {

		$hosts = Host::lists('first_name', 'id');
		$groups = array('0' => 'Sin Grupo') + Group::lists('id', 'id') + array('new' => 'Nuevo Grupo');
		$invitations = Invite::orderBy('group_id', 'ASC')->orderBy('last_name', 'ASC')->get();

		$totalAle = Invite::where('host_id', 2 )->count();
		$totalCris = Invite::where('host_id', 1)->count();
		$totalGlobal = Invite::count();

		return View::make('admin.index')
					->with('hosts', $hosts)
					->with('groups', $groups)
					->with('totalAle', $totalAle)
					->with('totalCris', $totalCris)
					->with('totalGlobal', $totalGlobal)
					->with('invitations', $invitations);

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
