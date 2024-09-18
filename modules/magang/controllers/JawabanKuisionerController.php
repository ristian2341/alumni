<?php

namespace app\modules\magang\controllers;

use Yii;    
use app\modules\magang\models\JawabanKuisioner;
use app\modules\magang\models\JawabanKuisionerDetail;
use app\modules\magang\models\JawabanKuisionerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\Siswa;
use app\modules\magang\models\Magang;
use app\modules\magang\models\MagangDetail;
use app\modules\master\models\MasterKuisioner;

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
        if(!isset(Yii::$app->user->identity)){
            return $this->redirect(['site/login']);
        }

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => ((!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('isi-kuisioner-magang')->create))),
                        'actions' => ['create','autocomplete-siswa','add-row-siswa'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => ((!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('isi-kuisioner-magang')->read))),
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => ((!empty(Yii::$app->user->identity->developer)  || !empty(Yii::$app->user->identity->getMenu('isi-kuisioner-magang')->update))),
                        'actions' => ['update','autocomplete-siswa','add-row-siswa'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => (!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('isi-kuisioner-magang')->delete)),
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
            if ($model->load($this->request->post())){
                $message = "";$success = true;
                $con = Yii::$app->db ;
                $transaction = $con->beginTransaction();
                try {
                    $model->code = $model->getCode();
                    $JawabanKuisionerDetail = $this->request->post()['JawabanKuisionerDetail'];
                    if(!empty($JawabanKuisionerDetail)){
                        foreach ($JawabanKuisionerDetail as $key => $value) {
                           
                            $detail = new JawabanKuisionerDetail();
                            $detail->code_jawaban = $model->code;
                            $detail->code_kuisioner = $value['code'];
                            $detail->jawaban = $value['pertanyaan'];
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
                        return $this->redirect(['view', 'code' => $model->code, 'nisn' => $model->nisn]);
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
        $magang = MagangDetail::find()->where(['nisn' => Yii::$app->user->identity->nis])->one();
        $model->nisn = isset($magang->nisn) ?$magang->nisn : '';
        $model->nama = isset($magang->nama) ?$magang->nama : '';
        $model->rombel = isset($magang->rombel) ?$magang->rombel : '';
        $model->jurusan = isset($magang->siswa->jurusan->nama) ? $magang->siswa->jurusan->nama : '';
        
        if(!empty($model->nisn)){
            $pertanyaan = MasterKuisioner::find()->where(['type' => 'MAGANG'])->andWhere("code_jurusan = '".$magang->siswa->code_jurusan."' or code_jurusan = '' ")->all();
            return $this->render('create', [
                'model' => $model,
                'pertanyaan' => $pertanyaan,
            ]);
        }else{
            Yii::$app->session->setFlash('warning',"Menu ini untuk siswa yang mengambil program magan dan belum mengisi kuisioner");
            return $this->redirect('site');
        }
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
