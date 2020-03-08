<?php

abstract class Tariff implements TariffInterface
{
    protected $name;
    protected $driverMinAge = 18;
    protected $driverMaxAge = 65;
    protected $driverRiskAge = 21;
    protected $driverRiskPercent = 10;
    protected $priceDistance;
    protected $distance;
    protected $priceTime;
    protected $time;
    protected $age;

    use AddGPS;

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
            $sum += $this->calculateAddGPS($this->time);
        }
        return $sum;
    }

    private function checkAge($age)
    {
        if (($age < $this->driverMinAge) || ($age > $this->driverMaxAge)) {
            die('Прокат автомобилей запрещен по возрасту');
        } else {
            return true;
        }
    }

    // пока оставил пабликом для вывода формулы расчета в index.php
    public function indexAge(int $age)
    {
        $index = 1;
        if ($this->checkAge($age) && ($age < $this->driverRiskAge)) {
            $index += $index * $this->driverRiskPercent / 100;
        }
        return $index;
    }
}