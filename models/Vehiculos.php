<?php

namespace app\models;
use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "vehiculos".
 *
 * @property int $vehiculo_id
 * @property int $usuario_id
 * @property string $placa
 * @property string $marca
 * @property string $modelo
 * @property string $color
 * @property string|null $foto_vehiculo_path
 * @property string|null $tipo
 * @property int|null $autorizado
 * @property string|null $fecha_registro
 * @property string|null $fecha_actualizacion
 *
 * @property RegistrosIngreso[] $registrosIngresos
 * @property Usuarios $usuario
 */
class Vehiculos extends \yii\db\ActiveRecord
{

    public $imageFile;
    /**
     * ENUM field values
     */
    const TIPO_AUTOMOVIL = 'automovil';
    const TIPO_MOTOCICLETA = 'motocicleta';
    const TIPO_DISCAPACITADOS = 'discapacitados';
    const TIPO_CARGA = 'carga';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehiculos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['foto_vehiculo_path'], 'default', 'value' => null],
            [['tipo'], 'default', 'value' => 'automovil'],
            [['autorizado'], 'default', 'value' => 1],
            [['usuario_id', 'placa', 'marca', 'modelo', 'color'], 'required'],
            [['usuario_id', 'autorizado'], 'integer'],
            [['tipo'], 'string'],
            [['fecha_registro', 'fecha_actualizacion'], 'safe'],
            [['placa'], 'string', 'max' => 15],
            [['marca', 'modelo'], 'string', 'max' => 50],
            [['color'], 'string', 'max' => 30],
            [['foto_vehiculo_path'], 'string', 'max' => 255],
            ['tipo', 'in', 'range' => array_keys(self::optsTipo())],
            [['placa'], 'unique'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'usuario_id']],
            [['imageFile'], 'file', 
            'skipOnEmpty' => true,
            'extensions' => 'png, jpg, jpeg',
            'checkExtensionByMimeType' => false, // Esto evita el error
            'maxSize' => 1024 * 1024 * 2 // 2MB
        ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vehiculo_id' => Yii::t('app', 'Vehiculo ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'placa' => Yii::t('app', 'Placa'),
            'marca' => Yii::t('app', 'Marca'),
            'modelo' => Yii::t('app', 'Modelo'),
            'color' => Yii::t('app', 'Color'),
            'foto_vehiculo_path' => Yii::t('app', 'Foto Vehiculo Path'),
            'tipo' => Yii::t('app', 'Tipo'),
            'autorizado' => Yii::t('app', 'Autorizado'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'fecha_actualizacion' => Yii::t('app', 'Fecha Actualizacion'),
        ];
    }

    public function upload()
{
    if ($this->validate()) {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        
        if ($this->imageFile) {
            $filename = Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
            $uploadPath = Yii::getAlias('@webroot/uploads/vehicles/');
            
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }
            
            if ($this->imageFile->saveAs($uploadPath . $filename)) {
                // Eliminar imagen anterior si existe
                if ($this->foto_vehiculo_path && file_exists($uploadPath . $this->foto_vehiculo_path)) {
                    unlink($uploadPath . $this->foto_vehiculo_path);
                }
                $this->foto_vehiculo_path = $filename;
                return true;
            }
        }
        return true; // Si no se subió archivo pero es válido
    }
    return false;
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
        return $this->hasMany(RegistrosIngreso::class, ['vehiculo_id' => 'vehiculo_id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['usuario_id' => 'usuario_id']);
    }

    /**
     * {@inheritdoc}
     * @return VehiculosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VehiculosQuery(get_called_class());
    }


    /**
     * column tipo ENUM value labels
     * @return string[]
     */
    public static function optsTipo()
    {
        return [
            self::TIPO_AUTOMOVIL => Yii::t('app', 'automovil'),
            self::TIPO_MOTOCICLETA => Yii::t('app', 'motocicleta'),
            self::TIPO_DISCAPACITADOS => Yii::t('app', 'discapacitados'),
            self::TIPO_CARGA => Yii::t('app', 'carga'),
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
    public function isTipoAutomovil()
    {
        return $this->tipo === self::TIPO_AUTOMOVIL;
    }

    public function setTipoToAutomovil()
    {
        $this->tipo = self::TIPO_AUTOMOVIL;
    }

    /**
     * @return bool
     */
    public function isTipoMotocicleta()
    {
        return $this->tipo === self::TIPO_MOTOCICLETA;
    }

    public function setTipoToMotocicleta()
    {
        $this->tipo = self::TIPO_MOTOCICLETA;
    }

    /**
     * @return bool
     */
    public function isTipoDiscapacitados()
    {
        return $this->tipo === self::TIPO_DISCAPACITADOS;
    }

    public function setTipoToDiscapacitados()
    {
        $this->tipo = self::TIPO_DISCAPACITADOS;
    }

    /**
     * @return bool
     */
    public function isTipoCarga()
    {
        return $this->tipo === self::TIPO_CARGA;
    }

    public function setTipoToCarga()
    {
        $this->tipo = self::TIPO_CARGA;
    }
}
