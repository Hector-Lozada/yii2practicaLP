<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tarifas]].
 *
 * @see Tarifas
 */
class TarifasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Tarifas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tarifas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
