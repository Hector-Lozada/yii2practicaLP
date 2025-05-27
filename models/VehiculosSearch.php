<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vehiculos;

/**
 * VehiculosSearch represents the model behind the search form of `app\models\Vehiculos`.
 */
class VehiculosSearch extends Vehiculos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vehiculo_id', 'usuario_id', 'autorizado'], 'integer'],
            [['placa', 'marca', 'modelo', 'color', 'foto_vehiculo_path', 'tipo', 'fecha_registro', 'fecha_actualizacion'], 'safe'],
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
        $query = Vehiculos::find();

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
            'vehiculo_id' => $this->vehiculo_id,
            'usuario_id' => $this->usuario_id,
            'autorizado' => $this->autorizado,
            'fecha_registro' => $this->fecha_registro,
            'fecha_actualizacion' => $this->fecha_actualizacion,
        ]);

        $query->andFilterWhere(['like', 'placa', $this->placa])
            ->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'modelo', $this->modelo])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'foto_vehiculo_path', $this->foto_vehiculo_path])
            ->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
