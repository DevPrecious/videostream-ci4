<?php

namespace App\Models;

use CodeIgniter\Model;

class Upload extends Model
{
	protected $table                = 'uploads';
	protected $primaryKey           = 'upload_id';
	protected $allowedFields        = ['user_id', 'video', 'thumbnail', 'description'];
}
