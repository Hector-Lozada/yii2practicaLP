<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Ventas]].
 *
 * @see Ventas
 */
class VentasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Ventas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Ventas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
