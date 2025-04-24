<?php

use app\models\Resultados;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ResultadosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Resultados');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resultados-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Resultados'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idresultados',
            'usuario_id',
            'examen_id',
            'puntuacion',
            'fecha',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Resultados $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idresultados' => $model->idresultados]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
