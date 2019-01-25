<?php

namespace Model;

class BattleResult implements \ArrayAccess {
    private $usedJediPowers;
    
    private $winningShip;
    
    private $losingShip;
    
    /**
     * @param boolean $usedJediPowers, AbstractShip $winningShip|null, AbstractShip $losingShip|null
     */
    public function __construct($usedJediPowers, AbstractShip $winningShip = null, AbstractShip $losingShip = null) {
        $this->setWereJediPowersUsed($usedJediPowers);
        $this->setWinningShip($winningShip);
        $this->setLosingShip($losingShip);
    }
    
    /**
     * @return boolean|null
     */
    public function wereJediPowersUsed() {
        return $this->usedJediPowers;
    }
    
    /**
     * @param boolean $usedJediPowers|null
     */
    public function setWereJediPowersUsed($usedJediPowers = null) {
        if (!is_bool($usedJediPowers)) {
            throw new Exception('Invalid used jedi powers passed '.$usedJediPowers);
        }
        
        $this->usedJediPowers = $usedJediPowers;
    }
    
    /**
     * @return AbstractShip|null
     */
    public function getWinningShip() {
        return $this->winningShip;
    }
    
    /**
     * @param AbstractShip $winningShip
     */
    public function setWinningShip(AbstractShip $winningShip = null) {
        $this->winningShip = $winningShip;
    }
    
    /**
     * @return AbstractShip|null
     */
    public function getLosingShip() {
        return $this->losingShip;
    }
    
    /**
     * @param AbstractShip $losingShip
     */
    public function setLosingShip(AbstractShip $losingShip = null) {
        $this->losingShip = $losingShip;
    }
    
    /**
     * @return boolean
     */
    public function isThereAWinner() {
        return $this->getWinningShip() !== null;
    }
    
    public function offsetExists($offset) {
        return property_exists($this, $offset);
    }
    
    public function offsetGet($offset) {
        return $this->$offset;
    }
    
    public function offsetSet($offset, $value) {
        $this->$offset = $value;
    }
    
    public function offsetUnset($offset) {
        unset($this->$offset);
    }
}