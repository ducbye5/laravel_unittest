<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public  function sum(int $a, int $b)
    {
        return $a + $b;
    }

    public  function sub(int $a, int $b)
    {
        return $a - $b;
    }
}
