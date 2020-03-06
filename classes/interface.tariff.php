<?php

interface iTariff
{
    /**
     * @return mixed
     */
    public function calculate();


    /**
     * @param int $age
     */
    public function checkAge(int $age);


    /**
     * @param int $age
     */
    public function indexAge(int $age);
}