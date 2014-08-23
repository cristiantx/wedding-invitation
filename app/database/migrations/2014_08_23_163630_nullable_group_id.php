<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullableGroupId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invites', function(Blueprint $table)
		{
			DB::statement("ALTER TABLE `invites`
						DROP FOREIGN KEY `invites_group_id_foreign`");
			DB::statement("ALTER TABLE `invites`
						CHANGE COLUMN `group_id` `group_id` INT(10) UNSIGNED NULL");

			DB::statement("ALTER TABLE `invites`
							ADD CONSTRAINT `invites_group_id_foreign`
						  FOREIGN KEY (`group_id`)
						  REFERENCES `groups` (`id`)
						  ON UPDATE CASCADE;
						");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('invites', function(Blueprint $table)
		{
			//
		});
	}

}
