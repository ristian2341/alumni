<?php

namespace app\modules\magang\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\magang\models\Magang;

/**
 * MagangSearch represents the model behind the search form of `app\modules\magang\models\Magang`.
 */
class MagangSearch extends Magang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'code_perusahaan', 'nama_perusahaan', 'pic', 'tgl_mulai', 'tgl_akhir', 'created_by', 'updated_by'], 'safe'],
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
        $query = Magang::find();

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
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_akhir' => $this->tgl_akhir,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'code_perusahaan', $this->code_perusahaan])
            ->andFilterWhere(['like', 'nama_perusahaan', $this->nama_perusahaan])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
