<?php

namespace Scytale\Bundle\IntercomBundle\Factory;

/**
 * Class IntercomServiceFactory
 *
 * @author Eduardo Conceição <eduardo.conceicao@gmail.com>
 *
 * @method getUsers()
 * @method getTags()
 */
class IntercomServiceFactory
{
    /**
     * @var array
     */
    private $services;

    /**
     * IntercomServiceFactory constructor.
     *
     * @param array $services
     */
    public function __construct(array $services)
    {
        $this->services = $services;
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return
     */
    public function __call($name, $arguments)
    {
        if (substr($name, 0, 3) !== 'get') {
            throw new \RuntimeException('Magic method must start with get');
        }

        // Convert to method name from camel case to dashes
        $methodName = substr($name, 3);
        $servicekey = strtolower(preg_replace(
            '/(?<!^)[A-Z]/', '-$0',
            $methodName
        ));

        if (!in_array($servicekey, array_keys($this->services))) {
            throw new \RuntimeException('Service does not exists');
        }

        return $this->services[$servicekey];
    }
}