<?php

namespace Model;

abstract class AbstractShip {
    private $id;
    
    private $name;
    
    private $weaponPower = 0;
    
    private $strength = 0;
    
    abstract public function getJediFactor();
    
    abstract public function getType();
    
    abstract public function isFunctional();
    
    /**
     * @param string $name
     */
    public function __construct($name) {
        $this->name = $name;
    }
   
    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName($name) {
        if (!is_string($name) || empty($name)) {
            throw new \Exception('Invalid name passed '.$name);
        }
        
        $this->name = $name;
    }
    
    /**
     * @return int
     */
    public function getWeaponPower() {
        return $this->weaponPower;
    }
    
    /**
     * @param int $weaponPower
     */
    public function setWeaponPower($weaponPower) {
        if (!is_numeric($weaponPower) || $weaponPower < 0) {
            throw new \Exception('Invalid weapon power passed '.$weaponPower);
        }
        
        $this->weaponPower = $weaponPower;
    }
    
    /**
     * @return int
     */
    public function getStrength() {
        return $this->strength;
    }
    
    /**
     * @param int $strength
     */
    public function setStrength($strength) {
        if (!is_numeric($strength)) {
            throw new \Exception('Invalid strength passed '.$strength);
        }
        
        $this->strength = $strength;
    }

    /**
     * @return string
     */
    public function getNameAndSpecs($usedShortFormat = false) {
        if ($usedShortFormat) {
            return sprintf(
                '%s: %s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->getJediFactor(),
                $this->strength
            );
        } else {
            return sprintf(
                '%s: w:%s, j:%s, s:%s',
                $this->name,
                $this->weaponPower,
                $this->getJediFactor(),
                $this->strength
            );            
        }
    }
    
    /**
     * @param AbstractShip $givenShip
     * 
     * @return boolean
     */
    public function doesGivenShipHaveMoreStrength(AbstractShip $givenShip) {
        return $givenShip->getStrength() > $this->strength;
    }
    
    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    protected function getSecretDoorCodeToTheDeathstar() {
        return 'Ra1nb0ws';
    }
    
    /**
     * @return string
     */
    public function __toString() {
        return $this->getName();
    }

}