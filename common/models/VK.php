<?php

/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 12.05.2017
 * Time: 22:13
 */

namespace common\models;

use common\classes\Debug;

class VK
{

    public $client_id, $client_secret, $access_token;
    public $version = '5.64';

    /**
     * VK constructor.
     * @param $data array
     */
    public function __construct($data)
    {
        $this->client_id = $data['client_id'];
        $this->client_secret = $data['client_secret'];
        $this->access_token = $data['access_token'];
    }

    /**
     * @param $method string
     * @param $params array
     * @return string
     */
    public function createRequest($method, $params)
    {
        $r = 'https://api.vk.com/method/' . $method . '?';
        $paramsStr = '';
        foreach ((array)$params as $key => $param) {
            $paramsStr .= $key . '=' . $param . '&';
        }
        $r .= $paramsStr;
        $r .= 'access_token=' . $this->access_token . '&';
        $r .= 'v=' . $this->version;
        return $r;
    }

    /**
     * @param $method string
     * @param $params array
     * @return bool|string
     */
    public function request($method, $params)
    {
        $request = $this->createRequest($method, $params);
        return file_get_contents($request);
    }

    /**
     * @param $domain
     * @param $data
     * @return bool|string
     */
    public function getGroupWall($domain, $data)
    {
        $data['domain'] = $domain;
        return $this->request('wall.get', $data);
    }

    public function getPostComments($group, $postId, $data = [])
    {
        $data['owner_id'] = $group;
        $data['post_id'] = $postId;
        return $this->request('wall.getComments', $data);
    }

}