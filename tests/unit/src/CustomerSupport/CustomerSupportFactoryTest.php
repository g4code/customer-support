<?php

use G4\CustomerSupport\Adapter\Zendesk\CustomerSupportZendesk;
use G4\CustomerSupport\CustomerSupportFactory;
use G4\Gateway\Http;
use G4\Gateway\Options;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;

class CustomerSupportFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testSetEmail()
    {
        $result = (new CustomerSupportFactory())->setEmail(new Email('test@email.com'));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testSetName()
    {
        $result = (new CustomerSupportFactory())->setName(new StringLiteral('name'));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testSetSubject()
    {
        $result = (new CustomerSupportFactory())->setSubject(new StringLiteral('subject'));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testSetComment()
    {
        $result = (new CustomerSupportFactory())->setComment(new StringLiteral('comment'));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testSetGateway()
    {
        $result = (new CustomerSupportFactory())->setGateway(new Http('url', new Options()));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    public function testSetAdapter()
    {
        $result = (new CustomerSupportFactory())->setAdapter(new StringLiteral('Zendesk'));
        $this->assertInstanceOf(CustomerSupportFactory::class, $result);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Email not set
     * @expectedExceptionCode 400
     */
    public function testCreateInstanceThrowEmailNotSetException()
    {
        (new CustomerSupportFactory())->createInstance();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessageName Name not set
     * @expectedExceptionCode 400
     */
    public function testCreateInstanceThrowNameNotSetException()
    {
        $factory = (new CustomerSupportFactory())
            ->setEmail(new Email('test@email.com'));
        $factory->createInstance();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Subject not set
     * @expectedExceptionCode 400
     */
    public function testCreateInstanceThrowSubjectNotSetException()
    {
        $factory = (new CustomerSupportFactory())
            ->setEmail(new Email('test@email.com'))
            ->setName(new StringLiteral('name'));

        $factory->createInstance();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Comment not set
     * @expectedExceptionCode 400
     */
    public function testCreateInstanceThrowCommentNotSetException()
    {
        $factory = (new CustomerSupportFactory())
            ->setEmail(new Email('test@email.com'))
            ->setName(new StringLiteral('name'))
            ->setSubject(new StringLiteral('subject'));

        $factory->createInstance();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Gateway not set
     * @expectedExceptionCode 400
     */
    public function testCreateInstanceThrowGatewayNotSetException()
    {
        $factory = (new CustomerSupportFactory())
            ->setEmail(new Email('test@email.com'))
            ->setName(new StringLiteral('name'))
            ->setSubject(new StringLiteral('subject'))
            ->setComment(new StringLiteral('comment'));

        $factory->createInstance();
    }

    public function testCreateInstance()
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

    /**
     * @expectedException G4\CustomerSupport\Exceptions\AdapterNotImplementedException
     * @expectedExceptionMessage Adapter 'Test' not implemented
     */
    public function testCreateInstanceThrowException()
    {
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
