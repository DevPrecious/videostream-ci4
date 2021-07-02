<?php

namespace App\Models;

use CodeIgniter\Model;

class Like extends Model
{
	protected $table                = 'likes';
	protected $primaryKey           = 'id';
	protected $allowedFields        = ['post_id', 'user_id'];

}
