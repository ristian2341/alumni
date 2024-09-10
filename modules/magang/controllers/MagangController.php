<?php

namespace app\modules\magang\controllers;

use Yii;
use app\modules\magang\models\Magang;
use app\modules\magang\models\MagangDetail;
use app\modules\magang\models\MagangSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use app\models\Siswa;

/**
 * MagangController implements the CRUD actions for Magang model.
 */
class MagangController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        if(isset(Yii::$app->user->identity)){
            return array_merge(
                parent::behaviors(),
                [
                   'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                            [
                                'allow' => ((!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('magang')->create))),
                                'actions' => ['create','autocomplete-siswa','add-row-siswa'],
                                'roles' => ['@'],
                            ],
                            [
                                'allow' => ((!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('magang')->read))),
                                'actions' => ['index', 'view'],
                                'roles' => ['@'],
                            ],
                            [
                                'allow' => ((!empty(Yii::$app->user->identity->developer)  || !empty(Yii::$app->user->identity->getMenu('magang')->update))),
                                'actions' => ['update','autocomplete-siswa','add-row-siswa'],
                                'roles' => ['@'],
                            ],
                            [
                                'allow' => (!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('magang')->delete)),
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
        }else{
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Lists all Magang models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MagangSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Magang model.
     * @param string $code Code
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($code)
    {
        return $this->render('view', [
            'model' => $this->findModel($code),
        ]);
    }

    /**
     * Creates a new Magang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Magang();
        $MagangDetail = New MagangDetail();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $message = "";$success = true;
                $con = Yii::$app->db ;
                $transaction = $con->beginTransaction();
                try {
                    $model->code = $model->getCode();
                    $model->tgl_mulai = date('Y-m-d',strtotime($model->tgl_mulai));
                    $model->tgl_akhir = date('Y-m-d',strtotime($model->tgl_akhir));
                    $model->nama_perusahaan = isset($model->dataPerusahaan->nama) ? $model->dataPerusahaan->nama : '';
                    $MagangDetail = $this->request->post()['MagangDetail'];
                    if(!empty($MagangDetail)){
                        foreach ($MagangDetail as $key => $value) {
                            $detail = new MagangDetail();
                            $detail->code_magang = $model->code;
                            $detail->nisn = $value['nisn'];
                            $detail->nama = $value['nama'];
                            $detail->code_jurusan = $value['rombel'];
                            if(!$detail->save()){
                                foreach($detail->errors as $error=>$value)
                                {
                                    $message .= $value[0];
                                }
                                $success = false;
                                Yii::$app->session->setFlash('error',$message); 
                                $transaction->rollBack();
                            }
                        }
                    }else{
                        $success = false;
                        $message = "Gagal Input Magang Detail";
                    }

        
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
                        Yii::$app->session->setFlash('success',"Simpan Data Magang Sukses");
                        return $this->redirect(['view', 'code' => $model->code]);
                    }else{
                        Yii::$app->session->setFlash('error',"Gagal Simpan Data Magang");
                    }
                } catch (\Exception $e) {
                    Yii::$app->session->setFlash('error',$e->getMessage());
                    $transaction->rollBack();
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        $session_detail = Yii::$app->session; 
        unset($session_detail['detail_magang']);

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Magang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $code Code
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($code)
    {
        $model = $this->findModel($code);
    
        $session_detail = Yii::$app->session;
        if ($this->request->isPost){
            if ($model->load($this->request->post())) {
                $message = "";$success = true;
                $con = Yii::$app->db ;
                $transaction = $con->beginTransaction();
                try {
                 
                    $model->tgl_mulai = date('Y-m-d',strtotime(str_replace("/","-",$model->tgl_mulai)));
                    $model->tgl_akhir = date('Y-m-d',strtotime(str_replace("/","-",$model->tgl_akhir)));
                    $model->nama_perusahaan = isset($model->dataPerusahaan->nama) ? $model->dataPerusahaan->nama : '';
                    $MagangDetail = $this->request->post()['MagangDetail'];
                    if(!empty($MagangDetail)){
                        MagangDetail::deleteAll(['code_magang' => $model->code]);
                        foreach ($MagangDetail as $key => $value) {
                            $detail = new MagangDetail();
                            $detail->code_magang = $model->code;
                            $detail->nisn = $value['nisn'];
                            $detail->nama = $value['nama'];
                            $detail->rombel = $value['rombel'];
                            if(!$detail->save()){
                                foreach($detail->errors as $error=>$value)
                                {
                                    $message .= $value[0];
                                }
                                $success = false;
                                Yii::$app->session->setFlash('error',$message); 
                                $transaction->rollBack();
                            }
                        }
                    }else{
                        $success = false;
                        $message = "Gagal Input Magang Detail";
                    }

        
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
                        Yii::$app->session->setFlash('success',"Simpan Data Magang Sukses");
                        return $this->redirect(['view', 'code' => $model->code]);
                    }else{
                        Yii::$app->session->setFlash('error',"Gagal Simpan Data Magang");
                    }
                } catch (\Exception $e) {
                    Yii::$app->session->setFlash('error',$e->getMessage());
                    $transaction->rollBack();
                }
            }
        }

        $session_detail = Yii::$app->session; 
        unset($session_detail['detail_magang']);

        $detail = $model->dataDetail;
        Yii::$app->session->set('detail_magang',$detail);
        $tbody = $this->renderPartial('table_detail',[
            'model_detail' => $detail,
        ]);
        
        $model->tgl_mulai = date('d-m-Y',strtotime($model->tgl_mulai));
        $model->tgl_akhir = date('d-m-Y',strtotime($model->tgl_akhir));
        return $this->render('update', [
            'model' => $model,
            'tbody' => $tbody,
        ]);
    }

    /**
     * Deletes an existing Magang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $code Code
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($code)
    {
        $this->findModel($code)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Magang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $code Code
     * @return Magang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($code)
    {
        if (($model = Magang::findOne(['code' => $code])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAutocompleteSiswa()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $result = [];$data=[];$datasiswa = [];
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        if($q != ''){
            $data = Siswa::find()->where(['id_status_siswa' => 1])->andWhere("(nama like '%".$q."%' or nisn like '%".$q."%')")->limit(50)->all();
        }else{
            $data = Siswa::find()->where(['id_status_siswa' => 1])->limit(50)->all();
        }
        
        if(!empty($data)){
            foreach ($data as $key => $val){
                $datasiswa[$key]=[
                    'id' => $val['nisn'],
                    'text' => "[".$val['nisn']."] ".$val['nama'],
                    'nama' => $val['nama'],
                    'rombel' => $val['rombel_now'],
                ];
            }
        }
        
        $result = ['results' => ['id' => '', 'text' => '']];
        $result['results'] = $datasiswa;
        return $result;
    }

    public function actionAddRowSiswa()
    {
        $detail = [];$data_detail=[];
    
        $number = isset($_POST['number']) ? $_POST['number'] : '';
        $nisn = isset($_POST['nisn']) ? $_POST['nisn'] : '';
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $rombel = isset($_POST['rombel']) ? $_POST['rombel'] : '';
        $action = isset($_POST['action']) ? $_POST['action'] : '';

        $detail = Yii::$app->session->get('detail_magang');
        if($action == 'add'){
            if($number != ''){
                $detail[$number]=[
                    'nisn' => $nisn,
                    'nama' => $nama,
                    'rombel' => $rombel,
                ];
            }else{
                $detail[]=[
                    'number' => isset($detail) ? count($detail) + 1 : 1,
                    'nisn' => $nisn,
                    'nama' => $nama,
                    'rombel' => $rombel,
                ];
            }
        }elseif($action == 'delete'){
            unset($detail[$number]);
        }
        Yii::$app->session->set('detail_magang',$detail);
        $data_detail = isset($detail) ? $detail : [];
        $result = $this->renderPartial('table_detail',[
            'model_detail' => $data_detail,
        ]);
        
        return $result;
    }
}
