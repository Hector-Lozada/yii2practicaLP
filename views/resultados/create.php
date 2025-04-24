<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Resultados $model */

$this->title = Yii::t('app', 'Create Resultados');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Resultados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resultados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
