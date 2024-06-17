<?php

namespace App\Controllers;

use App\Models\ReportModel;
use CodeIgniter\Controller;
use App\Models\CategoryModel;

class LetestReportController extends Controller
{

    public function letestreport()
    {

        // Fetch categories
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getCategories();

        // Pass categories to the view
        $data['categories'] = $categories;

        // Load FooterController and fetch its data
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
        $data = array_merge($data, $footerData);

        // Check if the requested page exists, else redirect to 404 error page
        if (empty($data['categories'])) {
            return redirect()->to(base_url('error-404'));
        }

        // Load view with merged data
        return view('letest_reports', $data);
    }





    // AJAX method to load next set of reports
    public function loadReports($page = 1)
    {


        

        $perPage = 2; // Number of reports per page
        $offset = ($page - 1) * $perPage;

        $orderBy = $this->request->getVar('orderBy'); // Get sorting option from the request
        $categoryId = $this->request->getVar('categoryId'); // Get category ID from the request

        $reportModel = new ReportModel();
        
        if (!empty($orderBy)) {
            // Apply sorting based on user selection
            switch ($orderBy) {
                case 'title_asc':
                    $reportModel->orderBy('rep_title', 'ASC');
                    break;
                case 'title_desc':
                    $reportModel->orderBy('rep_title', 'DESC');
                    break;
                case 'date_asc':
                    $reportModel->orderBy('rep_date', 'ASC');
                    break;
                case 'date_desc':
                    $reportModel->orderBy('rep_date', 'DESC');
                    break;
                default:
                    // Default sorting if no option is selected
                    $reportModel->orderBy('rep_date', 'DESC');
                    break;
            }
        } else {
            
            // Default sorting if no option is selected
            $reportModel->orderBy('rep_date', 'DESC');
        }

        

        if (!empty($categoryId)) {
            // Apply category filtering if a category is selected
            $reportModel->where('rep_sub_cat_1_id', $categoryId);
        }

        $latestReports = $reportModel->findAll($perPage, $offset);

        // Get total number of reports for pagination
        $totalReports = $reportModel->countAllResults();


        $data = [
            'reports' => $latestReports,
            'totalReports' => $totalReports,
            'perPage' => $perPage,

        ];


        

        echo json_encode($data);

        
    }
}
