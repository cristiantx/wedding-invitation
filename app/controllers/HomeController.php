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

		try {
			if( $invite_id ) {
				//$invite = Invite::find( Crypt::decrypt($invite_id) );
				$invite = Invite::findOrFail( $invite_id );
				$invite->seen_at = new DateTime();
				$invite->save();

				if( $invite->group ) {
					$invites = $invite->group->invites;
				} else {
					$invites = [ $invite ];
				}
			}
		} catch ( Exception $e ) {
			$invites = [];
		}

		return View::make('hello')->with( 'invites', $invites );

	}

	public function getUpload( $invite_id = false ) {

		if( !$invite_id ) return Response::redirect('/');


		return View::make('fileupload')->with( 'invite_id', $invite_id );

	}


	public function getPhotos( $invite_id = false ) {

		if( !$invite_id ) return Response::redirect('/');

		$directory = public_path().'/uploads/'. $invite_id;
		$files = File::files( $directory );
		$output = array();

		$thumbBaseDirectory = $directory . "/thumbs/";
		$publicBase = url() . '/uploads/' . $invite_id ;

		if( !File::exists( $thumbBaseDirectory ) ) {
			File::makeDirectory( $directory . '/thumbs',  $mode = 0777, $recursive = true);
		}

		foreach( $files as $file ) {

			$filename = basename( $file );
			$extension = File::extension( $file );

			$fileURI = $publicBase . "/{$filename}";

			$thumbPath = $thumbBaseDirectory . "/{$filename}";
			$thumbURI = $publicBase . "/thumbs/{$filename}";

			if( strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg' || strtolower($extension) == 'png'  ) {
				if( !File::exists( $thumbPath ) ) {
					Thumb::create( $file )
						->make('resize', array(200,200))
						->make('crop', array('center', 100, 100))
						->save( $thumbBaseDirectory );
				}
			}

			$output[] = array(
					'file' => $fileURI,
					'thumb' => $thumbURI
				);

		}

		return View::make('photolist')
				->with( 'invite_id', $invite_id )
				->with( 'files', $output );

	}


	public function postUpload( $invite_id = false ) {

		if( !$invite_id ) return Response::redirect('/');


		$input = Input::all();
		$rules = array(
		    'file' => 'image|max:30000',
		);

		/*$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return Response::make($validation->errors->first(), 400);
		}*/

		$file = Input::file('file');

        $extension = File::extension( $file->getClientOriginalName() );
        $directory = public_path().'/uploads/'. $invite_id;
        $filename = sha1(time().time()).".{$extension}";

        $upload_success = Input::file('file')->move($directory, $filename);

        if( $upload_success ) {
        	return Response::json('success', 200);
        } else {
        	return Response::json('error', 400);
        }

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
