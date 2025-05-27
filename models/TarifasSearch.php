<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tarifas;

/**
 * TarifasSearch represents the model behind the search form of `app\models\Tarifas`.
 */
class TarifasSearch extends Tarifas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarifa_id', 'usuario_registra'], 'integer'],
            [['tipo_usuario', 'tipo_vehiculo', 'vigente_desde', 'vigente_hasta', 'fecha_registro', 'fecha_actualizacion'], 'safe'],
            [['tarifa_hora', 'tarifa_dia', 'tarifa_mes'], 'number'],
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
        $query = Tarifas::find();

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
            'tarifa_id' => $this->tarifa_id,
            'tarifa_hora' => $this->tarifa_hora,
            'tarifa_dia' => $this->tarifa_dia,
            'tarifa_mes' => $this->tarifa_mes,
            'vigente_desde' => $this->vigente_desde,
            'vigente_hasta' => $this->vigente_hasta,
            'usuario_registra' => $this->usuario_registra,
            'fecha_registro' => $this->fecha_registro,
            'fecha_actualizacion' => $this->fecha_actualizacion,
        ]);

        $query->andFilterWhere(['like', 'tipo_usuario', $this->tipo_usuario])
            ->andFilterWhere(['like', 'tipo_vehiculo', $this->tipo_vehiculo]);

        return $dataProvider;
    }
}
