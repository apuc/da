<?php

namespace backend\modules\service\models;

use backend\modules\products\models\CategoryProduct;
use common\models\db\CategoryShop;
use common\models\db\Products;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\services\models\Services;

/**
 * ServicesSearch represents the model behind the search form about `backend\modules\services\models\Services`.
 */
class CategoryShopSearch extends CategoryProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id'], 'integer'],
            [['name', 'slug', 'icon'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = $this::find()->where(['type' => self::TYPE_SERVICE]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])->
        andFilterWhere(['like', 'slug', $this->slug]);


        return $dataProvider;
    }
}
