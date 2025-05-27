<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Vehiculos $model */

$this->title = 'Vehículo #' . $model->vehiculo_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vehiculos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vehiculos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'vehiculo_id' => $model->vehiculo_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'vehiculo_id' => $model->vehiculo_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que quieres eliminar este vehículo?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-4">
            <!-- Tarjeta con la imagen del vehículo -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <?php 
                    $imageUrl = $model->foto_vehiculo_path 
                        ? Url::to('@web/uploads/vehicles/' . $model->foto_vehiculo_path) 
                        : Url::to('@web/images/default-car.png'); // imagen por defecto opcional
                    ?>
                    <img src="<?= $imageUrl ?>" 
                         class="img-fluid mb-3 rounded" 
                         alt="Foto del vehículo"
                         style="width: 100%; max-width: 300px; object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'vehiculo_id',
                    [
            'label' => 'Usuario',
            'value' => $model->usuario->nombre . ' ' . $model->usuario->apellido . ' (' . $model->usuario->codigo_universitario . ')',
        ],
                    'placa',
                    'marca',
                    'modelo',
                    'color',
                    'tipo',
                    'autorizado',
                    [
                        'attribute' => 'fecha_registro',
                        'format' => ['date', 'php:d-m-Y'],
                    ],
                    [
                        'attribute' => 'fecha_actualizacion',
                        'format' => ['date', 'php:d-m-Y'],
                    ],
                ],
                'options' => ['class' => 'table table-striped table-bordered detail-view'],
            ]) ?>
        </div>
    </div>

</div>
