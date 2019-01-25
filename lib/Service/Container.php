<?php

namespace Service;

use Service\ShipLoader;
use Service\JsonFileShipStorage;
use Service\PdoShipStorage;
use Service\BattleManager;
use PDO;

class Container {
    private $configuration;
    
    private $pdo;
    
    private $shipLoader;
    
    private $shipStorage;
    
    private $battleManager;
   
    /**
     * @param array $configuration
     */
    public function __construct(array $configuration) {
        $this->configuration = $configuration;
    }
    
    /**
     * @return PDO
     */
    public function getPDO() {
        if (is_null($this->pdo)) {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_pass']  
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        return $this->pdo;
    }
    
    /**
     * @return ShipLoader
     */
    public function getShipLoader() {
        if (is_null($this->shipLoader)) {
            $this->shipLoader = new ShipLoader($this->getShipStorage());
        }
        
        return $this->shipLoader;
    }
    
    /**
     * @return ShipStorageInterface
     */
    public function getShipStorage() {
        if (is_null($this->shipStorage)) {
            // $this->shipStorage = new PdoShipStorage($this->getPDO());
            $this->shipStorage = new JsonFileShipStorage(__DIR__.'/../../resources/ships.json');
            
            $this->shipStorage = new LoggableShipStorage($this->shipStorage);
        }
        
        return $this->shipStorage;
    }
    
    /**
     * @return BattleManager
     */
    public function getBattleManager() {
        if (is_null($this->battleManager)) {
            $this->battleManager = new BattleManager();
        }
        
        return $this->battleManager;
    }
}
