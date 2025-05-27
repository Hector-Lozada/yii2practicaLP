<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;
/** @var yii\web\View $this */
/** @var app\models\Tarifas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tarifas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_usuario', [
        'inputOptions' => ['required' => true]
    ])->dropDownList([
        'estudiante' => 'Estudiante',
        'profesor' => 'Profesor',
        'administrativo' => 'Administrativo',
        'visitante' => 'Visitante',
    ], ['prompt' => 'Seleccione el tipo de usuario']) ?>

    <?= $form->field($model, 'tipo_vehiculo', [
        'inputOptions' => ['required' => true]
    ])->dropDownList([
        'automovil' => 'Automóvil',
        'motocicleta' => 'Motocicleta',
        'discapacitados' => 'Discapacitados',
        'carga' => 'Carga',
    ], ['prompt' => 'Seleccione el tipo de vehículo']) ?>

    <?= $form->field($model, 'tarifa_hora')->textInput([
        'maxlength' => true,
        'placeholder' => 'Ingrese la tarifa por hora',
        'required' => true
    ]) ?>

    <?= $form->field($model, 'tarifa_dia')->textInput([
        'maxlength' => true,
        'placeholder' => 'Ingrese la tarifa por día',
        'required' => true
    ]) ?>

    <?= $form->field($model, 'tarifa_mes')->textInput([
        'maxlength' => true,
        'placeholder' => 'Ingrese la tarifa por mes',
        'required' => true
    ]) ?>

    <?= $form->field($model, 'vigente_desde')->input('date', [
        'required' => true
    ]) ?>

    <?= $form->field($model, 'vigente_hasta')->input('date', [
        'required' => true
    ]) ?>

    <?= $form->field($model, 'usuario_registra')->dropDownList(
        ArrayHelper::map(Usuarios::find()->all(), 'usuario_id', function($u) {
            return $u->nombre . ' ' . $u->apellido . ' (' . $u->codigo_universitario . ')';
        }),
        ['prompt' => 'Seleccione el usuario que registra', 'required' => true]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
