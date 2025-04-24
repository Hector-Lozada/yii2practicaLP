<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Lecciones]].
 *
 * @see Lecciones
 */
class LeccionesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Lecciones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Lecciones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
