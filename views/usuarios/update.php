<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */

$this->title = Yii::t('app', 'Update Usuarios: {name}', [
    'name' => $model->idusuarios,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idusuarios, 'url' => ['view', 'idusuarios' => $model->idusuarios]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
