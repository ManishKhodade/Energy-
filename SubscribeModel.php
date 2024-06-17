<?php


namespace App\Models;

use CodeIgniter\Model;

class SubscribeModel extends Model
{
    protected $table = '24mr_newsletter';
    protected $primaryKey = 'id';

    protected $allowedFields = ['email'];

   
}

