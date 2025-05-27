<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tarifas $model */

$this->title = Yii::t('app', 'Create Tarifas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarifas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarifas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
