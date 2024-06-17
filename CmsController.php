<?php

namespace App\Controllers;

use App\Models\CmsModel;
use CodeIgniter\Controller;

class CmsController extends Controller
{
    public function cms($cmsTitle)
    {
        // Load the CmsModel
        $cmsModel = new CmsModel();

        // Fetch the CMS content based on the clicked title
        $cmsContent = $cmsModel->where('cms_title', str_replace('-', ' ', $cmsTitle))->first();

        if ($cmsContent) {
            // Pass the CMS content data to the view
            $data['cmsContent'] = $cmsContent;

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

            // Load view with merged data
            return view('cms', $data);
        } else {
            // If CMS content is not found, redirect to error-404 page
            return redirect()->to(base_url('error-404'));
        } 
    }
}
