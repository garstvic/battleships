<?php

namespace Model;

trait SettableJediFactorTrait {
    private $jediFactor = 0;
    
    /**
     * @return integer
     */
    public function getJediFactor() 
    {
        return $this->jediFactor;
    }
    
    /**
     * @param integer $jediFactor
     */
    public function setJediFactor($jediFactor)
    {
        if (!is_numeric($jediFactor) || $jediFactor < 0) {
            throw new Exception('Invalid jedi factor passed '.$jediFactor);
        }
        
        $this->jediFactor = $jediFactor;
    }
}
