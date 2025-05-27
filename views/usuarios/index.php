<?php

use app\models\Usuarios;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\UsuariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'foto_perfil_path',
                'format' => 'html',
                'value' => function($model) {
                    $imageUrl = $model->foto_perfil_path 
                        ? Url::to('@web/uploads/users/' . $model->foto_perfil_path) 
                        : Url::to('@web/images/default-user.png');
                    return Html::img($imageUrl, [
                        'style' => 'width: 50px; height: 50px; object-fit: cover; border-radius: 50%;',
                        'alt' => 'Foto de perfil',
                        'class' => 'img-thumbnail'
                    ]);
                },
                'contentOptions' => ['style' => 'width: 70px;'],
            ],
            'usuario_id',
            'codigo_universitario',
            'nombre',
            'apellido',
            [
                'attribute' => 'tipo',
                'value' => function($model) {
                    return $model->displayTipo();
                },
                'filter' => Usuarios::optsTipo(),
            ],
            'email:email',
            'telefono',
            [
                'attribute' => 'activo',
                'value' => function($model) {
                    return $model->activo ? 'Sí' : 'No';
                },
                'filter' => [1 => 'Sí', 0 => 'No'],
            ],
            [
                'attribute' => 'fecha_registro',
                'format' => ['date', 'php:d/m/Y'],
                'filter' => false,
            ],
            [
                'attribute' => 'fecha_actualizacion',
                'format' => ['date', 'php:d/m/Y'],
                'filter' => false,
            ],
            [
                'class' => ActionColumn::className(),
                'header' => 'Acciones',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'title' => 'Ver',
                            'class' => 'btn btn-sm btn-primary',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', $url, [
                            'title' => 'Editar',
                            'class' => 'btn btn-sm btn-success',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash"></i>', $url, [
                            'title' => 'Eliminar',
                            'class' => 'btn btn-sm btn-danger',
                            'data' => [
                                'confirm' => '¿Estás seguro de eliminar este usuario?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
                'urlCreator' => function ($action, Usuarios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'usuario_id' => $model->usuario_id]);
                }
            ],
        ],
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
        'pager' => [
            'options' => ['class' => 'pagination justify-content-center'],
            'linkOptions' => ['class' => 'page-link'],
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>