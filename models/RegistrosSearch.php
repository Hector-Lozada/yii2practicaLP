<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Registros;

/**
 * RegistrosSearch represents the model behind the search form of `app\models\Registros`.
 */
class RegistrosSearch extends Registros
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registro_id', 'vehiculo_id', 'espacio_id', 'usuario_registra'], 'integer'],
            [['fecha_entrada', 'fecha_salida', 'metodo_pago', 'observaciones', 'foto_comprobante_path', 'fecha_actualizacion'], 'safe'],
            [['monto_pagado'], 'number'],
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
        $query = Registros::find();

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
            'registro_id' => $this->registro_id,
            'vehiculo_id' => $this->vehiculo_id,
            'espacio_id' => $this->espacio_id,
            'fecha_entrada' => $this->fecha_entrada,
            'fecha_salida' => $this->fecha_salida,
            'monto_pagado' => $this->monto_pagado,
            'usuario_registra' => $this->usuario_registra,
            'fecha_actualizacion' => $this->fecha_actualizacion,
        ]);

        $query->andFilterWhere(['like', 'metodo_pago', $this->metodo_pago])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones])
            ->andFilterWhere(['like', 'foto_comprobante_path', $this->foto_comprobante_path]);

        return $dataProvider;
    }
}
