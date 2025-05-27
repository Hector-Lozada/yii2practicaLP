<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'] // Necesario para subir archivos
    ]); ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'codigo_universitario')->textInput([
    'maxlength' => true,
    'placeholder' => 'Ej: 2023001',
    'required' => true
]) ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'nombre')->textInput([
    'maxlength' => true,
    'placeholder' => 'Nombre(s)',
    'required' => true
]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'apellido')->textInput([
    'maxlength' => true,
    'placeholder' => 'Apellido(s)',
    'required' => true
]) ?>
                </div>
            </div>

            <?= $form->field($model, 'tipo')->dropDownList([
                'estudiante' => 'Estudiante', 
                'profesor' => 'Profesor', 
                'administrativo' => 'Administrativo', 
                'visitante' => 'Visitante'
            ], [
                'prompt' => 'Seleccione un tipo',
                'class' => 'form-select',
                'required' => true
            ]) ?>

            <?= $form->field($model, 'email')->textInput([
                'maxlength' => true,
                'type' => 'email',
                'placeholder' => 'ejemplo@universidad.edu',
                'required' => true
            ]) ?>

            <?= $form->field($model, 'telefono')->textInput([
                'maxlength' => true,
                'placeholder' => 'Formato: 555-1234567',
                'required' => true
            ]) ?>

            <?= $form->field($model, 'activo')->checkbox([
                'label' => 'Usuario activo',
                'uncheck' => 0,
                'checked' => ($model->isNewRecord) ? true : $model->activo,
                'required' => true
            ]) ?>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <!-- Vista previa de la imagen -->
                    <?php $imageUrl = !empty($model->foto_perfil_path) ? 
                        Url::base(true).'/'.$model->foto_perfil_path : 
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
    'id' => 'imageUpload',
    'required' => true
                    ])->label('Seleccionar imagen', [
                        'class' => 'btn btn-primary'
                    ]) ?>
                    
                    <!-- Campo oculto para mantener la ruta existente -->
                    <?= $form->field($model, 'foto_perfil_path')->hiddenInput()->label(false) ?>
                </div>
            </div>
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

<?php
// JavaScript para vista previa de imagen
$this->registerJs(<<<JS
$(document).ready(function() {
    // Vista previa de la imagen antes de subir
    $('#imageUpload').change(function(e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Cambiar estilo del campo de archivo
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });
});
JS
);
?>