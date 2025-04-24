<?php

namespace app\controllers;

use app\models\Resultados;
use app\models\ResultadosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResultadosController implements the CRUD actions for Resultados model.
 */
class ResultadosController extends Controller
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
     * Lists all Resultados models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ResultadosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Resultados model.
     * @param int $idresultados Idresultados
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idresultados)
    {
        return $this->render('view', [
            'model' => $this->findModel($idresultados),
        ]);
    }

    /**
     * Creates a new Resultados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Resultados();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idresultados' => $model->idresultados]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Resultados model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idresultados Idresultados
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idresultados)
    {
        $model = $this->findModel($idresultados);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idresultados' => $model->idresultados]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Resultados model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idresultados Idresultados
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idresultados)
    {
        $this->findModel($idresultados)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Resultados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idresultados Idresultados
     * @return Resultados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idresultados)
    {
        if (($model = Resultados::findOne(['idresultados' => $idresultados])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
