<?php

namespace Scytale\Bundle\IntercomBundle\Service;

use Intercom\IntercomClient;

/**
 * @author Eduardo Conceição <eduardo.conceicao@gmail.com>
 */
class IntercomProxyService
{
    /**
     * IntercomProxyService constructor.
     *
     * @param string $apiId
     * @param string $apiKey
     */
    public function __construct($apiId, $apiKey)
    {
        $this->client = new IntercomClient($apiId, $apiKey);
    }

    /**
     * @return array
     */
    public function getUserByEmail($email)
    {
        $this->client->users->getUsers(["email" => $email]);
    }
}