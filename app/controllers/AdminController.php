<?php

use Swift_SmtpTransport as SmtpTransport;

class AdminController extends BaseController {


	public function showAdmin() {

		$hosts = Host::orderBy('id', 'DESC')->lists('first_name', 'id');
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

				try {
					$inviteObj = Invite::findOrFail( $invite['id'] );

					if( $invite['remove'] == 'true' ) {
						$inviteObj->delete();
						continue;
					}

				} catch( Exception $e ) {
					continue;
				}

			}
			else {

				$inviteObj = new Invite();

			}

			$inviteObj->first_name = $invite['nombre'];
			$inviteObj->last_name = $invite['apellido'];
			$inviteObj->email = $invite['email'];


			if( isset($invite['group_id']) && $invite['group_id'] ) {
				$group = Group::find($invite['group_id']);
				$inviteObj->group()->associate( $group );
			}

			$host = Host::find($invite['host_id']);
			$inviteObj->host()->associate( $host );

			$inviteObj->save();

		}

		return Response::json( $invites );

	}

	public function sendInvitations() {

		$transport = SmtpTransport::newInstance('smtp.gmail.com', 25);
        $transport->setEncryption('tls');
        $transport->setUsername('cristian.conedera@gmail.com');
        $transport->setPassword('Ntx32640a');
        $swift = new Swift_Mailer($transport);

        Mail::setSwiftMailer($swift);

        $data = array(
        		'images' => [ asset('assets/images/aleycris.png') ]
        	);

		Mail::queue('emails.invitation', $data, function($message) {
			$message->from('cristian.conedera@gmail.com', 'Cristian Conedera')
					->to('cristian.conedera@bothmedia.com', 'Cristian Conedera')
					->subject('Fuiste invitado al Casamiento de Alejandra y Cristian!');

		});

	}

}
