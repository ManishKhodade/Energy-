<?php

namespace App\Libraries;

use App\Models\CheckoutsModel;
use App\Models\ReportLicenseModel;

class CartLibrary
{
    protected $checkoutsModel;
    protected $reportLicenseModel;

    public function __construct()
    {
        $this->checkoutsModel = new CheckoutsModel();
        $this->reportLicenseModel = new ReportLicenseModel();
    }

    public function getUserCartContents($userId)
    {
        if (!$userId) {
            return [];
        }

        $userCart = $this->checkoutsModel->where('id', $userId)->first();
        if ($userCart) {
            return json_decode($userCart['cart_contents'], true);
        }

        return [];
    }

    public function addToCart($userId, $newCartItem)
    {
        $existingCheckout = $this->checkoutsModel->where('id', $userId)->first();

        if ($existingCheckout) {
            $cartContents = json_decode($existingCheckout['cart_contents'], true);
            $cartContents[] = $newCartItem;

            $this->checkoutsModel->update($existingCheckout['p_id'], [
                'cart_contents' => json_encode($cartContents)
            ]);
        } else {
            $this->checkoutsModel->insert([
                'id' => $userId,
                'cart_contents' => json_encode([$newCartItem])
            ]);
        }

        // Update the report count in the session
        $this->updateReportCount($userId);
    }

    public function removeFromCart($userId, $indexToRemove)
    {
        if ($userId !== null && $indexToRemove !== null) {
            $userCart = $this->checkoutsModel->where('id', $userId)->first();
            if ($userCart) {
                $cartContents = json_decode($userCart['cart_contents'], true);
                if (isset($cartContents[$indexToRemove])) {
                    unset($cartContents[$indexToRemove]);
                    $cartContents = array_values($cartContents);
                    $this->checkoutsModel->update($userCart['p_id'], ['cart_contents' => json_encode($cartContents)]);
                }
            }
        }

        // Update the report count in the session
        $this->updateReportCount($userId);
    }

    public function updateCartItemLicense($userId, $index, $licenseKey, $licenseValue)
    {
        $userCart = $this->checkoutsModel->where('id', $userId)->first();
        if ($userCart) {
            $cartContents = json_decode($userCart['cart_contents'], true);
            if (isset($cartContents[$index])) {
                $cartContents[$index]['license_key'] = $licenseKey;
                $cartContents[$index]['license_value'] = $licenseValue;
                $this->checkoutsModel->update($userCart['p_id'], ['cart_contents' => json_encode($cartContents)]);
            }
        }
    }

    public function getReportLicenseByReportId($reportId)
    {
        return $this->reportLicenseModel->where('li_rep_id', $reportId)->findAll();
    }

    private function updateReportCount($userId)
    {
        $session = session();
        $cartContents = $this->getUserCartContents($userId);
        $reportCount = count($cartContents);
        $session->set('reportCount', $reportCount);
    }

    public function clearCart($userId)
    {
        $userCart = $this->checkoutsModel->where('id', $userId)->first();
        if ($userCart) {
            $this->checkoutsModel->update($userCart['p_id'], ['cart_contents' => json_encode([])]);
        }

        // Update the report count in the session
        $this->updateReportCount($userId);
    }
}
