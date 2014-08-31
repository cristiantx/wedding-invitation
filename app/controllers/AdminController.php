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

			if( isset($invite['group_id']) && $invite['group_id'] != 0 ) {
				$group = Group::find($invite['group_id']);
				$inviteObj->group()->associate( $group );
			} elseif( isset($invite['group_id']) && $invite['group_id'] == 0 ) {
				$inviteObj->group()->dissociate();
			}

			$host = Host::find($invite['host_id']);
			$inviteObj->host()->associate( $host );

			$inviteObj->save();

		}

		return Response::json( $invites );

	}

	public function listInvitations() {

		$hosts = Host::orderBy('id', 'DESC')->lists('first_name', 'id');
		$groups = array('0' => 'Sin Grupo') + Group::lists('id', 'id') + array('new' => 'Nuevo Grupo');
		$invitations = Invite::where('email','!=', '')->orderBy('group_id', 'ASC')->orderBy('last_name', 'ASC')->get();

		$totalAle = Invite::where('host_id', 2 )->count();
		$totalCris = Invite::where('host_id', 1)->count();
		$totalGlobal = Invite::count();

		return View::make('admin.sender')
					->with('hosts', $hosts)
					->with('groups', $groups)
					->with('totalAle', $totalAle)
					->with('totalCris', $totalCris)
					->with('totalGlobal', $totalGlobal)
					->with('invitations', $invitations);

	}

	public function dispatchInvitations() {

		$selected = Input::get('selected');
		$invitations = Invite::where('email', '!=', '')->whereIn( 'id', $selected )->get();
		$this->sendInvitations( $invitations );

		return Redirect::to('/invitaciones');

	}

	private function sendInvitations( $invitations ) {

		foreach( $invitations as $invite ) {

			if( !$invite->email || $invite->email == '' ) continue;

			$data = array(
					'images' => [ asset('assets/images/aleycris.png') ],
					'url' => url('/ver/' . $invite->id )
				);

			//$this->setHostAccount( $invite );

			Mail::queue('emails.invitation', $data, function($message)  use ( $invite ) {
				$message->from( $invite->host->email , $invite->host->first_name . ' ' . $invite->host->last_name )
						->to( $invite->email, $invite->first_name . ' ' . $invite->last_name )
						->subject('Fuiste invitado al Casamiento de Alejandra y Cristian!');
			});

			$invite->invited_on = new DateTime();
			$invite->save();

		}

	}

	private function setHostAccount( $invitation ) {

		if( $invitation->host->id == 1 ) {
			$user = 'cristian.conedera@gmail.com';
			$password = $_ENV['CRIS_P'];
		}
		else {
			$user = 'alejandramocoroa@gmail.com';
			$password = $_ENV['ALE_P'];
		}

		$transport = SmtpTransport::newInstance('smtp.gmail.com', 25);
		$transport->setEncryption('tls');
		$transport->setUsername( $user );
		$transport->setPassword( $password );
		$swift = new Swift_Mailer($transport);

		Mail::setSwiftMailer($swift);

	}

}
