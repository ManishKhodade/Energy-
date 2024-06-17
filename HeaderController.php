<?php

namespace App\Controllers;

class HeaderController extends BaseController
{
    public function header()
    {
        $session = session();
        $reportCount = $session->get('reportCount', 0); // Default to 0 if not set

        return view('header', ['reportCount' => $reportCount]);
    }
}
