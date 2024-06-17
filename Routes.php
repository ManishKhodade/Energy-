<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultController('IndexController::index'); // Set IndexController as default
$routes->get('/', 'IndexController::index');




$routes->get('footer', 'FooterController::index');
$routes->post('subscribe', 'FooterController::subscribe');
$routes->post('aa', 'FooterController::admin');


$routes->get('header', 'HeaderController::header');



$routes->get('contact-us', 'ContactController::contact');
$routes->post('contact/store', 'ContactController::store');


$routes->get('success', 'ThanksController::thanks');

$routes->get('/categories', 'CategoryController::index');

$routes->get('/checkout/(:num)', 'CheckoutController::index/$1');
$routes->post('remove-from-ckout', 'CheckoutController::removeFromCheckout');
$routes->post('store', 'CheckoutController::storeCheckout'); // Route to store checkout data


$routes->get('download-sample/(:num)/(:any)', 'DownlodsampleController::index/$1/$2');
$routes->post('save', 'DownlodsampleController::save');


$routes->get('letest-reports/', 'LetestReportController::letestreport');
// Define route for AJAX pagination of letest reports
$routes->get('letestreport/loadReports/(:num)', 'LetestReportController::loadReports/$1');



$routes->get('report/(:num)/(:any)', 'ReportDetailController::viewReport/$1/$2');


$routes->get('cart/', 'CartController::Cart'); // Route for adding item to cart
$routes->post('cart/add', 'CartController::addToCart');
$routes->post('remove-from-cart', 'CartController::removeFromCart');

$routes->post('update-cart-license', 'CartController::updateCartLicense');
$routes->get('cart/getCartCount', 'CartController::getCartCount');


$routes->get('about-Us','AboutUsController::AboutUs');


$routes->get('error-404','ErrorController::error');


$routes->get('blog', 'BlogController::Blog');
$routes->get('blog/(:num)/(:segment)', 'BlogController::newsDetail/$1/$2');
$routes->get('blog/page/(:num)', 'BlogController::loadNews/$1');


$routes->get('search-result', 'SearchController::search');
// Define route for AJAX pagination of search results
$routes->get('search/paginate', 'SearchController::paginateSearch');
$routes->post('/store-search-data', 'SearchController::storeSearchData');




$routes->get('category/(:any)', 'CategoryreportController::category/$1');
$routes->get('get-reports/(:num)/(:num)', 'CategoryreportController::getReports/$1/$2');



// Define a catch-all route to handle all other requests
// This route will match any URI segment and route it to the CmsController's cms method
// It should be placed last in the routes file to ensure it catches requests that don't match any previous routes
$routes->get('(:any)', 'CmsController::cms/$1');
