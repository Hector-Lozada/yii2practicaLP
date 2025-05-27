<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Espacios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="espacios-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'codigo_espacio')->textInput([
                'maxlength' => true,
                'required' => true,
                'placeholder' => 'Ej: A-101'
            ]) ?>

            <?= $form->field($model, 'zona')->dropDownList([
                'A' => 'Zona A', 
                'B' => 'Zona B', 
                'C' => 'Zona C', 
                'D' => 'Zona D', 
                'discapacitados' => 'Discapacitados', 
                'visitantes' => 'Visitantes'
            ], [
                'prompt' => 'Seleccione una zona',
                'required' => true
            ]) ?>

            <?= $form->field($model, 'tipo_vehiculo')->dropDownList([
                'automovil' => 'Automóvil', 
                'motocicleta' => 'Motocicleta', 
                'carga' => 'Vehículo de carga'
            ], [
                'prompt' => 'Seleccione tipo de vehículo',
                'required' => true
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'estado')->dropDownList([
                'disponible' => 'Disponible', 
                'ocupado' => 'Ocupado', 
                'mantenimiento' => 'En mantenimiento'
            ], [
                'prompt' => 'Seleccione estado',
                'required' => true
            ]) ?>

            <?= $form->field($model, 'ubicacion_gps')->textInput([
                'maxlength' => true,
                'required' => true,
                'placeholder' => 'Ej: -2.170998, -79.922356'
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), [
            'class' => 'btn btn-success btn-lg',
            'style' => 'width: 100%;'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

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