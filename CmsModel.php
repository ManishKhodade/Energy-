<?php

namespace App\Models;

use CodeIgniter\Model;

class CmsModel extends Model
{
    protected $table      = '24_cms';
    protected $primaryKey = 'cms_id';

    protected $allowedFields = [
        'cms_title',
        'cms_content',
        'page_title',
        'meta_keyword',
        'meta_description'
    ];


    public function getCmsAboutUs()
    {
        return $this->where('cms_title', 'About Us')->first();
    }


    public function getCmsTitles()
    {
        $titles = [
           
            'About Report',
            'privacy policy',
            'FAQs',
            'Terms of service',
            'Refund Policy',
            'Delivery Policy'
        ];

        return $this->select('cms_title')->whereIn('cms_title', $titles)->findAll();
    }
   
}
