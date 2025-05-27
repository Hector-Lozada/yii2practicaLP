<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuarios-form card shadow p-4 mt-3">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'] // Para subida de archivos
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'codigo_universitario', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'placeholder' => 'Ingrese el código universitario',
                    'required' => true
                ]
            ])->label('Código Universitario <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'nombre', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'placeholder' => 'Ingrese el nombre',
                    'required' => true
                ]
            ])->label('Nombre <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'apellido', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'placeholder' => 'Ingrese el apellido',
                    'required' => true
                ]
            ])->label('Apellido <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'tipo')->dropDownList([
                'estudiante' => 'Estudiante',
                'profesor' => 'Profesor',
                'administrativo' => 'Administrativo',
                'visitante' => 'Visitante',
            ], [
                'prompt' => 'Seleccione un tipo',
                'required' => true,
                'class' => 'form-select'
            ])->label('Tipo <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'rol')->dropDownList([
                'admin' => 'Administrador',
                'usuario' => 'Usuario',
            ], [
                'prompt' => 'Seleccione un rol',
                'required' => true,
                'class' => 'form-select'
            ])->label('Rol <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'email', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'placeholder' => 'Ingrese el correo electrónico',
                    'type' => 'email',
                    'required' => true
                ]
            ])->label('Correo electrónico <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'password_hash', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'placeholder' => 'Ingrese la contraseña',
                    'type' => 'password',
                    'required' => true
                ]
            ])->label('Contraseña <span style="color:red">*</span>') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'telefono', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'placeholder' => 'Ingrese el teléfono',
                    'required' => true
                ]
            ])->label('Teléfono <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'activo')->dropDownList([
                1 => 'Activo',
                0 => 'Inactivo'
            ], [
                'prompt' => 'Seleccione el estado',
                'required' => true,
                'class' => 'form-select'
            ])->label('Estado <span style="color:red">*</span>') ?>

            

            <?php if ($model->foto_perfil_path): ?>
                <div class="mb-2">
                    <label>Imagen actual:</label><br>
                    <img src="<?= Yii::getAlias('@web/' . $model->foto_perfil_path) ?>" class="rounded-circle shadow" style="width: 80px; height: 80px; object-fit:cover;">
                </div>
            <?php endif; ?>

           <?= $form->field($model, 'foto_perfil')->fileInput([
    'accept' => 'image/*',
    'class' => 'form-control',
    'required' => $model->isNewRecord // obligatorio solo al crear
])->label('Foto de perfil <span style="color:red">*</span>') ?>
        </div>
    </div>

    <div class="form-group mt-4 text-center">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success btn-lg px-5']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>