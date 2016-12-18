<?php

namespace Scytale\Bundle\IntercomBundle\Service;

use Scytale\Bundle\IntercomBundle\Factory\IntercomServiceFactory;

/**
 * @author Eduardo Conceição <eduardo.conceicao@gmail.com>
 */
class IntercomProxyClient
{
    /**
     * @var IntercomServiceFactory
     */
    private $factory;

    /**
     * IntercomProxyClient constructor.
     *
     * @param IntercomServiceFactory $factory
     */
    public function __construct(IntercomServiceFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->factory->getUsers();
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->factory->getTags();
    }
}