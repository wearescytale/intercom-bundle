<?php

namespace Scytale\Bundle\IntercomBundle\Service;

use Intercom\IntercomClient;

/**
 * @author Eduardo Conceição <eduardo.conceicao@gmail.com>
 */
class IntercomProxyClient
{
    /**
     * @var IntercomClient
     */
    private $client;

    /**
     * IntercomProxyClient constructor.
     *
     * @param string $accessToken
     */
    public function __construct($accessToken)
    {
        $this->client = new IntercomClient($accessToken, null);
    }

    /**
     * @param array $data
     */
    public function createUser(array $data)
    {
        if (!isset($data['email'])) {

            return;
        }

        $this->client->users->create($data);
    }

    /**
     * @return array
     */
    public function getUserByEmail($email)
    {
        return $this->client->users->getUsers(["email" => $email]);
    }

    /**
     * We'll need an extended scope intercom access token to list all
     * the users otherwise the intercom server will return an unauthorized
     * (401) http response
     *
     * @return array
     */
    public function getAllUsers()
    {
        try {
            $users = $this->client->users->getUsers([]);
        } catch (\Exception $e) {
            $users = array();
        }

        return $users;
    }
}