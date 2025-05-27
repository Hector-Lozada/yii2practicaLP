<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Espacios $model */

$this->title = Yii::t('app', 'Create Espacios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Espacios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="espacios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
