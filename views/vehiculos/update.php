<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Vehiculos $model */

$this->title = Yii::t('app', 'Update Vehiculos: {name}', [
    'name' => $model->vehiculo_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vehiculos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vehiculo_id, 'url' => ['view', 'vehiculo_id' => $model->vehiculo_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="vehiculos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
