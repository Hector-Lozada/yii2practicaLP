<?php

use app\models\Registros;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\RegistrosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Registros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registros-index card shadow p-4 mt-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">
            <i class="bi bi-journal-check me-2" style="font-size:2rem;color:#0d6efd;"></i>
            <?= Html::encode($this->title) ?>
        </h2>
        <?= Html::a('<i class="bi bi-plus-circle"></i> ' . Yii::t('app', 'Nuevo Registro'), ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'registro_id', // Puedes ocultar si no lo necesitas
            [
                'attribute' => 'vehiculo_id',
                'label' => 'Vehículo',
                'value' => function($model) {
                    return $model->vehiculo ? $model->vehiculo->placa . ' (' . $model->vehiculo->marca . ')' : '-';
                },
            ],
            [
                'attribute' => 'espacio_id',
                'label' => 'Espacio',
                'value' => function($model) {
                    return $model->espacio ? $model->espacio->codigo_espacio : '-';
                },
            ],
            [
                'attribute' => 'fecha_entrada',
                'label' => 'Entrada',
                'value' => function($model) {
                    return $model->fecha_entrada ? Yii::$app->formatter->asDatetime($model->fecha_entrada, 'php:d-m-Y H:i') : '';
                },
                'filter' => false
            ],
            [
                'attribute' => 'fecha_salida',
                'label' => 'Salida',
                'value' => function($model) {
                    return $model->fecha_salida ? Yii::$app->formatter->asDatetime($model->fecha_salida, 'php:d-m-Y H:i') : '';
                },
                'filter' => false
            ],
            [
                'attribute' => 'metodo_pago',
                'label' => 'Método de Pago',
                'filter' => [
                    'efectivo' => 'Efectivo',
                    'tarjeta' => 'Tarjeta',
                    'transferencia' => 'Transferencia',
                    '' => 'Sin pago'
                ],
                'value' => function($model) {
                    $metodos = [
                        'efectivo' => 'Efectivo',
                        'tarjeta' => 'Tarjeta',
                        'transferencia' => 'Transferencia',
                        '' => 'Sin pago'
                    ];
                    return $metodos[$model->metodo_pago] ?? 'Sin pago';
                }
            ],
            [
                'attribute' => 'monto_pagado',
                'label' => 'Monto Pagado',
                'value' => function($model) {
                    return $model->monto_pagado ? '$' . number_format($model->monto_pagado, 2) : '-';
                }
            ],
            [
                'attribute' => 'usuario_registra',
                'label' => 'Usuario Registra',
                'value' => function($model) {
                    return $model->usuario_registra ?? '-';
                }
            ],
            [
                'attribute' => 'observaciones',
                'format' => 'ntext',
                'label' => 'Observaciones',
                'contentOptions' => ['style'=>'max-width:150px; white-space:pre-line;']
            ],
            [
                'attribute' => 'foto_comprobante_path',
                'label' => 'Comprobante',
                'format' => 'html',
                'value' => function($model) {
                    if ($model->foto_comprobante_path && file_exists(Yii::getAlias('@webroot/'.$model->foto_comprobante_path))) {
                        return Html::a(
                            Html::img(Yii::getAlias('@web/'.$model->foto_comprobante_path), [
                                'style' => 'width:40px; height:40px; object-fit:cover; border-radius:6px; border:1px solid #ccc;',
                                'alt' => 'Comprobante'
                            ]),
                            Yii::getAlias('@web/'.$model->foto_comprobante_path),
                            ['target' => '_blank', 'title' => 'Ver comprobante']
                        );
                    }
                    return '<span class="text-muted">-</span>';
                },
                'contentOptions' => ['style' => 'text-align:center;'],
                'headerOptions' => ['style' => 'width:60px; text-align:center;'],
                'filter' => false
            ],
            [
                'attribute' => 'fecha_actualizacion',
                'label' => 'Actualización',
                'value' => function($model) {
                    return $model->fecha_actualizacion ? Yii::$app->formatter->asDate($model->fecha_actualizacion) : '';
                },
                'filter' => false
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Registros $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'registro_id' => $model->registro_id]);
                }
            ],
        ],
        'summary' => 'Mostrando <b>{begin}-{end}</b> de <b>{totalCount}</b> registros',
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class,
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<style>
.registros-index .table th, .registros-index .table td {
    vertical-align: middle;
}
.registros-index .badge {
    font-size: 1em;
    padding: .5em 1em;
    border-radius: .5rem;
    font-weight: 500;
}
.registros-index .fw-bold {
    letter-spacing: 1px;
}
</style>