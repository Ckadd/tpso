<?php

namespace App\Service;

class OrganizationService
{
    /**
     * Find user in organization.
     *
     * @param [type] $id
     *
     * @return array
     */
    public static function findUserInOrganization($id)
    {
        $organizationRepository = app()->make('App\Repository\OrganizationRepository');

        return $organizationRepository->findUserInOrganization($id);
    }
}
