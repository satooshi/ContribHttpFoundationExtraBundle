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
     * Response content.
     *
     * @var array
     */
    protected $data;

    /**
     * Whether to use serializer.
     *
     * @var boolean
     */
    protected $serialize = false;

    // accessor

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setSerialize($serialize)
    {
        $this->serialize = $serialize;
    }

    public function getSerialize()
    {
        return $this->serialize;
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
