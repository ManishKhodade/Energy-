<?php

namespace App\Controllers;

use App\Libraries\CartLibrary;
use CodeIgniter\Controller;

class CartController extends Controller
{
    protected $cartLibrary;

    public function __construct()
    {
        $this->cartLibrary = new CartLibrary();
    }

    public function cart()
    {
        $session = session();
        $userId = $session->get('user_id');
        $cartData = $this->cartLibrary->getUserCartContents($userId);

        foreach ($cartData as &$item) {
            $item['license_types'] = $this->cartLibrary->getReportLicenseByReportId($item['report_id']);
        }

        $footerController = new FooterController();
        $footerData = $footerController->index();

        if (!is_array($footerData)) {
            $footerData = [];
        }
 // Fetch report count from the session
$session = session();
$reportCount = $session->get('reportCount', 0); // Default to 0 if not set

     

        $data=['cartContents' => $cartData,
        'reportCount' => $reportCount];

        $data = array_merge($data,$footerData);

        return view('cart', $data);
    }

    public function addToCart()
    {
        $session = session();

        $URLID = $this->request->getPost('rep_url');
        $reportId = $this->request->getPost('report_id');
        $sc1Name = $this->request->getPost('sc1_name');
        $repPage = $this->request->getPost('rep_page');
        $repTitle = $this->request->getPost('rep_title');
        $repDate = $this->request->getPost('rep_date');
        $submitTodo = $this->request->getPost('submit_todo');
        $reportLicense = (string) $this->request->getPost('report_license');

        list($licenseKey, $licenseValue) = explode('-', $reportLicense);

        if (!$session->has('user_id')) {
            $session->set('user_id', rand(100, 1000));
        }
        $userId = $session->get('user_id');




        
        $newCartItem = [
            'rep_url' => $URLID,
            'report_id' => $reportId,
            'sc1_name' => $sc1Name,
            'rep_page' => $repPage,
            'rep_title' => $repTitle,
            'rep_date' => $repDate,
            'license_key' => $licenseKey,
            'license_value' => $licenseValue
        ];

        $this->cartLibrary->addToCart($userId, $newCartItem);

        if ($submitTodo === 'buy_now') {
            return redirect()->to(base_url('/checkout/' . $userId));
        } else {
            return redirect()->to(base_url('/cart'));
        }
    }

    public function removeFromCart()
    {
        $session = session();
        $userId = $session->get('user_id');
        $indexToRemove = $this->request->getPost('index');

        $this->cartLibrary->removeFromCart($userId, $indexToRemove);

        return redirect()->to(base_url('/cart'));
    }

    public function updateCartLicense()
    {
        $session = session();
        $userId = $session->get('user_id');
        $index = $this->request->getPost('index');
        $license = (string) $this->request->getPost('license');

        list($licenseKey, $licenseValue) = explode('-', $license);

        $this->cartLibrary->updateCartItemLicense($userId, $index, $licenseKey, $licenseValue);

        return redirect()->to(base_url('/cart'));
    }
}
