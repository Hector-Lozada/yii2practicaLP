<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tarifas".
 *
 * @property int $tarifa_id
 * @property string $tipo_usuario
 * @property string $tipo_vehiculo
 * @property float $tarifa_hora
 * @property float $tarifa_dia
 * @property float $tarifa_mes
 * @property string $vigente_desde
 * @property string|null $vigente_hasta
 * @property int $usuario_registra
 * @property string|null $fecha_registro
 * @property string|null $fecha_actualizacion
 *
 * @property Usuarios $usuarioRegistra
 */
class Tarifas extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TIPO_USUARIO_ESTUDIANTE = 'estudiante';
    const TIPO_USUARIO_PROFESOR = 'profesor';
    const TIPO_USUARIO_ADMINISTRATIVO = 'administrativo';
    const TIPO_USUARIO_VISITANTE = 'visitante';
    const TIPO_VEHICULO_AUTOMOVIL = 'automovil';
    const TIPO_VEHICULO_MOTOCICLETA = 'motocicleta';
    const TIPO_VEHICULO_DISCAPACITADOS = 'discapacitados';
    const TIPO_VEHICULO_CARGA = 'carga';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarifas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vigente_hasta'], 'default', 'value' => null],
            [['tipo_usuario', 'tipo_vehiculo', 'tarifa_hora', 'tarifa_dia', 'tarifa_mes', 'vigente_desde', 'usuario_registra'], 'required'],
            [['tipo_usuario', 'tipo_vehiculo'], 'string'],
            [['tarifa_hora', 'tarifa_dia', 'tarifa_mes'], 'number'],
            [['vigente_desde', 'vigente_hasta', 'fecha_registro', 'fecha_actualizacion'], 'safe'],
            [['usuario_registra'], 'integer'],
            ['tipo_usuario', 'in', 'range' => array_keys(self::optsTipoUsuario())],
            ['tipo_vehiculo', 'in', 'range' => array_keys(self::optsTipoVehiculo())],
            [['usuario_registra'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_registra' => 'usuario_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tarifa_id' => Yii::t('app', 'Tarifa ID'),
            'tipo_usuario' => Yii::t('app', 'Tipo Usuario'),
            'tipo_vehiculo' => Yii::t('app', 'Tipo Vehiculo'),
            'tarifa_hora' => Yii::t('app', 'Tarifa Hora'),
            'tarifa_dia' => Yii::t('app', 'Tarifa Dia'),
            'tarifa_mes' => Yii::t('app', 'Tarifa Mes'),
            'vigente_desde' => Yii::t('app', 'Vigente Desde'),
            'vigente_hasta' => Yii::t('app', 'Vigente Hasta'),
            'usuario_registra' => Yii::t('app', 'Usuario Registra'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'fecha_actualizacion' => Yii::t('app', 'Fecha Actualizacion'),
        ];
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

    /**
     * {@inheritdoc}
     * @return TarifasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TarifasQuery(get_called_class());
    }


    /**
     * column tipo_usuario ENUM value labels
     * @return string[]
     */
    public static function optsTipoUsuario()
    {
        return [
            self::TIPO_USUARIO_ESTUDIANTE => Yii::t('app', 'estudiante'),
            self::TIPO_USUARIO_PROFESOR => Yii::t('app', 'profesor'),
            self::TIPO_USUARIO_ADMINISTRATIVO => Yii::t('app', 'administrativo'),
            self::TIPO_USUARIO_VISITANTE => Yii::t('app', 'visitante'),
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
            self::TIPO_VEHICULO_DISCAPACITADOS => Yii::t('app', 'discapacitados'),
            self::TIPO_VEHICULO_CARGA => Yii::t('app', 'carga'),
        ];
    }

    /**
     * @return string
     */
    public function displayTipoUsuario()
    {
        return self::optsTipoUsuario()[$this->tipo_usuario];
    }

    /**
     * @return bool
     */
    public function isTipoUsuarioEstudiante()
    {
        return $this->tipo_usuario === self::TIPO_USUARIO_ESTUDIANTE;
    }

    public function setTipoUsuarioToEstudiante()
    {
        $this->tipo_usuario = self::TIPO_USUARIO_ESTUDIANTE;
    }

    /**
     * @return bool
     */
    public function isTipoUsuarioProfesor()
    {
        return $this->tipo_usuario === self::TIPO_USUARIO_PROFESOR;
    }

    public function setTipoUsuarioToProfesor()
    {
        $this->tipo_usuario = self::TIPO_USUARIO_PROFESOR;
    }

    /**
     * @return bool
     */
    public function isTipoUsuarioAdministrativo()
    {
        return $this->tipo_usuario === self::TIPO_USUARIO_ADMINISTRATIVO;
    }

    public function setTipoUsuarioToAdministrativo()
    {
        $this->tipo_usuario = self::TIPO_USUARIO_ADMINISTRATIVO;
    }

    /**
     * @return bool
     */
    public function isTipoUsuarioVisitante()
    {
        return $this->tipo_usuario === self::TIPO_USUARIO_VISITANTE;
    }

    public function setTipoUsuarioToVisitante()
    {
        $this->tipo_usuario = self::TIPO_USUARIO_VISITANTE;
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
    public function isTipoVehiculoDiscapacitados()
    {
        return $this->tipo_vehiculo === self::TIPO_VEHICULO_DISCAPACITADOS;
    }

    public function setTipoVehiculoToDiscapacitados()
    {
        $this->tipo_vehiculo = self::TIPO_VEHICULO_DISCAPACITADOS;
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
}
