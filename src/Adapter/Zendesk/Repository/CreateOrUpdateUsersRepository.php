<?php

namespace G4\CustomerSupport\Adapter\Zendesk\Repository;

use G4\Gateway\Http;
use G4\CustomerSupport\Adapter\Zendesk\Exceptions\FailedToCreateUserException;
use G4\CustomerSupport\Adapter\Zendesk\Map\CreateUpdateMap;
use G4\CustomerSupport\Adapter\Zendesk\User\User;

class CreateOrUpdateUsersRepository
{
    const SERVICE_NAME = '/users/create_or_update';

    /**
     * @var Http
     */
    private $httpGateway;

    /**
     * CreateOrUpdateUsersRepository constructor.
     * @param Http $httpGateway
     */
    public function __construct(Http $httpGateway)
    {
        $httpGateway->setServiceName(self::SERVICE_NAME);
        $this->httpGateway = $httpGateway;
    }

    /**
     * @param User $user
     * @throws FailedToCreateUserException
     */
    public function post(User $user)
    {

        $map = CreateUpdateMap::map($user);
        $response = $this->httpGateway->post($map);

        if (!$response->isSuccess()) {
            throw new FailedToCreateUserException();
        }
    }
}
