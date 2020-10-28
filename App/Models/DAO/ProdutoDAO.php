<?php

namespace App\Models\DAO;

use Core\DAO;
use App\Models\Entities\Produto;

class ProdutoDAO extends DAO {
    protected $table = 'produtos';
    protected $class = Produto::class;

    public function findAllIds(Array $ids){
        if(count($ids) > 0){
            $ids_merged = implode(',',$ids);
            $statement = $this->conn->query("SELECT * FROM $this->table WHERE id in($ids_merged)");
            return $this->processResults($statement);
        }
        return [];
    }
}
