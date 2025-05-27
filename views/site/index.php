<?php

/** @var yii\web\View $this */

$this->title = 'Bienvenido al Sistema de Estacionamiento UTELVT';
?>

<style>
.hero-bg {
    min-height: 70vh;
    background: linear-gradient(rgba(17,17,17,0.7), rgba(17,17,17,0.7)), url('@web/images/estacionamiento.jpg') center center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    border-radius: 1.2rem;
    box-shadow: 0 4px 32px rgba(0,0,0,0.10);
    margin-top: 40px;
    margin-bottom: 40px;
}
.hero-content {
    text-align: center;
    padding: 3rem 2rem;
}
.hero-title {
    font-size: 2.6rem;
    font-weight: 700;
    letter-spacing: 2px;
}
.hero-desc {
    font-size: 1.25rem;
    font-weight: 400;
    margin-top: 1.5rem;
}
.hero-btn {
    margin-top: 2.5rem;
}
@media (max-width: 767px) {
    .hero-bg {
        min-height: 45vh;
        padding: 1.5rem 0;
    }
    .hero-title {
        font-size: 1.7rem;
    }
    .hero-content {
        padding: 2rem 0.5rem;
    }
}
</style>

<div class="site-index">

    <div class="hero-bg">
        <div class="hero-content w-100">
           <img src="<?= Yii::getAlias('@web') ?>/images/logo.png" alt="Logo UTELVT" style="width: 85px; background: #fff; border-radius:50%; box-shadow:0 0 8px #0002; padding:8px;">
            <h1 class="hero-title mt-3 mb-2">Bienvenido al Sistema de<br>Estacionamiento Universitario UTELVT</h1>
            <p class="hero-desc">
                Gestiona vehículos, espacios, usuarios y controla el acceso al estacionamiento de forma sencilla y eficiente.<br>
                Accede a los módulos desde el menú superior.
            </p>
            <div class="hero-btn">
                <?php if (Yii::$app->user->isGuest): ?>
                    <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="btn btn-success btn-lg px-5 py-2">
                        Iniciar sesión
                    </a>
                <?php else: ?>
                    <a href="<?= \yii\helpers\Url::to(['/registros/index']) ?>" class="btn btn-primary btn-lg px-5 py-2">
                        Ir a Registros
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 col-lg-7 text-center">
            <h3 class="mb-4">¿Qué puedes hacer aquí?</h3>
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body py-4">
                            <span class="display-6 text-success mb-2 d-block">
                                <i class="bi bi-car-front"></i>
                            </span>
                            <div class="fw-bold mb-1">Vehículos</div>
                            <small class="text-muted">Registra y administra los vehículos autorizados.</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body py-4">
                            <span class="display-6 text-success mb-2 d-block">
                                <i class="bi bi-grid-3x3-gap"></i>
                            </span>
                            <div class="fw-bold mb-1">Espacios</div>
                            <small class="text-muted">Gestiona los espacios de estacionamiento disponibles.</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body py-4">
                            <span class="display-6 text-success mb-2 d-block">
                                <i class="bi bi-person-badge"></i>
                            </span>
                            <div class="fw-bold mb-1">Usuarios</div>
                            <small class="text-muted">Controla el acceso de los usuarios al sistema.</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body py-4">
                            <span class="display-6 text-success mb-2 d-block">
                                <i class="bi bi-cash-coin"></i>
                            </span>
                            <div class="fw-bold mb-1">Tarifas</div>
                            <small class="text-muted">Consulta y administra las tarifas vigentes.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-muted small">
                Sistema desarrollado para la gestión del estacionamiento universitario UTELVT.
            </div>
        </div>
    </div>
</div>