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
<div class="usuarios-index card shadow p-4 mt-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
        <?= Html::a('<i class="bi bi-plus-circle"></i> ' . Yii::t('app', 'Nuevo Usuario'), ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'foto_perfil_path',
                'label' => 'Foto',
                'format' => 'html',
                'value' => function($model) {
                    if ($model->foto_perfil_path && file_exists(Yii::getAlias('@webroot/' . $model->foto_perfil_path))) {
                        return Html::img(
                            Yii::getAlias('@web/' . $model->foto_perfil_path),
                            [
                                'class' => 'rounded-circle shadow',
                                'style' => 'width:50px; height:50px; object-fit:cover; border:2px solid #00723A; background:#fff;',
                                'alt' => $model->nombre,
                            ]
                        );
                    } else {
                        return Html::tag('span', '<i class="bi bi-person-circle" style="font-size:2.5rem;color:#ccc"></i>', ['class'=>'d-inline-block']);
                    }
                },
                'contentOptions' => ['style' => 'text-align:center;'],
                'headerOptions' => ['style' => 'width:70px; text-align:center;'],
                'filter' => false
            ],
            'codigo_universitario',
            'nombre',
            'apellido',
            [
                'attribute' => 'tipo',
                'filter' => Usuarios::optsTipo(),
                'value' => function($model) { return $model->displayTipo(); },
            ],
            [
                'attribute' => 'rol',
                'filter' => Usuarios::optsRol(),
                'value' => function($model) { return $model->displayRol(); },
            ],
            'email:email',
            // 'password_hash', // No se recomienda mostrar hashes de contraseñas en el listado
            'telefono',
            [
                'attribute' => 'activo',
                'format' => 'html',
                'filter' => [1 => 'Sí', 0 => 'No'],
                'value' => function ($model) {
                    return $model->activo ? 
                        '<span class="badge bg-success">Activo</span>' : 
                        '<span class="badge bg-danger">Inactivo</span>';
                }
            ],
            [
                'attribute' => 'fecha_registro',
                'label' => 'Fecha registro',
                'value' => function($model) {
                    return $model->fecha_registro ? Yii::$app->formatter->asDate($model->fecha_registro) : '';
                },
                'filter' => false
            ],
            [
                'attribute' => 'fecha_actualizacion',
                'label' => 'Fecha actualización',
                'value' => function($model) {
                    return $model->fecha_actualizacion ? Yii::$app->formatter->asDate($model->fecha_actualizacion) : '';
                },
                'filter' => false
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Usuarios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'usuario_id' => $model->usuario_id]);
                }
            ],
        ],
        'summary' => 'Mostrando <b>{begin}-{end}</b> de <b>{totalCount}</b> usuarios',
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class,
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>

<style>
.usuarios-index .table th, .usuarios-index .table td {
    vertical-align: middle;
}
</style>