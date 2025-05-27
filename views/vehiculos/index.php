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

$this->title = Yii::t('app', 'Vehiculos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehiculos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Vehiculos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        
        'vehiculo_id',
        [
            'attribute' => 'foto_vehiculo_path',
            'label' => 'Foto',
            'format' => 'html',
            'value' => function ($model) {
                $url = $model->foto_vehiculo_path 
                    ? Url::to('@web/uploads/vehicles/' . $model->foto_vehiculo_path) 
                    : Url::to('@web/images/default-car.png');
                return Html::img($url, ['style' => 'width:80px; height:auto;']);
            },
        ],
        [
            'attribute' => 'usuario_id',
            'label' => 'Usuario',
            'value' => function ($model) {
                return $model->usuario->nombre . ' ' . $model->usuario->apellido . ' (' . $model->usuario->codigo_universitario . ')';
            },
        ],
        'placa',
        'marca',
        'modelo',
        'color',
        'tipo',
        [
            'attribute' => 'autorizado',
            'value' => function ($model) {
                return $model->autorizado ? 'Sí' : 'No';
            },
        ],
        [
            'attribute' => 'fecha_registro',
            'format' => ['date', 'php:d-m-Y'],
        ],
        [
            'attribute' => 'fecha_actualizacion',
            'format' => ['date', 'php:d-m-Y'],
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Vehiculos $model, $key, $index, $column) {
                return Url::toRoute([$action, 'vehiculo_id' => $model->vehiculo_id]);
            }
        ],
    ],
]); ?>


    <?php Pjax::end(); ?>

</div>
