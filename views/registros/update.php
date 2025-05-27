<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Registros $model */

$this->title = Yii::t('app', 'Update Registros: {name}', [
    'name' => $model->registro_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Registros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->registro_id, 'url' => ['view', 'registro_id' => $model->registro_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="registros-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
