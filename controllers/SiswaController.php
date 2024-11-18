<?php

namespace app\controllers;

use Yii;
use app\models\Siswa;
use app\models\User;
use app\models\StatusSiswa;
use app\models\SiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\Json;

//excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * SiswaController implements the CRUD actions for Siswa model.
 */
class SiswaController extends Controller
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
                            'allow' => ((!empty(Yii::$app->user->identity->developer) || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('data_siswa')->create)))),
                            'actions' => ['create'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => ((!empty(Yii::$app->user->identity->developer) || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('data_siswa')->read)))),
                            'actions' => ['index', 'view','import-excel','autocomplete-siswa','data-siswa','generate-user'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => ((!empty(Yii::$app->user->identity->developer)  || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('data_siswa')->update)))),
                            'actions' => ['update'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => (!empty(Yii::$app->user->identity->developer) || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('data_siswa')->delete))),
                            'actions' => ['delete'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => (!empty(Yii::$app->user->identity->developer) || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('data_profile')->update))),
                            // 'allow' => true,
                            'actions' => ['profile-update'],
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
     * Lists all Siswa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SiswaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Siswa model.
     * @param int $code Code
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
     * Creates a new Siswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Siswa();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'code' => $model->code]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Siswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $code Code
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($code)
    {
        $model = $this->findModel($code);

        if($this->request->isPost && $model->load($this->request->post())) 
        {
            if(!$model->save()){
                foreach($model->errors as $error=>$value)
                {
                    $message .= $value[0];
                }
                Yii::$app->session->setFlash('error',$message); 
            }
            return $this->redirect(['view', 'code' => $model->code]);
        }

        $status_siswa = StatusSiswa::find()->select("status")->indexBy("id")->column();
        $year1 = date('Y') - 10;
        $year2 = date('Y');
        $tahun_lulus[""] = "";
        while ($year1 <= $year2) {
            $tahun_lulus[$year1] = $year1;
            $year1++;
        }
  
        $model->tahun_lulus = empty($model->tahun_lulus) ? "" : $model->tahun_lulus;
        return $this->render('update', [
            'model' => $model,
            'status_siswa' => $status_siswa,
            'tahun' => $tahun_lulus,
        ]);
    }

    /**
     * Deletes an existing Siswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $code Code
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($code)
    {
        $this->findModel($code)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Siswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $code Code
     * @return Siswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($code)
    {
        if (($model = Siswa::findOne(['code' => $code])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionImportExcel()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        ini_set('memory_limit','1024M'); 
		ini_set('max_execution_time', 1000);
		$success = true;
		$message = '';

        if(Yii::$app->request->isPost)
        {  
            $model = new Siswa();
            if(!empty($_FILES)){
                $fileupload  = @$_FILES['file_upload']['tmp_name'];
                $name      = $_FILES['file_upload']['name'];
                $type      = $_FILES['file_upload']['type'];
            
                if($fileupload)
                {
                    $spreadsheet = IOFactory::load($fileupload);
                    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                    if($sheetData)
                    {
                        $connection = \Yii::$app->db;
                        $transaction = $connection->beginTransaction();
                        try {
                            foreach($sheetData as $index=>$data)
                            {
                                if(!empty($data['E']) && $data['E'] !='NISN'){
                                    $model = Siswa::find()->where(['nisn' => $data['E']])->one();
                                    if(empty($model)){
                                        $proses = $this->insertData($data);
                                    }else{
                                        $proses = $this->updateData($data,$model->code);
                                    }
                                    $success = $proses['success'];
                                    $message = $proses['message'];
                                }
                            }
    
                            if($success)
                            {
                                $transaction->commit();
                                $message = "Success Upload data siswa";
                            }else{
                                $transaction->rollback();
                                $message = "Gagal Upload data siswa";
                            }
                        } catch (\Exception $e) {
                            $transaction->rollback();
                            $message = $e->getMessage();
                        }
                    }
                }
                else{
                    $success = false;
                    $message = "Gagal Upload data siswa";
                }
            }
        }else{
            $message = "Gagal Upload data siswa";
        }
        return ['success' => $success,'message' => $message];
    }

    private function insertData($data)
    {
        $success = true;$message = "";

        $model = new Siswa();
        $model->code = $model->getCode();
        $model->nipd = $data['C'];
        $model->nisn = $data['E'];
        $model->nik = $data['H'];
        $model->nama = strtoupper($data['B']);
        $model->jen_kelamin = strtoupper($data['D']);
        $model->tempat_lahir = strtoupper($data['F']);
        $model->tgl_lahir = $data['G'];
        $model->alamat = $data['J'];
        $model->rt = $data['K'];
        $model->rw = $data['L'];
        $model->dusun = $data['M'];
        $model->kelurahan = $data['N'];
        $model->kecamatan = $data['O'];
        $model->kabupaten = 'Surabaya';
        $model->kabupaten = 'Jawa Timur';
        $model->kode_pos = $data['P'];
        $model->jenis_tinggal = $data['Q'];
        $model->alat_transportasi = $data['R'];
        $model->phone = $data['S'];
        $model->handphone = $data['T'];
        $model->email = $data['U'];
        $model->skhun = $data['V'];
        $model->no_kps = $data['X'];
        $model->nama_ayah = $data['Y'];
        $model->tgl_lahir_ayah = !empty($data['Z']) ? $data['Z'] : 0;
        $model->pendidikan_ayah = $data['AA'];
        $model->pekerjaan_ayah = $data['AB'];
        $model->penghasilan_ayah = $data['AC'];
        $model->nik_ayah = $data['AD'];
        $model->nama_ibu = $data['AE'];
        $model->tgl_lahir_ibu = !empty($data['AF']) ? $data['AF'] : 0;
        $model->pendidikan_ibu = $data['AG'];
        $model->pekerjaan_ibu = $data['AH'];
        $model->penghasilan_ibu = $data['AI'];
        $model->nik_ibu = $data['AJ'];
        $model->nama_wali = $data['AK'];
        $model->tgl_lahir_wali = !empty($data['AL']) ? $data['AL'] : 0;
        $model->pendidikan_wali = $data['AM'];
        $model->pekerjaan_wali = $data['AN'];
        $model->penghasilan_wali = $data['AO'];
        $model->nik_wali = $data['AP'];
        $model->rombel_now = $data['AQ'];
        $model->no_peserta_ujian = $data['AR'];
        $model->no_seri_ijazah = $data['AS'];
        $model->nomor_kip = $data['AU'];
        $model->nama_di_kip = $data['AV'];
        $model->nomor_kks = $data['AW'];
        $model->no_akta_lahir = $data['AX'];
        $model->bank = $data['AY'];
        $model->no_rekening_bank = $data['AZ'];
        $model->atas_nama_rekening = $data['BA'];
        $model->layak_pip = !empty($data['BB']) ? $data['BB'] : 'Tidak';
        $model->alasan_layak_pip = $data['BC'];
        $model->kebutuhan_khusus = !empty($data['BD']) ? $data['BD'] : 'Tidak';
        $model->sekolah_asal = $data['BE'];
        $model->anak_keberapa = $data['BF'];
        $model->lintang = !empty($data['BG']) ? $data['BG'] : '';
        $model->bujur = !empty($data['BH']) ? $data['BH'] : '';
        $model->berat_badan = $data['BJ'];
        $model->tinggi_badan = $data['BK'];
        $model->lingkar_kepala = $data['BL'];
        $model->jml_saudara = $data['BL'];
        $model->jarak_rumah = $data['BL'];
        if(!$model->save()){
            $success = false;
            foreach($model->errors as $error => $value){
                $message .= $value[0].', ';
            }
            $message = substr($message, 0, -2);
        }

        return ['success' => $success,'message' => $message];
    }

    private function updateData($data,$code)
    {
        $success = true;$message = "";

        $model = Siswa::find()->where(['code' => $code])->one();
        if(!empty($model)){
               $model->nipd = $data['C'];
               $model->nisn = $data['E'];
               $model->nik = $data['H'];
               $model->nama = strtoupper($data['B']);
               $model->jen_kelamin = strtoupper($data['D']);
               $model->tempat_lahir = strtoupper($data['F']);
               $model->tgl_lahir = $data['G'];
               $model->alamat = $data['J'];
               $model->rt = $data['K'];
               $model->rw = $data['L'];
               $model->dusun = $data['M'];
               $model->kelurahan = $data['N'];
               $model->kecamatan = $data['O'];
               $model->kabupaten = 'Surabaya';
               $model->kabupaten = 'Jawa Timur';
               $model->kode_pos = $data['P'];
               $model->jenis_tinggal = $data['Q'];
               $model->alat_transportasi = $data['R'];
               $model->phone = $data['S'];
               $model->handphone = $data['T'];
               $model->email = $data['U'];
               $model->skhun = $data['V'];
               $model->no_kps = $data['X'];
               $model->nama_ayah = $data['Y'];
               $model->tgl_lahir_ayah = !empty($data['Z']) ? $data['Z'] : 0;
               $model->pendidikan_ayah = $data['AA'];
               $model->pekerjaan_ayah = $data['AB'];
               $model->penghasilan_ayah = $data['AC'];
               $model->nik_ayah = $data['AD'];
               $model->nama_ibu = $data['AE'];
               $model->tgl_lahir_ibu = !empty($data['AF']) ? $data['AF'] : 0;
               $model->pendidikan_ibu = $data['AG'];
               $model->pekerjaan_ibu = $data['AH'];
               $model->penghasilan_ibu = $data['AI'];
               $model->nik_ibu = $data['AJ'];
               $model->nama_wali = $data['AK'];
               $model->tgl_lahir_wali = !empty($data['AL']) ? $data['AL'] : 0;
               $model->pendidikan_wali = $data['AM'];
               $model->pekerjaan_wali = $data['AN'];
               $model->penghasilan_wali = $data['AO'];
               $model->nik_wali = $data['AP'];
               $model->rombel_now = $data['AQ'];
               $model->no_peserta_ujian = $data['AR'];
               $model->no_seri_ijazah = $data['AS'];
               $model->nomor_kip = $data['AU'];
               $model->nama_di_kip = $data['AV'];
               $model->nomor_kks = $data['AW'];
               $model->no_akta_lahir = $data['AX'];
               $model->bank = $data['AY'];
               $model->no_rekening_bank = $data['AZ'];
               $model->atas_nama_rekening = $data['BA'];
               $model->layak_pip = !empty($data['BB']) ? $data['BB'] : 0;
               $model->alasan_layak_pip = $data['BC'];
               $model->kebutuhan_khusus = !empty($data['BD']) ? $data['BD'] : 0;
               $model->sekolah_asal = $data['BE'];
               $model->anak_keberapa = $data['BF'];
               $model->lintang = !empty($data['BG']) ? $data['BG'] : '';
               $model->bujur = !empty($data['BH']) ? $data['BH'] : '';
               $model->berat_badan = $data['BJ'];
               $model->tinggi_badan = $data['BK'];
               $model->lingkar_kepala = $data['BL'];
               $model->jml_saudara = $data['BL'];
               $model->jarak_rumah = $data['BL'];
               if(!$model->save()){
                   $success = false;
                   foreach($model->errors as $error => $value){
                       $message .= $value[0].', ';
                   }
                   $message = substr($message, 0, -2);
               }
        }

        return ['success' => $success,'message' => $message];
    }

    public function actionProfileUpdate()
    {
        $nisn = isset($_GET['nisn']) ? $_GET['nisn'] : (isset(Yii::$app->user->identity->nis) ? Yii::$app->user->identity->nis : '');
        $success = true;$message="";

        $model = Siswa::find()->where(['nisn' => $nisn])->one();
        
        if(!empty($model)){
            if($this->request->isPost) 
            {
                if($model->load($this->request->post())){
    
                    $connection = \Yii::$app->db;
                    $transaction = $connection->beginTransaction();
                    try {
                        $model->file = UploadedFile::getInstance($model, 'file');
                        if(!empty($model->file)){
                            $path = 'img/foto_siswa/'.$model->nisn."/";
                            if(!file_exists ($path))
                            {
                                mkdir($path, 0777, true);
                            }
                            
                            $model->file->saveAs($path. $model->nisn . '.' . $model->file->extension);
                            $model->foto = $path.$model->nisn .'.'. $model->file->extension;
                        }
                        
                        if($model->id_status_siswa == 1 || $model->id_status_siswa == 2){
                            $model->perusahaan = "";
                            $model->alamat_perusahaan = "";
                            $model->jabatan = "";
                            $model->mulai_bekerja = "";
                            $model->jenis_usaha = "";
                            $model->lokasi_usaha = "";
                            $model->nama_universitas = "";
                            $model->jurusan_kuliah = "";
                        }
                        if($model->id_status_siswa == 3){
                            $model->perusahaan = "";
                            $model->alamat_perusahaan = "";
                            $model->jabatan = "";
                            $model->mulai_bekerja = "";
                            $model->jenis_usaha = "";
                            $model->lokasi_usaha = "";
                        }
                        if($model->id_status_siswa == 4){
                            $model->perusahaan = "";
                            $model->alamat_perusahaan = "";
                            $model->jabatan = "";
                            $model->mulai_bekerja = "";
                            $model->nama_universitas = "";
                            $model->jurusan_kuliah = "";
                        }
                        if($model->id_status_siswa == 5){
                            $model->jenis_usaha = "";
                            $model->lokasi_usaha = "";
                            $model->nama_universitas = "";
                            $model->jurusan_kuliah = "";
                            $model->mulai_bekerja = date('Y-m-d',strtotime($model->mulai_bekerja));
                        }
                        
                        if(!$model->save()){
                            foreach($model->errors as $error=>$value)
                            {
                                $message .= $value[0];
                            }
                            Yii::$app->session->setFlash('error',$message); 
                        }
        
                        if($success){
                            $transaction->commit();
                        }
                    } catch (\Exception $e) {
                        $transaction->rollback();
                        $message = $e->getMessage();
                    }
                }
            }

            $status_siswa = StatusSiswa::find()->select("status")->indexBy("id")->column();
            return $this->render('profile_siswa', [
                'model' => $model,
                'status_siswa' => $status_siswa
            ]);
        }else{
            Yii::$app->session->setFlash('error',"Anda tidak memiliki akses untuk halaman ini"); 
            return $this->redirect('site');
        }
    }

    public function actionAutocompleteSiswa()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $result = [];$data=[];$datasiswa = [];
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        if($q != ''){
            $data = Siswa::find()->Where("(nama like '%".$q."%' or nisn like '%".$q."%')")->limit(50)->all();
        }else{
            $data = Siswa::find()->limit(50)->all();
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

    public function actionGenerateUser()
    {
        ini_set('memory_limit','1024M'); 
		ini_set('max_execution_time', 1000000);
		$success = true;
        $model = Siswa::find()->where("nisn not in(select nis from user)")->all();
        if(!empty($model)){
            foreach ($model as $key => $data) {
                if(!empty($data->nisn)){
                    $user = new User();
                    $user->user_id = $user->getUserId();
                    $user->type_akun = "siswa";
                    $user->type_user = "siswa";
                    $user->username = $data->nisn;
                    $user->password = Yii::$app->getSecurity()->generatePasswordHash($data->nisn);
                    $user->full_name = $data->nama;
                    $user->nis = $data->nisn;
                    $user->email = $data->email;
                    $user->phone = $data->handphone;
                    $user->alamat = $data->alamat." rt/rw ".$data->rt."/".$data->rw." ".$data->kelurahan." ".$data->kecamatan;
                    $user->kota ="";
                    $user->propinsi = $data->kabupaten;
                    $user->status = 1;
                    if(!$user->save()){
                        Yii::$app->session->setFlash('error', $user->errors);
                        $success = false;
                    }
                }
            }
        }
        if($success){
            Yii::$app->session->setFlash('success', "Generate User Siswa Berhasil");
        }else{
            Yii::$app->session->setFlash('error', "Generate User Siswa ada yang gagal");
        }
        return $this->redirect(['siswa/index']);
    }

}