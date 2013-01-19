<?php

namespace Contrib\HttpFoundationExtraBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Contrib\HttpFoundationExtraBundle\Configuration\Json;
use Contrib\HttpFoundationExtraBundle\HttpFoundation as Contrib;

/**
 * The JsonListener class handles the @Json annotation.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class JsonListener
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
     * Initialize a new json response object.
     *
     * @param GetResponseForControllerResultEvent $event A GetResponseForControllerResultEvent instance
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request    = $event->getRequest();
        $parameters = $event->getControllerResult();
        $json       = $request->attributes->get('_json');

        if (!($json instanceof Json)) {
            return;
        }

        if ($json->getSerialize()) {
            $serializer = $this->getSerializer();

            if ($json->hasSeializeGroups()) {
                $groups = $json->getSerializeGroups();
                $serializer->setGroups($groups);
            }

            $serializedData = $serializer->serialize($parameters, 'json');

            $response = new Contrib\JsonResponse($serializedData);
        } else {
            $response = new JsonResponse($parameters);
        }

        $callbackName = $json->getCallbackName();
        $callback     = $request->get($callbackName, null);

        if ($callback !== null) {
            $response->setCallback($callback);
        }

        $event->setResponse($response);
    }

    /**
     * @return JMS\Serializer\Serializer
     */
    protected function getSerializer()
    {
        return $this->container->get('jms_serializer');
    }
}
