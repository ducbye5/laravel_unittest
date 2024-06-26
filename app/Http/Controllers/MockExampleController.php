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

    public function getEmailByUserId($id)
    {
        $email = $this->exampleService->getEmailByUserId($id);

        if ($this->checkExistEmail($email)) {
            return $this->exampleService->getNoReplyEmail();
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
        $user->name = 'Merry';
        $user->password = '123456';
        $user->save();

        return $user;
    }

    public function deleteUserByIds($ids)
    {
        DeleteUserJob::dispatch($ids);
    }

    public function storeFile()
    {

    }
}
