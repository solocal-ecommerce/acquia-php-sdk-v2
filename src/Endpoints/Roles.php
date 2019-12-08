<?php

namespace AcquiaCloudApi\Endpoints;

use AcquiaCloudApi\Connector\ClientInterface;
use AcquiaCloudApi\Response\RolesResponse;
use AcquiaCloudApi\Response\RoleResponse;
use AcquiaCloudApi\Response\OperationResponse;

/**
 * Class Client
 * @package AcquiaCloudApi\CloudApi
 */
class Roles implements CloudApi
{

    /** @var ClientInterface The API client. */
    protected $client;

    /**
     * Client constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Show all roles in an organization.
     *
     * @param string $organizationUuid
     * @return RolesResponse
     */
    public function getAll($organizationUuid)
    {
        return new RolesResponse(
            $this->client->request('get', "/organizations/${organizationUuid}/roles")
        );
    }

    /**
     * Return details about a specific role.
     *
     * @param string $roleUuid
     * @return RoleResponse
     */
    public function get($roleUuid)
    {
        return new RoleResponse(
            $this->client->request('get', "/roles/${roleUuid}")
        );
    }

    /**
     * Create a new role.
     *
     * @param string      $organizationUuid
     * @param string      $name
     * @param array       $permissions
     * @param null|string $description
     * @return OperationResponse
     */
    public function create($organizationUuid, $name, array $permissions, $description = null)
    {
        $options = [
            'form_params' => [
                'name' => $name,
                'permissions' => $permissions,
                'description' => $description,
            ],
        ];

        return new OperationResponse(
            $this->client->request('post', "/organizations/${organizationUuid}/roles", $options)
        );
    }

    /**
     * Update the permissions associated with a role.
     *
     * @param string $roleUuid
     * @param array  $permissions
     * @return OperationResponse
     */
    public function update($roleUuid, array $permissions)
    {
        $options = [
            'form_params' => [
                'permissions' => $permissions,
            ],
        ];

        return new OperationResponse(
            $this->client->request('put', "/roles/${roleUuid}", $options)
        );
    }

    /**
     * Delete a role.
     *
     * @param string $roleUuid
     * @return OperationResponse
     */
    public function delete($roleUuid)
    {
        return new OperationResponse($this->client->request('delete', "/roles/${roleUuid}"));
    }
}
