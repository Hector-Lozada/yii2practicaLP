<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $idusuarios
 * @property string|null $nombre
 * @property string|null $email
 * @property string|null $password
 * @property string|null $creado_en
 *
 * @property Cursos[] $cursos
 * @property Resultados[] $resultados
 */
class Usuarios extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'email', 'password', 'creado_en'], 'default', 'value' => null],
            [['creado_en'], 'safe'],
            [['nombre', 'email'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idusuarios' => Yii::t('app', 'Idusuarios'),
            'nombre' => Yii::t('app', 'Nombre'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'creado_en' => Yii::t('app', 'Creado En'),
        ];
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery|CursosQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Cursos::class, ['usuario_creador_id' => 'idusuarios']);
    }

    /**
     * Gets query for [[Resultados]].
     *
     * @return \yii\db\ActiveQuery|ResultadosQuery
     */
    public function getResultados()
    {
        return $this->hasMany(Resultados::class, ['usuario_id' => 'idusuarios']);
    }

    /**
     * {@inheritdoc}
     * @return UsuariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosQuery(get_called_class());
    }

}
