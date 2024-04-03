<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ExampleController extends Controller
{
    public function sum(int $a, int $b)
    {
        return $a + $b;
    }

    public function sub(int $a, int $b)
    {
        return $a - $b;
    }

    public function existArrayKey(array $arr, $key)
    {
        return array_key_exists($key, $arr);
    }

    public function largeTimeout()
    {
//       sleep(70);
        return true;
    }

    public function mediumTimeout()
    {
//       sleep(15);
        return true;
    }

    public function smallTimeout()
    {
        sleep(5);
        return true;
    }

    public function getEmailFromCacheByKey($key)
    {
        return Cache::get($key);
    }
}
