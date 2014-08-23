<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invites', function(Blueprint $table) {

			$table->increments('id');
			$table->integer('host_id')->unsigned();
			$table->integer('group_id')->unsigned();
			$table->string('first_name', 60);
			$table->string('last_name', 60)->nullable();
			$table->string('email', 70);

			$table->timestamp('invited_on')->nullable()->default(null);
			$table->timestamp('confirmed_on')->nullable()->default(null);

			$table->timestamps();

			$table->foreign('host_id')->references('id')->on('hosts')
					->onDelete('restrict')->onUpdate('cascade');
			$table->foreign('group_id')->references('id')->on('groups')
					->onDelete('restrict')->onUpdate('cascade');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('invites');
	}

}
