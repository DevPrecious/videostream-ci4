<?php

namespace App\Models;

use CodeIgniter\Model;

class Subscribe extends Model
{
	protected $table                = 'subscribes';
	protected $primaryKey           = 'id';
	protected $allowedFields        = ['post_id', 'user_id'];
}
