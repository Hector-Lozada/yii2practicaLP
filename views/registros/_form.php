<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Vehiculos;
use app\models\Espacios;
use app\models\Usuarios;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var app\models\Registros $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="registros-form card shadow p-4 mt-3">

    <div class="mb-4 border-bottom pb-2 d-flex align-items-center">
        <i class="bi bi-journal-check me-2" style="font-size:2rem;color:#0d6efd;"></i>
        <h3 class="mb-0 ms-2" style="font-weight: 600;">Gestión de Registros</h3>
    </div>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'vehiculo_id')->dropDownList(
                ArrayHelper::map(Vehiculos::find()->all(), 'vehiculo_id', function($vehiculo) {
                    return $vehiculo->placa . ' - ' . $vehiculo->marca . ' ' . $vehiculo->modelo;
                }),
                [
                    'prompt' => 'Seleccione un vehículo',
                    'required' => true,
                    'class' => 'form-select'
                ]
            )->label('Vehículo <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'espacio_id')->dropDownList(
                ArrayHelper::map(Espacios::find()->all(), 'espacio_id', 'codigo_espacio'),
                [
                    'prompt' => 'Seleccione un espacio',
                    'required' => true,
                    'class' => 'form-select'
                ]
            )->label('Espacio <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'fecha_entrada')->input('date', [
                'required' => true,
                'class' => 'form-control',
                'placeholder' => 'Seleccione la fecha de entrada'
            ])->label('Fecha de entrada <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'fecha_salida')->input('date', [
                'required' => true,
                'class' => 'form-control',
                'placeholder' => 'Seleccione la fecha de salida'
            ])->label('Fecha de salida <span style="color:red">*</span>') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'metodo_pago')->dropDownList(
                [
                    'efectivo' => 'Efectivo',
                    'tarjeta' => 'Tarjeta',
                    'app' => 'App',
                    'gratis' => 'Gratis',
                ],
                [
                    'prompt' => 'Seleccione el método de pago',
                    'required' => true,
                    'class' => 'form-select'
                ]
            )->label('Método de pago <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'monto_pagado', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'required' => true,
                    'placeholder' => 'Ingrese el monto pagado'
                ]
            ])->label('Monto pagado <span style="color:red">*</span>') ?>

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

            <?= $form->field($model, 'observaciones')->textarea([
                'rows' => 6,
                'required' => true,
                'class' => 'form-control',
                'placeholder' => 'Ingrese observaciones adicionales si las hay'
            ])->label('Observaciones <span style="color:red">*</span>') ?>

            <?php
            $imageUrl = !empty($model->foto_comprobante_path)
                ? Url::base(true) . '/' . $model->foto_comprobante_path
                : Url::base(true) . '/images/default-profile.jpg';
            ?>
            <div class="form-group mb-3">
                <label class="fw-bold">Comprobante</label>
                <div>
                    <img id="imagePreview" src="<?= $imageUrl ?>"
                         class="img-thumbnail mb-3"
                         style="max-width: 200px; max-height: 200px; border-radius: 0.5rem; border:1px solid #ccc;">
                </div>
            </div>
            <?= $form->field($model, 'imageFile', [
                'template' => '
                    <div class="custom-file">
                        {input}
                        {label}
                        {error}
                    </div>
                ',
                'labelOptions' => ['class' => 'custom-file-label'],
                'inputOptions' => [
                    'class' => 'custom-file-input',
                    'accept' => 'image/*',
                    'id' => 'imageUpload',
                    'onchange' => 'previewImage(this)'
                ]
            ])->fileInput()->label('Seleccionar imagen', ['class' => 'btn btn-primary']) ?>

            <?= $form->field($model, 'foto_comprobante_path')->hiddenInput()->label(false) ?>
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
.registros-form .form-select,
.registros-form .form-control {
    border-radius: .5rem;
    box-shadow: none;
}
.registros-form label {
    font-weight: 500;
}
.registros-form .form-group {
    margin-bottom: 1.2rem;
}
</style>

<script>
function previewImage(input) {
    var preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>