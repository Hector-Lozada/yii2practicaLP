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
<div class="registros-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Registros'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'registro_id',
            'vehiculo_id',
            'espacio_id',
            'fecha_entrada',
            'fecha_salida',
            'metodo_pago',
            'monto_pagado',
            'usuario_registra',
            'observaciones:ntext',
            'foto_comprobante_path',
            'fecha_actualizacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Registros $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'registro_id' => $model->registro_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
