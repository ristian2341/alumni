<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\models\User;
use app\models\StatusSiswa;
use app\modules\master\models\Jurusan;

/**
 * This is the model class for table "siswa".
 *
 * @property int $code
 * @property string|null $nipd
 * @property string|null $nisn
 * @property string|null $nik
 * @property string|null $nama
 * @property string|null $jen_kelamin P = Perempuan || L = Laki-Laki
 * @property string|null $tempat_lahir
 * @property string|null $tgl_lahir
 * @property string|null $alamat
 * @property string|null $rt
 * @property string|null $rw
 * @property string|null $dusun
 * @property string|null $kelurahan
 * @property string|null $kecamatan
 * @property string|null $kabupaten
 * @property string|null $kode_pos
 * @property string|null $jenis_tinggal
 * @property string|null $alat_transportasi
 * @property string|null $phone
 * @property string|null $handphone
 * @property string|null $email
 * @property int|null $skhun
 * @property string|null $no_kps
 * @property string|null $nama_ayah
 * @property string|null $tgl_lahir_ayah
 * @property string|null $pendidikan_ayah
 * @property string|null $pekerjaan_ayah
 * @property string|null $penghasilan_ayah
 * @property string|null $nik_ayah
 * @property string|null $nama_ibu
 * @property string|null $tgl_lahir_ibu
 * @property string|null $pendidikan_ibu
 * @property string|null $pekerjaan_ibu
 * @property string|null $penghasilan_ibu
 * @property string|null $nik_ibu
 * @property string|null $nama_wali
 * @property string|null $tgl_lahir_wali
 * @property string|null $pendidikan_wali
 * @property string|null $pekerjaan_wali
 * @property string|null $penghasilan_wali
 * @property string|null $nik_wali
 * @property string|null $rombel_now
 * @property string|null $no_peserta_ujian
 * @property string|null $no_seri_ijazah
 * @property string|null $nomor_kip
 * @property int|null $nama_di_kip
 * @property string|null $nomor_kks
 * @property string|null $no_akta_lahir
 * @property string|null $bank
 * @property string|null $no_rekening_bank
 * @property string|null $atas_nama_rekening
 * @property int|null $layak_pip
 * @property string|null $alasan_layak_pip
 * @property int|null $kebutuhan_khusus
 * @property string|null $sekolah_asal
 * @property int|null $anak_keberapa
 * @property int|null $lintang
 * @property int|null $bujur
 * @property string|null $no_kk
 * @property int|null $berat_badan
 * @property int|null $tinggi_badan
 * @property int|null $lingkar_kepala
 * @property int|null $jml_saudara
 * @property int|null $jarak_rumah
 */
