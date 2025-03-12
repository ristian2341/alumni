<?php

namespace app\modules\curiculumvitae\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\curiculumvitae\models\CvSiswa;

/**
 * CvSiswaSearch represents the model behind the search form of `app\modules\curiculumvitae\models\CvSiswa`.
 */
class CvSiswaSearch extends CvSiswa
{
    public $jurusan;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'nik', 'pendidikan', 'pengalaman', 'kemampuan','jurusan','nama'], 'safe'],
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
        $query = CvSiswa::find()
            ->select("`cv_siswa`.*,jurusan.nama jurusan")
            ->leftJoin('siswa','cv_siswa.nik=siswa.nik')
            ->leftJoin('jurusan','siswa.code_jurusan = jurusan.code');
        
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'pendidikan', $this->pendidikan])
            ->andFilterWhere(['like', 'pengalaman', $this->pengalaman])
            ->andFilterWhere(['like', 'siswa.nama', $this->nama])
            ->andFilterWhere(['like', 'kemampuan', $this->kemampuan]);
        
        return $dataProvider;
    }
}
