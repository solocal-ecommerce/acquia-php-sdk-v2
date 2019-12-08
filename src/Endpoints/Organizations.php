<?php

namespace AcquiaCloudApi\Endpoints;

use AcquiaCloudApi\Connector\ClientInterface;
use AcquiaCloudApi\Response\ApplicationsResponse;
use AcquiaCloudApi\Response\InvitationsResponse;
use AcquiaCloudApi\Response\MembersResponse;
use AcquiaCloudApi\Response\OrganizationsResponse;
use AcquiaCloudApi\Response\TeamsResponse;
use AcquiaCloudApi\Response\OperationResponse;

/**
 * Class Client
 * @package AcquiaCloudApi\CloudApi
 */
class Organizations implements CloudApi
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
     * Show all organizations.
     *
     * @return OrganizationsResponse
     */
    public function getAll()
    {
        return new OrganizationsResponse($this->client->request('get', '/organizations'));
    }

    /**
     * Show all applications in an organisation.
     *
     * @param string $organizationUuid
     *
     * @return ApplicationsResponse
     */
    public function getApplications($organizationUuid)
    {
        return new ApplicationsResponse(
            $this->client->request('get', "/organizations/${organizationUuid}/applications")
        );
    }

    /**
     * Show all members of an organisation.
     *
     * @param string $organizationUuid
     * @return MembersResponse
     */
    public function getMembers($organizationUuid)
    {
        return new MembersResponse(
            $this->client->request('get', "/organizations/${organizationUuid}/members")
        );
    }

    /**
     * Show all members invited to an organisation.
     *
     * @param string $organizationUuid
     * @return InvitationsResponse
     */
    public function getInvitees($organizationUuid)
    {
        return new InvitationsResponse(
            $this->client->request('get', "/organizations/${organizationUuid}/team-invites")
        );
    }

    /**
     * Delete a member from an organisation.
     *
     * @param string $organizationUuid
     * @param string $memberUuid
     * @return OperationResponse
     */
    public function deleteMember($organizationUuid, $memberUuid)
    {
        return new OperationResponse(
            $this->client->request(
                'delete',
                "/organizations/${organizationUuid}/members/${memberUuid}"
            )
        );
    }

    /**
     * Show all teams in an organization.
     *
     * @param string $organizationUuid
     * @return TeamsResponse
     */
    public function getTeams($organizationUuid)
    {
        return new TeamsResponse(
            $this->client->request('get', "/organizations/${organizationUuid}/teams")
        );
    }
}
