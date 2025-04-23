<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ventas".
 *
 * @property int $id
 * @property int|null $cliente_id
 * @property int|null $producto_id
 * @property int|null $empleado_id
 * @property string|null $fecha_venta
 * @property int|null $cantidad
 * @property float|null $total
 *
 * @property Clientes $cliente
 * @property Empleados $empleado
 * @property Productos $producto
 */
class Ventas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ventas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'producto_id', 'empleado_id', 'cantidad', 'total'], 'default', 'value' => null],
            [['cliente_id', 'producto_id', 'empleado_id', 'cantidad'], 'integer'],
            [['fecha_venta'], 'safe'],
            [['total'], 'number'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::class, 'targetAttribute' => ['cliente_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['producto_id' => 'id']],
            [['empleado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empleados::class, 'targetAttribute' => ['empleado_id' => 'id']],
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
            'empleado_id' => Yii::t('app', 'Empleado ID'),
            'fecha_venta' => Yii::t('app', 'Fecha Venta'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'total' => Yii::t('app', 'Total'),
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
     * Gets query for [[Empleado]].
     *
     * @return \yii\db\ActiveQuery|EmpleadosQuery
     */
    public function getEmpleado()
    {
        return $this->hasOne(Empleados::class, ['id' => 'empleado_id']);
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
     * @return VentasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VentasQuery(get_called_class());
    }

}
