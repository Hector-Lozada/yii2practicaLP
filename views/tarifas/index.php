<?php

use app\models\Tarifas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\TarifasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tarifas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarifas-index card shadow p-4 mt-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">
            <i class="bi bi-currency-dollar me-2" style="font-size:2rem;color:#28a745;"></i>
            <?= Html::encode($this->title) ?>
        </h2>
        <?= Html::a('<i class="bi bi-plus-circle"></i> ' . Yii::t('app', 'Nueva Tarifa'), ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'tarifa_id', // Oculte el ID si no es necesario mostrarlo

            [
                'attribute' => 'tipo_usuario',
                'label' => 'Tipo Usuario',
                'filter' => [
                    'estudiante' => 'Estudiante',
                    'profesor' => 'Profesor',
                    'administrativo' => 'Administrativo',
                    'visitante' => 'Visitante'
                ],
                'value' => function($model) {
                    $tipos = [
                        'estudiante' => 'Estudiante',
                        'profesor' => 'Profesor',
                        'administrativo' => 'Administrativo',
                        'visitante' => 'Visitante'
                    ];
                    return $tipos[$model->tipo_usuario] ?? $model->tipo_usuario;
                }
            ],
            [
                'attribute' => 'tipo_vehiculo',
                'label' => 'Tipo Vehículo',
                'filter' => [
                    'automovil' => 'Automóvil',
                    'motocicleta' => 'Motocicleta',
                    'carga' => 'Vehículo de carga'
                ],
                'value' => function($model) {
                    $tipos = [
                        'automovil' => 'Automóvil',
                        'motocicleta' => 'Motocicleta',
                        'carga' => 'Vehículo de carga'
                    ];
                    return $tipos[$model->tipo_vehiculo] ?? $model->tipo_vehiculo;
                }
            ],
            [
                'attribute' => 'tarifa_hora',
                'label' => 'Tarifa x Hora',
                'value' => function($model) {
                    return '$' . number_format($model->tarifa_hora, 2);
                }
            ],
            [
                'attribute' => 'tarifa_dia',
                'label' => 'Tarifa x Día',
                'value' => function($model) {
                    return '$' . number_format($model->tarifa_dia, 2);
                }
            ],
            [
                'attribute' => 'tarifa_mes',
                'label' => 'Tarifa x Mes',
                'value' => function($model) {
                    return '$' . number_format($model->tarifa_mes, 2);
                }
            ],
            [
                'attribute' => 'vigente_desde',
                'label' => 'Vigente desde',
                'value' => function($model) {
                    return $model->vigente_desde ? Yii::$app->formatter->asDate($model->vigente_desde) : '';
                },
                'filter' => false
            ],
            [
                'attribute' => 'vigente_hasta',
                'label' => 'Vigente hasta',
                'value' => function($model) {
                    return $model->vigente_hasta ? Yii::$app->formatter->asDate($model->vigente_hasta) : '';
                },
                'filter' => false
            ],
            [
                'attribute' => 'usuario_registra',
                'label' => 'Creado por',
                'value' => function($model) {
                    return $model->usuario_registra ?? '-';
                }
            ],
            [
                'attribute' => 'fecha_registro',
                'label' => 'Fecha registro',
                'value' => function($model) {
                    return $model->fecha_registro ? Yii::$app->formatter->asDate($model->fecha_registro) : '';
                },
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
                'urlCreator' => function ($action, Tarifas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'tarifa_id' => $model->tarifa_id]);
                }
            ],
        ],
        'summary' => 'Mostrando <b>{begin}-{end}</b> de <b>{totalCount}</b> tarifas',
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class,
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<style>
.tarifas-index .table th, .tarifas-index .table td {
    vertical-align: middle;
}
.tarifas-index .badge {
    font-size: 1em;
    padding: .5em 1em;
    border-radius: .5rem;
    font-weight: 500;
}
.tarifas-index .fw-bold {
    letter-spacing: 1px;
}
</style>