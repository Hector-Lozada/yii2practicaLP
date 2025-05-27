<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;

/** @var yii\web\View $this */
/** @var app\models\Vehiculos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vehiculos-form card shadow p-4 mt-3">

    <div class="mb-4 border-bottom pb-2 d-flex align-items-center">
        <i class="bi bi-car-front-fill me-2" style="font-size:2rem;color:#00723A;"></i>
        <h3 class="mb-0 ms-2" style="font-weight: 600;">Gestión de Vehículos</h3>
    </div>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'] // Necesario para subir archivos
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'usuario_id')->dropDownList(
                ArrayHelper::map(Usuarios::find()->all(), 'usuario_id', function($usuario) {
                    return $usuario->nombre . ' ' . $usuario->apellido . ' (' . $usuario->codigo_universitario . ')';
                }),
                [
                    'prompt' => 'Seleccione un usuario',
                    'required' => true,
                    'class' => 'form-select'
                ]
            )->label('Usuario <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'placa', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'required' => true,
                    'placeholder' => 'Ej: ABC-1234'
                ]
            ])->label('Placa <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'marca', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'required' => true,
                    'placeholder' => 'Ej: Toyota'
                ]
            ])->label('Marca <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'modelo', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'required' => true,
                    'placeholder' => 'Ej: Corolla'
                ]
            ])->label('Modelo <span style="color:red">*</span>') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'color', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'maxlength' => true,
                    'required' => true,
                    'placeholder' => 'Ej: Rojo'
                ]
            ])->label('Color <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'tipo')->dropDownList([
                'automovil' => 'Automóvil',
                'motocicleta' => 'Motocicleta',
                'discapacitados' => 'Discapacitados',
                'carga' => 'Carga'
            ], [
                'prompt' => 'Seleccione un tipo',
                'required' => true,
                'class' => 'form-select'
            ])->label('Tipo <span style="color:red">*</span>') ?>

            <?= $form->field($model, 'autorizado')->dropDownList([
                1 => 'Sí',
                0 => 'No'
            ], [
                'required' => true,
                'class' => 'form-select'
            ])->label('Autorizado <span style="color:red">*</span>') ?>

            <!-- Campo para subir imagen -->
            <?= $form->field($model, 'imageFile')->fileInput([
                'accept' => 'image/*',
                'required' => $model->isNewRecord, // Requerido solo para nuevos registros
                'onchange' => 'previewImage(this)',
                'class' => 'form-control'
            ])->label('Foto del vehículo' . ($model->isNewRecord ? ' <span style="color:red">*</span>' : '')) ?>

            <!-- Vista previa de la imagen -->
            <?php if (!$model->isNewRecord && $model->foto_vehiculo_path): ?>
                <div class="form-group mb-3">
                    <label class="fw-bold">Imagen actual</label>
                    <div>
                        <?= Html::img('@web/uploads/vehicles/' . $model->foto_vehiculo_path, [
                            'style' => 'max-width: 200px; max-height: 150px; border-radius: 0.5rem; border:1px solid #ccc;',
                            'id' => 'imagePreview'
                        ]) ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="form-group mb-3">
                    <label class="fw-bold">Vista previa</label>
                    <div>
                        <img id="imagePreview" style="max-width: 200px; max-height: 150px; display: none; border-radius: 0.5rem; border:1px solid #ccc;">
                    </div>
                </div>
            <?php endif; ?>
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
.vehiculos-form .form-select,
.vehiculos-form .form-control {
    border-radius: .5rem;
    box-shadow: none;
}
.vehiculos-form label {
    font-weight: 500;
}
.vehiculos-form .form-group {
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