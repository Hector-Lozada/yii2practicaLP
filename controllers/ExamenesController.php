<?php

namespace app\controllers;

use app\models\Examenes;
use app\models\ExamenesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExamenesController implements the CRUD actions for Examenes model.
 */
class ExamenesController extends Controller
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
     * Lists all Examenes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ExamenesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Examenes model.
     * @param int $idexamenes Idexamenes
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idexamenes)
    {
        return $this->render('view', [
            'model' => $this->findModel($idexamenes),
        ]);
    }

    /**
     * Creates a new Examenes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Examenes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idexamenes' => $model->idexamenes]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Examenes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idexamenes Idexamenes
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idexamenes)
    {
        $model = $this->findModel($idexamenes);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idexamenes' => $model->idexamenes]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Examenes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idexamenes Idexamenes
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idexamenes)
    {
        $this->findModel($idexamenes)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Examenes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idexamenes Idexamenes
     * @return Examenes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idexamenes)
    {
        if (($model = Examenes::findOne(['idexamenes' => $idexamenes])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
