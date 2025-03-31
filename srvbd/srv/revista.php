<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_REVISTAS.php";

ejecutaServicio(function () {
    $id = recuperaIdEntero("id");
    $modelo = selectFirst(pdo: Bd::pdo(), from: REVISTAS, where: [REV_ID => $id]);

    if ($modelo === false) {
        throw new ProblemDetails(
            status: NOT_FOUND,
            title: "Revista no encontrada",
            type: "/error/revistanoencontrada.html",
            detail: "No existe revista con el ID proporcionado"
        );
    }

    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $modelo[REV_NOMBRE]],
        "editorial" => ["value" => $modelo[REV_EDITORIAL]],
        "genero" => ["value" => $modelo[REV_GENERO]]
    ]);
});