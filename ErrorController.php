<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ErrorController extends Controller{


    public function error()
    {

         
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
        return \view('error',$data);
    }


}