<?php

class Host extends \Eloquent {
	protected $fillable = [];

	public function invites() {
		return $this->hasMany('Invite');
	}

}
