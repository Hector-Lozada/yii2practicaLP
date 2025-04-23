<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id
 * @property string|null $nombre_completo
 * @property string|null $email
 * @property string|null $telefono
 * @property string|null $direccion
 * @property string|null $fecha_registro
 *
 * @property SoporteTecnico[] $soporteTecnicos
 * @property Ventas[] $ventas
 */
class Clientes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_completo', 'email', 'telefono', 'direccion'], 'default', 'value' => null],
            [['direccion'], 'string'],
            [['fecha_registro'], 'safe'],
            [['nombre_completo', 'email'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 20],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre_completo' => Yii::t('app', 'Nombre Completo'),
            'email' => Yii::t('app', 'Email'),
            'telefono' => Yii::t('app', 'Telefono'),
            'direccion' => Yii::t('app', 'Direccion'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
        ];
    }

    /**
     * Gets query for [[SoporteTecnicos]].
     *
     * @return \yii\db\ActiveQuery|SoporteTecnicoQuery
     */
    public function getSoporteTecnicos()
    {
        return $this->hasMany(SoporteTecnico::class, ['cliente_id' => 'id']);
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery|VentasQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::class, ['cliente_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ClientesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientesQuery(get_called_class());
    }

}
