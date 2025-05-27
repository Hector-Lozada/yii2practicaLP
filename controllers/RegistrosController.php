<?php

namespace app\controllers;

use app\models\Registros;
use app\models\RegistrosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * RegistrosController implements the CRUD actions for Registros model.
 */
class RegistrosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Registros models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RegistrosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Registros model.
     * @param int $registro_id Registro ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($registro_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($registro_id),
        ]);
    }

    /**
     * Creates a new Registros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
{
    $model = new Registros();

    if ($this->request->isPost) {
        $model->load($this->request->post());
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        // Validación separada para el archivo
        $fileValid = true;
        if ($model->imageFile) {
            $fileValid = $model->validate(['imageFile']);
        }

        if ($fileValid && $model->upload() && $model->save()) {
            Yii::$app->session->setFlash('success', 'Ingreso registrado correctamente.');
            return $this->redirect(['view', 'registro_id' => $model->registro_id]);


        } else {
            Yii::$app->session->setFlash('error', 'Error al registrar el ingreso.');
        }
    } else {
        $model->loadDefaultValues();
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}

    /**
     * Updates an existing Registros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $registro_id Registro ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($registro_id)
    {
        $model = $this->findModel($registro_id);
        $imagenAnterior = $model->foto_comprobante_path; // Guardar la ruta de la imagen anterior

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
                    Yii::$app->session->setFlash('success', 'Ingreso actualizado correctamente.');
                    return $this->redirect(['view', 'registro_id' => $model->registro_id]);

                }
            } else {
                // Si no se subió nueva imagen, mantener la anterior
                $model->foto_comprobante_path = $imagenAnterior;
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Ingreso actualizado correctamente.');
                    return $this->redirect(['view', 'registro_id' => $model->registro_id]);

                }
            }
            
            Yii::$app->session->setFlash('error', 'Error al actualizar el vehiculo.');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Registros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $registro_id Registro ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($registro_id)
    {
        $this->findModel($registro_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Registros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $registro_id Registro ID
     * @return Registros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($registro_id)
    {
        if (($model = Registros::findOne(['registro_id' => $registro_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
