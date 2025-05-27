<?php

use app\models\Vehiculos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\VehiculosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Vehículos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehiculos-index card shadow p-4 mt-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
        <?= Html::a('<i class="bi bi-plus-circle"></i> ' . Yii::t('app', 'Nuevo Vehículo'), ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'foto_vehiculo_path',
                'label' => 'Foto',
                'format' => 'html',
                'value' => function ($model) {
                    $ruta = $model->foto_vehiculo_path 
                        ? Yii::getAlias('@web/uploads/vehicles/' . $model->foto_vehiculo_path)
                        : Yii::getAlias('@web/images/default-car.png');
                    return Html::img($ruta, [
                        'class' => 'rounded shadow',
                        'style' => 'width:60px; height:45px; object-fit:cover; border:2px solid #00723A; background:#fff;',
                        'alt' => 'Foto vehículo'
                    ]);
                },
                'contentOptions' => ['style' => 'text-align:center;'],
                'headerOptions' => ['style' => 'width:70px; text-align:center;'],
                'filter' => false
            ],
            [
                'attribute' => 'usuario_id',
                'label' => 'Usuario',
                'value' => function ($model) {
                    return $model->usuario 
                        ? $model->usuario->nombre . ' ' . $model->usuario->apellido . ' (' . $model->usuario->codigo_universitario . ')'
                        : '(Sin usuario)';
                },
            ],
            'placa',
            'marca',
            'modelo',
            'color',
            [
                'attribute' => 'tipo',
                'filter' => [
                    'Automóvil' => 'Automóvil',
                    'Motocicleta' => 'Motocicleta',
                    'Camioneta' => 'Camioneta',
                    'Otro' => 'Otro',
                ],
            ],
            [
                'attribute' => 'autorizado',
                'format' => 'html',
                'filter' => [1 => 'Sí', 0 => 'No'],
                'value' => function ($model) {
                    return $model->autorizado
                        ? '<span class="badge bg-success">Sí</span>'
                        : '<span class="badge bg-danger">No</span>';
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
                'label' => 'Fecha actualización',
                'value' => function($model) {
                    return $model->fecha_actualizacion ? Yii::$app->formatter->asDate($model->fecha_actualizacion) : '';
                },
                'filter' => false
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Vehiculos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'vehiculo_id' => $model->vehiculo_id]);
                }
            ],
        ],
        'summary' => 'Mostrando <b>{begin}-{end}</b> de <b>{totalCount}</b> vehículos',
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class,
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<style>
.vehiculos-index .table th, .vehiculos-index .table td {
    vertical-align: middle;
}
</style>