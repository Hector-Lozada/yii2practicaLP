<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "registros_ingreso".
 *
 * @property int $registro_id
 * @property int $vehiculo_id
 * @property int $espacio_id
 * @property string|null $fecha_entrada
 * @property string|null $fecha_salida
 * @property string|null $metodo_pago
 * @property float|null $monto_pagado
 * @property int $usuario_registra
 * @property string|null $observaciones
 * @property string|null $foto_comprobante_path
 * @property string|null $fecha_actualizacion
 *
 * @property EspaciosEstacionamiento $espacio
 * @property Usuarios $usuarioRegistra
 * @property Vehiculos $vehiculo
 */
class Registros extends \yii\db\ActiveRecord
{

    /**
     * @var UploadedFile Atributo para manejar la subida de archivos
     */
    public $imageFile;

    /**
     * ENUM field values
     */
    const METODO_PAGO_EFECTIVO = 'efectivo';
    const METODO_PAGO_TARJETA = 'tarjeta';
    const METODO_PAGO_APP = 'app';
    const METODO_PAGO_GRATIS = 'gratis';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registros_ingreso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_salida', 'metodo_pago', 'observaciones', 'foto_comprobante_path'], 'default', 'value' => null],
            [['monto_pagado'], 'default', 'value' => 0.00],
            [['vehiculo_id', 'espacio_id', 'usuario_registra'], 'required'],
            [['vehiculo_id', 'espacio_id', 'usuario_registra'], 'integer'],
            [['fecha_entrada', 'fecha_salida', 'fecha_actualizacion'], 'safe'],
            [['metodo_pago', 'observaciones'], 'string'],
            [['monto_pagado'], 'number'],
            [['foto_comprobante_path'], 'string', 'max' => 255],
            ['metodo_pago', 'in', 'range' => array_keys(self::optsMetodoPago())],
            [['vehiculo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehiculos::class, 'targetAttribute' => ['vehiculo_id' => 'vehiculo_id']],
            [['espacio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Espacios::class, 'targetAttribute' => ['espacio_id' => 'espacio_id']],
            [['usuario_registra'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_registra' => 'usuario_id']],
            [['imageFile'], 'file', 
            'skipOnEmpty' => true,
            'extensions' => 'png, jpg, jpeg',
            'checkExtensionByMimeType' => false, // Importante
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
            'registro_id' => Yii::t('app', 'Registro ID'),
            'vehiculo_id' => Yii::t('app', 'Vehiculo ID'),
            'espacio_id' => Yii::t('app', 'Espacio ID'),
            'fecha_entrada' => Yii::t('app', 'Fecha Entrada'),
            'fecha_salida' => Yii::t('app', 'Fecha Salida'),
            'metodo_pago' => Yii::t('app', 'Metodo Pago'),
            'monto_pagado' => Yii::t('app', 'Monto Pagado'),
            'usuario_registra' => Yii::t('app', 'Usuario Registra'),
            'observaciones' => Yii::t('app', 'Observaciones'),
            'foto_comprobante_path' => Yii::t('app', 'Foto Comprobante Path'),
            'fecha_actualizacion' => Yii::t('app', 'Fecha Actualizacion'),
            'imageFile' => Yii::t('app', 'Foto de Perfil'),
        ];
    }

     public function upload()
{
    if ($this->validate()) {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        
        if ($this->imageFile) {
            $filename = Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
            $uploadPath = Yii::getAlias('@webroot/uploads/registros/');
            
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }
            
            if ($this->imageFile->saveAs($uploadPath . $filename)) {
                // Eliminar imagen anterior si existe
                if ($this->foto_comprobante_path && file_exists($uploadPath . $this->foto_comprobante_path)) {
                    unlink($uploadPath . $this->foto_comprobante_path);
                }
                $this->foto_comprobante_path = $filename;
                return true;
            }
        }
        return true; // Si no se subió archivo pero es válido
    }
    return false;
}
public function getUploadPath()
    {
        return Yii::getAlias('@webroot/uploads/registros/');
    }

    /**
     * Gets query for [[Espacio]].
     *
     * @return \yii\db\ActiveQuery|EspaciosQuery
     */
    public function getEspacio()
    {
        return $this->hasOne(Espacios::class, ['espacio_id' => 'espacio_id']);
    }

    /**
     * Gets query for [[UsuarioRegistra]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuarioRegistra()
    {
        return $this->hasOne(Usuarios::class, ['usuario_id' => 'usuario_registra']);
    }
    public function getUsuario()
{
    return $this->hasOne(Usuarios::class, ['usuario_id' => 'usuario_registra']);
}


    /**
     * Gets query for [[Vehiculo]].
     *
     * @return \yii\db\ActiveQuery|VehiculosQuery
     */
    public function getVehiculo()
    {
        return $this->hasOne(Vehiculos::class, ['vehiculo_id' => 'vehiculo_id']);
    }

    /**
     * {@inheritdoc}
     * @return RegistrosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegistrosQuery(get_called_class());
    }


    /**
     * column metodo_pago ENUM value labels
     * @return string[]
     */
    public static function optsMetodoPago()
    {
        return [
            self::METODO_PAGO_EFECTIVO => Yii::t('app', 'efectivo'),
            self::METODO_PAGO_TARJETA => Yii::t('app', 'tarjeta'),
            self::METODO_PAGO_APP => Yii::t('app', 'app'),
            self::METODO_PAGO_GRATIS => Yii::t('app', 'gratis'),
        ];
    }

    /**
     * @return string
     */
    public function displayMetodoPago()
    {
        return self::optsMetodoPago()[$this->metodo_pago];
    }

    /**
     * @return bool
     */
    public function isMetodoPagoEfectivo()
    {
        return $this->metodo_pago === self::METODO_PAGO_EFECTIVO;
    }

    public function setMetodoPagoToEfectivo()
    {
        $this->metodo_pago = self::METODO_PAGO_EFECTIVO;
    }

    /**
     * @return bool
     */
    public function isMetodoPagoTarjeta()
    {
        return $this->metodo_pago === self::METODO_PAGO_TARJETA;
    }

    public function setMetodoPagoToTarjeta()
    {
        $this->metodo_pago = self::METODO_PAGO_TARJETA;
    }

    /**
     * @return bool
     */
    public function isMetodoPagoApp()
    {
        return $this->metodo_pago === self::METODO_PAGO_APP;
    }

    public function setMetodoPagoToApp()
    {
        $this->metodo_pago = self::METODO_PAGO_APP;
    }

    /**
     * @return bool
     */
    public function isMetodoPagoGratis()
    {
        return $this->metodo_pago === self::METODO_PAGO_GRATIS;
    }

    public function setMetodoPagoToGratis()
    {
        $this->metodo_pago = self::METODO_PAGO_GRATIS;
    }
}
