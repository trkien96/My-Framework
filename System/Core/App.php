<?php

class App extends Routes
{
    public function __construct()
    {
        $url = isset($_GET['r'])? $_GET['r'] : '';
        $this->route($url);
    }
}