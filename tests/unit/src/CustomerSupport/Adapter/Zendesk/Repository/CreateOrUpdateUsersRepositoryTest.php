<?php

use G4\CustomerSupport\Adapter\Zendesk\Repository\CreateOrUpdateUsersRepository;
use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\Gateway\Http;
use G4\Gateway\Response;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;

class CreateOrUpdateUsersRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | Http
     */
    private $httpGateway;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | Response
     */
    private $response;

    /**
     * @var User
     */
    private $user;

    public function setUp()
    {
        $this->httpGateway = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->user = new User(new Email('test@email.com'), new StringLiteral('name'));
    }

    public function tearDown()
    {
        $this->httpGateway = null;
        $this->response    = null;
        $this->user        = null;
    }

    /**
     * @expectedException G4\CustomerSupport\Adapter\Zendesk\Exceptions\FailedToCreateUserException
     * @expectedExceptionMessage Failed to create user
     */
    public function testPostThrowException()
    {
        $this->httpGateway
            ->expects($this->once())
            ->method('post')
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('isSuccess')
            ->willReturn(false);

        (new CreateOrUpdateUsersRepository($this->httpGateway))->post($this->user);
    }

    public function testPost()
    {
        $this->httpGateway
            ->expects($this->once())
            ->method('post')
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('isSuccess')
            ->willReturn(true);

        (new CreateOrUpdateUsersRepository($this->httpGateway))->post($this->user);
    }
}
