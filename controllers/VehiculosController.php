<?php

namespace app\controllers;

use app\models\Vehiculos;
use app\models\VehiculosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * VehiculosController implements the CRUD actions for Vehiculos model.
 */
class VehiculosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
{
    return [
        'access' => [
            'class' => \yii\filters\AccessControl::class,
            'rules' => [
                // Acciones que todos los autenticados pueden hacer
                [
                    'allow' => true,
                    'actions' => ['index', 'view'],
                    'roles' => ['@'],
                ],
                // Acciones restringidas solo para admin
                [
                    'allow' => true,
                    'actions' => ['create', 'update', 'delete'],
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin();
                    }
                ],
            ],
        ],
    ];
}

    /**
     * Lists all Vehiculos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VehiculosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vehiculos model.
     * @param int $vehiculo_id Vehiculo ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($vehiculo_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($vehiculo_id),
        ]);
    }

    /**
     * Creates a new Vehiculos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
{
    $model = new Vehiculos();

    if ($this->request->isPost) {
        $model->load($this->request->post());
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        // Validación separada para el archivo
        $fileValid = true;
        if ($model->imageFile) {
            $fileValid = $model->validate(['imageFile']);
        }

        if ($fileValid && $model->upload() && $model->save()) {
            Yii::$app->session->setFlash('success', 'Vehiculo registrado correctamente.');
            return $this->redirect(['view', 'vehiculo_id' => $model->usuario_id]);
        } else {
            Yii::$app->session->setFlash('error', 'Error al registrar el vehiculo.');
        }
    } else {
        $model->loadDefaultValues();
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}

    /**
     * Updates an existing Vehiculos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $vehiculo_id Vehiculo ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($vehiculo_id)
    {
        $model = $this->findModel($vehiculo_id);
        $imagenAnterior = $model->foto_vehiculo_path; // Guardar la ruta de la imagen anterior

        if ($this->request->isPost && $model->load($this->request->post())) {
            // Manejar la subida de la imagen
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            
            // Si se subió una nueva imagen o no
            if ($model->imageFile) {
                if ($model->upload() && $model->save()) {
                    // Eliminar la imagen anterior si existe y se subió una nueva
                    if ($imagenAnterior && file_exists($model->getUploadPath() . $imagenAnterior)) {
                        unlink($model->getUploadPath() . $imagenAnterior);
                    }
                    Yii::$app->session->setFlash('success', 'Vehiculo actualizado correctamente.');
                    return $this->redirect(['view', 'vehiculo_id' => $model->usuario_id]);
                }
            } else {
                // Si no se subió nueva imagen, mantener la anterior
                $model->foto_vehiculo_path = $imagenAnterior;
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Vehiculo actualizado correctamente.');
                    return $this->redirect(['view', 'vehiculo_id' => $model->usuario_id]);
                }
            }
            
            Yii::$app->session->setFlash('error', 'Error al actualizar el vehiculo.');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Vehiculos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $vehiculo_id Vehiculo ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($vehiculo_id)
    {
        $model = $this->findModel($vehiculo_id);
        
        // Eliminar la imagen asociada si existe
        if ($model->foto_vehiculo_path && file_exists($model->getUploadPath() . $model->foto_vehiculo_path)) {
            unlink($model->getUploadPath() . $model->foto_vehiculo_path);
        }
        
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Vehiculo eliminado correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'Error al eliminar el Vehiculo.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vehiculos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $vehiculo_id Vehiculo ID
     * @return Vehiculos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($vehiculo_id)
    {
        if (($model = Vehiculos::findOne(['vehiculo_id' => $vehiculo_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
