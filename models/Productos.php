<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $categoria
 * @property float|null $precio
 * @property int|null $stock
 * @property string|null $fecha_lanzamiento
 *
 * @property SoporteTecnico[] $soporteTecnicos
 * @property Ventas[] $ventas
 */
class Productos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria', 'precio', 'stock', 'fecha_lanzamiento'], 'default', 'value' => null],
            [['nombre'], 'required'],
            [['precio'], 'number'],
            [['stock'], 'integer'],
            [['fecha_lanzamiento'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['categoria'], 'string', 'max' => 50],
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
            'categoria' => Yii::t('app', 'Categoria'),
            'precio' => Yii::t('app', 'Precio'),
            'stock' => Yii::t('app', 'Stock'),
            'fecha_lanzamiento' => Yii::t('app', 'Fecha Lanzamiento'),
        ];
    }

    /**
     * Gets query for [[SoporteTecnicos]].
     *
     * @return \yii\db\ActiveQuery|SoporteTecnicoQuery
     */
    public function getSoporteTecnicos()
    {
        return $this->hasMany(SoporteTecnico::class, ['producto_id' => 'id']);
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery|VentasQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::class, ['producto_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductosQuery(get_called_class());
    }

}
