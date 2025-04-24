<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "examenes".
 *
 * @property int $idexamenes
 * @property string|null $titulo
 * @property int|null $curso_id
 * @property string|null $fecha
 *
 * @property Cursos $curso
 * @property Resultados[] $resultados
 */
class Examenes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'examenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'curso_id', 'fecha'], 'default', 'value' => null],
            [['curso_id'], 'integer'],
            [['fecha'], 'safe'],
            [['titulo'], 'string', 'max' => 100],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cursos::class, 'targetAttribute' => ['curso_id' => 'idcursos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idexamenes' => Yii::t('app', 'Idexamenes'),
            'titulo' => Yii::t('app', 'Titulo'),
            'curso_id' => Yii::t('app', 'Curso ID'),
            'fecha' => Yii::t('app', 'Fecha'),
        ];
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery|CursosQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Cursos::class, ['idcursos' => 'curso_id']);
    }

    /**
     * Gets query for [[Resultados]].
     *
     * @return \yii\db\ActiveQuery|ResultadosQuery
     */
    public function getResultados()
    {
        return $this->hasMany(Resultados::class, ['examen_id' => 'idexamenes']);
    }

    /**
     * {@inheritdoc}
     * @return ExamenesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExamenesQuery(get_called_class());
    }

}
