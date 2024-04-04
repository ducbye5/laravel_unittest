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

        return $this->getEmail($user);
    }

    public function getUserNameByEmail($email)
    {
        $user = $this->userRepository->getUserNameByEmail($id);

        if (! $user) {
            return null;
        }

        return $user->name;
    }

    protected function validateUserId($id): bool
    {
        return is_int($id);
    }

    private function getEmail($user)
    {
        return $user['email'];
    }
}
