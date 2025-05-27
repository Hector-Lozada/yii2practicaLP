<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Espacios $model */

$this->title = $model->espacio_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Espacios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="espacios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'espacio_id' => $model->espacio_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'espacio_id' => $model->espacio_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'espacio_id',
            'codigo_espacio',
            'zona',
            'tipo_vehiculo',
            'estado',
            'ubicacion_gps',
            'fecha_creacion',
            'fecha_actualizacion',
        ],
    ]) ?>

</div>
