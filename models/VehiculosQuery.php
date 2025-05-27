<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Vehiculos]].
 *
 * @see Vehiculos
 */
class VehiculosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Vehiculos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Vehiculos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
