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
     * @param array  $criteria
     *
     * @return mixed
     */
    private function tagUser($tagName, $criteria)
    {
        return $this->client->tags->tag([
            "name"  => $tagName,
            "users" => [$criteria]
        ]);
    }

    /**
     * @param string $tagName
     * @param string $email
     *
     * @return mixed
     */
    public function tagUserByEmail($tagName, $email)
    {
        $criteria = ['email' => $email];

        return $this->tagUser($tagName, $criteria);
    }

    /**
     * @param string $tagName
     * @param string $userId
     *
     * @return mixed
     */
    public function tagUserById($tagName, $userId)
    {
        $criteria = ['id' => $userId];

        return $this->tagUser($tagName, $criteria);
    }
}