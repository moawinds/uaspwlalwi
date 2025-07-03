<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class aboutController extends BaseController
{
    public function index()
    {
        return view ('v_about');
    }
}