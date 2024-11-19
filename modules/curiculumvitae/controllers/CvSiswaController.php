<?php

namespace app\modules\curiculumvitae\controllers;

use Yii;   
use app\modules\curiculumvitae\models\CvSiswa;
use app\modules\curiculumvitae\models\CvSiswaSearch;
use app\models\Siswa;

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
                        'actions' => ['update','autocomplete-siswa'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['input-data','add-row-pendidikan','load-temp-table'],
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

        $session_detail = Yii::$app->session; 
        unset($session_detail['detail_pendidikan']);

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
        $nis = isset(Yii::$app->user->identity->nis) ? Yii::$app->user->identity->nis : '';
        $data_siswa = Siswa::find()->where(['nisn' => $nis])->andWhere("id_status_siswa in (select id from status_siswa where status <> 'Belum Lulus')")->one();        
        if(!empty($data_siswa)){
            $model = CvSiswa::find()->where(['nik' => $data_siswa->nik])->one();
            if(empty($model)){
                $model = new CvSiswa(); 
            }

            if($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    
                }
            }
            
            $model->nik = isset($data_siswa->nik) ?  $data_siswa->nik: '';
            $model->nama = isset($data_siswa->nama) ? $data_siswa->nama : '';
            $model->tempat_lahir = isset($data_siswa->tempat_lahir) ? $data_siswa->tempat_lahir : '';
            $model->tanggal_lahir = (!empty($data_siswa->tgl_lahir) && ($data_siswa->tgl_lahir != '0000-00-00')) ? $data_siswa->tgl_lahir : null;
            $alamat = (isset($data_siswa->alamat) ? $data_siswa->alamat : '' )." RT/RW ".(isset($data_siswa->rt) ? $data_siswa->rt : '' )."/".(isset($data_siswa->rt) ? $data_siswa->rt : '' )." ".(isset($data_siswa->dusun) ? $data_siswa->dusun : '' )." ".(isset($data_siswa->kelurahan) ? $data_siswa->kelurahan : '' )." ".(isset($data_siswa->kecamatan) ? $data_siswa->kecamatan : '' );
            $model->alamat_tinggal = $alamat;
            $model->kontak = isset($data_siswa->handphone) ? $data_siswa->handphone : '';
            $model->email = isset($data_siswa->email) ? $data_siswa->email : '';

            $session_detail = Yii::$app->session; 
            unset($session_detail['detail_pendidikan']);

            if(!empty($model->pendidikan)){
                $pendidikan = json_decode($model->pendidikan);
                foreach ($pendidikan as $key => $data) {
                    $periode1 = isset($data['periode1']) ? strtoupper($data['periode1']) : '';
                    $periode2 = isset($data['periode2']) ? strtoupper($data['periode2']) : '';
                    $detail[]=[
                        'number' => isset($detail) ? count($detail) + 1 : 1,
                        'sekolah' => isset($data['sekolah']) ? strtoupper($data['sekolah']) : '',
                        'jurusan' => isset($data['jurusan']) ? strtoupper($data['jurusan']) : '',
                        'periode' => $periode1."-".$periode2,
                        'periode1' => $periode1,
                        'periode2' => $periode2,
                    ];
                }
                Yii::$app->session->set('detail_pendidikan',$detail);
            }
            
            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            Yii::$app->session->setFlash('warning',"Menu ini untuk siswa yang sudah lulus");
            return $this->redirect('site');
        }
    }

    public function actionAddRowPendidikan()
    {
        $detail = [];$data_detail=[];
    
        $number = isset($_POST['number']) ? $_POST['number'] : '';
        $sekolah = isset($_POST['sekolah']) ? $_POST['sekolah'] : '';
        $jurusan = isset($_POST['jurusan']) ? $_POST['jurusan'] : '';
        $periode1 = isset($_POST['periode1']) ? $_POST['periode1'] : '';
        $periode2 = isset($_POST['periode2']) ? $_POST['periode2'] : '';
        $action = isset($_POST['action']) ? $_POST['action'] : '';

        $detail = Yii::$app->session->get('detail_pendidikan');
        if($action == 'add'){
            if($number != ''){
                $detail[$number]=[
                    'sekolah' => strtoupper($sekolah),
                    'jurusan' => strtoupper($jurusan),
                    'periode' => $periode1."-".$periode2,
                    'periode1' => $periode1,
                    'periode2' => $periode2,
                ];
            }else{
                $detail[]=[
                    'number' => isset($detail) ? count($detail) + 1 : 1,
                    'sekolah' => strtoupper($sekolah),
                    'jurusan' => strtoupper($jurusan),
                    'periode' => $periode1."-".$periode2,
                    'periode1' => $periode1,
                    'periode2' => $periode2,
                ];
            }
        }elseif($action == 'delete'){
            unset($detail[$number]);
        }
        Yii::$app->session->set('detail_pendidikan',$detail);
        $data_detail = isset($detail) ? $detail : [];
        $result = $this->renderPartial('table_detail',[
            'model_detail' => $data_detail,
        ]);
        
        return $result;
    }

    public function actionLoadTempTable()
    {
        
        $data_detail = Yii::$app->session->get('detail_pendidikan');;
        $result = $this->renderPartial('table_detail',[
            'model_detail' => $data_detail,
        ]);
        
        return $result;
    }
}
