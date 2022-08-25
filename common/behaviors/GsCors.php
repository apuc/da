<?php


namespace common\behaviors;


use yii\filters\Cors;

class GsCors extends Cors
{

    public function prepareHeaders($requestHeaders){
        $responseHeaders = parent::prepareHeaders($requestHeaders);

        if (isset($this->cors['Access-Control-Allow-Headers'])) {
            $responseHeaders['Access-Control-Allow-Headers'] = implode(', ', $this->cors['Access-Control-Allow-Headers']);
        }

        return $responseHeaders;
    }

}