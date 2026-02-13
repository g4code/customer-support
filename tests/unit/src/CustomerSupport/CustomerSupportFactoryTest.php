<?php

use G4\CustomerSupport\Adapter\Zendesk\CustomerSupportZendesk;
use G4\CustomerSupport\CustomerSupportFactory;
use G4\Gateway\Http;
use G4\Gateway\Options;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;
use PHPUnit\Framework\TestCase;

class CustomerSupportFactoryTest extends TestCase
{

    public function testSetEmail(): void
    {
        $result = (new CustomerSupportFactory())->setEmail(new Email('test@email.com'));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testSetName(): void
    {
        $result = (new CustomerSupportFactory())->setName(new StringLiteral('name'));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testSetSubject(): void
    {
        $result = (new CustomerSupportFactory())->setSubject(new StringLiteral('subject'));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testSetComment(): void
    {
        $result = (new CustomerSupportFactory())->setComment(new StringLiteral('comment'));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testSetGateway(): void
    {
        $result = (new CustomerSupportFactory())->setGateway(new Http('url', new Options()));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testSetAdapter(): void
    {
        $result = (new CustomerSupportFactory())->setAdapter(new StringLiteral('Zendesk'));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testCreateInstanceThrowEmailNotSetException(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Email not set');
        $this->expectExceptionCode(400);
        
        (new CustomerSupportFactory())->createInstance();
    }

    public function testCreateInstanceThrowNameNotSetException(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Name not set');
        $this->expectExceptionCode(400);
        
        $factory = (new CustomerSupportFactory())
            ->setEmail(new Email('test@email.com'));
        $factory->createInstance();
    }

    public function testCreateInstanceThrowSubjectNotSetException(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Subject not set');
        $this->expectExceptionCode(400);
        
        $factory = (new CustomerSupportFactory())
            ->setEmail(new Email('test@email.com'))
            ->setName(new StringLiteral('name'));

        $factory->createInstance();
    }

    public function testCreateInstanceThrowCommentNotSetException(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Comment not set');
        $this->expectExceptionCode(400);
        
        $factory = (new CustomerSupportFactory())
            ->setEmail(new Email('test@email.com'))
            ->setName(new StringLiteral('name'))
            ->setSubject(new StringLiteral('subject'));

        $factory->createInstance();
    }

    public function testCreateInstanceThrowGatewayNotSetException(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Gateway not set');
        $this->expectExceptionCode(400);
        
        $factory = (new CustomerSupportFactory())
            ->setEmail(new Email('test@email.com'))
            ->setName(new StringLiteral('name'))
            ->setSubject(new StringLiteral('subject'))
            ->setComment(new StringLiteral('comment'));

        $factory->createInstance();
    }

    public function testCreateInstance(): void
    {
        $factory = (new CustomerSupportFactory())
            ->setEmail(new Email('test@email.com'))
            ->setName(new StringLiteral('name'))
            ->setSubject(new StringLiteral('subject'))
            ->setComment(new StringLiteral('comment'))
            ->setGateway(new Http('url', new Options()))
            ->setAdapter(new StringLiteral('Zendesk'));

        $result = $factory->createInstance();

        $this->assertInstanceOf(CustomerSupportZendesk::class, $result);
    }

    public function testCreateInstanceThrowException(): void
    {
        $this->expectException(\G4\CustomerSupport\Exceptions\AdapterNotImplementedException::class);
        $this->expectExceptionMessage("Adapter 'Test' not implemented");
        
        $factory = (new CustomerSupportFactory())
            ->setEmail(new Email('test@email.com'))
            ->setName(new StringLiteral('name'))
            ->setSubject(new StringLiteral('subject'))
            ->setComment(new StringLiteral('comment'))
            ->setGateway(new Http('url', new Options()))
            ->setAdapter(new StringLiteral('Test'));

        $factory->createInstance();
    }
}
