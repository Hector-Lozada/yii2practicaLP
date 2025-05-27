<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\EspaciosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="espacios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'espacio_id') ?>

    <?= $form->field($model, 'codigo_espacio') ?>

    <?= $form->field($model, 'zona') ?>

    <?= $form->field($model, 'tipo_vehiculo') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'ubicacion_gps') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'fecha_actualizacion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
