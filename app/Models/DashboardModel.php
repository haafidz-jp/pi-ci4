<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

    public function total_produk()
    {
        return $this->db->table('produk')->countAll();
    }

    public function total_supplier()
    {
        return $this->db->table('supplier')->countAll();
    }
}