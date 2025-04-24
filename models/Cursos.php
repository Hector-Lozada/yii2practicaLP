<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cursos".
 *
 * @property int $idcursos
 * @property string|null $titulo
 * @property string|null $descripcion
 * @property int|null $usuario_creador_id
 *
 * @property Examenes[] $examenes
 * @property Lecciones[] $lecciones
 * @property Usuarios $usuarioCreador
 */
class Cursos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cursos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'usuario_creador_id'], 'default', 'value' => null],
            [['usuario_creador_id'], 'integer'],
            [['titulo'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 255],
            [['usuario_creador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_creador_id' => 'idusuarios']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcursos' => Yii::t('app', 'Idcursos'),
            'titulo' => Yii::t('app', 'Titulo'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'usuario_creador_id' => Yii::t('app', 'Usuario Creador ID'),
        ];
    }

    /**
     * Gets query for [[Examenes]].
     *
     * @return \yii\db\ActiveQuery|ExamenesQuery
     */
    public function getExamenes()
    {
        return $this->hasMany(Examenes::class, ['curso_id' => 'idcursos']);
    }

    /**
     * Gets query for [[Lecciones]].
     *
     * @return \yii\db\ActiveQuery|LeccionesQuery
     */
    public function getLecciones()
    {
        return $this->hasMany(Lecciones::class, ['curso_id' => 'idcursos']);
    }

    /**
     * Gets query for [[UsuarioCreador]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuarioCreador()
    {
        return $this->hasOne(Usuarios::class, ['idusuarios' => 'usuario_creador_id']);
    }

    /**
     * {@inheritdoc}
     * @return CursosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CursosQuery(get_called_class());
    }

}
