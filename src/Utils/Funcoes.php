<?php

function dd($dados): void
{   
    echo "<pre>";
    print_r($dados);
    echo "</pre>";
    exit;
}