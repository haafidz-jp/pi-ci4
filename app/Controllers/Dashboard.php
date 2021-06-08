<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    protected $dashboard;

    public function __construct()
    {
        $this->dashboard = new DashboardModel();
    }


    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'total_produk' => $this->dashboard->total_produk(),
            'total_supplier' => $this->dashboard->total_supplier(),
            'all_data' => $this->dashboard->select_data() // selecting all data
        ];

        return view('dashboard/index', $data);
    }

    
}
