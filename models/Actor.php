<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actor".
 *
 * @property int $idactor
 * @property string|null $nombres
 * @property string|null $apellidos
 * @property string|null $biografia
 *
 * @property PeliculaHasActor[] $peliculaHasActors
 * @property Pelicula[] $peliculaIdpeliculas
 */
class Actor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'biografia'], 'default', 'value' => null],
            [['nombres', 'apellidos', 'biografia'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idactor' => Yii::t('app', 'Idactor'),
            'nombres' => Yii::t('app', 'Nombres'),
            'apellidos' => Yii::t('app', 'Apellidos'),
            'biografia' => Yii::t('app', 'Biografia'),
        ];
    }

    /**
     * Gets query for [[PeliculaHasActors]].
     *
     * @return \yii\db\ActiveQuery|PeliculaHasActorQuery
     */
    public function getPeliculaHasActors()
    {
        return $this->hasMany(PeliculaHasActor::class, ['actor_idactor' => 'idactor']);
    }

    /**
     * Gets query for [[PeliculaIdpeliculas]].
     *
     * @return \yii\db\ActiveQuery|PeliculaQuery
     */
    public function getPeliculaIdpeliculas()
    {
        return $this->hasMany(Pelicula::class, ['idpelicula' => 'pelicula_idpelicula'])->viaTable('pelicula_has_actor', ['actor_idactor' => 'idactor']);
    }

    /**
     * {@inheritdoc}
     * @return ActorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActorQuery(get_called_class());
    }

}
