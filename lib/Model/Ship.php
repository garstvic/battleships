<?php

namespace Model;

class Ship extends AbstractShip 
{
    use SettableJediFactorTrait;
    
    private $underRepair;
    
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);
        
        $this->underRepair = mt_rand(1, 100) < 30;
    }

    /**
     * @return boolean
     */
    public function isFunctional()
    {
        return !$this->underRepair;
    }
        
    /**
     * @return string
     */
    public function getType()
    {
        return 'Empire';
    }     
}
