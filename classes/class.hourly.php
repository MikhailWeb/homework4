<?php

class Hourly extends Tariff
{
    public $name = 'Тариф почасовой';
    public $priceDistance = 0;
    public $priceTime = 200;

    use AddonDriver;

    public function __construct(int $distance, int $time, int $age, $arrAddon = [])
    {
        parent::__construct($distance, $time, $age, $arrAddon);
        $this->addDriver = (isset($arrAddon['addDriver']) && ($arrAddon['addDriver'] == true));
    }

    public function calculate()
    {
        $this->time = ($this->time < 1) ? 1 : $this->time;
        $hour = (bcmod($this->time, 60) > 0) ? 1 : 0;
        $this->time = intdiv($this->time, 60) + $hour;

        $sum = ($this->distance * $this->priceDistance + $this->time * $this->priceTime) * $this->indexAge($this->age);
        if ($this->addGPS) {
            $sum += $this->time * $this->priceAddGPS;
        }
        if ($this->addDriver) {
            $sum += $this->priceAddDriver;
        }
        return $sum;
    }
}
