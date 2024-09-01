<?php

namespace app\controllers;

use Yii;
use app\models\StatusSiswa;
use app\models\StatusSiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * StatusSiswaController implements the CRUD actions for StatusSiswa model.
 */
class StatusSiswaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
               'access' => [
                'class' => AccessControl::class,
                'rules' => [
                        [
                            'allow' => !empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('status_siswa')->create),
                            'actions' => ['create'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => !empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('status_siswa')->read),
                            'actions' => ['index', 'view'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => !empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('status_siswa')->update),
                            'actions' => ['update'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => !empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('status_siswa')->delete),
                            'actions' => ['delete'],
                            'roles' => ['@'],
                        ],
                    ],
                ],
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
     * Lists all StatusSiswa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StatusSiswaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StatusSiswa model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StatusSiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new StatusSiswa();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StatusSiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StatusSiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StatusSiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return StatusSiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StatusSiswa::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
