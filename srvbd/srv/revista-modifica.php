<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_REVISTAS.php";

ejecutaServicio(function () {
    $id = recuperaIdEntero("id");
    $nombre = validaNombre(recuperaTexto("nombre"));
    $editorial = validaNombre(recuperaTexto("editorial"));
    $genero = validaNombre(recuperaTexto("genero"));

    update(
        pdo: Bd::pdo(),
        table: REVISTAS,
        set: [
            REV_NOMBRE => $nombre,
            REV_EDITORIAL => $editorial,
            REV_GENERO => $genero
        ],
        where: [REV_ID => $id]
    );

    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "editorial" => ["value" => $editorial],
        "genero" => ["value" => $genero]
    ]);
});