<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Registros $model */

$this->title = Yii::t('app', 'Create Registros');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Registros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
