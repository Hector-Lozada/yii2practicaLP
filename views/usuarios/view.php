<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */

$this->title = $model->nombre . ' ' . $model->apellido;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'usuario_id' => $model->usuario_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'usuario_id' => $model->usuario_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que quieres eliminar este usuario?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-3">
            <!-- Tarjeta con la imagen de perfil -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <?php 
                    $imageUrl = $model->foto_perfil_path 
                        ? Url::to('@web/uploads/users/' . $model->foto_perfil_path) 
                        : Url::to('@web/images/default-user.png');
                    ?>
                    <img src="<?= $imageUrl ?>" 
                         class="img-fluid rounded-circle mb-3" 
                         alt="Foto de perfil"
                         style="width: 200px; height: 200px; object-fit: cover;">
                    <h5 class="card-title"><?= Html::encode($model->nombre . ' ' . $model->apellido) ?></h5>
                    <p class="text-muted"><?= Html::encode($model->displayTipo()) ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'usuario_id',
                    'codigo_universitario',
                    'nombre',
                    'apellido',
                    [
                        'attribute' => 'tipo',
                        'value' => $model->displayTipo(),
                    ],
                    'email:email',
                    'telefono',
                    [
                        'attribute' => 'activo',
                        'value' => $model->activo ? 'Sí' : 'No',
                    ],
                    'fecha_registro:datetime',
                    'fecha_actualizacion:datetime',
                    [
                        'attribute' => 'foto_perfil_path',
                        'format' => 'raw',
                        'value' => Html::a('Ver imagen completa', 
                                          Url::to('@web/uploads/users/' . $model->foto_perfil_path), 
                                          ['target' => '_blank']),
                        'visible' => !empty($model->foto_perfil_path),
                    ],
                ],
                'options' => ['class' => 'table table-striped table-bordered detail-view'],
            ]) ?>
        </div>
    </div>

</div>