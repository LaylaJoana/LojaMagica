<?php

function view($page, $params = [])
{
    foreach ($params as $key => $param) {
        $$key = $param;
    }

    return include __DIR__ . '/../Views/' . $page . '.php';
}
