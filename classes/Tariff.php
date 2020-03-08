<?php

trait AddonGPS
{
    public $addGPS = false;
    public $priceAddGPS = 15;
}

trait AddonDriver
{
    public $addDriver = false;
    public $priceAddDriver = 100;
}

abstract class Tariff implements iTariff
{
    public $name;
    public $driverMinAge = 18;
    public $driverMaxAge = 65;
    public $driverRiskAge = 21;
    public $driverRiskPercent = 10;
    public $priceDistance;
    public $distance;
    public $priceTime;
    public $time;
    public $age;

    use AddonGPS;

    public function __construct(int $distance, int $time, int $age, $arrAddon = [])
    {
        echo $this->name;
        $this->distance = $distance;
        $this->time = $time;
        $this->age = $age;

        $this->addGPS = (isset($arrAddon['addGPS']) && ($arrAddon['addGPS'] == true));
    }

    public function calculate()
    {
        $sum = ($this->distance * $this->priceDistance + $this->time * $this->priceTime) * $this->indexAge($this->age);

        if ($this->addGPS) {
            $this->time = ($this->time < 1) ? 1 : $this->time;
            $hour = (bcmod($this->time, 60) > 0) ? 1 : 0;
            $this->time = intdiv($this->time, 60) + $hour;
            $sum += $this->time * $this->priceAddGPS;
        }
        return $sum;
    }

    public function checkAge($age)
    {
        if (($age < $this->driverMinAge) || ($age > $this->driverMaxAge)) {
            die('sharing auto impossible');
        } else {
            return true;
        }
    }

    public function indexAge(int $age)
    {
        $index = 1;
        if ($this->checkAge($age) && ($age < $this->driverRiskAge)) {
            $index += $index * $this->driverRiskPercent / 100;
        }
        return $index;
    }
}