<?php

namespace G4\CustomerSupport;

use G4\Gateway\Http;
use \G4\Constants\Http as Error;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;
use G4\CustomerSupport\Adapter\Zendesk\CustomerSupportZendesk;
use G4\CustomerSupport\Exceptions\AdapterNotImplementedException;

class CustomerSupportFactory
{
    const ADAPTER_ZENDESK = 'Zendesk';


    private $email;
    private $name;
    private $subject;
    private $comment;
    private $gateway;
    private $adapter;


    public function setEmail(Email $email)
    {
        $this->email = $email;
        return $this;
    }

    public function setName(StringLiteral $name)
    {
        $this->name = $name;
        return $this;
    }

    public function setSubject(StringLiteral $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setComment(StringLiteral $comment)
    {
        $this->comment = $comment;
        return $this;
    }

    public function setGateway(Http $gateway)
    {
        $this->gateway = $gateway;
        return $this;
    }

    public function setAdapter(StringLiteral $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function createInstance()
    {
        if (!$this->email instanceof Email) {
            throw new \Exception('Email not set', Error::CODE_400);
        }
        if (!$this->name instanceof StringLiteral) {
            throw new \Exception('Name not set', Error::CODE_400);
        }
        if (!$this->subject instanceof StringLiteral) {
            throw new \Exception('Subject not set', Error::CODE_400);
        }
        if (!$this->comment instanceof StringLiteral) {
            throw new \Exception('Comment not set', Error::CODE_400);
        }
        if (!$this->gateway instanceof Http) {
            throw new \Exception('Gateway not set', Error::CODE_400);
        }

        $ticket = new Ticket(
            $this->email,
            $this->name,
            $this->subject,
            $this->comment
        );

        switch ((string)$this->adapter) {
            case self::ADAPTER_ZENDESK:
                return new CustomerSupportZendesk($this->gateway, $ticket);
                break;
            default:
                throw new AdapterNotImplementedException((string)$this->adapter);
        }
    }
}
