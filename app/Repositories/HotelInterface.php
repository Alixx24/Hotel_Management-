<?php

namespace App\Repositories;

interface HotelInterface {

    function index();
    function agentRegisterStore(array $data);
    function checkLoginAgent($credentials);
}