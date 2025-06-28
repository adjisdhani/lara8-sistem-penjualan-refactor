<?php

namespace App\Http\Controllers;

/* 
    kalo controller ini menggunakan service pattern

    jadi dari controller -> service -> model
*/

use App\Services\DashboardService;
class DashboardController extends Controller
{
    protected $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
       $data = $this->service->index();

        return view('Dashboard.index', $data);
    }
}