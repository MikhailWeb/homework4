<?php

class Daily extends Tariff
{
    public $name = 'Тариф суточный';
    public $priceDistance = 1;
    public $priceTime = 1000;

    use AddonDriver;

    public function __construct(int $distance, int $time, int $age, $arrAddon = [])
    {
        parent::__construct($distance, $time, $age, $arrAddon);
        $this->addDriver = (isset($arrAddon['addDriver']) && ($arrAddon['addDriver'] == true));
    }

    public function calculate()
    {
        $this->time = ($this->time < 30) ? 30 : $this->time;
        $day = (bcmod($this->time, 1470) > 0) ? 1 : 0;
        $this->time = intdiv($this->time, 1470) + $day;

        $sum = ($this->distance * $this->priceDistance + $this->time * $this->priceTime) * $this->indexAge($this->age);
        if ($this->addGPS) {
            $sum += $this->time * 24 * $this->priceAddGPS;
        }
        if ($this->addDriver) {
            $sum += $this->priceAddDriver;
        }
        return $sum;
    }
}
