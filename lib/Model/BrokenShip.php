<?php

namespace Model;

class BrokenShip extends AbstractShip {
    /**
     * @return int
     */
    public function getJediFactor() {
        return 0;
    }
    
    /**
     * @return string
     */
    public function getType() {
        return 'Broken'; 
    }
    
    /**
     * @return boolean
     */
    public function isFunctional() {
        return false;   
    }
}