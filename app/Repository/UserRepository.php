<?php

namespace App\Repository;

use App\Model\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Find user by id.
     *
     * @param mixed $id
     *
     * @return array
     */
    public function findById($id)
    {
        try {
            return $this->userModel->where('id', $id)
                ->firstOrFail()
                ->toArray();
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }
}
