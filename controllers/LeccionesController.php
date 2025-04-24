<?php

namespace app\controllers;

use app\models\Lecciones;
use app\models\LeccionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LeccionesController implements the CRUD actions for Lecciones model.
 */
class LeccionesController extends Controller
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
     * Lists all Lecciones models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LeccionesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lecciones model.
     * @param int $idlecciones Idlecciones
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idlecciones)
    {
        return $this->render('view', [
            'model' => $this->findModel($idlecciones),
        ]);
    }

    /**
     * Creates a new Lecciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Lecciones();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idlecciones' => $model->idlecciones]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Lecciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idlecciones Idlecciones
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idlecciones)
    {
        $model = $this->findModel($idlecciones);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idlecciones' => $model->idlecciones]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Lecciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idlecciones Idlecciones
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idlecciones)
    {
        $this->findModel($idlecciones)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lecciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idlecciones Idlecciones
     * @return Lecciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idlecciones)
    {
        if (($model = Lecciones::findOne(['idlecciones' => $idlecciones])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
