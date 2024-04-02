
<?php

namespace App\Http\Repositories;

use App\User;

class UserRepository
{
    private $model;

    public function __construct(User $user)
	{
		$this->model = $user;
	}

    public function getUserById($id)
    {
        return $this->model
            ->query()
            ->select([
                'name',
                'emai'
            ])->where('id', $id);
            ->first();        
    }
}
