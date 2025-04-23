<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ventas $model */

$this->title = Yii::t('app', 'Create Ventas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ventas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
