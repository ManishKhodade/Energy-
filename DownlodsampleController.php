<?php

namespace App\Controllers;

use App\Models\DownoldContactModel;
use CodeIgniter\Controller;
use Config\Services;

class DownlodsampleController extends Controller
{
    public function index($repId, $repUrl)
    {
        // Initialize session
        $session = session();

        // Fetch report data from the session
        $report = $session->get('report');
        
        // Generate a random security code and store it in the session
        $securityCode = mt_rand(1000, 9999);
        $session->set('securityCode', $securityCode);

        // Check if report data is empty
        if (empty($report)) {
            return redirect()->to(base_url('error-404'));
        }

        // Fetch report count from the session, default to 0 if not set
        $reportCount = $session->get('reportCount', 0);

        // Prepare data for the view
        $data = [
            'report' => $report,
            'reportCount' => $reportCount,
            'securityCode' => $securityCode
        ];

        // Load FooterController and fetch its data
        $footerController = new FooterController();
        $footerData = $footerController->index();

        // Merge the fetched data with the existing data
        if (is_array($footerData)) {
            $data = array_merge($data, $footerData);
        }

        // Load the download sample view with report data
        return view('downlodsample', $data);
    }

    public function save()
    {
        // Retrieve session security code
        $session = session();
        $sessionSecurityCode = $session->get('securityCode');

        // Retrieve user-entered code from the form
        $userEnteredCode = $this->request->getPost('code');

        // Check if the user-entered code matches the session security code
        if ($userEnteredCode != $sessionSecurityCode) {
            session()->setFlashdata('error', 'Security code does not match. Please try again.');
            return redirect()->back()->withInput();
        }

        // Create an instance of the DownoldContactModel
        $contactModel = new DownoldContactModel();

        // Retrieve form data
        $data = [
            'contact_plan' => $this->request->getPost('format'),
            'contact_rep_title' => $this->request->getPost('rep_title'),
            'contact_rep_date' => $this->request->getPost('rep_date'),
            'contact_rep_page' => $this->request->getPost('rep_page'),
            'contact_rep_id' => $this->request->getPost('rep_id'),
            'choose_report_id' => $this->request->getPost('rep_id'),
            'contact_person' => $this->request->getPost('first_Name') . ' ' . $this->request->getPost('last_name'),
            'contact_email' => $this->request->getPost('email'),
            'contact_phone' => $this->request->getPost('phone'),
            'contact_company' => $this->request->getPost('company'),
            'contact_job_role' => $this->request->getPost('job_role'),
            'contact_report_url' => $this->request->getPost('report_url'),
            'contact_code' => $this->request->getPost('code'),
            'contact_datetime' => date('Y-m-d H:i:s'),
        ];

        // Save data to the database
        if ($contactModel->insert($data)) {
            // Prepare email to the admin
            $adminEmail = Services::email();
            $adminEmail->setTo('manishkhodade7387@gmail.com');
            $adminEmail->setFrom('khodade2001@gmail.com', 'Manish Khodade');
            $adminEmail->setSubject('New Report Download Request');
            $adminMessage = view('downlod_admin_mail', $data);
            $adminEmail->setMessage($adminMessage);
            $adminEmail->setMailType('html'); // Set email format to HTML

            // Send emails
            $adminEmailSent = $adminEmail->send();

            // Prepare email to the user
            $userEmail = Services::email();
            $userEmail->setTo($data['contact_email']);
            $userEmail->setFrom('khodade2001@gmail.com', 'Manish Khodade');
            $userEmail->setSubject('Your Report Download Request');
            $userMessage = view('downlod_user_mail', $data);
            $userEmail->setMessage($userMessage);
            $userEmail->setMailType('html'); // Set email format to HTML

            $userEmailSent = $userEmail->send();

            // Check if both emails were sent
            if ($adminEmailSent && $userEmailSent) {
                session()->setFlashdata('message', 'Your request has been successfully submitted.');
            } else {
                // Log email errors if needed
                log_message('error', 'Failed to send emails.');
                session()->setFlashdata('error', 'Failed to send confirmation emails. Please try again.');
            }
        } else {
            session()->setFlashdata('error', 'Failed to submit your request. Please try again.');
        }

        return redirect()->to(base_url('success'));
    }
}
