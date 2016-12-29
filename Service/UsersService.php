<?php

namespace Scytale\Bundle\IntercomBundle\Service;

use GuzzleHttp\Exception\RequestException;
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
     * @return array|null
     */
    public function getUserByEmail($email)
    {
        try {
            $user = $this->client->users->getUsers(["email" => $email]);
        } catch (RequestException $exception) {
            $user = null;
        }

        return $user;
    }

    /**
     * @param array $emails
     *
     * @return array|null
     */
    public function getUsersByEmail($emails)
    {
        try {
            $userEmails = array();
            foreach ($emails as $email) {
                $userEmails[] = ['email' => $email];
            }

            $users = $this->client->users->getUsers($userEmails);
        } catch (RequestException $exception) {
            $users = array();
        }

        return $users;
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