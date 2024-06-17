<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CmsModel;
use App\Models\ContactInfoModel;
use App\Models\SubscribeModel;

class FooterController extends Controller
{
    public function index()
    {
        // Load the CmsModel
        $cmsModel = new CmsModel();

        // Fetch the CMS titles
        $cmsTitles = $cmsModel->getCmsTitles();

        // Pass the data to the view
        $data['cmsTitles'] = $cmsTitles;

        // Fetch report count from the session
        $session = session();
        $reportCount = $session->get('reportCount', 0); // Default to 0 if not set

        // Add report count to the data array
        $data['reportCount'] = $reportCount;

        // Load the ContactInfoModel
        $contactInfoModel = new ContactInfoModel();

        // Fetch the contact information (only the first row)
        $contactInfo = $contactInfoModel->first();

        // Pass the contact information data to the view
        $data['contactInfo'] = $contactInfo;

        // Load the view
        return view('footer', $data);
    }

    public function subscribe()
    {
        $subscribeModel = new SubscribeModel();

        // Get the email from the form
        $email = $this->request->getPost('EMAIL');

        // Validation rules
        $rules = [
            'EMAIL' => 'required|valid_email'
        ];

        // Custom error messages
        $errors = [
            'EMAIL' => [
                'required' => 'Email is required.',
                'valid_email' => 'Please enter a valid email address.'
            ]
        ];

        // Perform validation
        if (!$this->validate($rules, $errors)) {
            // Redirect back with validation errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // If validation passes, insert the email into the database
        $data = ['email' => $email];
        $subscribeModel->insert($data);

        // Send confirmation email to the user and notification email to the admin
        $this->sendEmails($email);

        // Redirect back with success message
        return redirect()->to(base_url('success'))->with('success', 'You have successfully subscribed.');
    }

    private function sendEmails($userEmail)
    {
        $email = \Config\Services::email();

        // Email configuration
        $email->setFrom('khodade2001@gmail.com', 'Manish Khodade');
        $adminEmail = 'manishkhodade7387@gmail.com'; // Replace with actual admin email

        // Email to the user
        $userMessage = view('user_subscribe_mail');
        $email->setTo($userEmail);
        $email->setSubject('Subscription Confirmation');
        $email->setMessage($userMessage);
        $email->setMailType('html');
        if (!$email->send()) {
            // Handle error if email to user fails to send
            log_message('error', 'Failed to send subscription confirmation email to user: ' . $email->printDebugger(['headers']));
        }

        // Email to the admin
        $email->clear(); // Clear previous email settings
        $adminMessage = view('admin_subscribe_mail', ['email' => $userEmail]);
        $email->setTo($adminEmail);
        $email->setSubject('New Subscription');
        $email->setMessage($adminMessage);
        $email->setMailType('html'); // Set email format to HTML

        if (!$email->send()) {
            // Handle error if email to admin fails to send
            log_message('error', 'Failed to send subscription notification email to admin: ' . $email->printDebugger(['headers']));
        }
    }


   
}
