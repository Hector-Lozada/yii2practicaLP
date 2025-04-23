<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Ventas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ventas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cliente_id')->textInput() ?>

    <?= $form->field($model, 'producto_id')->textInput() ?>

    <?= $form->field($model, 'empleado_id')->textInput() ?>

    <?= $form->field($model, 'fecha_venta')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
