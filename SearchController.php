<?php

namespace App\Controllers;

use App\Models\ReportModel;

use CodeIgniter\Controller;

class SearchController extends Controller
{


    public function search()
    {
        // Generate a random security code and store it in the session
        $securityCode = mt_rand(1000, 9999);
        session()->set('securityCode', $securityCode);




        // Prepare data for the view
        $data = [

            'securityCode' => $securityCode,

        ];

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

        return view('search_result', $data);
    }

    public function paginateSearch()
    {
        $searchTerm = $this->request->getVar('s');
        $page = $this->request->getVar('page') ?: 1; // Default page is 1

        // Load the ReportModel
        $reportModel = new ReportModel();

        // Calculate offset
        $perPage = 2; // Number of items per page
        $offset = ($page - 1) * $perPage;

        // Call the method to fetch paginated search results
        $searchResults = $reportModel->searchByTitlePaginated($searchTerm, $perPage, $offset);

        // Return paginated results as JSON
        $data['searchResults'] = $searchResults;

        echo json_encode($data);
    }


    public function storeSearchData()
    {
        // Retrieve form data from POST request
        $topic = $this->request->getPost('topic');
        $fullName = $this->request->getPost('full_name');
        $emailId = $this->request->getPost('email_id');
        $message = $this->request->getPost('message');
        $code = $this->request->getPost('captcha_code');
    
        // Retrieve session user ID and security code
        $session = session();
        $sessionSecurityCode = $session->get('securityCode');
    
        // Validate email
        if (!filter_var($emailId, FILTER_VALIDATE_EMAIL)) {
            session()->setFlashdata('error', 'Invalid email format. Please enter a valid email address.');
            return redirect()->back()->withInput();
        }
    
        // Validate the security code
        if ($code != $sessionSecurityCode) {
            session()->setFlashdata('error', 'Security code does not match. Please try again.');
            return redirect()->back()->withInput();
        }
    
        // Form data is valid, proceed with storing and sending emails
        $tempData = [
            'topic' => $topic,
            'full_name' => $fullName,
            'email_id' => $emailId,
            'message' => $message,
            'code' => $code
        ];
    
        // Load email library
        $email = \Config\Services::email();
    
        // Send email to admin
        $adminEmail = clone $email; // Create a clone to avoid conflicts
        $adminEmail->setFrom('khodade2001@gmail.com', 'Manish Khodade');
        $adminEmail->setTo('manishkhodade7387@gmail.com'); // Admin email
        $adminEmail->setSubject('Search Data Received');
        $adminMessage = view('admin_search_mail', $tempData); // Load admin email template
        $adminEmail->setMessage($adminMessage);
        $adminEmail->setMailType('html'); // Set email format to HTML
        $adminEmail->send(); // Send email to admin
    
        // Send email to user
        $userEmail = clone $email; // Create a clone to avoid conflicts
        $userEmail->setFrom('khodade2001@gmail.com', 'Manish Khodade');
        $userEmail->setTo($emailId); // User email
        $userEmail->setSubject('Thank you for your search');
        $userMessage = view('user_search_mail', $tempData); // Load user email template
        $userEmail->setMessage($userMessage);
        $userEmail->setMailType('html'); // Set email format to HTML
        $userEmail->send(); // Send email to user
    
        // Redirect back to the search page or to a success page
        return redirect()->to(base_url('success'));
    }
    
}
