<?php

namespace G4\CustomerSupport\Adapter\Zendesk\Repository;

use G4\Gateway\Http;
use G4\ValueObject\Email;
use G4\CustomerSupport\Adapter\Zendesk\Exceptions\FailedToFindEmailException;
use G4\CustomerSupport\Adapter\Zendesk\Map\SearchMap;
use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\CustomerSupport\Adapter\Zendesk\User\UserFactory;
use G4\CustomerSupport\ParamsConst;

class SearchUsersRepository
{
    const SERVICE_NAME = '/users/search';

    /**
     * @var Http
     */
    private $httpGateway;

    /**
     * SearchUsersRepository constructor.
     * @param Http $httpGateway
     */
    public function __construct(Http $httpGateway)
    {
        $httpGateway->setServiceName(self::SERVICE_NAME);
        $this->httpGateway = $httpGateway;
    }

    /**
     * @param $email
     * @return User
     * @throws FailedToFindEmailException
     */
    public function findUserByEmail(Email $email)
    {
        $response = $this->httpGateway->get(SearchMap::map($email));

        if (!$response->isSuccess()) {
            throw new FailedToFindEmailException((string)$email);
        }

        $userData = $response->getResource(ParamsConst::USERS)[0];

        return (new UserFactory())
            ->set($userData)
            ->reconstitute();
    }
}
