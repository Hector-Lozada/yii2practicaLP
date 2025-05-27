<?php

namespace app\controllers;

use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

class UsuariosController extends Controller
{
    public function behaviors()
{
    return [
        'access' => [
            'class' => \yii\filters\AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin();
                    }
                ],
            ],
        ],
    ];
}

    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($usuario_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($usuario_id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Usuarios();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->foto_perfil = UploadedFile::getInstance($model, 'foto_perfil');

            // Validar archivo si se subió, si no, igual validar el resto
            if ($model->validate()) {
                if ($model->uploadFotoPerfil() && $model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Usuario registrado correctamente.');
                    return $this->redirect(['view', 'usuario_id' => $model->usuario_id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error al registrar el Usuario.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Error al validar los datos.');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($usuario_id)
    {
        $model = $this->findModel($usuario_id);
        $imagenAnterior = $model->foto_perfil_path;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->foto_perfil = UploadedFile::getInstance($model, 'foto_perfil');

            if ($model->foto_perfil) {
                if ($model->uploadFotoPerfil() && $model->save(false)) {
                    // Eliminar imagen anterior si existe y es distinta
                    if ($imagenAnterior && $imagenAnterior !== $model->foto_perfil_path && file_exists(Yii::getAlias('@webroot/' . $imagenAnterior))) {
                        @unlink(Yii::getAlias('@webroot/' . $imagenAnterior));
                    }
                    Yii::$app->session->setFlash('success', 'Usuario actualizado correctamente.');
                    return $this->redirect(['view', 'usuario_id' => $model->usuario_id]);
                }
            } else {
                // Si no se subió nueva imagen, mantener la anterior
                $model->foto_perfil_path = $imagenAnterior;
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Usuario actualizado correctamente.');
                    return $this->redirect(['view', 'usuario_id' => $model->usuario_id]);
                }
            }

            Yii::$app->session->setFlash('error', 'Error al actualizar el Usuario.');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($usuario_id)
    {
        $model = $this->findModel($usuario_id);
        // Borra la imagen si existe
        if ($model->foto_perfil_path && file_exists(Yii::getAlias('@webroot/' . $model->foto_perfil_path))) {
            @unlink(Yii::getAlias('@webroot/' . $model->foto_perfil_path));
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($usuario_id)
    {
        if (($model = Usuarios::findOne(['usuario_id' => $usuario_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}