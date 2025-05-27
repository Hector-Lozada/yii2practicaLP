<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RegistrosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="registros-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'registro_id') ?>

    <?= $form->field($model, 'vehiculo_id') ?>

    <?= $form->field($model, 'espacio_id') ?>

    <?= $form->field($model, 'fecha_entrada') ?>

    <?= $form->field($model, 'fecha_salida') ?>

    <?php // echo $form->field($model, 'metodo_pago') ?>

    <?php // echo $form->field($model, 'monto_pagado') ?>

    <?php // echo $form->field($model, 'usuario_registra') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <?php // echo $form->field($model, 'foto_comprobante_path') ?>

    <?php // echo $form->field($model, 'fecha_actualizacion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
