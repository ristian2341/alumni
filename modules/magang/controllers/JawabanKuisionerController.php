<?php

namespace app\modules\magang\controllers;

use app\modules\magang\models\JawabanKuisioner;
use app\modules\magang\models\JawabanKuisionerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JawabanKuisionerController implements the CRUD actions for JawabanKuisioner model.
 */
class JawabanKuisionerController extends Controller
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
     * Lists all JawabanKuisioner models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new JawabanKuisionerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JawabanKuisioner model.
     * @param string $code Code
     * @param string $nisn Nisn
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($code, $nisn)
    {
        return $this->render('view', [
            'model' => $this->findModel($code, $nisn),
        ]);
    }

    /**
     * Creates a new JawabanKuisioner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new JawabanKuisioner();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'code' => $model->code, 'nisn' => $model->nisn]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JawabanKuisioner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $code Code
     * @param string $nisn Nisn
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($code, $nisn)
    {
        $model = $this->findModel($code, $nisn);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'code' => $model->code, 'nisn' => $model->nisn]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JawabanKuisioner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $code Code
     * @param string $nisn Nisn
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($code, $nisn)
    {
        $this->findModel($code, $nisn)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JawabanKuisioner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $code Code
     * @param string $nisn Nisn
     * @return JawabanKuisioner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($code, $nisn)
    {
        if (($model = JawabanKuisioner::findOne(['code' => $code, 'nisn' => $nisn])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
