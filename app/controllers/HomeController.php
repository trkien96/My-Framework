<?php

class HomeController extends Routes
{
    public function index()
    {
        $this->lib("Auth");
        $auth = new Auth;
        $result = $auth->login("Trung Kien","12345678");
        $this->view('home', ['name' => $result]);
    }

    public function show()
    {
        echo base('style.js');
    }
}