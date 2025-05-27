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
 * @property string $email
 * @property string|null $telefono
 * @property int|null $activo
 * @property string|null $fecha_registro
 * @property string|null $fecha_actualizacion
 * @property string|null $foto_perfil_path
 * @property UploadedFile $imageFile Propiedad virtual para manejar la subida de archivos
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile Atributo para manejar la subida de archivos
     */
    public $imageFile;

    /**
     * ENUM field values
     */
    const TIPO_ESTUDIANTE = 'estudiante';
    const TIPO_PROFESOR = 'profesor';
    const TIPO_ADMINISTRATIVO = 'administrativo';
    const TIPO_VISITANTE = 'visitante';

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
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'fecha_registro',
                'updatedAtAttribute' => 'fecha_actualizacion',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telefono', 'foto_perfil_path'], 'default', 'value' => null],
            [['activo'], 'default', 'value' => 1],
            [['codigo_universitario', 'nombre', 'apellido', 'tipo', 'email'], 'required'],
            [['tipo'], 'string'],
            [['activo'], 'integer'],
            [['fecha_registro', 'fecha_actualizacion'], 'safe'],
            [['codigo_universitario', 'telefono'], 'string', 'max' => 20],
            [['nombre', 'apellido', 'email'], 'string', 'max' => 100],
            [['foto_perfil_path'], 'string', 'max' => 255],
            [['imageFile'], 'file', 
            'skipOnEmpty' => true,
            'extensions' => 'png, jpg, jpeg',
            'checkExtensionByMimeType' => false, // Importante
            'maxSize' => 1024 * 1024 * 2 // 2MB
        ],
            ['tipo', 'in', 'range' => array_keys(self::optsTipo())],
            [['codigo_universitario'], 'unique'],
            [['email'], 'unique'],
            ['email', 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'codigo_universitario' => Yii::t('app', 'Código Universitario'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellido' => Yii::t('app', 'Apellido'),
            'tipo' => Yii::t('app', 'Tipo'),
            'email' => Yii::t('app', 'Email'),
            'telefono' => Yii::t('app', 'Teléfono'),
            'activo' => Yii::t('app', 'Activo'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'fecha_actualizacion' => Yii::t('app', 'Fecha Actualización'),
            'foto_perfil_path' => Yii::t('app', 'Foto de Perfil'),
            'imageFile' => Yii::t('app', 'Foto de Perfil'),
        ];
    }

    /**
     * Maneja la subida de la imagen
     * @return bool
     */
    public function upload()
{
    if ($this->imageFile) {
        // Verificar si el archivo temporal existe realmente
        if (!file_exists($this->imageFile->tempName)) {
            $this->addError('imageFile', 'El archivo temporal no está disponible.');
            return false;
        }

        $filename = Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
        $uploadPath = $this->getUploadPath();
        
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }
        
        if ($this->imageFile->saveAs($uploadPath . $filename)) {
            // Eliminar imagen anterior si existe
            if ($this->foto_perfil_path && file_exists($uploadPath . $this->foto_perfil_path)) {
                unlink($uploadPath . $this->foto_perfil_path);
            }
            $this->foto_perfil_path = $filename;
            return true;
        }
    }
    return true; // Si no hay archivo para subir, considerar como éxito
}

    /**
     * Obtiene la ruta completa para subir archivos
     * @return string
     */
    public function getUploadPath()
    {
        return Yii::getAlias('@webroot/uploads/users/');
    }

    /**
     * Obtiene la URL para acceder a la imagen
     * @return string|null
     */
    public function getImageUrl()
    {
        if ($this->foto_perfil_path) {
            return Yii::getAlias('@web/uploads/users/') . $this->foto_perfil_path;
        }
        return Yii::getAlias('@web/images/default-user.png'); // Imagen por defecto
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
            self::TIPO_ESTUDIANTE => Yii::t('app', 'Estudiante'),
            self::TIPO_PROFESOR => Yii::t('app', 'Profesor'),
            self::TIPO_ADMINISTRATIVO => Yii::t('app', 'Administrativo'),
            self::TIPO_VISITANTE => Yii::t('app', 'Visitante'),
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
}