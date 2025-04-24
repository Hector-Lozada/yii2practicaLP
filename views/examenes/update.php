<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Examenes $model */

$this->title = Yii::t('app', 'Update Examenes: {name}', [
    'name' => $model->idexamenes,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Examenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idexamenes, 'url' => ['view', 'idexamenes' => $model->idexamenes]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="examenes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
