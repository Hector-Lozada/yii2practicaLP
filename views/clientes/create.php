<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Clientes $model */

$this->title = Yii::t('app', 'Create Clientes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
