<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_REVISTAS.php";

ejecutaServicio(function () {
    $nombre = validaNombre(recuperaTexto("nombre"));
    $editorial = validaNombre(recuperaTexto("editorial"));
    $genero = validaNombre(recuperaTexto("genero"));

    $pdo = Bd::pdo();
    insert(pdo: $pdo, into: REVISTAS, values: [
        REV_NOMBRE => $nombre,
        REV_EDITORIAL => $editorial,
        REV_GENERO => $genero
    ]);
    $id = $pdo->lastInsertId();

    devuelveCreated("/srv/revista.php?id=" . urlencode($id), [
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "editorial" => ["value" => $editorial],
        "genero" => ["value" => $genero]
    ]);
});
