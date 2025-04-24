<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cursos $model */

$this->title = Yii::t('app', 'Update Cursos: {name}', [
    'name' => $model->idcursos,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cursos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcursos, 'url' => ['view', 'idcursos' => $model->idcursos]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cursos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
