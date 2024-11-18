<?php

namespace app\modules\curiculumvitae\controllers;

use Yii;   
use app\modules\curiculumvitae\models\CvSiswa;
use app\modules\curiculumvitae\models\CvSiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * CvSiswaController implements the CRUD actions for CvSiswa model.
 */
class CvSiswaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => ((!empty(Yii::$app->user->identity->developer) || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('cv-siswa')->create)))),
                        'actions' => ['create','autocomplete-siswa'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => ((!empty(Yii::$app->user->identity->developer) || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('cv-siswa')->read)))),
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => ((!empty(Yii::$app->user->identity->developer)  || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('cv-siswa')->update)))),
                        'actions' => ['update','autocomplete-siswa','add-row-siswa'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['input-data'],
                        // 'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CvSiswa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CvSiswaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CvSiswa model.
     * @param string $code Code
     * @param string $nik Nik
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($code, $nik)
    {
        return $this->render('view', [
            'model' => $this->findModel($code, $nik),
        ]);
    }

    /**
     * Creates a new CvSiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CvSiswa();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'code' => $model->code, 'nik' => $model->nik]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CvSiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $code Code
     * @param string $nik Nik
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($code, $nik)
    {
        $model = $this->findModel($code, $nik);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'code' => $model->code, 'nik' => $model->nik]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CvSiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $code Code
     * @param string $nik Nik
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($code, $nik)
    {
        $this->findModel($code, $nik)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CvSiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $code Code
     * @param string $nik Nik
     * @return CvSiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($code, $nik)
    {
        if (($model = CvSiswa::findOne(['code' => $code, 'nik' => $nik])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionInputData()
    {
        
        $model = new CvSiswa();
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'code' => $model->code, 'nik' => $model->nik]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $model->nik = Yii::$app->user->identity->nis;
        
        if(!empty($model->nik)){
            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            Yii::$app->session->setFlash('warning',"Menu ini untuk siswa");
            return $this->redirect('site');
        }
    }
}
