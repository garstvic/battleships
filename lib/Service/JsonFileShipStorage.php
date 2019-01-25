<?php

namespace Service;

class JsonFileShipStorage implements ShipStorageInterface {
    private $filename;
    
    /**
     * @param string $jsonFilePath
     */
    public function __construct($jsonFilePath) {
        $this->filename = $jsonFilePath;
    }
    
    /**
     * @return string
     */
    public function fetchAllShipsData() {
        $jsonContents = file_get_contents($this->filename);
        
        return json_decode($jsonContents, true);
    }
    
    /**
     * @return null|[]
     */
    public function fetchSingleShipData($id) {
        $ships = $this->fetchAllShipsData();
        
        foreach ($ships as $ship) {
            if ($ship['id'] == $id) {
                return $ship;
            }   
        }
        
        return null;
    }
}