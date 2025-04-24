<?php

use app\models\Examenes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ExamenesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Examenes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="examenes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Examenes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idexamenes',
            'titulo',
            'curso_id',
            'fecha',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Examenes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idexamenes' => $model->idexamenes]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
