<?php

namespace Scytale\Bundle\IntercomBundle\Service;

use Intercom\IntercomClient;

/**
 * Class UsersService
 *
 * @author Eduardo Conceição <eduardo.conceicao@gmail.com>
 */
class UsersService
{
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
     * @param string $email
     *
     * @return array
     */
    public function getUserByEmail($email)
    {
        return $this->client->users->getUsers(["email" => $email]);
    }

    /**
     * The intercom access token must be an extended one in order to list all
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