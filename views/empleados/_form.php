<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Empleados $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="empleados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'puesto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_contratacion')->textInput() ?>

    <?= $form->field($model, 'salario')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
