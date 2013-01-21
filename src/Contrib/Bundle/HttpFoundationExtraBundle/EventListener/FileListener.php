<?php

namespace Contrib\Bundle\HttpFoundationExtraBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Contrib\Bundle\HttpFoundationExtraBundle\HttpFoundation\FileResponse;
use Contrib\Bundle\HttpFoundationExtraBundle\Configuration\File;

/**
 * The FileListener class handles the @File annotation.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class FileListener
{
    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * Constructor.
     *
     * @param ContainerInterface $container The service container instance
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Initialize a new file download response object.
     *
     * @param GetResponseForControllerResultEvent $event A GetResponseForControllerResultEvent instance
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request    = $event->getRequest();
        $parameters = $event->getControllerResult();
        $file       = $request->attributes->get('_file');

        if (!($file instanceof File)) {
            return;
        }

        $attr = array(
            'filename' => $file->getFilename(),
            'charset'  => $file->getCharset(),
            'mimeType' => $file->getMimeType(),
        );

        if (isset($parameters['content'])) {
            $attr['content'] = $parameters['content'];
        }

        if (isset($parameters['path'])) {
            $attr['path'] = $parameters['path'];
        }

        $event->setResponse(new FileResponse($attr));
    }
}
