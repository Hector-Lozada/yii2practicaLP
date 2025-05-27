<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Espacios]].
 *
 * @see Espacios
 */
class EspaciosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Espacios[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Espacios|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
