<?php

class Connection
{

  private static $pdo = null;

  //=============
  // getPdo
  //=============
  /**
   *
   *  launch startConnexion
   *
   */
  public static function getPdo()
  {
    if (self::$pdo == null) {
      self::startConnexion();
    }

    return self::$pdo;
  }
  //=============
  // startConnexion
  //=============
  /**
   *
   *  Give the connection to DB if information is correct
   *
   */
  public static function startConnexion()
  {
    self::$pdo = new PDO(DSN, USERNAME, PWD, [PDO::ATTR_PERSISTENT => true]);
  }
}
