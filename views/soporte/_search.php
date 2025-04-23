<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SoporteSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="soporte-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cliente_id') ?>

    <?= $form->field($model, 'producto_id') ?>

    <?= $form->field($model, 'descripcion_problema') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'fecha_reporte') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
