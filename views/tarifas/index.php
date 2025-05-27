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
<div class="tarifas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tarifas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tarifa_id',
            'tipo_usuario',
            'tipo_vehiculo',
            'tarifa_hora',
            'tarifa_dia',
            'tarifa_mes',
            'vigente_desde',
            'vigente_hasta',
            'usuario_registra',
            'fecha_registro',
            'fecha_actualizacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tarifas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'tarifa_id' => $model->tarifa_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
