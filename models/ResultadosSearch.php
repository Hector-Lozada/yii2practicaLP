<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Resultados;

/**
 * ResultadosSearch represents the model behind the search form of `app\models\Resultados`.
 */
class ResultadosSearch extends Resultados
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idresultados', 'usuario_id', 'examen_id'], 'integer'],
            [['puntuacion'], 'number'],
            [['fecha'], 'safe'],
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
        $query = Resultados::find();

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
            'idresultados' => $this->idresultados,
            'usuario_id' => $this->usuario_id,
            'examen_id' => $this->examen_id,
            'puntuacion' => $this->puntuacion,
            'fecha' => $this->fecha,
        ]);

        return $dataProvider;
    }
}
