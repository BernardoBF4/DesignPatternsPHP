<?php

interface Logger
{
  public function log();
}

class LogToFile implements Logger
{
  public function log()
  {
    var_dump('logging to file');
  }
}

class LogToDatabase implements Logger
{
  public function log()
  {
    var_dump('logging to database');
  }
}

class LogToGoogleChat implements Logger
{
  public function log()
  {
    var_dump('logging to google chat');
  }
}

class App
{
  public function log($data, Logger $logger = null)
  {
    $logger = $logger ?: new LogToFile();
    $logger->log($data);
  }
}

$app = (new App)->log('infos', new LogToDatabase);
