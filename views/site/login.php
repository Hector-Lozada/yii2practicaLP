<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.login-panel {
    background: #fff;
    border-radius: 1.25rem;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    padding: 2.5rem 2rem 2rem 2rem;
    margin-top: 36px;
}
.login-logo {
    display: block;
    margin: 0 auto 18px auto;
    width: 70px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 0 8px #0002;
    padding: 8px;
}
.login-title {
    font-weight: 700;
    letter-spacing: 1px;
    color: #198754;
}
@media (max-width: 767px) {
    .login-panel {
        padding: 1.5rem 0.7rem;
    }
}
</style>

<div class="site-login d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-6 col-lg-5">
        <div class="login-panel">
            <img src="<?= Yii::getAlias('@web') ?>/images/logo.png" alt="Logo UTELVT" class="login-logo">
            <h1 class="login-title text-center mb-3"><?= Html::encode($this->title) ?></h1>
            <p class="text-center text-muted mb-4">Ingresa tus credenciales para acceder al sistema.</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'correo')->input('email')->label('Correo electrónico') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>
            <?= $form->field($model, 'rememberMe')->checkbox(['label' => 'Recordarme']) ?>

            <div class="form-group mt-4 mb-2 text-center">
                <?= Html::submitButton('Iniciar sesión', ['class' => 'btn btn-success px-5 py-2', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="mt-3 text-center text-muted small">
                ¿Olvidaste tu contraseña? Contacta al administrador.
            </div>
        </div>
    </div>
</div>