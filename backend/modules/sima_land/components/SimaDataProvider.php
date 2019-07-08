<?php

namespace backend\modules\sima_land\components;

use yii\data\ArrayDataProvider;
use yii\data\BaseDataProvider;

class SimaDataProvider extends ArrayDataProvider
{
    private $page;
    private $items;

    public function init()
    {
        parent::init();
    }

    public function __construct($config = [], $page)
    {
        parent::__construct($config);
        $this->page = $page;
    }

    protected function prepareModels()
    {
        $this->items = SimaLand::load('item', null, $this->page);
        // TODO: Implement prepareModels() method.
        return $this->items['items'];
    }

    protected function prepareKeys($models)
    {
        if ($this->key !== null) {
            $keys = [];

            foreach ($models as $model) {
                if (is_string($this->key)) {
                    $keys[] = $model[$this->key];
                } else {
                    $keys[] = call_user_func($this->key, $model);
                }
            }

            return $keys;
        }

        return array_keys($models);
    }

    /**
     * {@inheritdoc}
     */
    protected function prepareTotalCount()
    {
        $count = $this->items['_meta']['totalCount'];

        return $count;
    }
}