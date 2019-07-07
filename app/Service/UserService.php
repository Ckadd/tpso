<?php

namespace App\Service;

class UserService
{
    /**
     * Find user by id.
     *
     * @param mixed $id
     *
     * @return array
     */
    public static function findById($id)
    {
        $userRepository = app()->make('App\Repository\UserRepository');

        return $userRepository->findById($id);
    }

    /**
     * Check current user has specific role.
     *
     * @param array $userRoles
     *
     * @return bool
     */
    public static function isRole(array $userRoles)
    {
        $userCurrentRoles = auth()->user()->toArray();

        return in_array($userCurrentRoles['role']['name'] ?? '*', $userRoles);
    }
}
