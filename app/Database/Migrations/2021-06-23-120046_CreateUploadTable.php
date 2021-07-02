<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUploadTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned'    => true,
                 'auto_increment' => true,
			],
			'user_id' => [
				'type' => 'INT',
			],
			'video' => [
				'type' => 'VARCHAR',
				'constraint' => '225'
			],
			'thumbnail' => [
				'type' => 'VARCHAR',
				'constraint' => '225'
			],
			'description' => [
				'type' => 'TEXT'
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('uploads');
	}

	public function down()
	{
		$this->forge->dropTable('uploads');
	}
}
