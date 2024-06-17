<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CategoryModel;
use App\Models\ReportModel;
use App\Models\NewsModel;
use App\Models\CmsModel;

class IndexController extends Controller
{
    public function index()
    {
        // Initialize session
        session();

        // Create an instance of the ReportModel
        $reportModel = new ReportModel();
        
        // Call the custom method to fetch the first three report IDs
        $firstThreeReportIds = $reportModel->getFirstThreeReportIds();

        // Fetch all data related to the first three report IDs
        $firstThreeReportsData = [];
        foreach ($firstThreeReportIds as $reportId) {
            $firstThreeReportsData[] = $reportModel->find($reportId);
        }

        // Create an instance of the CategoryModel
        $categoryModel = new CategoryModel();
        
        // Call the custom method to fetch the first three categories
        $categories = $categoryModel->getFirstEightCategories();

        // Create an instance of the NewsModel
        $newsModel = new NewsModel();
        
        // Call the custom method to fetch the first three news
        $news = $newsModel->getFournews();

        // Create an instance of the CmsModel
        $cmsModel = new CmsModel();
    
        // Fetch CMS data where cms_title is 'About Us'
        $aboutUs = $cmsModel->getCmsAboutUs();

        // Load FooterController2 and fetch its data
        $footerController = new FooterController();
        $footerData = $footerController->index();

        // Ensure $footerData is an array
        if (!is_array($footerData)) {
            $footerData = [];
        }

        // Fetch report count from the session
    $session = session();
    $reportCount = $session->get('reportCount', 0); // Default to 0 if not set

    // Add report count to the data array
    $data['reportCount'] = $reportCount;
        
         
        // Merge the fetched data with the existing data
        $data = [
            'firstThreeReportsData' => $firstThreeReportsData,
            'categories' => $categories,
            'news' => $news,
            'aboutUs' => $aboutUs,
        ];

        // Merge with footer data
        $data = array_merge($data, $footerData);

        // Set session data
        $_SESSION['data'] = $data;

        return view('index', $data);
        
    }
}
