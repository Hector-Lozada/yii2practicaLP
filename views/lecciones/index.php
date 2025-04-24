<?php

use app\models\Lecciones;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\LeccionesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Lecciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lecciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Lecciones'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idlecciones',
            'titulo',
            'contenido:ntext',
            'curso_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Lecciones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idlecciones' => $model->idlecciones]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
