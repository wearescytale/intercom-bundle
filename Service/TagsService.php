<?php

namespace Scytale\Bundle\IntercomBundle\Service;

use Intercom\IntercomClient;

/**
 * Class TagsService
 *
 * @author Eduardo Conceição <eduardo.conceicao@gmail.com>
 */
class TagsService
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
     * @return array
     */
    public function getAll()
    {
        return $this->client->tags->getTags();
    }

    /**
     * @param string $tagName
     * @param array  $users
     *
     * @return mixed
     */
    private function tagUser($tagName, $users)
    {
        return $this->client->tags->tag([
            "name"  => $tagName,
            "users" => $users
        ]);
    }

    /**
     * @param string $tagName
     * @param array  $emails
     *
     * @return mixed
     */
    public function tagUsersByEmail($tagName, array $emails)
    {
        $users = array();
        foreach ($emails as $email) {
            $users[] = ['email' => $email];
        }

        return $this->tagUser($tagName, $users);
    }

    /**
     * @param string $tagName
     * @param array  $userIds
     *
     * @return mixed
     */
    public function tagUsersById($tagName, array $userIds)
    {
        $users = array();
        foreach ($userIds as $id) {
            $users[] = ['id' => $id];
        }

        return $this->tagUser($tagName, $users);
    }
}