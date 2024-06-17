<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReportModel;
use App\Models\NewsModel;

class BlogController extends Controller
{

    public function Blog()
    {
        try {
            // Load the NewsModel
            $newsModel = new NewsModel();

            // Fetch latest news data
            $news = $newsModel->getLatestNews();

            // Pass the fetched news data to the view
            $data['news'] = $news;

            // Load the ReportModel
            $reportModel = new ReportModel();

            // Fetch reports from last month to current date
            $reports = $reportModel->getLastMonthToCurrentReports();

            // Pass the fetched reports to the view
            $data['reports'] = $reports;

            // Load FooterController and fetch its data
            $footerController = new FooterController();
            $footerData = $footerController->index();

            // Ensure $footerData is an array
            if (!is_array($footerData)) {
                $footerData = [];
            }

            // Merge the fetched data with the existing data
            $data = array_merge($data, $footerData);

            // Load view with merged data
            return view('blog', $data);
        } catch (\Exception $e) {
            // If an exception occurs, redirect to the error page
            return redirect()->to(base_url('error-404'));
        }
    }


    public function loadNews($page = 1)
    {
        try {
            $perPage = 2; // Number of news articles per page
            $offset = ($page - 1) * $perPage;

            // Load the NewsModel
            $newsModel = new NewsModel();

            // Fetch news articles for the specified page
            $news = $newsModel->getLatestNews(); // Use getLatestNews method

            // Calculate pagination data
            $totalNews = count($news);
            $totalPages = ceil($totalNews / $perPage);

            // Paginate the news articles for the specified page
            $pagedNews = array_slice($news, $offset, $perPage);

            $data = [
                'news' => $pagedNews,
                'totalNews' => $totalNews,
                'perPage' => $perPage,
                'totalPages' => $totalPages
            ];

            // Return the paginated news articles as JSON
            echo json_encode($data);
        } catch (\Exception $e) {
            // If an exception occurs, redirect to the error page
            return redirect()->to(base_url('error-404'));
        }
    }


    public function newsDetail($id, $nws_url)
    {
        try {
            // Load the NewsModel
            $newsModel = new NewsModel();

            // Fetch the news article by ID
            $article = $newsModel->find($id);

            // If the fetched article exists and its nws_url matches the provided nws_url, proceed
            if ($article && $article['nws_url'] == $nws_url) {
                // Pass the fetched article data to the view
                $data['article'] = $article;

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
                return view('blog-antha-market-insight', $data);
            } else {
                // If the article doesn't exist or nws_url doesn't match, handle the error (e.g., show a 404 page)
                return redirect()->to(base_url('error-404'));
            }
        } catch (\Exception $e) {
            // If an exception occurs, redirect to the error page
            return redirect()->to(base_url('error-404'));
        }
    }
}
