<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLikesTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'like_id' => [
				'type' => 'INT',
				'unsigned'    => true,
                 'auto_increment' => true,
			],
			'post_id' => [
				'type' => 'INT',
			],
		]);
		$this->forge->addKey('like_id', true);
		$this->forge->createTable('likes');
	}

	public function down()
	{
		$this->forge->dropTable('likes');
	}
}
