<?php

namespace Src\Controllers;


class HomeController
{


    public function index(): void
    {
        view('welcome/welcome');
    }
}
