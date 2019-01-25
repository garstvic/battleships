<?php

namespace Service;

use PDO;

class PdoShipStorage implements ShipStorageInterface {
    public $pdo;
    
    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    
    /**
     * @return []
     */
    public function fetchAllShipsData() {
        $pdo = $this->pdo;
        $statement = $pdo->prepare('SELECT * FROM ship');
        $statement->execute();
        $shipsArray = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $shipsArray;
    }
    
    /**
     * @return []
     */
    public function fetchSingleShipData($id) {
        $pdo = $this->pdo;
        $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
        $statement->execute(array('id' => $id));
        $shipArray = $statement->fetch(PDO::FETCH_ASSOC);
        
        if (!$shipArray) {
            return null;
        }
        
        return $shipArray;
    }
}
