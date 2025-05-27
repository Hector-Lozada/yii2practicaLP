<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Espacios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="espacios-form card shadow p-4 mt-3">

    <div class="mb-4 border-bottom pb-2 d-flex align-items-center">
        <i class="bi bi-geo-alt-fill me-2" style="font-size:2rem;color:#198754;"></i>
        <h3 class="mb-0 ms-2" style="font-weight: 600;">Gestión de Espacios</h3>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'codigo_espacio', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'required' => true,
                    'placeholder' => 'Ej: A-101'
                ]
            ])->label('Código del espacio <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'zona')->dropDownList([
                'A' => 'Zona A',
                'B' => 'Zona B',
                'C' => 'Zona C',
                'D' => 'Zona D',
                'discapacitados' => 'Discapacitados',
                'visitantes' => 'Visitantes'
            ], [
                'prompt' => 'Seleccione una zona',
                'required' => true,
                'class' => 'form-select'
            ])->label('Zona <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'tipo_vehiculo')->dropDownList([
                'automovil' => 'Automóvil',
                'motocicleta' => 'Motocicleta',
                'carga' => 'Vehículo de carga'
            ], [
                'prompt' => 'Seleccione tipo de vehículo',
                'required' => true,
                'class' => 'form-select'
            ])->label('Tipo de vehículo <span style="color:red">*</span>') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'estado')->dropDownList([
                'disponible' => 'Disponible',
                'ocupado' => 'Ocupado',
                'mantenimiento' => 'En mantenimiento'
            ], [
                'prompt' => 'Seleccione estado',
                'required' => true,
                'class' => 'form-select'
            ])->label('Estado <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'ubicacion_gps', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'required' => true,
                    'placeholder' => 'Ej: -2.170998, -79.922356',
                    'id' => 'espacios-ubicacion_gps'
                ]
            ])->label('Ubicación GPS <span style="color:red">*</span>') ?>
            <small class="text-muted">Formato: <b>latitud, longitud</b> (ejemplo: -2.170998, -79.922356)</small>
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
.espacios-form .form-select,
.espacios-form .form-control {
    border-radius: .5rem;
    box-shadow: none;
}
.espacios-form label {
    font-weight: 500;
}
.espacios-form .form-group {
    margin-bottom: 1.2rem;
}
</style>

<script>
// Validación básica de coordenadas GPS
document.querySelector('form').addEventListener('submit', function(e) {
    const gpsInput = document.getElementById('espacios-ubicacion_gps');
    const gpsValue = gpsInput.value.trim();

    // Expresión regular para validar coordenadas simples
    const gpsRegex = /^-?\d{1,3}\.\d+,\s*-?\d{1,3}\.\d+$/;

    if (gpsValue && !gpsRegex.test(gpsValue)) {
        alert('Por favor ingrese coordenadas válidas en formato: latitud, longitud');
        gpsInput.focus();
        e.preventDefault();
    }
});
</script>