<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Registros $model */

$this->title = $model->registro_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Registros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registros-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'registro_id' => $model->registro_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'registro_id' => $model->registro_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-4">
            <!-- Mostrar la imagen del comprobante si existe -->
            <?php if (!empty($model->foto_comprobante_path)): ?>
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <?php
                        $imageUrl = Url::to('@web/uploads/registros/' . $model->foto_comprobante_path);
                        ?>
                        <img src="<?= $imageUrl ?>"
                             alt="Comprobante"
                             class="img-fluid rounded mb-3"
                             style="width: 100%; max-width: 300px; object-fit: cover;">
                        <p><?= Html::a('Ver imagen completa', $imageUrl, ['target' => '_blank']) ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-8">
            <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'registro_id',
        [
            'attribute' => 'vehiculo_id',
            'label' => 'Vehículo',
            'value' => $model->vehiculo ? $model->vehiculo->placa . ' - ' . $model->vehiculo->marca : 'No asignado',
        ],
        [
            'attribute' => 'espacio_id',
            'label' => 'Espacio',
            'value' => $model->espacio ? $model->espacio->codigo_espacio : 'No asignado',
        ],
        [
            'attribute' => 'fecha_entrada',
            'format' => ['date', 'php:d-m-Y'],
        ],
        [
            'attribute' => 'fecha_salida',
            'format' => ['date', 'php:d-m-Y'],
        ],
        'metodo_pago',
        'monto_pagado',
        [
    'attribute' => 'usuario_registra',
    'label' => 'Registrado por',
    'value' => $model->usuario
        ? $model->usuario->nombre . ' ' . $model->usuario->apellido . ' (' . $model->usuario->codigo_universitario . ')'
        : 'No registrado',
],

        'observaciones:ntext',
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
