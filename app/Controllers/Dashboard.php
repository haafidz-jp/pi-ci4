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

    // public function stok_kurang()
    // {

        // $builder = $this->db->table('produk');
        //     $query = $builder->get()->getResult();
        //     $data['all_data'] = $query;
        // $query = $builder->getWhere(['quantity <' => 5]);
        // $data['all_data'] = $query;
        

        // return view('dashboard/index', $data);


    //     // $all_data = $dashboard->get_compiled_select();
    //     // echo $all_data;

    //     // $result = $dashboard->stok_kurang();
    //     // echo '<pre>';
    //     //     print_r($result);
    //     // echo '<pre>';
    // }
}
