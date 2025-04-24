<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resultados".
 *
 * @property int $idresultados
 * @property int|null $usuario_id
 * @property int|null $examen_id
 * @property float|null $puntuacion
 * @property string|null $fecha
 *
 * @property Examenes $examen
 * @property Usuarios $usuario
 */
class Resultados extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resultados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'examen_id', 'puntuacion', 'fecha'], 'default', 'value' => null],
            [['usuario_id', 'examen_id'], 'integer'],
            [['puntuacion'], 'number'],
            [['fecha'], 'safe'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'idusuarios']],
            [['examen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Examenes::class, 'targetAttribute' => ['examen_id' => 'idexamenes']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idresultados' => Yii::t('app', 'Idresultados'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'examen_id' => Yii::t('app', 'Examen ID'),
            'puntuacion' => Yii::t('app', 'Puntuacion'),
            'fecha' => Yii::t('app', 'Fecha'),
        ];
    }

    /**
     * Gets query for [[Examen]].
     *
     * @return \yii\db\ActiveQuery|ExamenesQuery
     */
    public function getExamen()
    {
        return $this->hasOne(Examenes::class, ['idexamenes' => 'examen_id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['idusuarios' => 'usuario_id']);
    }

    /**
     * {@inheritdoc}
     * @return ResultadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResultadosQuery(get_called_class());
    }

}
