<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('produk');  
    }

    // fungsi SELECT * FROM produk WHERE quantity < 5;
    public function produk_kurang()
    {
        return $this->builder->getWhere(['quantity <' => 5])->getResultObject();
    }

     // fungsi SELECT * FROM produk WHERE quantity > 10;
    public function produk_lebih()
    {
        return $this->builder->getWhere(['quantity >' => 10])->getResultObject();
    }

    // return INT
    public function total_produk()
    {
        return $this->db->table('produk')->countAll();
    }

    // return INT
    public function total_supplier()
    {
        return $this->db->table('supplier')->countAll();
    }
}