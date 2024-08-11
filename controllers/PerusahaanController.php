<?php

namespace app\controllers;

use Yii;
use app\models\Perusahaan;
use app\models\PerusahaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

use app\models\User;

/**
 * PerusahaanController implements the CRUD actions for Perusahaan model.
 */
class PerusahaanController extends Controller
{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => (isset(Yii::$app->user->identity->developer) && (Yii::$app->user->identity->developer || Yii::$app->user->identity->getMenu('Perusahaan')->create)),
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => (isset(Yii::$app->user->identity->developer) && (Yii::$app->user->identity->developer || Yii::$app->user->identity->getMenu('Perusahaan')->read)),
                        'actions' => ['index', 'view','send-register'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => (isset(Yii::$app->user->identity->developer) && (Yii::$app->user->identity->developer || Yii::$app->user->identity->getMenu('Perusahaan')->update)),
                        'actions' => ['update'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => isset(Yii::$app->user->identity->developer) && (Yii::$app->user->identity->developer || Yii::$app->user->identity->getMenu('Perusahaan')->delete),
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
        ];
    }

    /**
     * Lists all Perusahaan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PerusahaanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Perusahaan model.
     * @param int $id_perusahaan Id Perusahaan
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_perusahaan)
    {
        $model = $this->findModel($id_perusahaan);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Perusahaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Perusahaan();
        $message = "";$success = true;
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $con = Yii::$app->db ;
                $transaction = $con->beginTransaction();
                try {
                    $model->id_perusahaan = $model->getPerusahaanId();
                    if(!$model->save()){
                        foreach($model->errors as $error=>$value)
                        {
                            $message .= $value[0];
                        }
                        $success = false;
                        Yii::$app->session->setFlash('error',$message); 
                        $transaction->rollBack();
                    }

                    if($success){
                        $transaction->commit();
                        Yii::$app->session->setFlash('success',"Simpan Data Perusahaan Sukses");
                        return $this->redirect(['view', 'id_perusahaan' => $model->id_perusahaan]);
                    }else{
                        Yii::$app->session->setFlash('error',"Gagal Simpan Data Perusahaan");
                    }
                } catch (\Exception $e) {
                    Yii::$app->session->setFlash('error',$e->getMessage());
                    $transaction->rollBack();
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Perusahaan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_perusahaan Id Perusahaan
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_perusahaan)
    {
        $model = $this->findModel($id_perusahaan);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_perusahaan' => $model->id_perusahaan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Perusahaan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_perusahaan Id Perusahaan
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_perusahaan)
    {
        $this->findModel($id_perusahaan)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Perusahaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_perusahaan Id Perusahaan
     * @return Perusahaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_perusahaan)
    {
        if (($model = Perusahaan::findOne(['id_perusahaan' => $id_perusahaan])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionSendRegister($id_perusahaan)
    {
        $model = $this->findModel($id_perusahaan);
        if(!empty($model)){
            
        }
    }
}
