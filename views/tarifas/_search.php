<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TarifasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tarifas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'tarifa_id') ?>

    <?= $form->field($model, 'tipo_usuario') ?>

    <?= $form->field($model, 'tipo_vehiculo') ?>

    <?= $form->field($model, 'tarifa_hora') ?>

    <?= $form->field($model, 'tarifa_dia') ?>

    <?php // echo $form->field($model, 'tarifa_mes') ?>

    <?php // echo $form->field($model, 'vigente_desde') ?>

    <?php // echo $form->field($model, 'vigente_hasta') ?>

    <?php // echo $form->field($model, 'usuario_registra') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'fecha_actualizacion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
