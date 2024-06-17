<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactUsModel extends Model
{
    protected $table = '24mr_Contact_us';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Username', 'Email', 'Phone', 'Enter_Company', 'Country', 'Message'];
    
}
