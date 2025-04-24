<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Examenes $model */

$this->title = Yii::t('app', 'Create Examenes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Examenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="examenes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
