<?php

namespace App\Controllers;

use App\Models\CategoryModel; // Import the CategoryModel

class CategoryController extends BaseController
{
    public function index()
    {
        // Initialize session
        $session = session();

        // Fetch report count from the session
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

        // Fetch categories from the database
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategories();

        return view('category', $data);
    }
}
