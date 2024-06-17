<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutsModel extends Model
{
    protected $table = '24_24mr_checkouts';
    protected $primaryKey = 'p_id';
    protected $allowedFields = [
        'id',
        'order_no', 
        'queryID', 
        'cart_contents',
        'full_name', 
        'email_id', 
        'contact_no', 
        'company', 
        'city', 
        'country', 
        'address', 
        'zip_postal', 
        'type', 
        'checkout_type', 
        'expected_delivery_date', 
        'currency', 
        'password', 
        'date', 
        'status'
    ];



    
}
