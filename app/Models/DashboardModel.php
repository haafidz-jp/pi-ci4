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

    // func select all data or by id
    public function select_data($id = FALSE)
    {
        if ($id == FALSE) {
            return $this->builder->get()->getResultObject();
        }

        return $this->builder->getWhere(['id' => 5])->getRow();
    }

    public function total_produk()
    {
        return $this->db->table('produk')->countAll();
    }

    public function total_supplier()
    {
        return $this->db->table('supplier')->countAll();
    }

    public function stok_kurang()
    {
        // return $this->db->table('produk')
        // $builder = $this->db->table('produk');
        // $builder->select('id,name,category,quantity,sku')
        // ->where(array('quantity <' => 5));
        // $query = $builder->get();
        // return $query;

        // SQL Statement
        // return $this->db->table('produk')
        // ->select('id,name ,category, quantity, sku')
        // ->where(array('quantity <' => 5))
        // ->get();
    }
}