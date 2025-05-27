<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;
/** @var yii\web\View $this */
/** @var app\models\Tarifas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tarifas-form card shadow p-4 mt-3">

    <div class="mb-4 border-bottom pb-2 d-flex align-items-center">
        <i class="bi bi-currency-dollar me-2" style="font-size:2rem;color:#28a745;"></i>
        <h3 class="mb-0 ms-2" style="font-weight: 600;">Gestión de Tarifas</h3>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tipo_usuario')->dropDownList([
                'estudiante' => 'Estudiante',
                'profesor' => 'Profesor',
                'administrativo' => 'Administrativo',
                'visitante' => 'Visitante',
            ], [
                'prompt' => 'Seleccione el tipo de usuario',
                'required' => true,
                'class' => 'form-select'
            ])->label('Tipo de usuario <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'tipo_vehiculo')->dropDownList([
                'automovil' => 'Automóvil',
                'motocicleta' => 'Motocicleta',
                'discapacitados' => 'Discapacitados',
                'carga' => 'Carga',
            ], [
                'prompt' => 'Seleccione el tipo de vehículo',
                'required' => true,
                'class' => 'form-select'
            ])->label('Tipo de vehículo <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'tarifa_hora', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'placeholder' => 'Ingrese la tarifa por hora',
                    'required' => true
                ]
            ])->label('Tarifa por hora <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'tarifa_dia', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'placeholder' => 'Ingrese la tarifa por día',
                    'required' => true
                ]
            ])->label('Tarifa por día <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'tarifa_mes', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'placeholder' => 'Ingrese la tarifa por mes',
                    'required' => true
                ]
            ])->label('Tarifa por mes <span style="color:red">*</span>') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'vigente_desde')->input('date', [
                'required' => true,
                'class' => 'form-control'
            ])->label('Vigente desde <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'vigente_hasta')->input('date', [
                'required' => true,
                'class' => 'form-control'
            ])->label('Vigente hasta <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'usuario_registra')->dropDownList(
                ArrayHelper::map(Usuarios::find()->all(), 'usuario_id', function($u) {
                    return $u->nombre . ' ' . $u->apellido . ' (' . $u->codigo_universitario . ')';
                }),
                [
                    'prompt' => 'Seleccione el usuario que registra',
                    'required' => true,
                    'class' => 'form-select'
                ]
            )->label('Usuario que registra <span style="color:red">*</span>') ?>
        </div>
    </div>

    <div class="form-group mt-4 text-center">
        <?= Html::submitButton('<i class="bi bi-save2"></i> ' . Yii::t('app', 'Guardar'), [
            'class' => 'btn btn-success btn-lg px-5 shadow'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
.tarifas-form .form-select,
.tarifas-form .form-control {
    border-radius: .5rem;
    box-shadow: none;
}
.tarifas-form label {
    font-weight: 500;
}
.tarifas-form .form-group {
    margin-bottom: 1.2rem;
}
</style>