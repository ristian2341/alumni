<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Siswa;

/**
 * SiswaSearch represents the model behind the search form of `app\models\Siswa`.
 */
class SiswaSearch extends Siswa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'skhun', 'nama_di_kip', 'layak_pip', 'kebutuhan_khusus', 'anak_keberapa', 'lintang', 'bujur', 'berat_badan', 'tinggi_badan', 'lingkar_kepala', 'jml_saudara', 'jarak_rumah', 'created_at', 'updated_at'], 'integer'],
            [['nipd', 'nisn', 'nik', 'nama', 'jen_kelamin', 'tempat_lahir', 'tgl_lahir', 'alamat', 'rt', 'rw', 'dusun', 'kelurahan', 'kecamatan', 'kabupaten', 'kode_pos', 'jenis_tinggal', 'alat_transportasi', 'phone', 'handphone', 'email', 'no_kps', 'nama_ayah', 'tgl_lahir_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'penghasilan_ayah', 'nik_ayah', 'nama_ibu', 'tgl_lahir_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ibu', 'nik_ibu', 'nama_wali', 'tgl_lahir_wali', 'pendidikan_wali', 'pekerjaan_wali', 'penghasilan_wali', 'nik_wali', 'rombel_now', 'no_peserta_ujian', 'no_seri_ijazah', 'nomor_kip', 'nomor_kks', 'no_akta_lahir', 'bank', 'no_rekening_bank', 'atas_nama_rekening', 'alasan_layak_pip', 'sekolah_asal', 'no_kk', 'created_by', 'updated_by','code_jurusan'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Siswa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'code' => $this->code,
            'tgl_lahir' => $this->tgl_lahir,
            'skhun' => $this->skhun,
            'tgl_lahir_ayah' => $this->tgl_lahir_ayah,
            'tgl_lahir_ibu' => $this->tgl_lahir_ibu,
            'tgl_lahir_wali' => $this->tgl_lahir_wali,
            'nama_di_kip' => $this->nama_di_kip,
            'layak_pip' => $this->layak_pip,
            'kebutuhan_khusus' => $this->kebutuhan_khusus,
            'anak_keberapa' => $this->anak_keberapa,
            'lintang' => $this->lintang,
            'bujur' => $this->bujur,
            'berat_badan' => $this->berat_badan,
            'tinggi_badan' => $this->tinggi_badan,
            'lingkar_kepala' => $this->lingkar_kepala,
            'jml_saudara' => $this->jml_saudara,
            'jarak_rumah' => $this->jarak_rumah,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'code_jurusan' => $this->code_jurusan,
        ]);

        $query->andFilterWhere(['like', 'nipd', $this->nipd])
            ->andFilterWhere(['like', 'nisn', $this->nisn])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jen_kelamin', $this->jen_kelamin])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'rt', $this->rt])
            ->andFilterWhere(['like', 'rw', $this->rw])
            ->andFilterWhere(['like', 'dusun', $this->dusun])
            ->andFilterWhere(['like', 'kelurahan', $this->kelurahan])
            ->andFilterWhere(['like', 'kecamatan', $this->kecamatan])
            ->andFilterWhere(['like', 'kabupaten', $this->kabupaten])
            ->andFilterWhere(['like', 'kode_pos', $this->kode_pos])
            ->andFilterWhere(['like', 'jenis_tinggal', $this->jenis_tinggal])
            ->andFilterWhere(['like', 'alat_transportasi', $this->alat_transportasi])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'handphone', $this->handphone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'no_kps', $this->no_kps])
            ->andFilterWhere(['like', 'nama_ayah', $this->nama_ayah])
            ->andFilterWhere(['like', 'pendidikan_ayah', $this->pendidikan_ayah])
            ->andFilterWhere(['like', 'pekerjaan_ayah', $this->pekerjaan_ayah])
            ->andFilterWhere(['like', 'penghasilan_ayah', $this->penghasilan_ayah])
            ->andFilterWhere(['like', 'nik_ayah', $this->nik_ayah])
            ->andFilterWhere(['like', 'nama_ibu', $this->nama_ibu])
            ->andFilterWhere(['like', 'pendidikan_ibu', $this->pendidikan_ibu])
            ->andFilterWhere(['like', 'pekerjaan_ibu', $this->pekerjaan_ibu])
            ->andFilterWhere(['like', 'penghasilan_ibu', $this->penghasilan_ibu])
            ->andFilterWhere(['like', 'nik_ibu', $this->nik_ibu])
            ->andFilterWhere(['like', 'nama_wali', $this->nama_wali])
            ->andFilterWhere(['like', 'pendidikan_wali', $this->pendidikan_wali])
            ->andFilterWhere(['like', 'pekerjaan_wali', $this->pekerjaan_wali])
            ->andFilterWhere(['like', 'penghasilan_wali', $this->penghasilan_wali])
            ->andFilterWhere(['like', 'nik_wali', $this->nik_wali])
            ->andFilterWhere(['like', 'rombel_now', $this->rombel_now])
            ->andFilterWhere(['like', 'no_peserta_ujian', $this->no_peserta_ujian])
            ->andFilterWhere(['like', 'no_seri_ijazah', $this->no_seri_ijazah])
            ->andFilterWhere(['like', 'nomor_kip', $this->nomor_kip])
            ->andFilterWhere(['like', 'nomor_kks', $this->nomor_kks])
            ->andFilterWhere(['like', 'no_akta_lahir', $this->no_akta_lahir])
            ->andFilterWhere(['like', 'bank', $this->bank])
            ->andFilterWhere(['like', 'no_rekening_bank', $this->no_rekening_bank])
            ->andFilterWhere(['like', 'atas_nama_rekening', $this->atas_nama_rekening])
            ->andFilterWhere(['like', 'alasan_layak_pip', $this->alasan_layak_pip])
            ->andFilterWhere(['like', 'sekolah_asal', $this->sekolah_asal])
            ->andFilterWhere(['like', 'no_kk', $this->no_kk])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
