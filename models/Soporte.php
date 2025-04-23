<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "soporte_tecnico".
 *
 * @property int $id
 * @property int|null $cliente_id
 * @property int|null $producto_id
 * @property string|null $descripcion_problema
 * @property string|null $estado
 * @property string|null $fecha_reporte
 *
 * @property Clientes $cliente
 * @property Productos $producto
 */
class Soporte extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTADO_PENDIENTE = 'Pendiente';
    const ESTADO_EN_PROCESO = 'En proceso';
    const ESTADO_RESUELTO = 'Resuelto';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'soporte_tecnico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'producto_id', 'descripcion_problema'], 'default', 'value' => null],
            [['estado'], 'default', 'value' => 'Pendiente'],
            [['cliente_id', 'producto_id'], 'integer'],
            [['descripcion_problema', 'estado'], 'string'],
            [['fecha_reporte'], 'safe'],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::class, 'targetAttribute' => ['cliente_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['producto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cliente_id' => Yii::t('app', 'Cliente ID'),
            'producto_id' => Yii::t('app', 'Producto ID'),
            'descripcion_problema' => Yii::t('app', 'Descripcion Problema'),
            'estado' => Yii::t('app', 'Estado'),
            'fecha_reporte' => Yii::t('app', 'Fecha Reporte'),
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery|ClientesQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::class, ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery|ProductosQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Productos::class, ['id' => 'producto_id']);
    }

    /**
     * {@inheritdoc}
     * @return SoporteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SoporteQuery(get_called_class());
    }


    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_PENDIENTE => Yii::t('app', 'Pendiente'),
            self::ESTADO_EN_PROCESO => Yii::t('app', 'En proceso'),
            self::ESTADO_RESUELTO => Yii::t('app', 'Resuelto'),
        ];
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
    public function isEstadoPendiente()
    {
        return $this->estado === self::ESTADO_PENDIENTE;
    }

    public function setEstadoToPendiente()
    {
        $this->estado = self::ESTADO_PENDIENTE;
    }

    /**
     * @return bool
     */
    public function isEstadoEnProceso()
    {
        return $this->estado === self::ESTADO_EN_PROCESO;
    }

    public function setEstadoToEnProceso()
    {
        $this->estado = self::ESTADO_EN_PROCESO;
    }

    /**
     * @return bool
     */
    public function isEstadoResuelto()
    {
        return $this->estado === self::ESTADO_RESUELTO;
    }

    public function setEstadoToResuelto()
    {
        $this->estado = self::ESTADO_RESUELTO;
    }
}
