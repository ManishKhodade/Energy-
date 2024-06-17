<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportDetailModel extends Model
{
    protected $table = '24_report_metadata';
    
    protected $primaryKey = 'meta_id';
    
    protected $allowedFields = ['meta_rep_id', 'rep_list_table', 'rep_table_text', 'rep_contents', 'rep_table_of_contents'];

   
}
