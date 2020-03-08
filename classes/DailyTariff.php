<?php

class DailyTariff extends Tariff
{
    protected $name = 'Тариф суточный';
    protected $priceDistance = 1;
    protected $priceTime = 1000;

    use AddDriver;

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
            $sum += $this->calculateAddGPS($this->time * 24);
        }
        if ($this->addDriver) {
            $sum += $this->calculateAddDriver();
        }
        return $sum;
    }
}
