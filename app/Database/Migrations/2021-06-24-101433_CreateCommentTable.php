<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommentTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'comment_id' => [
				'type' => 'INT',
				'unsigned'    => true,
                 'auto_increment' => true,
			],
			'user_id' => [
				'type' => 'INT',
			],
			'post_id' => [
				'type' => 'INT',
			],
			'comment' => [
				'type' => 'VARCHAR',
				'constraint' => '225'
			],
		]);

		$this->forge->addKey('comment_id', true);
		$this->forge->createTable('comments');
	}

	public function down()
	{
		$this->forge->dropTable('comments');
	}
}
