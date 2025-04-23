<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Empleados $model */

$this->title = Yii::t('app', 'Create Empleados');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empleados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empleados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
