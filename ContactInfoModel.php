<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactInfoModel extends Model
{
    protected $table = '24_contact_info';
    protected $primaryKey = 'info_id';
    protected $allowedFields = ['info_mail', 'info_virtual_no', 'info_local_no'];
}
