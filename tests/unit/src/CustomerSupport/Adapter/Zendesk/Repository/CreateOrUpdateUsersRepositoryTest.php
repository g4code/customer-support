<?php

use G4\CustomerSupport\Adapter\Zendesk\Repository\CreateOrUpdateUsersRepository;
use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\Gateway\Http;
use G4\Gateway\Response;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CreateOrUpdateUsersRepositoryTest extends TestCase
{
    private MockObject|Http $httpGateway;
    private MockObject|Response $response;
    private User $user;

    protected function setUp(): void
    {
        $this->httpGateway = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->user = new User(new Email('test@email.com'), new StringLiteral('name'));
    }

    protected function tearDown(): void
    {
        unset($this->httpGateway, $this->response, $this->user);
    }

    public function testPostThrowException(): void
    {
        $this->expectException(\G4\CustomerSupport\Adapter\Zendesk\Exceptions\FailedToCreateUserException::class);
        $this->expectExceptionMessage('Failed to create user');
        
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

    public function testPost(): void
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
