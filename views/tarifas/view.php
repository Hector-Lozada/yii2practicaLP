<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tarifas $model */

$this->title = $model->tarifa_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarifas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tarifas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'tarifa_id' => $model->tarifa_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'tarifa_id' => $model->tarifa_id], [
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
        ],
    ]) ?>

</div>
