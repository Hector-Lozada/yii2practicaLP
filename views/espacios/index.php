<?php

use app\models\Espacios;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EspaciosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Espacios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="espacios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Espacios'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'espacio_id',
            'codigo_espacio',
            'zona',
            'tipo_vehiculo',
            'estado',
            //'ubicacion_gps',
            //'fecha_creacion',
            //'fecha_actualizacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Espacios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'espacio_id' => $model->espacio_id]);
                 }
            ],
        ],
    ]); ?>


</div>
