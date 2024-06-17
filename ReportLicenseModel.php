<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportLicenseModel extends Model
{
    protected $table = '24_report_license';
    protected $primaryKey = 'li_id';
    protected $allowedFields = ['li_pub_id', 'li_rep_id', 'li_key', 'li_value'];

    
}
