<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;

/** @var yii\web\View $this */
/** @var app\models\Vehiculos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vehiculos-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'] // Necesario para subir archivos
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'usuario_id')->dropDownList(
                ArrayHelper::map(Usuarios::find()->all(), 'usuario_id', function($usuario) {
                    return $usuario->nombre . ' ' . $usuario->apellido . ' (' . $usuario->codigo_universitario . ')';
                }),
                ['prompt' => 'Seleccione un usuario', 'required' => true]
            ) ?>

            <?= $form->field($model, 'placa')->textInput([
                'maxlength' => true,
                'required' => true,
                'placeholder' => 'Ej: ABC-1234'
            ]) ?>

            <?= $form->field($model, 'marca')->textInput([
                'maxlength' => true,
                'required' => true,
                'placeholder' => 'Ej: Toyota'
            ]) ?>

            <?= $form->field($model, 'modelo')->textInput([
                'maxlength' => true,
                'required' => true,
                'placeholder' => 'Ej: Corolla'
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'color')->textInput([
                'maxlength' => true,
                'required' => true,
                'placeholder' => 'Ej: Rojo'
            ]) ?>

            <?= $form->field($model, 'tipo')->dropDownList([
                'automovil' => 'Automóvil', 
                'motocicleta' => 'Motocicleta', 
                'discapacitados' => 'Discapacitados', 
                'carga' => 'Carga'
            ], [
                'prompt' => 'Seleccione un tipo',
                'required' => true
            ]) ?>

            <?= $form->field($model, 'autorizado')->dropDownList([
                1 => 'Sí',
                0 => 'No'
            ], [
                'required' => true
            ]) ?>

            <!-- Campo para subir imagen -->
            <?= $form->field($model, 'imageFile')->fileInput([
                'accept' => 'image/*',
                'required' => $model->isNewRecord, // Requerido solo para nuevos registros
                'onchange' => 'previewImage(this)'
            ]) ?>

            <!-- Vista previa de la imagen -->
            <?php if (!$model->isNewRecord && $model->foto_vehiculo_path): ?>
                <div class="form-group">
                    <label>Imagen Actual</label>
                    <div>
                        <?= Html::img('@web/uploads/vehicles/' . $model->foto_vehiculo_path, [
                            'style' => 'max-width: 200px; max-height: 150px;',
                            'id' => 'imagePreview'
                        ]) ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="form-group">
                    <label>Vista Previa</label>
                    <div>
                        <img id="imagePreview" style="max-width: 200px; max-height: 150px; display: none;">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

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