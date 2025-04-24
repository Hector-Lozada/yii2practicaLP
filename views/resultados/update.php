<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Resultados $model */

$this->title = Yii::t('app', 'Update Resultados: {name}', [
    'name' => $model->idresultados,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Resultados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idresultados, 'url' => ['view', 'idresultados' => $model->idresultados]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="resultados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
