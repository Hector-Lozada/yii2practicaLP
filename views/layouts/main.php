<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        /* Navbar custom color and style */
        .utelvt-navbar {
            background: #111 !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            min-height: 48px !important; /* reduce height */
        }
        .utelvt-navbar .navbar-nav .nav-link,
        .utelvt-navbar .navbar-nav .dropdown-item {
            color: #fff !important;
            font-weight: 500;
            transition: color 0.2s;
            padding-top: 6px !important;
            padding-bottom: 6px !important;
        }
        .utelvt-navbar .navbar-nav .nav-link:hover,
        .utelvt-navbar .navbar-nav .dropdown-item:hover {
            color: #ffe082 !important;
        }
        .utelvt-navbar .navbar-brand,
        .utelvt-navbar .navbar-brand .utelvt-text {
            color: #fff !important;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 1.1rem;
        }
        .utelvt-navbar .dropdown-menu {
            background: #232323;
        }
        .utelvt-navbar .dropdown-item {
            color: #fff !important;
        }
        .utelvt-navbar .dropdown-item:hover {
            background: #333;
            color: #ffe082 !important;
        }
        .utelvt-text {
            vertical-align: middle;
            font-size: 1.15rem;
            margin-left: 8px;
            letter-spacing: 2px;
        }
        .navbar-nav .nav-item .logout {
            color: #fff !important;
            padding: 0;
            margin-left: 10px;
        }
        .navbar-nav .nav-item .logout:hover {
            color: #ffe082 !important;
            text-decoration: underline;
        }
        body {
            background: #f5f7fa;
        }
        .container {
            margin-top: 65px;
        }
        footer {
            font-size: 0.95rem;
        }
        .utelvt-navbar .navbar-brand span img {
            height: 28px !important;
            width: 28px !important;
        }
        @media (max-width: 768px) {
            .container { margin-top: 85px; }
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' =>
            Html::tag('span',
                Html::img('@web/images/logo.png', [
                    'alt' => 'UTELVT Logo',
                    'style' => 'height:28px; width:28px; object-fit:contain;'
                ]),
                [
                    'style' =>
                        'display:inline-block; vertical-align:middle; ' .
                        'background:#fff; border-radius:50%; ' .
                        'box-shadow: 0 2px 8px rgba(0,0,0,0.10); ' .
                        'padding:3px; margin-right:10px;'
                ]
            )
            . '<span class="utelvt-text">UTELVT</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar navbar-expand-md utelvt-navbar navbar-dark fixed-top py-0']
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            [
                'label' => 'Estacionamiento',
                'items' => [
                    ['label' => 'Usuarios', 'url' => ['/usuarios/index']],
                    ['label' => 'Vehículos', 'url' => ['/vehiculos/index']],
                    ['label' => 'Espacios', 'url' => ['/espacios/index']],
                    ['label' => 'Registros', 'url' => ['/registros/index']],
                    ['label' => 'Tarifas', 'url' => ['/tarifas/index']],
                ],
            ],
        ]
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto mb-2 mb-md-0'],
        'items' => [
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Cerrar sesión (' . Yii::$app->user->identity->email . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);

    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; UTELVT <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>