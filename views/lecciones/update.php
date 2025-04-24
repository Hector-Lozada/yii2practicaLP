<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lecciones $model */

$this->title = Yii::t('app', 'Update Lecciones: {name}', [
    'name' => $model->idlecciones,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lecciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idlecciones, 'url' => ['view', 'idlecciones' => $model->idlecciones]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lecciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
