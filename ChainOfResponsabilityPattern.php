<?php

class HomeStatus
{
  public $lightsOff = true;
  public $alarmOn = true;
  public $doorLocked = true;
}

abstract class HomeChecker
{
  protected $successor;

  public abstract function check(HomeStatus $home);

  public function succeedWith(HomeChecker $successor)
  {
    $this->successor = $successor;
  }

  public function next(HomeStatus $home)
  {
    if ($this->successor) {
      $this->successor->check($home);
    }
  }
}

class Lights extends HomeChecker
{
  public function check(HomeStatus $home)
  {
    if (!$home->lightsOff) {
      throw new Exception('The lights are still on!');
    }

    $this->next($home);
  }
}

class Alarm extends HomeChecker
{
  public function check(HomeStatus $home)
  {
    if (!$home->alarmOn) {
      throw new Exception('The alarm is not on!');
    }

    $this->next($home);
  }
}

class Door extends HomeChecker
{
  public function check(HomeStatus $home)
  {
    if (!$home->doorLocked) {
      throw new Exception('The door is not locked!');
    }

    $this->next($home);
  }
}

$lights = new Lights();
$alarm = new Alarm();
$door = new Door();

$lights->succeedWith($alarm);
$alarm->succeedWith($door);

$lights->check(new HomeStatus);
