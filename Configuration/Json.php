<?php

namespace Contrib\HttpFoundationExtraBundle\Configuration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationAnnotation;

/**
 * The Json class handles the @Json annotation parts.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 * @Annotation
 */
class Json  extends ConfigurationAnnotation
{
    /**
     * Whether to use serializer.
     *
     * @var boolean
     */
    protected $serialize = false;

    /**
     * Callback name in request parameter.
     *
     * @var string
     */
    protected $callbackName = 'callback';

    // accessor

    public function setSerialize($serialize)
    {
        $this->serialize = $serialize;
    }

    public function getSerialize()
    {
        return $this->serialize;
    }

    public function setCallbackName($callbackName)
    {
        $this->callbackName = $callbackName;
    }

    public function getCallbackName()
    {
        return $this->callbackName;
    }

    /**
     * Returns the annotation alias name.
     *
     * @return string
     * @see ConfigurationInterface
     */
    public function getAliasName()
    {
        return 'json';
    }
}
