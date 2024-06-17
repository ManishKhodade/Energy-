<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table      = '24_24mr_news_releases';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'reportID',
        'nws_category',
        'nws_title',
        'nws_url',
        'nws_descrip',
        'nws_content',
        'nws_featured_image',
        'nws_page_title',
        'nws_meta_descrip',
        'nws_added_on',
        'nws_last_update_on',
        'nws_date',
        'nws_views',
        'nws_status'
    ];

   
    public function getFournews()
    {
        return $this->where('id <=', 913)->findAll();
    }

    public function getLatestNews()
    {
        // Query to fetch the latest news data
        return $this->orderBy('nws_date', 'DESC')->findAll();
    }


}
