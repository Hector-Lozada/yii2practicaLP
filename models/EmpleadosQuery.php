<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Empleados]].
 *
 * @see Empleados
 */
class EmpleadosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Empleados[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Empleados|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
