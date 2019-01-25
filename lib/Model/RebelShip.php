<?php

namespace Model;

class RebelShip extends AbstractShip {
    /**
     * @return string
     */
    public function getFavouriteJedi() {
        $coolJedis = array('Yoda', 'Ben Kenobi');
        $key = array_rand($coolJedis);
        
        return $coolJedis[$key];
    }
    
    /**
     * @return string
     */
    public function getType() {
        return 'Rebel';
    }
    
    /**
     * @return boolean
     */
    public function isFunctional() {
        return true;
    }
    
    /**
     * @return string
     */
    public function getNameAndSpecs($usedShortFormat = false) {
        return parent::getNameAndSpecs($usedShortForamt).' (Rebel)';
    }    
    
    /**
     * @return int
     */
    public function getJediFactor() {
        return rand(10, 30);
    }
}