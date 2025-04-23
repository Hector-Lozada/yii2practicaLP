<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Soporte $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="soporte-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cliente_id')->textInput() ?>

    <?= $form->field($model, 'producto_id')->textInput() ?>

    <?= $form->field($model, 'descripcion_problema')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'Pendiente' => 'Pendiente', 'En proceso' => 'En proceso', 'Resuelto' => 'Resuelto', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'fecha_reporte')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
