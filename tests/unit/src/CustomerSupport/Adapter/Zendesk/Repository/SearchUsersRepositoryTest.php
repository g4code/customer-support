<?php

use G4\CustomerSupport\Adapter\Zendesk\Repository\SearchUsersRepository;
use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\Gateway\Http;
use G4\Gateway\Response;
use G4\ValueObject\Email;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class SearchUsersRepositoryTest extends TestCase
{
    private MockObject|Http $httpGateway;
    private MockObject|Response $response;
    private Email $email;

    protected function setUp(): void
    {
        $this->httpGateway = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->email = new Email('test@email.com');
    }

    protected function tearDown(): void
    {
        unset($this->httpGateway, $this->response, $this->email);
    }

    public function testFindUserByEmailThrowException(): void
    {
        $this->expectException(\G4\CustomerSupport\Adapter\Zendesk\Exceptions\FailedToFindEmailException::class);
        $this->expectExceptionMessage("Failed to find user with email: 'test@email.com'");
        
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

    public function testFindUserByEmail(): void
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
