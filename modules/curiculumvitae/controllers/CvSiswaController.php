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
use yii\web\UploadedFile;
use yii\helpers\Url;

use kartik\mpdf\Pdf;
use Mpdf\Mpdf;

use app\models\Setting;

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
                        'actions' => ['input-data','add-row-pendidikan','load-temp-table','add-row-pengalaman','load-temp-pengalaman','print-cv'],
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
        unset($session_detail['detail_pengalaman']);
       
        Yii::$app->session->set('detail_pengalaman',$detail);
        $data_detail = isset($detail) ? $detail : [];
        $result = $this->renderPartial('table_pengalaman',[
            'model_detail' => $data_detail,
        ]);
        

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
                    $model->code = $model->getCode();
                    $session =  Yii::$app->session;
                    $pendidikan = isset($session['detail_pendidikan']) ? $session['detail_pendidikan'] : [];
                    $model->pendidikan = !empty($pendidikan) ? json_encode($pendidikan,true) : (isset($model->pendidikan) ? $model->pendidikan : "");
                    $pengalaman = isset($session['detail_pengalaman']) ? $session['detail_pengalaman'] : [];
                    $model->pengalaman = !empty($pengalaman) ? json_encode($pengalaman,true) : (isset($model->pengalaman) ? $model->pengalaman : ""); 

                    // add foto //
                    $model->file = UploadedFile::getInstance($model, 'file');
                    if(!empty($model->file)){
                        $path = 'img/cv/'.$model->nik."/";
                        if(!file_exists($path))
                        {
                            mkdir($path, 0777, true);
                        }
                        if(file_exists($path.$model->nik .'.'. $model->file->extension)){
                            unlink($path.$model->nik .'.'. $model->file->extension);
                        }
                        $model->file->saveAs($path. $model->nik . '.' . $model->file->extension);
                        $model->path_foto = $path.$model->nik .'.'. $model->file->extension;
                    }

                    if(!$model->save()){
                        foreach($model->errors as $error=>$value)
                        {
                            $message .= $value[0];
                        }
                        Yii::$app->session->setFlash('error',$message); 
                    }
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
            unset($session_detail['detail_pengalaman']);   
           
            if(!empty($model->pendidikan)){
                $pendidikan = isset($model->pendidikan) ? json_decode($model->pendidikan) : "";
              
                if(!empty($pendidikan)){
                    foreach ($pendidikan as $key => $data) {
                        $periode1 = isset($data->periode1) ? strtoupper($data->periode1) : '';
                        $periode2 = isset($data->periode2) ? strtoupper($data->periode2) : '';
                        $detail[]=[
                            'number' => isset($detail) ? count($detail) + 1 : 1,
                            'sekolah' => isset($data->sekolah) ? strtoupper($data->sekolah) : '',
                            'jurusan' => isset($data->actionAddRowPendidikanjurusan) ? strtoupper($data->jurusan) : '',
                            'periode' => $periode1."-".$periode2,
                            'periode1' => $periode1,
                            'periode2' => $periode2,
                        ];
                    }
                    Yii::$app->session->set('detail_pendidikan',$detail);
                }
            }

            if(!empty($model->pengalaman)){
                $pengalaman = isset($model->pengalaman) ? json_decode($model->pengalaman) : "";
                if(!empty($pengalaman)){
                    foreach ($pengalaman as $key => $data) {
                        if(isset($data->perusahaan)){
                            $tahun1 = isset($data->tahun1) ? strtoupper($data->tahun1) : '';
                            $tahun2 = isset($data->tahun2) ? strtoupper($data->tahun2) : '';
                            $data_pengalaman[]=[
                                'number' => isset($detail) ? count($detail) + 1 : 1,
                                'perusahaan' => isset($data->perusahaan) ? strtoupper($data->perusahaan) : '',
                                'jabatan' =>isset($data->jabatan) ? strtoupper($data->jabatan) : '',
                                'tahun1' => $tahun1,
                                'tahun2' => $tahun2,
                            ];
                        }
                    }
                    Yii::$app->session->set('detail_pengalaman',$data_pengalaman);
                }
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

    public function actionAddRowPengalaman(){
        $detail = [];$data_detail=[];
    
        $number = isset($_POST['number']) ? $_POST['number'] : '';
        $perusahaan = isset($_POST['perusahaan']) ? $_POST['perusahaan'] : '';
        $jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';
        $tahun1 = isset($_POST['tahun1']) ? $_POST['tahun1'] : '';
        $tahun2 = isset($_POST['tahun2']) ? $_POST['tahun2'] : '';
        $action = isset($_POST['action']) ? $_POST['action'] : '';

        $detail = Yii::$app->session->get('detail_pengalaman');
        if($action == 'add'){
            if($number != ''){
                $detail[$number]=[
                    'perusahaan' => strtoupper($perusahaan),
                    'jabatan' => strtoupper($jabatan),
                    'tahun1' => $tahun1,
                    'tahun2' => $tahun2,
                ];
            }else{
                $detail[]=[
                    'number' => isset($detail) ? count($detail) + 1 : 1,
                    'perusahaan' => strtoupper($perusahaan),
                    'jabatan' => strtoupper($jabatan),
                    'tahun1' => $tahun1,
                    'tahun2' => $tahun2,
                ];
            }
        }elseif($action == 'delete'){
            unset($detail[$number]);
        }
       
        Yii::$app->session->set('detail_pengalaman',$detail);
        $data_detail = isset($detail) ? $detail : [];
        $result = $this->renderPartial('table_pengalaman',[
            'model_detail' => $data_detail,
        ]);
        
        return $result;
    }

    public function actionLoadTempPengalaman()
    {
        $data_detail = Yii::$app->session->get('detail_pengalaman');
       
        $result = $this->renderPartial('table_pengalaman',[
            'model_detail' => $data_detail,
        ]);
        
        return $result;
    }

    public function actionPrintCv()
    {
        $code  = isset($_GET['code']) ? $_GET['code'] : '';
        $setting = Setting::find()->where(['id_setting' => 1])->one();

        if(!empty($code)){
            $model = CvSiswa::find()->where(['code' => $code])->one();
            $data_siswa = Siswa::find()->where(['nik' => $model->nik])->one();     
            
            $content = $this->renderPartial('_file_pdf',[
				'model'=>$model,
                'data_siswa' => $data_siswa
			]);

             // set mpdf //
            $pdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_top' => 0,
                'margin_bottom' => 0,
                'margin_header' => 0,
                'margin_footer' => 0,
            ]);
            $pdf->SetDisplayMode('fullpage');
            $pdf->addPage();
            $pdf->SetDefaultBodyCSS('background-image', url::To("background_cv.png"));
            $pdf->SetDefaultBodyCSS('background-image-resize', 6);
            $pdf->WriteHTML($content);
            $pdf->OutPut();
            exit;
        }
    }
}
