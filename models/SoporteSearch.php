<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Soporte;

/**
 * SoporteSearch represents the model behind the search form of `app\models\Soporte`.
 */
class SoporteSearch extends Soporte
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cliente_id', 'producto_id'], 'integer'],
            [['descripcion_problema', 'estado', 'fecha_reporte'], 'safe'],
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
        $query = Soporte::find();

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
            'cliente_id' => $this->cliente_id,
            'producto_id' => $this->producto_id,
            'fecha_reporte' => $this->fecha_reporte,
        ]);

        $query->andFilterWhere(['like', 'descripcion_problema', $this->descripcion_problema])
            ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
