<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class ReportModel extends Model
{
    protected $table = '24_report'; // Assuming 'reports' as the table name

    protected $primaryKey = 'rep_id'; // Assuming 'rep_id' as the primary key

    protected $allowedFields = [
        'rep_cat_id',
        'rep_sub_cat_1_id',
        'rep_sub_cat_2_id',
        'product_type_id',
        'publisher_id',
        'rep_url',
        'rep_title',
        'rep_descrip',
        'rep_price',
        'rep_discount',
        'rep_entry_date',
        'rep_upcoming_published_status',
        'rep_status',
        'rep_page_title',
        'rep_meta_title',
        'rep_meta_title_grs',
        'rep_meta_tags',
        'rep_archive_status',
        'rep_report_code',
        'rep_page',
        'popularity',
        'rep_date',
        'last_modified_at',
        'rep_country',
        'rep_region',
        'rep_product_type',
        'rep_toc_no',
        'rep_toc_fig',
        'rep_company',
        'rep_delivery_formats',
        'rep_visit_count',
        'rep_countries',
        'rep_tags',
        'rep_fig_no',
        'rep_promoted_for',
        'rep_pr_status',
        'grs_sample',
        'mr_sample',
        'mrs_sample',
        'promote_24mr_date',
        'promote_24mr_dme',
        'promote_grs_date',
        'promote_grs_dme',
        'promote_stat_date',
        'promote_stat_dme',
        'grs_views',
        '24mr_views',
        'rrep_redirect_id',
        'rep_cagr',
        'rep_app',
        'rep_type'
    ];
 // You may define additional functions or relationships here if needed

 
 public function getReportsByCategory($categoryId, $perPage = 2, $offset = 0)
    {
        // Fetch reports by category ID with pagination
        return $this->where('rep_sub_cat_1_id', $categoryId)
                    ->orderBy('rep_date', 'DESC') // Optionally, order by date or any other field
                    ->findAll($perPage, $offset);
    }

    public function getTotalReportsByCategory($categoryId)
    {
        // Get total count of reports by category ID
        return $this->where('rep_sub_cat_1_id', $categoryId)
                    ->countAllResults();
    }
 


    public function searchByTitlePaginated($searchTerm, $perPage, $offset)
    {
        // Perform the search query using Query Builder with pagination
        $query = $this->like('rep_title', $searchTerm)
                      ->limit($perPage, $offset)
                      ->findAll();
    
        return $query;
    }
    

   
    

   
    public function getFirstThreeReportIds()
    {
        $query = $this->query('SELECT rep_id FROM 24_report ORDER BY rep_date ASC LIMIT 3');
        $result = $query->getResult();

        $reportIds = [];
        foreach ($result as $row) {
            $reportIds[] = $row->rep_id;
        }

        return $reportIds;
    }



    public function getReportsByCategoryAndDate($categoryId)
    {
        
        $sixMonthsAgo = date('Y-m-d', strtotime('-6 months'));
        $query = $this->where('rep_sub_cat_1_id', $categoryId)
                      ->where('rep_date >=', $sixMonthsAgo)
                      ->orderBy('rep_date', 'ASC')
                      ->limit(2)
                      ->findAll();
        return $query;
    }


    public function getLatestReports()
    {
        // Select all fields from the 24_report table
        $this->select('*')
             ->orderBy('rep_date', 'DESC');
    
        return $this->findAll();
    }  


    public function getLastMonthToCurrentReports()
    {
        // Get the first day of the last month
        $firstDayLastMonth = date('Y-m-01', strtotime('last month'));
        
        // Get the current date
        $currentDate = date('Y-m-d');
        
        // Fetch reports from the first day of the last month to the current date
        return $this->where('rep_entry_date >=', $firstDayLastMonth)
                    ->where('rep_entry_date <=', $currentDate)
                    ->orderBy('rep_entry_date', 'ASC')
                    ->findAll();
    }
   

   

    
}