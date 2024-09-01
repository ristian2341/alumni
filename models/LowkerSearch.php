<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lowker;

/**
 * LowkerSearch represents the model behind the search form of `app\models\Lowker`.
 */
class LowkerSearch extends Lowker
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_lowker', 'tgl_post', 'tgl_last', 'lowongan', 'id_perusahaan', 'nama_perusahaan', 'alamat', 'kabupaten', 'propinsi', 'kontak', 'email', 'requirement', 'keterangan', 'created_by', 'updated_by','jabatan'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
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
        $query = Lowker::find();

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
            'tgl_post' => $this->tgl_post,
            'tgl_last' => $this->tgl_last,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'code_lowker', $this->code_lowker])
            ->andFilterWhere(['like', 'lowongan', $this->lowongan])
            ->andFilterWhere(['like', 'id_perusahaan', $this->id_perusahaan])
            ->andFilterWhere(['like', 'nama_perusahaan', $this->nama_perusahaan])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'kabupaten', $this->kabupaten])
            ->andFilterWhere(['like', 'propinsi', $this->propinsi])
            ->andFilterWhere(['like', 'kontak', $this->kontak])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'requirement', $this->requirement])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'jabatan', $this->updated_by]);

        return $dataProvider;
    }
}
