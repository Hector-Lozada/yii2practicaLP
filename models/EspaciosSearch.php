<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Espacios;

/**
 * EspaciosSearch represents the model behind the search form of `app\models\Espacios`.
 */
class EspaciosSearch extends Espacios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['espacio_id'], 'integer'],
            [['codigo_espacio', 'zona', 'tipo_vehiculo', 'estado', 'ubicacion_gps', 'fecha_creacion', 'fecha_actualizacion'], 'safe'],
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
        $query = Espacios::find();

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
            'espacio_id' => $this->espacio_id,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_actualizacion' => $this->fecha_actualizacion,
        ]);

        $query->andFilterWhere(['like', 'codigo_espacio', $this->codigo_espacio])
            ->andFilterWhere(['like', 'zona', $this->zona])
            ->andFilterWhere(['like', 'tipo_vehiculo', $this->tipo_vehiculo])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'ubicacion_gps', $this->ubicacion_gps]);

        return $dataProvider;
    }
}
