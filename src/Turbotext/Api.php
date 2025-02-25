<?php

namespace Sb\Turbotext;

class Api
{
    const END_POINT = 'https://www.turbotext.ru/api';
    const OPTION_API_KEY = 'api_key';
    const OPTION_METHOD = 'action';
    const IMAGE_URL = 'http://www.turbotext.ru/uploads/';

    private $apiKey = null;

    public function __construct($options = array())
    {
        $this->apiKey = $options['api_key'];
    }

    public function getFolders()
    {
        $result = $this->call(array(
            self::OPTION_METHOD => 'get_folders'
        ));
        return $result->folders;
    }

    public function getOrders($folderId = null)
    {
        $options = array(
            self::OPTION_METHOD => 'get_orders'
        );
        if ($folderId) {
            $options['folder_id'] = $folderId;
        }
        $result = $this->call($options);
        return $result->orders;
    }

    public function getOrder($orderId)
    {
        $result = $this->call(array(
            self::OPTION_METHOD => 'get_order',
            'order_id' => $orderId
        ));
        return $result;
    }

    public function completeOrder($orderId, $folderId)
    {
        $result = $this->call(array(
            self::OPTION_METHOD => 'move_order',
            'order_id' => $orderId,
            'folder_id' => $folderId
        ));
        return $result;
    }

    public function call($options = array())
    {
        $options[self::OPTION_API_KEY] = $this->apiKey;
        $ch = curl_init(self::END_POINT);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($options));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_error($ch);
        $response = curl_exec($ch);
        $result = json_decode($response);
        return $result;
    }
}
