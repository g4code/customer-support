<?php

use G4\CustomerSupport\Adapter\Zendesk\Repository\SearchUsersRepository;
use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\Gateway\Http;
use G4\Gateway\Response;
use G4\ValueObject\Email;

class SearchUsersRepositoryTest extends \PHPUnit_Framework_TestCase
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
     * @var Email
     */
    private $email;

    public function setUp()
    {
        $this->httpGateway = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->email = new Email('test@email.com');
    }

    public function tearDown()
    {
        $this->httpGateway = null;
        $this->response    = null;
        $this->email       = null;
    }

    /**
     * @expectedException G4\CustomerSupport\Adapter\Zendesk\Exceptions\FailedToFindEmailException
     * @expectedExceptionMessage Failed to find user with email: 'test@email.com'
     */
    public function testFindUserByEmailThrowException()
    {
        $this->httpGateway
            ->expects($this->once())
            ->method('get')
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('isSuccess')
            ->willReturn(false);

        (new SearchUsersRepository($this->httpGateway))->findUserByEmail($this->email);
    }

    public function testFindUserByEmail()
    {
        $responseData = [
            0 => [
                'email' => (string)$this->email,
            ]
        ];

        $this->httpGateway
            ->expects($this->once())
            ->method('get')
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('isSuccess')
            ->willReturn(true);

        $this->response
            ->expects($this->once())
            ->method('getResource')
            ->with('users')
            ->willReturn($responseData);

        $this->assertInstanceOf(
            User::class,
            (new SearchUsersRepository($this->httpGateway))->findUserByEmail($this->email)
        );
    }
}
