<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Examenes]].
 *
 * @see Examenes
 */
class ExamenesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Examenes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Examenes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
