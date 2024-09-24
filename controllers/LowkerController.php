<?php

namespace app\controllers;

use Yii;
use app\models\Lowker;
use app\models\LowkerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Perusahaan;

/**
 * LowkerController implements the CRUD actions for Lowker model.
 */
class LowkerController extends Controller
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
                        'allow' =>  !empty(Yii::$app->user->identity->developer)  || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('lowongan_kerja')->create)),
                        'actions' => ['create','data-perusahaan'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => !empty(Yii::$app->user->identity->developer)  || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('lowongan_kerja')->read)),
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => !empty(Yii::$app->user->identity->developer)  || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('lowongan_kerja')->update)),
                        'actions' => ['update','data-perusahaan'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => !empty(Yii::$app->user->identity->developer)  || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('lowongan_kerja')->delete)),
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
     * Lists all Lowker models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LowkerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lowker model.
     * @param string $code_lowker Code Lowker
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($code_lowker)
    {
        return $this->render('view', [
            'model' => $this->findModel($code_lowker),
        ]);
    }

    /**
     * Creates a new Lowker model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Lowker();
        $success = true; $message = "";
        if ($this->request->isPost) {
            $conn = Yii::$app->db;
            $trans = $conn->beginTransaction();
            try {
                if ($model->load($this->request->post())){
                    $model->code_lowker = $model->getLowkerId();
                    $model->tgl_post = date('Y-m-d',strtotime($model->tgl_post));
                    $model->tgl_last = date('Y-m-d',strtotime($model->tgl_last));
                    
                    if(!$model->save()){
                        $success = false;
						$message .= (count($model->errors) > 0) ? 'ERROR Create Kasbon: ' : '';
                        foreach ($model->errors as $key => $val) {
                            $message .= $value[0].', ';
                        }
                    }

                    if($success){
                        $trans->commit();
                        Yii::$app->session->setFlash('success',"Input Lowongan Kerja Success"); 
                        return $this->redirect(['view', 'code_lowker' => $model->code_lowker]);
                    }else{
                        $trans->rollBack();
                        Yii::$app->session->setFlash('error',$message); 
                    }
                }
            } catch (\Exception $e) {
                $trans->rollBack();
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Lowker model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $code_lowker Code Lowker
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($code_lowker)
    {
        $model = $this->findModel($code_lowker);

        if ($this->request->isPost) {
            $success = true; $message = "";
            $conn = Yii::$app->db;
            $trans = $conn->beginTransaction();
            try {
                if ($model->load($this->request->post())){
                    $model->tgl_post = date('Y-m-d',strtotime($model->tgl_post));
                    $model->tgl_last = date('Y-m-d',strtotime($model->tgl_last));
                    if(!$model->save()){
                        $success = false;
						$message .= (count($model->errors) > 0) ? 'ERROR Create Kasbon: ' : '';
                        foreach ($model->errors as $key => $val) {
                            $message .= $value[0].', ';
                        }
                    }

                    if($success){
                        $trans->commit();
                        Yii::$app->session->setFlash('success',"Input Lowongan Kerja Success"); 
                        return $this->redirect(['view', 'code_lowker' => $model->code_lowker]);
                    }else{
                        $trans->rollBack();
                        Yii::$app->session->setFlash('error',$message); 
                    }
                }
            } catch (\Exception $e) {
                $trans->rollBack();
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
            return $this->redirect(['view', 'code_lowker' => $model->code_lowker]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Lowker model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $code_lowker Code Lowker
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($code_lowker)
    {
        $this->findModel($code_lowker)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lowker model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $code_lowker Code Lowker
     * @return Lowker the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($code_lowker)
    {
        if (($model = Lowker::findOne(['code_lowker' => $code_lowker])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionDataPerusahaan()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $result = [];$data=[];$data_maklon = [];
        $request = isset($_POST['q']) ? $_POST['q'] : '';

        if($request != ''){
            $data = Perusahaan::find()->where(["like",'id_perusahaan',$request])->orWhere(["like",'nama',$request])->all();
            foreach ($data as $key => $val){
                $data_maklon[$key]=[
                    'id' => $val['id_perusahaan'],
                    'text' => "[".$val['id_perusahaan']."] ".$val['nama'].";",
                    'nama' => $val['nama'],
                    'alamat' => $val['alamat'],
                    'kota' => $val['kota'],
                    'propinsi' => $val['propinsi'],
                    'email' => $val['email'],
                    'phone' => $val['phone'],
                ];
            }
        }

        $result = ['results' => ['id' => '', 'text' => '']];
        $result['results'] = $data_maklon;
        return $result;
    }

}
