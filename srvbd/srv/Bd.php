<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS REVISTAS (
      REV_ID INTEGER,
      REV_NOMBRE TEXT NOT NULL,
      REV_EDITORIAL TEXT NOT NULL,
      REV_GENERO TEXT NOT NULL,
      CONSTRAINT REV_PK
          PRIMARY KEY(REV_ID),
      CONSTRAINT REV_NOMBRE_UNQ
          UNIQUE(REV_NOMBRE),
      CONSTRAINT REV_NOMBRE_NV
          CHECK(LENGTH(REV_NOMBRE) > 0),
      CONSTRAINT REV_EDITORIAL_NV
          CHECK(LENGTH(REV_EDITORIAL) > 0),
      CONSTRAINT REV_GENERO_NV
          CHECK(LENGTH(REV_GENERO) > 0)
  )"
   );
  }

  return self::$pdo;
 }
}
