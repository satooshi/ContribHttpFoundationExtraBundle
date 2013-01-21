<?php

namespace Contrib\Bundle\HttpFoundationExtraBundle\Configuration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationAnnotation;

/**
 * The File class handles the @File annotation parts.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 * @Annotation
 */
class File  extends ConfigurationAnnotation
{
    protected $filename;
    protected $charset;
    protected $mimeType;

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Returns the annotation alias name.
     *
     * @return string
     * @see ConfigurationInterface
     */
    public function getAliasName()
    {
        return 'file';
    }
}
