<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "espacios_estacionamiento".
 *
 * @property int $espacio_id
 * @property string $codigo_espacio
 * @property string $zona
 * @property string $tipo_vehiculo
 * @property string|null $estado
 * @property string|null $ubicacion_gps
 * @property string|null $fecha_creacion
 * @property string|null $fecha_actualizacion
 *
 * @property RegistrosIngreso[] $registrosIngresos
 */
class Espacios extends \yii\db\ActiveRecord
{

    /**
     * @var UploadedFile Atributo para manejar la subida de archivos
     */
    public $imageFile;

    /**
     * ENUM field values
     */
    const ZONA_A = 'A';
    const ZONA_B = 'B';
    const ZONA_C = 'C';
    const ZONA_D = 'D';
    const ZONA_DISCAPACITADOS = 'discapacitados';
    const ZONA_VISITANTES = 'visitantes';
    const TIPO_VEHICULO_AUTOMOVIL = 'automovil';
    const TIPO_VEHICULO_MOTOCICLETA = 'motocicleta';
    const TIPO_VEHICULO_CARGA = 'carga';
    const ESTADO_DISPONIBLE = 'disponible';
    const ESTADO_OCUPADO = 'ocupado';
    const ESTADO_MANTENIMIENTO = 'mantenimiento';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'espacios_estacionamiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubicacion_gps'], 'default', 'value' => null],
            [['estado'], 'default', 'value' => 'disponible'],
            [['codigo_espacio', 'zona', 'tipo_vehiculo'], 'required'],
            [['zona', 'tipo_vehiculo', 'estado'], 'string'],
            [['fecha_creacion', 'fecha_actualizacion'], 'safe'],
            [['codigo_espacio'], 'string', 'max' => 10],
            [['ubicacion_gps'], 'string', 'max' => 100],
            ['zona', 'in', 'range' => array_keys(self::optsZona())],
            ['tipo_vehiculo', 'in', 'range' => array_keys(self::optsTipoVehiculo())],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['codigo_espacio'], 'unique'],
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
            'espacio_id' => Yii::t('app', 'Espacio ID'),
            'codigo_espacio' => Yii::t('app', 'Codigo Espacio'),
            'zona' => Yii::t('app', 'Zona'),
            'tipo_vehiculo' => Yii::t('app', 'Tipo Vehiculo'),
            'estado' => Yii::t('app', 'Estado'),
            'ubicacion_gps' => Yii::t('app', 'Ubicacion Gps'),
            'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
            'fecha_actualizacion' => Yii::t('app', 'Fecha Actualizacion'),
        ];
    }

    /**
     * Gets query for [[RegistrosIngresos]].
     *
     * @return \yii\db\ActiveQuery|RegistrosIngresoQuery
     */
    public function getRegistrosIngresos()
    {
        return $this->hasMany(RegistrosIngreso::class, ['espacio_id' => 'espacio_id']);
    }

    /**
     * {@inheritdoc}
     * @return EspaciosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EspaciosQuery(get_called_class());
    }


    /**
     * column zona ENUM value labels
     * @return string[]
     */
    public static function optsZona()
    {
        return [
            self::ZONA_A => Yii::t('app', 'A'),
            self::ZONA_B => Yii::t('app', 'B'),
            self::ZONA_C => Yii::t('app', 'C'),
            self::ZONA_D => Yii::t('app', 'D'),
            self::ZONA_DISCAPACITADOS => Yii::t('app', 'discapacitados'),
            self::ZONA_VISITANTES => Yii::t('app', 'visitantes'),
        ];
    }

    /**
     * column tipo_vehiculo ENUM value labels
     * @return string[]
     */
    public static function optsTipoVehiculo()
    {
        return [
            self::TIPO_VEHICULO_AUTOMOVIL => Yii::t('app', 'automovil'),
            self::TIPO_VEHICULO_MOTOCICLETA => Yii::t('app', 'motocicleta'),
            self::TIPO_VEHICULO_CARGA => Yii::t('app', 'carga'),
        ];
    }

    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_DISPONIBLE => Yii::t('app', 'disponible'),
            self::ESTADO_OCUPADO => Yii::t('app', 'ocupado'),
            self::ESTADO_MANTENIMIENTO => Yii::t('app', 'mantenimiento'),
        ];
    }

    /**
     * @return string
     */
    public function displayZona()
    {
        return self::optsZona()[$this->zona];
    }

    /**
     * @return bool
     */
    public function isZonaA()
    {
        return $this->zona === self::ZONA_A;
    }

    public function setZonaToA()
    {
        $this->zona = self::ZONA_A;
    }

    /**
     * @return bool
     */
    public function isZonaB()
    {
        return $this->zona === self::ZONA_B;
    }

    public function setZonaToB()
    {
        $this->zona = self::ZONA_B;
    }

    /**
     * @return bool
     */
    public function isZonaC()
    {
        return $this->zona === self::ZONA_C;
    }

    public function setZonaToC()
    {
        $this->zona = self::ZONA_C;
    }

    /**
     * @return bool
     */
    public function isZonaD()
    {
        return $this->zona === self::ZONA_D;
    }

    public function setZonaToD()
    {
        $this->zona = self::ZONA_D;
    }

    /**
     * @return bool
     */
    public function isZonaDiscapacitados()
    {
        return $this->zona === self::ZONA_DISCAPACITADOS;
    }

    public function setZonaToDiscapacitados()
    {
        $this->zona = self::ZONA_DISCAPACITADOS;
    }

    /**
     * @return bool
     */
    public function isZonaVisitantes()
    {
        return $this->zona === self::ZONA_VISITANTES;
    }

    public function setZonaToVisitantes()
    {
        $this->zona = self::ZONA_VISITANTES;
    }

    /**
     * @return string
     */
    public function displayTipoVehiculo()
    {
        return self::optsTipoVehiculo()[$this->tipo_vehiculo];
    }

    /**
     * @return bool
     */
    public function isTipoVehiculoAutomovil()
    {
        return $this->tipo_vehiculo === self::TIPO_VEHICULO_AUTOMOVIL;
    }

    public function setTipoVehiculoToAutomovil()
    {
        $this->tipo_vehiculo = self::TIPO_VEHICULO_AUTOMOVIL;
    }

    /**
     * @return bool
     */
    public function isTipoVehiculoMotocicleta()
    {
        return $this->tipo_vehiculo === self::TIPO_VEHICULO_MOTOCICLETA;
    }

    public function setTipoVehiculoToMotocicleta()
    {
        $this->tipo_vehiculo = self::TIPO_VEHICULO_MOTOCICLETA;
    }

    /**
     * @return bool
     */
    public function isTipoVehiculoCarga()
    {
        return $this->tipo_vehiculo === self::TIPO_VEHICULO_CARGA;
    }

    public function setTipoVehiculoToCarga()
    {
        $this->tipo_vehiculo = self::TIPO_VEHICULO_CARGA;
    }

    /**
     * @return string
     */
    public function displayEstado()
    {
        return self::optsEstado()[$this->estado];
    }

    /**
     * @return bool
     */
    public function isEstadoDisponible()
    {
        return $this->estado === self::ESTADO_DISPONIBLE;
    }

    public function setEstadoToDisponible()
    {
        $this->estado = self::ESTADO_DISPONIBLE;
    }

    /**
     * @return bool
     */
    public function isEstadoOcupado()
    {
        return $this->estado === self::ESTADO_OCUPADO;
    }

    public function setEstadoToOcupado()
    {
        $this->estado = self::ESTADO_OCUPADO;
    }

    /**
     * @return bool
     */
    public function isEstadoMantenimiento()
    {
        return $this->estado === self::ESTADO_MANTENIMIENTO;
    }

    public function setEstadoToMantenimiento()
    {
        $this->estado = self::ESTADO_MANTENIMIENTO;
    }
}
