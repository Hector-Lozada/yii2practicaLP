<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Productos;

/**
 * ProductosSearch represents the model behind the search form of `app\models\Productos`.
 */
class ProductosSearch extends Productos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stock'], 'integer'],
            [['nombre', 'categoria', 'fecha_lanzamiento'], 'safe'],
            [['precio'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Productos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'fecha_lanzamiento' => $this->fecha_lanzamiento,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'categoria', $this->categoria]);

        return $dataProvider;
    }
}
