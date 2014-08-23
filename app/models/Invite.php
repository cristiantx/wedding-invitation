<?php

class Invite extends \Eloquent {
	protected $fillable = [];

	public function host() {
		return $this->belongsTo('Host');
	}

	public function group() {
		return $this->belongsTo('Group');
	}

}
