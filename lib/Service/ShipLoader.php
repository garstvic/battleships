<?php

namespace Service;

use Model\RebelShip;
use Model\Ship;
use Model\AbstractShip;
use Model\ShipCollection;
use Model\BountyHunterShip;

class ShipLoader {
    private $shipStorage;
    
    /**
     * @param ShipStorageInterface $shipStorage
     */
    public function __construct(ShipStorageInterface $shipStorage) {
        $this->shipStorage = $shipStorage;
    }
    
    /**
     * @return ShipCollection
     */
    public function getShips() {
        try {
            $shipsData = $this->shipStorage->fetchAllShipsData();
        } catch (\PDOException $e) {
            trigger_error('Database Exception! '.$e->getMessage());
            $shipsData = array();
        }
        
        $ships = array();
        
        foreach ($shipsData as $shipData) {
            $ships[] = $this->createShipFromData($shipData);
        }
        
        // Boba Fett's ship
        $ships[] = new BountyHunterShip('Slave 1');
        
        return new ShipCollection($ships);
    }   

    /**
     * @return AbstractShip
     */
    private function createShipFromData(array $shipData) {
        if (strpos($shipData['team'], 'rebel') === 0) {
            $ship = new RebelShip($shipData['name']);
        } else {
            $ship = new Ship($shipData['name']);
            $ship->setJediFactor($shipData['jedi_factor']);            
        }
        
        $ship->setId($shipData['id']);
        $ship->setWeaponPower($shipData['weapon_power']);
        $ship->setStrength($shipData['strength']);
        
        return $ship;
    }
    
    /**
     * @param int $id
     * @return null|AbstractShip 
     */
    public function findOneById($id) {
        
        $shipArray = $this->shipStorage->fetchSingleShipData($id);
        
        return $this->createShipFromData($shipArray);
    }

}
