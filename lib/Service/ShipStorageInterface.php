<?php

namespace Service;

interface ShipStorageInterface 
{
    /**
     * Returns an array of ship arrays with keys
     * 
     * @return array
     */
    public function fetchAllShipsData();
    
    /**
     * Returns an array of ship
     * 
     * @param integer $id
     * @return array
     */
    public function fetchSingleShipData($id);
}