class Siswa extends \yii\db\ActiveRecord
{
    public $file_upload,$file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siswa';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_lahir','lintang','bujur','mulai_bekerja'], 'safe'],
            [['skhun', 'nama_di_kip', 'anak_keberapa','berat_badan', 'tinggi_badan', 'lingkar_kepala', 'jml_saudara', 'jarak_rumah','created_at','updated_at','tgl_lahir_ayah','tgl_lahir_ibu', 'tgl_lahir_wali','id_status_siswa'], 'integer'],
            [['alasan_layak_pip'], 'string'],
            [['nipd', 'nisn', 'nik','created_by','updated_by','code_jurusan'], 'string', 'max' => 16],
            [['nama', 'alamat', 'sekolah_asal','alamat_perusahaan','jenis_usaha','lokasi_usaha','nama_universitas','jurusan_kuliah'], 'string', 'max' => 150],
            [['jen_kelamin'], 'string', 'max' => 1],
            [['foto','sosial_media'], 'string', 'max' => 255],
            [['tempat_lahir', 'dusun', 'kelurahan', 'kecamatan', 'kabupaten', 'jenis_tinggal', 'alat_transportasi', 'email', 'nama_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'penghasilan_ayah', 'nik_ayah', 'nama_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ibu', 'nik_ibu', 'nama_wali', 'pendidikan_wali', 'pekerjaan_wali', 'penghasilan_wali', 'nik_wali', 'rombel_now', 'no_peserta_ujian', 'no_seri_ijazah', 'nomor_kip', 'nomor_kks', 'no_akta_lahir', 'bank', 'no_rekening_bank', 'atas_nama_rekening','kebutuhan_khusus','whatsapp','perusahaan','jabatan'], 'string', 'max' => 100],
            [['rt', 'rw','tahun_lulus'], 'string', 'max' => 5],
            [['kode_pos'], 'string', 'max' => 10],
            [['phone', 'handphone'], 'string', 'max' => 15],
            [['no_kps'], 'string', 'max' => 50],
            [['no_kk', 'layak_pip'], 'string', 'max' => 20],
            [['file_upload','file'], 'file','maxFiles' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'nipd' => 'Nipd',
            'nisn' => 'Nisn',
            'nik' => 'Nik',
            'nama' => 'Nama',
            'jen_kelamin' => 'Jen Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tgl Lahir',
            'alamat' => 'Alamat',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'dusun' => 'Dusun',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kabupaten' => 'Kabupaten / Kota',
            'kode_pos' => 'Kode Pos',
            'jenis_tinggal' => 'Jenis Tinggal',
            'alat_transportasi' => 'Alat Transportasi',
            'phone' => 'Phone',
            'handphone' => 'Handphone',
            'email' => 'Email',
            'skhun' => 'Skhun',
            'no_kps' => 'No Kps',
            'nama_ayah' => 'Nama Ayah',
            'tgl_lahir_ayah' => 'Tahun Lahir Ayah',
            'pendidikan_ayah' => 'Pendidikan Ayah',
            'pekerjaan_ayah' => 'Pekerjaan Ayah',
            'penghasilan_ayah' => 'Penghasilan Ayah',
            'nik_ayah' => 'Nik Ayah',
            'nama_ibu' => 'Nama Ibu',
            'tgl_lahir_ibu' => 'Tahun Lahir Ibu',
            'pendidikan_ibu' => 'Pendidikan Ibu',
            'pekerjaan_ibu' => 'Pekerjaan Ibu',
            'penghasilan_ibu' => 'Penghasilan Ibu',
            'nik_ibu' => 'Nik Ibu',
            'nama_wali' => 'Nama Wali',
            'tgl_lahir_wali' => 'Tahun Lahir Wali',
            'pendidikan_wali' => 'Pendidikan Wali',
            'pekerjaan_wali' => 'Pekerjaan Wali',
            'penghasilan_wali' => 'Penghasilan Wali',
            'nik_wali' => 'Nik Wali',
            'rombel_now' => 'Rombel Now',
            'no_peserta_ujian' => 'No Peserta Ujian',
            'no_seri_ijazah' => 'No Seri Ijazah',
            'nomor_kip' => 'Nomor Kip',
            'nama_di_kip' => 'Nama Di Kip',
            'nomor_kks' => 'Nomor Kks',
            'no_akta_lahir' => 'No Akta Lahir',
            'bank' => 'Bank',
            'no_rekening_bank' => 'No Rekening Bank',
            'atas_nama_rekening' => 'Atas Nama Rekening',
            'layak_pip' => 'Layak Pip',
            'alasan_layak_pip' => 'Alasan Layak Pip',
            'kebutuhan_khusus' => 'Kebutuhan Khusus',
            'sekolah_asal' => 'Sekolah Asal',
            'anak_keberapa' => 'Anak Keberapa',
            'lintang' => 'Lintang',
            'bujur' => 'Bujur',
            'no_kk' => 'No Kk',
            'berat_badan' => 'Berat Badan',
            'tinggi_badan' => 'Tinggi Badan',
            'lingkar_kepala' => 'Lingkar Kepala',
            'jml_saudara' => 'Jml Saudara',
            'jarak_rumah' => 'Jarak Rumah',
            'foto' => 'Foto',
            'created_at' => 'Tgl Simpan',
            'created_by' => 'Dibuat Oleh',
            'updated_at' => 'Tgl Ubah',
            'updated_by' => 'Diubah Oleh',
            'id_status_siswa' => 'Status Siswa',
            'tahun_lulus' => 'Tahun Lulus',
            'code_jurusan' => 'Jurusan',
            'whatsapp' => 'Nomor WA',
            'perusahaan' => 'Nama Perusahaan',
            'alamat_perusahaan' => 'Alamat Perusahaan',
            'jabatan' => 'Jabatan',
            'mulai_bekerja' => 'Mulai Bekerja',
            'jenis_usaha' => 'Jenis Usaha',
            'lokasi_usaha' => 'Lokasi Usaha',
            'nama_universitas' => 'Nama Universitas',
            'jurusan_kuliah' => 'Jurusan Kuliah',
            'sosial_media' => 'Sosial Media (exp : Facebook : test@gmail.com)',
            'file' => 'File Foto',
        ];
    }

    public function getCreated()
    {
        $username = User::find()->select(['full_name'])->where(['user_id' => $this->created_by])->column();
        return $username[0];
    }

    public function getUpdated()
    {
        $username = User::find()->select(['full_name'])->where(['user_id' => $this->created_by])->column();
        return $username[0];
    }

    public function getStatusSiswa()
    {
        $status = StatusSiswa::find()->select(['status'])->where(['id' => $this->id_status_siswa])->column();
        return $status[0];
    }

    public function getJurusan()
    {
        return $this->hasOne(Jurusan::className(),['code'=>'code_jurusan']);
        return $this->hasOne(Jurusan::className(),['code'=>'code_jurusan']);
        return $this->hasOne(Jurusan::className(),['code'=>'code_jurusan']);
    }

    public function getCode()
    {
        $sDate = date('Ymd');
        $count = $this->find()->where(['like','code',$sDate])->count();
        $n = 0;
        if($count > 0){
            $model = $this->find()->where(['like','code',$sDate])->orderBy(['code' => SORT_DESC])->one();
            $n = (int)substr($model->code, -5);
        }
        return (string) $sDate.sprintf('%05s', ($n +1));
    }
}
