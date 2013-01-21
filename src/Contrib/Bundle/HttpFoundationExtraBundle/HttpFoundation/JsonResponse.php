<?php

namespace Contrib\Bundle\HttpFoundationExtraBundle\HttpFoundation;

use Symfony\Component\HttpFoundation\JsonResponse as Base;

/**
 * Response represents an HTTP response in JSON format.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class JsonResponse extends Base
{
    /**
     * Sets the data to be sent as json.
     *
     * @param string $data Serialized json.
     *
     * @return JsonResponse
     */
    public function setData($data = array())
    {
        $this->data = $data;

        return $this->update();
    }
}
