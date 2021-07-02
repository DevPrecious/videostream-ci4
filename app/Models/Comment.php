<?php

namespace App\Models;

use CodeIgniter\Model;

class Comment extends Model
{
	protected $table                = 'comments';
	protected $primaryKey           = 'id';
	protected $allowedFields        = ['user_id', 'post_id', 'comment'];
}
