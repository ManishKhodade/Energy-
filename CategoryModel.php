<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = '24_sub_cat_1'; // Replace 'your_table_name' with the actual name of your table
    protected $primaryKey = 'sc1_id'; // Primary key of your table
    
    protected $allowedFields = [

        'sc1_category_id',
        'sc1_name',
        'sc1_category_logo',
        'sc1_description',
        'sc1_url',
        'sc1_page_title',
        'sc1_meta_keywrd',
        'sc1_meta_descrip',
        'sc1_status'
    ]; // Fields that are allowed to be inserted/updated

    public function getCategoryByUrl($categoryUrl)
    {
        // Fetch category by URL
        return $this->where('sc1_url', $categoryUrl)
                    ->first();
    }
    // You can define more custom functions here for specific queries or operations

   
    public function getFirstEightCategories()
    {
        return $this->where('sc1_id <=', 8)->findAll();
    }

    

    public function getCategories()
    {
        return $this->findAll();
    }


    
    

    
}
