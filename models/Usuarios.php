<?php

namespace app\models;
use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $usuario_id
 * @property string $codigo_universitario
 * @property string $nombre
 * @property string $apellido
 * @property string $tipo
 * @property string $rol
 * @property string $email
 * @property string $password_hash
 * @property string|null $telefono
 * @property int|null $activo
 * @property string|null $fecha_registro
 * @property string|null $fecha_actualizacion
 * @property string|null $foto_perfil_path
 *
 * @property RegistrosIngreso[] $registrosIngresos
 * @property Tarifas[] $tarifas
 * @property Vehiculos[] $vehiculos
 */
class Usuarios extends \yii\db\ActiveRecord
{

    /**
     * @var UploadedFile Atributo para manejar la subida de archivos
     */
   public $foto_perfil; // en la clase Usuarios

    /**
     * ENUM field values
     */
    const TIPO_ESTUDIANTE = 'estudiante';
    const TIPO_PROFESOR = 'profesor';
    const TIPO_ADMINISTRATIVO = 'administrativo';
    const TIPO_VISITANTE = 'visitante';
    const ROL_ADMIN = 'admin';
    const ROL_USUARIO = 'usuario';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }
    public function beforeSave($insert)
{
    if (parent::beforeSave($insert)) {
        if ($this->foto_perfil instanceof \yii\web\UploadedFile) {
            $this->uploadFotoPerfil();
        }
        return true;
    }
    return false;
}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telefono', 'foto_perfil_path'], 'default', 'value' => null],
            [['rol'], 'default', 'value' => 'usuario'],
            [['activo'], 'default', 'value' => 1],
            [['codigo_universitario', 'nombre', 'apellido', 'tipo', 'email', 'password_hash'], 'required'],
            [['tipo', 'rol'], 'string'],
            [['activo'], 'integer'],
            [['fecha_registro', 'fecha_actualizacion'], 'safe'],
            [['codigo_universitario', 'telefono'], 'string', 'max' => 20],
            [['nombre', 'apellido', 'email'], 'string', 'max' => 100],
            [['password_hash', 'foto_perfil_path'], 'string', 'max' => 255],
            ['tipo', 'in', 'range' => array_keys(self::optsTipo())],
            ['rol', 'in', 'range' => array_keys(self::optsRol())],
            [['codigo_universitario'], 'unique'],
            [['email'], 'unique'],
            [['foto_perfil'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'skipOnEmpty' => true, 'maxSize' => 1024*1024*2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'codigo_universitario' => Yii::t('app', 'Codigo Universitario'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellido' => Yii::t('app', 'Apellido'),
            'tipo' => Yii::t('app', 'Tipo'),
            'rol' => Yii::t('app', 'Rol'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'telefono' => Yii::t('app', 'Telefono'),
            'activo' => Yii::t('app', 'Activo'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'fecha_actualizacion' => Yii::t('app', 'Fecha Actualizacion'),
            'foto_perfil_path' => Yii::t('app', 'Foto Perfil Path'),
            'foto_perfil' => Yii::t('app', 'Foto de Perfil'),
        ];
    }

    public function uploadFotoPerfil()
{
    $this->foto_perfil = \yii\web\UploadedFile::getInstance($this, 'foto_perfil');
    if ($this->foto_perfil) {
        $directory = Yii::getAlias('@webroot/uploads/users');
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        $filename = uniqid('user_') . '.' . $this->foto_perfil->extension;
        $path = $directory . '/' . $filename;
        if ($this->foto_perfil->saveAs($path)) {
            $this->foto_perfil_path = 'uploads/users/' . $filename;
            return true;
        }
        return false;
    }
    return true;
}
public function getUploadPath()
    {
        return Yii::getAlias('@webroot/uploads/users/');
    }

    /**
     * Gets query for [[RegistrosIngresos]].
     *
     * @return \yii\db\ActiveQuery|RegistrosIngresoQuery
     */
    public function getRegistrosIngresos()
    {
        return $this->hasMany(RegistrosIngreso::class, ['usuario_registra' => 'usuario_id']);
    }

    /**
     * Gets query for [[Tarifas]].
     *
     * @return \yii\db\ActiveQuery|TarifasQuery
     */
    public function getTarifas()
    {
        return $this->hasMany(Tarifas::class, ['usuario_registra' => 'usuario_id']);
    }

    /**
     * Gets query for [[Vehiculos]].
     *
     * @return \yii\db\ActiveQuery|VehiculosQuery
     */
    public function getVehiculos()
    {
        return $this->hasMany(Vehiculos::class, ['usuario_id' => 'usuario_id']);
    }

    /**
     * {@inheritdoc}
     * @return UsuariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosQuery(get_called_class());
    }


    /**
     * column tipo ENUM value labels
     * @return string[]
     */
    public static function optsTipo()
    {
        return [
            self::TIPO_ESTUDIANTE => Yii::t('app', 'estudiante'),
            self::TIPO_PROFESOR => Yii::t('app', 'profesor'),
            self::TIPO_ADMINISTRATIVO => Yii::t('app', 'administrativo'),
            self::TIPO_VISITANTE => Yii::t('app', 'visitante'),
        ];
    }

    /**
     * column rol ENUM value labels
     * @return string[]
     */
    public static function optsRol()
    {
        return [
            self::ROL_ADMIN => Yii::t('app', 'admin'),
            self::ROL_USUARIO => Yii::t('app', 'usuario'),
        ];
    }

    /**
     * @return string
     */
    public function displayTipo()
    {
        return self::optsTipo()[$this->tipo];
    }

    /**
     * @return bool
     */
    public function isTipoEstudiante()
    {
        return $this->tipo === self::TIPO_ESTUDIANTE;
    }

    public function setTipoToEstudiante()
    {
        $this->tipo = self::TIPO_ESTUDIANTE;
    }

    /**
     * @return bool
     */
    public function isTipoProfesor()
    {
        return $this->tipo === self::TIPO_PROFESOR;
    }

    public function setTipoToProfesor()
    {
        $this->tipo = self::TIPO_PROFESOR;
    }

    /**
     * @return bool
     */
    public function isTipoAdministrativo()
    {
        return $this->tipo === self::TIPO_ADMINISTRATIVO;
    }

    public function setTipoToAdministrativo()
    {
        $this->tipo = self::TIPO_ADMINISTRATIVO;
    }

    /**
     * @return bool
     */
    public function isTipoVisitante()
    {
        return $this->tipo === self::TIPO_VISITANTE;
    }

    public function setTipoToVisitante()
    {
        $this->tipo = self::TIPO_VISITANTE;
    }

    /**
     * @return string
     */
    public function displayRol()
    {
        return self::optsRol()[$this->rol];
    }

    /**
     * @return bool
     */
    public function isRolAdmin()
    {
        return $this->rol === self::ROL_ADMIN;
    }

    public function setRolToAdmin()
    {
        $this->rol = self::ROL_ADMIN;
    }

    /**
     * @return bool
     */
    public function isRolUsuario()
    {
        return $this->rol === self::ROL_USUARIO;
    }

    public function setRolToUsuario()
    {
        $this->rol = self::ROL_USUARIO;
    }
    // En models/Usuarios.php
public function isAdmin() {
    return $this->rol === 'admin';
}
}

