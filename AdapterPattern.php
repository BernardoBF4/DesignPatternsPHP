<?php

interface BookInterface
{
  public function open();
  public function turnPage();
}

interface EReder
{
  public function turnOn();
  public function pressNextButton();
}

class Book implements BookInterface
{
  public function open()
  {
    var_dump('opening the paper book');
  }

  public function turnPage()
  {
    var_dump('turnng the page');
  }
}

class Kindle implements EReder // The Kindle class doesn't implments the BookInterface contract and therefore cannot be used with the read method from Person
{
  public function turnOn()
  {
    var_dump('turning on the device');
  }

  public function pressNextButton()
  {
    var_dump('going to the next page');
  }
}

// That's why we have an adapater, to make the Kindle (of type EReder) be usable by the read method in Person
class EReaderAdapter implements BookInterface // This contract is necessary, since the adpater must be guaranteed to have the same methods as the the Book class, so that they might be interchangeable 
{
  public function __construct(EReder $e_reader) // It wraps the EReder-typed object and then maps each function of it into the BookInterface functions
  {
    $this->e_reader = $e_reader;
  }

  public function open()
  {
    $this->e_reader->turnOn();
  }

  public function turnPage()
  {
    $this->e_reader->pressNextButton();
  }
}


class Person
{
  public function read(BookInterface $book) // The read method requires any object that implements the BookInterface contract
  {
    $book->open();
    $book->turnPage();
  }
}

(new Person())->read(new EReaderAdapter(new Kindle));
