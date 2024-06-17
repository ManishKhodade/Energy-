<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ThanksController extends Controller
{
    public function thanks()
    {

        // Fetch report count from the session
        $session = session();
        $reportCount = $session->get('reportCount', 0); // Default to 0 if not set

        // Add report count to the data array
        $data['reportCount'] = $reportCount;

        // Load FooterController and fetch its data
        $footerController = new FooterController();
        $footerData = $footerController->index();

        // Ensure $footerData is an array
        if (!is_array($footerData)) {
            $footerData = [];
        }

        // Merge the fetched data with the existing data
        $data = array_merge($data, $footerData);


        return \view('thanksview', $data);
    }
}
