<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CmsModel;

class AboutUsController extends Controller
{
    public function AboutUs()
    {
        // Load the CMS model
        $cmsModel = new CmsModel();

        // Fetch content for About Us from the CMS model
        $aboutUsContent = $cmsModel->getCmsAboutUs();

        // If content is not found, redirect to 404 page
        if (!$aboutUsContent) {
            return redirect()->to(base_url('error-404'));
        }

        // Initialize session
        $session = session();

        // Fetch report count from the session
        $reportCount = $session->get('reportCount', 0); // Default to 0 if not set

        // Add report count to the data array
        $data['reportCount'] = $reportCount;

        // Prepare data to pass to the view
        $data = [
            'content' => $aboutUsContent,
            'reportCount' => $reportCount // Add other data as needed
        ];

        // Load FooterController and fetch its data
        $footerController = new FooterController();
        $footerData = $footerController->index();

        // Ensure $footerData is an array
        if (!is_array($footerData)) {
            $footerData = [];
        }

        // Merge the fetched data with the existing data
        $data = array_merge($data, $footerData);

        // Load view with merged data
        return view('abutUs', $data);
    }
}
