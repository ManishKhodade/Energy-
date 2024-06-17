<?php

namespace App\Models;

use CodeIgniter\Model;

class CiSessionsModel extends Model
{
    protected $table = '24mr_ci_sessions';
    protected $primaryKey = 'id'; // Assuming 'id' is the primary key column

    protected $allowedFields = ['id', 'ip_address', 'timestamp', 'data'];

   
    
}
