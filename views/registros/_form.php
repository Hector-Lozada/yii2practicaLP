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

<div class="registros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vehiculo_id')->dropDownList(
        ArrayHelper::map(Vehiculos::find()->all(), 'vehiculo_id', function($vehiculo) {
            return $vehiculo->placa . ' - ' . $vehiculo->marca . ' ' . $vehiculo->modelo;
        }),
        ['prompt' => 'Seleccione un vehículo', 'required' => true]
    ) ?>

    <?= $form->field($model, 'espacio_id')->dropDownList(
        ArrayHelper::map(Espacios::find()->all(), 'espacio_id', 'codigo_espacio'),
        ['prompt' => 'Seleccione un espacio', 'required' => true]
    ) ?>

    <?= $form->field($model, 'fecha_entrada')->input('date', [
        'required' => true,
        'placeholder' => 'Seleccione la fecha de entrada',
    ]) ?>

    <?= $form->field($model, 'fecha_salida')->input('date', [
        'required' => true,
        'placeholder' => 'Seleccione la fecha de salida',
    ]) ?>

    <?= $form->field($model, 'metodo_pago')->dropDownList(
        [ 
            'efectivo' => 'Efectivo', 
            'tarjeta' => 'Tarjeta', 
            'app' => 'App', 
            'gratis' => 'Gratis', 
        ],
        ['prompt' => 'Seleccione el método de pago', 'required' => true]
    ) ?>

    <?= $form->field($model, 'monto_pagado')->textInput([
        'maxlength' => true,
        'required' => true,
        'placeholder' => 'Ingrese el monto pagado',
    ]) ?>

    <?= $form->field($model, 'usuario_registra')->dropDownList(
        ArrayHelper::map(Usuarios::find()->all(), 'usuario_id', function($u) {
            return $u->nombre . ' ' . $u->apellido . ' (' . $u->codigo_universitario . ')';
        }),
        ['prompt' => 'Seleccione el usuario que registra', 'required' => true]
    ) ?>

    <?= $form->field($model, 'observaciones')->textarea([
        'rows' => 6,
        'required' => true,
        'placeholder' => 'Ingrese observaciones adicionales si las hay',
    ]) ?>


 <!-- Vista previa de la imagen -->
                    <?php $imageUrl = !empty($model->foto_comprobante_path) ? 
                        Url::base(true).'/'.$model->foto_comprobante_path : 
                        Url::base(true).'/images/default-profile.jpg'; ?>
                    
                    <img id="imagePreview" src="<?= $imageUrl ?>" 
                         class="img-thumbnail mb-3" 
                         style="max-width: 200px; max-height: 200px;">
                    
                    <!-- Campo real para subir archivos -->
                    <?= $form->field($model, 'imageFile', [
                        'template' => '
                            <div class="custom-file">
                                {input}
                                {label}
                                {error}
                            </div>
                        ',
                        'labelOptions' => ['class' => 'custom-file-label'],
                        'inputOptions' => ['class' => 'custom-file-input']
                    ])->fileInput([
                        'accept' => 'image/*',
                        'id' => 'imageUpload'
                    ])->label('Seleccionar imagen', [
                        'class' => 'btn btn-primary'
                    ]) ?>
    <?= $form->field($model, 'foto_comprobante_path')->hiddenInput()->label(false)
 ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
