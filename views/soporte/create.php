<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Soporte $model */

$this->title = Yii::t('app', 'Create Soporte');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Soportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soporte-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
