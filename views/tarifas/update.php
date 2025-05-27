<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tarifas $model */

$this->title = Yii::t('app', 'Update Tarifas: {name}', [
    'name' => $model->tarifa_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarifas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tarifa_id, 'url' => ['view', 'tarifa_id' => $model->tarifa_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tarifas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
