<?php

namespace G4\CustomerSupport\Adapter\Zendesk\User;

use G4\Factory\ReconstituteInterface;
use G4\ValueObject\Dictionary;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;
use G4\CustomerSupport\ParamsConst;

class UserFactory implements ReconstituteInterface
{
    /**
     * @var Dictionary
     */
    private $data;

    /**
     * @param null $data
     * @return $this
     */
    public function set($data = null)
    {
        $data instanceof Dictionary
            ? $this->data = $data
            : $this->data = new Dictionary($data);
        return $this;
    }

    public function reconstitute()
    {
        $user = new User(
            new Email(strtolower((string)$this->data->get(ParamsConst::EMAIL))),
            new StringLiteral((string)$this->data->get(ParamsConst::NAME))
        );

        if ($this->data->get(ParamsConst::ID)) {
            $user->setUserId(
                new StringLiteral((string)$this->data->get(ParamsConst::ID))
            );
        }

        return $user;
    }
}
