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

    public function getNoReplyEmail(): string
    {
        return 'noreply@gmail.com';
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
