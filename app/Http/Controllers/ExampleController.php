<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ExampleService;

class ExampleController extends Controller
{
    private $exampleService;

    public function __construct(ExampleService $exampleService)
	{
		$this->exampleService = $exampleService;
	}

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
       sleep(70);
        return true;
    }

    public function mediumTimeout()
    {
       sleep(15);
        return true;
    }

    public function smallTimeout()
    {
        sleep(5);
        return true;
    }

    public function getEmailByUserId($id)
    {
        $email = $this->exampleService->getEmailByUserId($id);

        return $this->replaceEmailDomain($email);
    }

    private function replaceEmailDomain($email)
    {
        if ($email) {
            $email = str_replace('@gmail.com', '@vti.com.vn', $email);
        }

        return $email;
    }
}
