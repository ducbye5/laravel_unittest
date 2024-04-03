<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ExampleService;

class MockExampleController extends Controller
{
    private $exampleService;

    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    public function getEmailByUserId($id)
    {
        $email = $this->exampleService->getEmailByUserId($id);

        if ($this->checkExistEmail($email)) {
            return null;
        }

        return $this->replaceEmailDomain($email);
    }

    protected function checkExistEmail($email)
    {
        return empty($email);
    }

    private function replaceEmailDomain($email)
    {
        return str_replace('@gmail.com', '@vti.com.vn', $email);
    }
}
