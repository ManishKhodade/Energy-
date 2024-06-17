<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CheckoutsModel;
use App\Libraries\CartLibrary;
use App\Models\CountryModel;

use Config\Services;

class CheckoutController extends Controller
{
    protected $cartLibrary;
    protected $checkoutModel;
    protected $countryModel;
    public function __construct()
    {
        $this->cartLibrary = new CartLibrary();
        $this->checkoutModel = new CheckoutsModel();
        $this->countryModel = new CountryModel(); // Initialize the CountryModel

        
    }

    public function index($userId = null)
    {



        
        if (is_null($userId) || !is_numeric($userId)) {
            // If user ID is missing or invalid, redirect to 404 page
            return redirect()->to(base_url('/error-404'));
        }

        // Fetch the cart data for the user
        $cartData = $this->cartLibrary->getUserCartContents($userId);

        if (empty($cartData)) {
            // If no cart data is found, redirect to cart page with an empty cart message
            return redirect()->to(base_url('/cart'))->with('message', 'Your cart is empty!');
        }

        // Calculate the subtotal
        $subTotal = 0;
        foreach ($cartData as $item) {
            $subTotal += (float) $item['license_value'];
        }

        // Load FooterController and fetch its data
        $footerController = new FooterController();
        $footerData = $footerController->index();

        // Ensure $footerData is an array
        if (!is_array($footerData)) {
            $footerData = [];
        }

        // Generate a random security code and store it in the session
        $securityCode = mt_rand(1000, 9999);
        session()->set('securityCode', $securityCode);


        $countries = $this->countryModel->getCountries(); // Fetch countries


        // Prepare data for the view
        $data = [
            'cartContents' => $cartData,
            'subTotal' => $subTotal,
            'securityCode' => $securityCode,
            'countries' => $countries
        ];

        // Fetch report count from the session
        $session = session();
        $reportCount = $session->get('reportCount', 0); // Default to 0 if not set

        // Add report count to the data array
        $data['reportCount'] = $reportCount;

        // Merge with footer data
        $data = array_merge($data, $footerData);

        // Load view with merged data
        return view('checkout', $data);
    }

    // Method to store checkout data in the database
    public function storeCheckout()
{
    // Retrieve session user ID and security code
    $session = session();
    $userId = $session->get('user_id');
    $sessionSecurityCode = $session->get('securityCode');

    // Retrieve form data
    $payopction = $this->request->getPost('pay_option');
    $fullName = $this->request->getPost('full_name');
    $email = $this->request->getPost('email');
    $companyName = $this->request->getPost('company_name');
    $contactNumber = $this->request->getPost('contact_number');
    $jobRole = $this->request->getPost('job_role');
    $country = $this->request->getPost('country');
    $userSecurityCode = $this->request->getPost('security_code');

    // Validate the security code
    if ($userSecurityCode != $sessionSecurityCode) {
        return redirect()->back()->with('error', 'The security code does not match. Please try again.');
    }

    // Get current date and time
    $date = date('Y-m-d H:i:s');

    // Prepare data for insertion
    $checkoutData = [
        'checkout_type' => $payopction,
        'full_name' => $fullName,
        'email_id' => $email,
        'company' => $companyName,
        'contact_no' => $contactNumber,
        'city' => $jobRole,
        'country' => $country,
        'password' => $userSecurityCode,
        'date' => $date
    ];

    // Find the row in the database where ID matches the session user ID
    $existingRow = $this->checkoutModel->where('id', $userId)->first();

    // If a row with the matching user ID exists, update it; otherwise, insert a new row
    if ($existingRow) {
        $this->checkoutModel->update($existingRow['p_id'], $checkoutData);
    } else {
        $checkoutData['id'] = $userId; // Set the user ID in the data array
        $this->checkoutModel->insert($checkoutData);
    }

    // Fetch the cart data for the user
    $cartData = $this->cartLibrary->getUserCartContents($userId);

    // Prepare email data
    $emailData = [
        'checkoutData' => $checkoutData,
        'cartData' => $cartData
    ];

    // Send email to administrator
    $adminEmail = Services::email(); // Load email library
    $adminEmail->setFrom('khodade2001@gmail.com', 'Manish Khodade');
    $adminEmail->setTo('manishkhodade7387@gmail.com'); // Set recipient email address
    $adminEmail->setSubject('New Checkout Form Submission');

    // Construct email message for administrator
    $adminMessage = view('checkout_admin_mail', $emailData);
    $adminEmail->setMessage($adminMessage);
    $adminEmail->setMailType('html'); // Set email format to HTML

    // Send email to administrator
    $adminEmailSent = $adminEmail->send();

    // Send email to user
    $userEmail = Services::email(); // Load email library
    $userEmail->setFrom('khodade2001@gmail.com', 'Manish Khodade');
    $userEmail->setTo($email); // Set recipient email address
    $userEmail->setSubject('Thank you for contacting us');

    // Construct email message for user
    $userMessage = view('checkout_user_mail', $emailData);
    $userEmail->setMessage($userMessage);
    $userEmail->setMailType('html'); // Set email format to HTML

    // Send email to user
    $userEmailSent = $userEmail->send();

    if ($adminEmailSent && $userEmailSent) {
        // Emails sent successfully, clear the cart
        $this->cartLibrary->clearCart($userId);
        return redirect()->to(base_url('success'));
    } else {
        // Email sending failed, capture debug info
        $data = [];
        if (!$adminEmailSent) {
            $data['adminEmailError'] = $adminEmail->printDebugger(['headers']);
        }
        if (!$userEmailSent) {
            $data['userEmailError'] = $userEmail->printDebugger(['headers']);
        }
        return redirect()->back()->with('error', 'Failed to send emails')->withInput()->with('emailErrors', $data);
    }
}



public function removeFromCheckout()
{
    $session = session();
    $userId = $session->get('user_id');
    $indexToRemove = $this->request->getPost('index');

    $this->cartLibrary->removeFromCart($userId, $indexToRemove);

    return redirect()->to(base_url('/cart'));
}


}
