<?php

namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model
{
    protected $table = '24_country'; // Replace 'your_table_name' with the actual name of your table
    protected $primaryKey = 'id';


    protected $allowedFields = [
        'iso', 
        'name', 
        'nicename', 
        'iso3', 
        'numcode', 
        'phonecode', 
        'continent', 
        'reports_count'
    ];

    public function getCountries()
    {
        return $this->select('name, phonecode')
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }
    
}