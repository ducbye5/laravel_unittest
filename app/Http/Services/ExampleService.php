<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class ExampleService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

    public function getEmailByUserId($id)
    {
        if (! $this->validateUserId($id)) {
            return null;
        }

        $user = $this->userRepository->getUserById($id);

        if (! $user) {
            return null;
        }

        return $user->email;
    }

    protected function validateUserId($id)
    {
        return is_int($id);
    }
}
