<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lecciones".
 *
 * @property int $idlecciones
 * @property string|null $titulo
 * @property string|null $contenido
 * @property int|null $curso_id
 *
 * @property Cursos $curso
 */
class Lecciones extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lecciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'contenido', 'curso_id'], 'default', 'value' => null],
            [['contenido'], 'string'],
            [['curso_id'], 'integer'],
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
            'idlecciones' => Yii::t('app', 'Idlecciones'),
            'titulo' => Yii::t('app', 'Titulo'),
            'contenido' => Yii::t('app', 'Contenido'),
            'curso_id' => Yii::t('app', 'Curso ID'),
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
     * {@inheritdoc}
     * @return LeccionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LeccionesQuery(get_called_class());
    }

}
