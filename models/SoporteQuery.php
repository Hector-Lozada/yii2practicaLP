<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Soporte]].
 *
 * @see Soporte
 */
class SoporteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Soporte[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Soporte|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
