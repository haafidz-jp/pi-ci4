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
    public function select_data($id = TRUE)
    {
        if ($id == FALSE) {
            return $this->builder->get()->getResultObject();
        }

        return $this->builder->getWhere(['quantity <' => 5])->getRow();
    }

    public function total_produk()
    {
        return $this->db->table('produk')->countAll();
    }

    public function total_supplier()
    {
        return $this->db->table('supplier')->countAll();
    }

    // public function stok_kurangg()
    // {
    //     $builder = $this->db->table('produk');
    //     $query = $builder->get()->getResult();
    //     $data['all_data'] = $query;

    //     return $this->db->table('produk')->getWhere(['quantity <' => 5]);
    // }

    // public function stok_kurang()
    // {

    //     // $query = $builder->getWhere('produk', array('quantity <' => 5));
        

    //     // ini query
    //     // return $this->db->table('produk')
    //     //                 ->where(['quantity <' => 5])
    //     //                 ->get()
    //     //                 ->getRow();

    //     // $builder = $this->db->table('produk');
    //     // $builder->where(array('quantity <' => 5));
    //     // $query = $builder->getCompiledSelect();
    //     // return $query;

    //     // SQL Statement
    //     // return $this->db->table('produk')
    //     // ->select('id,name ,category, quantity, sku')
    //     // ->where(array('quantity <' => 5))
    //     // ->get();
    // }
}