<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReportModel;
use App\Models\CategoryModel;

class CategoryreportController extends Controller
{
    public function category($categoryUrl)
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategoryByUrl($categoryUrl);

        if (!$category) {
            return redirect()->to(base_url('404'));
        }

        $data['category'] = $category;
        $data['reportCount'] = session()->get('reportCount', 0);

        $footerController = new FooterController();
        $footerData = $footerController->index();
        if (!is_array($footerData)) {
            $footerData = [];
        }
        $data = array_merge($data, $footerData);

        return view('categoryreports', $data);
    }

    public function getReports($categoryId, $page = 1)
    {
        $reportModel = new ReportModel();
        $perPage = 1; // Number of reports per page
        $offset = ($page - 1) * $perPage;
    
        $totalReports = $reportModel->getTotalReportsByCategory($categoryId);
        $reports = $reportModel->getReportsByCategory($categoryId, $perPage, $offset);
    
        $data = [
            'reports' => $reports,
            'totalPages' => ceil($totalReports / $perPage),
            'currentPage' => $page,
        ];
    
        return $this->response->setJSON($data);
    }
}
