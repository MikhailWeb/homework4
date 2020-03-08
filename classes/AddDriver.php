<?php

trait AddDriver
{
    protected $addDriver = false;
    protected $priceAddDriver = 100;

    protected function calculateAddDriver()
    {
        return $this->priceAddDriver;
    }

}
