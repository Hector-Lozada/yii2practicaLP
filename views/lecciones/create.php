<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lecciones $model */

$this->title = Yii::t('app', 'Create Lecciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lecciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lecciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
