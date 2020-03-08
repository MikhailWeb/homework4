<?php

trait AddGPS
{
    protected $addGPS = false;
    protected $priceAddGPS = 15;

    protected function calculateAddGPS($hours)
    {
        return $hours * $this->priceAddGPS;
    }
}
