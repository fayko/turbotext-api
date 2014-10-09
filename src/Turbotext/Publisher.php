<?php

namespace Sb\Turbotext;

class Publisher
{
    private $api = null;

    private $sourceFolder = null;
    private $destinationFolder = null;

    public function __construct($options = array())
    {
        $this->api = new Api(
            $options
        );
        $this->sourceFolder = $options['source_folder'];
        var_dump($this->sourceFolder);
        $this->destinationFolder = $options['destination_folder'];
    }

    public function getApi()
    {
        return $this->api;
    }

    public function getOrders()
    {
        return $this->getApi()->getOrders($this->sourceFolder);
    }

    public function getOrder($orderId)
    {
        return $this->getApi()->getOrder($orderId);
    }

    public function completeOrder($orderId)
    {
        return $this->getApi()->completeOrder($orderId);
    }
} 