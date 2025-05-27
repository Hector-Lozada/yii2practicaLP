<?php

use app\models\Espacios;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\EspaciosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Espacios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="espacios-index card shadow p-4 mt-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">
            <i class="bi bi-geo-alt-fill me-2" style="font-size:2rem;color:#198754;"></i>
            <?= Html::encode($this->title) ?>
        </h2>
        <?= Html::a('<i class="bi bi-plus-circle"></i> ' . Yii::t('app', 'Nuevo Espacio'), ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'espacio_id', // Puedes ocultar el ID si no lo necesitas a la vista
            [
                'attribute' => 'codigo_espacio',
                'label' => 'Código',
            ],
            [
                'attribute' => 'zona',
                'label' => 'Zona',
                'filter' => [
                    'A' => 'Zona A',
                    'B' => 'Zona B',
                    'C' => 'Zona C',
                    'D' => 'Zona D',
                    'discapacitados' => 'Discapacitados',
                    'visitantes' => 'Visitantes'
                ],
                'value' => function($model) {
                    $zonas = [
                        'A' => 'Zona A',
                        'B' => 'Zona B',
                        'C' => 'Zona C',
                        'D' => 'Zona D',
                        'discapacitados' => 'Discapacitados',
                        'visitantes' => 'Visitantes'
                    ];
                    return $zonas[$model->zona] ?? $model->zona;
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
                'attribute' => 'estado',
                'format' => 'html',
                'filter' => [
                    'disponible' => 'Disponible',
                    'ocupado' => 'Ocupado',
                    'mantenimiento' => 'En mantenimiento'
                ],
                'value' => function($model) {
                    switch($model->estado) {
                        case 'disponible':
                            return '<span class="badge bg-success">Disponible</span>';
                        case 'ocupado':
                            return '<span class="badge bg-danger">Ocupado</span>';
                        case 'mantenimiento':
                            return '<span class="badge bg-warning text-dark">En mantenimiento</span>';
                        default:
                            return Html::encode($model->estado);
                    }
                }
            ],
            [
                'attribute' => 'ubicacion_gps',
                'label' => 'Ubicación GPS',
                'value' => function($model) {
                    return Html::tag('span', Html::encode($model->ubicacion_gps), [
                        'class' => 'fw-bold text-secondary',
                        'title' => 'Latitud, Longitud'
                    ]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'fecha_creacion',
                'label' => 'Creación',
                'value' => function($model) {
                    return $model->fecha_creacion ? Yii::$app->formatter->asDate($model->fecha_creacion) : '';
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
                'urlCreator' => function ($action, Espacios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'espacio_id' => $model->espacio_id]);
                }
            ],
        ],
        'summary' => 'Mostrando <b>{begin}-{end}</b> de <b>{totalCount}</b> espacios',
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class,
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<style>
.espacios-index .table th, .espacios-index .table td {
    vertical-align: middle;
}
.espacios-index .badge {
    font-size: 1em;
    padding: .5em 1em;
    border-radius: .5rem;
    font-weight: 500;
}
.espacios-index .fw-bold {
    letter-spacing: 1px;
}
</style>