<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Resultados]].
 *
 * @see Resultados
 */
class ResultadosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Resultados[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Resultados|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
