<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleados".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $puesto
 * @property string|null $departamento
 * @property string|null $fecha_contratacion
 * @property float|null $salario
 *
 * @property Ventas[] $ventas
 */
class Empleados extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'puesto', 'departamento', 'fecha_contratacion', 'salario'], 'default', 'value' => null],
            [['fecha_contratacion'], 'safe'],
            [['salario'], 'number'],
            [['nombre'], 'string', 'max' => 100],
            [['puesto', 'departamento'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'puesto' => Yii::t('app', 'Puesto'),
            'departamento' => Yii::t('app', 'Departamento'),
            'fecha_contratacion' => Yii::t('app', 'Fecha Contratacion'),
            'salario' => Yii::t('app', 'Salario'),
        ];
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery|VentasQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::class, ['empleado_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return EmpleadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmpleadosQuery(get_called_class());
    }

}
