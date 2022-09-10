<?php

abstract class Sub
{
  public function make()
  {
    return $this->layBread()
      ->addLettuce()
      ->addPrimaryToppings()
      ->addSauces();
  }

  protected function layBread()
  {
    var_dump('laying down the bread');
    return $this;
  }

  protected function addLettuce()
  {
    var_dump('adding lettuce');
    return $this;
  }

  protected function addSauces()
  {
    var_dump('adding sauces');
    return $this;
  }

  abstract function addPrimaryToppings();
}

class TurkeySub extends Sub
{
  public function addPrimaryToppings()
  {
    var_dump('adding turkey');
    return $this;
  }
}

class VeggieSub extends Sub
{
  public function addPrimaryToppings()
  {
    var_dump('adding veggies');
    return $this;
  }
}

$veggie_sub = (new VeggieSub())->make();
$turkey_sub = (new TurkeySub())->make();
