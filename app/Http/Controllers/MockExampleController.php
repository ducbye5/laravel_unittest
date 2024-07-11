<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ExampleService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Jobs\DeleteUserJob;

class MockExampleController extends Controller
{
    private $exampleService;

    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    public function formatNumber($number)
    {
        $number =  $this->roundNumber($number);

        return $this->convertNumberToInt($number);
    }

    public function convertNumberToInt($number)
    {
        return (int) $number;
    }

    protected function roundNumber($number)
    {
        return round($number, 2);
    }

    public function getEmailByUserId($id)
    {
        $email = $this->exampleService->getEmailByUserId($id);

        if ($this->isNotExistEmail($email)) {
            return $this->exampleService->getNoReplyEmail();
        }

        return $this->replaceEmailDomain($email);
    }

    protected function isNotExistEmail($email)
    {
        return empty($email);
    }

    private function replaceEmailDomain($email)
    {
        return str_replace('@gmail.com', '@vti.com.vn', $email);
    }

    public function getEmailFromCacheByKey($key)
    {
        return Cache::get($key);
    }

    public function getUserAddressById($id)
    {
        $user = DB::table('user')->where('id', $id)->first();

        return $user->address;
    }

    public function createUser()
    {
        $user = new User();
        $user->name = 'abc';
        $user->email = 'abc@gmail.com';
        return $user->save();
    }

    public function findUser()
    {
        return User::find(1);
    }

    public function deleteUserByIds($ids)
    {
        DeleteUserJob::dispatch($ids);
    }
}
