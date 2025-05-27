<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Espacios $model */

$this->title = Yii::t('app', 'Update Espacios: {name}', [
    'name' => $model->espacio_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Espacios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->espacio_id, 'url' => ['view', 'espacio_id' => $model->espacio_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="espacios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
