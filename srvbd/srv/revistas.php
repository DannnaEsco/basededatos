<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_REVISTAS.php";

ejecutaServicio(function () {
  $lista = select(pdo: Bd::pdo(), from: REVISTAS, orderBy: REV_NOMBRE);

  $render = "";
  foreach ($lista as $modelo) {
      $id = urlencode($modelo[REV_ID]);
      $nombre = htmlentities($modelo[REV_NOMBRE]);
      $editorial = htmlentities($modelo[REV_EDITORIAL]);
      
      $render .= "<li>
          <dl>
              <dt>Nombre</dt><dd>$nombre</dd>
              <dt>Editorial</dt><dd>$editorial</dd>
          </dl>
          <p><a href='modifica.html?id=$id'>Modificar</a></p>
      </li>";
  }

  devuelveJson(["lista" => ["innerHTML" => $render]]);
});