<?php

namespace Contrib\Bundle\HttpFoundationExtraBundle\HttpFoundation;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * File response.
 *
 * require either attrs:
 *
 * * content
 * * path
 *
 * optional:
 *
 * * filename: if this attr was set, this will be used as download filename.
 * * mimeType
 * * charset
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class FileResponse extends Response
{
    /**
     * Constructor.
     *
     * @param array   $attr
     * @param integer $status
     * @param array   $headers
     */
    public function __construct($attr = array(), $status = 200, $headers = array())
    {
        parent::__construct('', $status, $headers);

        try {
            $this->setFileHeaders($attr);
        } catch (\Exception $e) {
            throw new NotFoundHttpException('Not Found', $e);
        }
    }

    /**
     * Create file response headers.
     *
     * @param array $attr
     * @throws \RuntimeException
     * @return multitype:string number
     */
    protected function setFileHeaders($attr = array())
    {
        if (!isset($attr['content']) && !isset($attr['path'])) {
            throw new \RuntimeException('Neither content nor path were set to attr.');
        }

        if (isset($attr['content'])) {
            $content       = $attr['content'];
            $contentLength = strlen($content);
        } elseif (isset($attr['path'])) {
            $path = $attr['path'];

            if (!file_exists($path) || !is_file($path) || !is_readable($path)) {
                throw new \RuntimeException(sprintf('Could not read file path (%s).', $path));
            }

            $content = file_get_contents($path);

            if ($content === false) {
                throw new \RuntimeException(sprintf('Could not read file path (%s).', $path));
            }

            $contentLength = filesize($path);
            $filename      = basename($path);
        }

        $this->content = $content;

        if (isset($attr['filename'])) {
            $filename = $attr['filename'];
        }

        if (!isset($filename)) {
            throw new \RuntimeException('Could not set file name.');
        }

        if (isset($attr['mimeType'])) {
            $mimeType = $attr['mimeType'];
        } else {
            $mimeType = 'application/octet-stream';
        }

        if (isset($attr['charset'])) {
            $charset = $attr['charset'];

            $this->headers->set('Content-Type', sprintf('%s; charset=%s', $mimeType, $charset));
        } else {
            $this->headers->set('Content-Type', sprintf('%s', $mimeType));
        }

        $this->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));
        $this->headers->set('Content-Length', $contentLength);
    }
}
