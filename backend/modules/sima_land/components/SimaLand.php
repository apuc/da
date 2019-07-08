<?php

namespace backend\modules\sima_land\components;

use common\classes\Debug;
use SimaLand\API\Rest\Request;
use yii\base\Component;

class SimaLand extends \SimaLand\API\Rest\Client
{
    public static function load($type, $category = null, $page = 1)
    {
        $client = new \backend\modules\sima_land\components\SimaLand([
            'login' => 'nasty_sklyarova@bk.ru',
            'password' => '123edsaqw',
        ]);
        $response = $client->get($type,['page' => $page, 'per_page' => 10]);
        if(!empty($category))
        {
            $response = $client->get($type,['page' => $page, 'per_page' => 10,'category_id' => $category]);
        }

        return json_decode($response->getBody(), true);
    }

    public function batchQuery(array $requests)
    {
        $client = $this->getHttpClient();
        $promises = [];
        foreach ($requests as $name => $request) {
            if (!($request instanceof Request)) {
                throw new \Exception('Request must be implement "\SimaLand\API\Rest\Request"');
            }
            $url = $this->createUrl($request->entity);
            $promises[$name] = $client->requestAsync(
                $request->method,
                $url,
                $this->getOptions($request)
            );
        }
        /** @var \GuzzleHttp\Psr7\Response[] $responses */
        $responses = \GuzzleHttp\Promise\unwrap($promises);
        foreach ($responses as $key => $response) {
            if ($response->getStatusCode() == 401) {
                $this->deleteToken();
                return $this->batchQuery($requests);
            }
        }
        return $responses;
    }

    /**
     * Создания url к сущности.
     *
     * @param string $entity
     * @return string
     */
    private function createUrl($entity)
    {
        $url = $this->baseUrl;
        $urlLen = strlen($url);
        $entityLen = strlen($entity);
        if ($url[$urlLen - 1] != '/' && $entity[0] != '/') {
            $url .= "/";
        }
        if ($entity[$entityLen - 1] != '/') {
            $entity .= "/";
        }
        return $url . $entity;
    }
}