<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ContactUsModel;
use Config\Services;
use App\Models\CountryModel; // Import CountryModel

class ContactController extends Controller
{
    public function contact()
    {


        // Load FooterController and fetch its data
        $footerController = new FooterController();
        $footerData = $footerController->index();

        // Ensure $footerData is an array
        if (!is_array($footerData)) {
            $footerData = [];
        }

          // Load the CountryModel
          $countryModel = new CountryModel();

          // Fetch countries
          $countries = $countryModel->getCountries();

        // Fetch report count from the session
        $session = session();
        $reportCount = $session->get('reportCount', 0); // Default to 0 if not set


         // Generate a random security code and store it in the session
         $securityCode = mt_rand(1000, 9999);
         $session->set('securityCode', $securityCode);
        $data['securityCode'] = $securityCode;

        // Add report count to the data array
        $data['reportCount'] = $reportCount;
        $data['countries'] = $countries;
        
        // Merge the fetched data with the existing data
        $data = array_merge($data, $footerData);

        // Load view with merged data
        return view('contact_form', $data);
    }
    

    public function store()
    {
        // Load the ContactUsModel
        $contactUsModel = new ContactUsModel();

        // Retrieve the form data from POST request
        $formData = [
            'Username' => $this->request->getPost('name'),
            'Email' => $this->request->getPost('email'),
            'Phone' => $this->request->getPost('phone'),
            'Enter_Company' => $this->request->getPost('Company_name'),
            'Country' => $this->request->getPost('Country'),
            'Message' => $this->request->getPost('message')
        ];

        // Insert the data into the database
        if (!$contactUsModel->insert($formData)) {
            // Handle the error if insertion fails
            return redirect()->back()->with('error', 'Failed to save the contact data.');
        }

        // Send email to administrator
        $adminEmail = Services::email(); // Load email library
        $adminEmail->setFrom('khodade2001@gmail.com', 'Manish Khodade');
        $adminEmail->setTo('manishkhodade7387@gmail.com'); // Set recipient email address
        $adminEmail->setSubject('New Contact Form Submission');

        // Construct email message for administrator
        $adminMessage = view('contact_admin_email', ['formData' => $formData]);
        $adminEmail->setMessage($adminMessage);
        $adminEmail->setMailType('html'); // Set email format to HTML

        // Send email to administrator
        if (!$adminEmail->send()) {
            // Email sending to administrator failed
            return redirect()->to(base_url('error-404'));
        }

        // Send email to user
        $userEmail = Services::email(); // Load email library
        $userEmail->setFrom('khodade2001@gmail.com', 'Manish Khodade');
        $userEmail->setTo($formData['Email']); // Set recipient email address
        $userEmail->setSubject('Thank you for contacting us');

        // Construct email message for user
        $userMessage = view('contact_user_email', ['formData' => $formData]);
        $userEmail->setMessage($userMessage);
        $userEmail->setMailType('html'); // Set email format to HTML

        // Send email to user
        if (!$userEmail->send()) {
            // Email sending to user failed
            return redirect()->to(base_url('error-404'));
        }

        // Email sent successfully to both administrator and user
        return redirect()->to(base_url('success'));
    }
}
