<?php

interface CarService
{
  public function getCost();
}

class BasicInspection implements CarService
{
  public function getCost()
  {
    return 25;
  }
}

class OilChange implements CarService
{
  function __construct(CarService $car_service)
  {
    $this->car_service = $car_service;
  }

  public function getCost()
  {
    return 29 + $this->car_service->getCost();
  }
}

class TireRotation implements CarService
{
  function __construct(CarService $car_service)
  {
    $this->car_service = $car_service;
  }

  public function getCost()
  {
    return 50 + $this->car_service->getCost();
  }
}

echo (new OilChange(new TireRotation(new BasicInspection())))->getCost();
