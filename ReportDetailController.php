<?php

namespace App\Controllers;

use App\Models\ReportModel;
use App\Models\ReportDetailModel;
use App\Models\CategoryModel;
use App\Models\ReportLicenseModel; // Import the ReportLicenseModel

class ReportDetailController extends BaseController
{
    public function viewReport($repId, $repUrl)
    {
        // Check if $repId consists of numeric characters only
        if (!ctype_digit($repId)) {
            // Redirect the user to the 404 error page
            return redirect()->to(base_url('error-404'));
        }

        // Initialize session
        $session = session();

        // Load models
        $reportModel = new ReportModel();
        $reportDetailModel = new ReportDetailModel();
        $categoryModel = new CategoryModel();
        $reportLicenseModel = new ReportLicenseModel(); // Instantiate ReportLicenseModel

        // Get report details from both tables
        $report = $reportModel->find($repId);
        $reportDetail = $reportDetailModel->where('meta_rep_id', $repId)->first();

        // Check if the report exists
        if (!$report) {
            // Redirect the user to the 404 error page
            return redirect()->to(base_url('error-404'));
        }

        // Fetch report licenses by joining 24_report_license table
        $reportLicenses = [];
        if ($report) {
            $reportLicenses = $reportLicenseModel
                ->where('li_rep_id', $repId)
                ->findAll(); // Use findAll() to get all matching rows
        }

        // Decode the rep_url
        $decodedRepUrl = urldecode($repUrl);

        // Fetch category based on the condition
        $category = null;
        if ($report && $report['rep_sub_cat_1_id']) {
            $category = $categoryModel->where('sc1_category_id', $report['rep_sub_cat_1_id'])->first();
        }

        // Fetch reports with the same category and within last 6 months
        $similarReports = [];
        if ($report && $report['rep_sub_cat_1_id']) {
            $similarReports = $reportModel->getReportsByCategoryAndDate($report['rep_sub_cat_1_id']);
        }

        // Check if repUrl is correct
        if ($decodedRepUrl !== $report['rep_url']) {
            // Redirect to error-404 page
            return redirect()->to(base_url('error-404'));
        }

        // Set session data
        $session->set([
            'report' => $report,
            'reportDetail' => $reportDetail,
            'repUrl' => $decodedRepUrl,
            'category' => $category,
            'similarReports' => $similarReports,
            'reportLicenses' => $reportLicenses, // Add report licenses to session data
        ]);

        // Fetch report count from session
        $reportCount = $session->get('reportCount', 0); // Default to 0 if not set

        // Load FooterController2 and fetch its data
        $footerController = new FooterController();
        $footerData = $footerController->index();

        // Ensure $footerData is an array
        if (!is_array($footerData)) {
            $footerData = [];
        }

        // Merge the fetched data with the existing data
        $data = [
            'report' => $report,
            'reportDetail' => $reportDetail,
            'repUrl' => $decodedRepUrl,
            'category' => $category,
            'similarReports' => $similarReports,
            'reportLicenses' => $reportLicenses, // Add report licenses to view data
            'reportCount' => $reportCount // Add report count to view data
        ];

        // Merge with footer data
        $data = array_merge($data, $footerData);

        // Load view
        return view('report_detail', $data);
    }
}
