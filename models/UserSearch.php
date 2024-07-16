<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'nis', 'username', 'password', 'full_name', 'type_akun', 'device_id', 'fire_base', 'email', 'id_telegram', 'generate_code', 'type_user', 'authKey', 'accessToken', 'picture', 'created_by', 'updated_by'], 'safe'],
            [['last_login', 'long', 'lat', 'developer', 'approval', 'admin', 'status', 'created_at', 'updated_at'], 'integer'],
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
        $query = User::find();

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
            'last_login' => $this->last_login,
            'long' => $this->long,
            'lat' => $this->lat,
            'developer' => $this->developer,
            'approval' => $this->approval,
            'admin' => $this->admin,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'type_akun', $this->type_akun])
            ->andFilterWhere(['like', 'device_id', $this->device_id])
            ->andFilterWhere(['like', 'fire_base', $this->fire_base])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'id_telegram', $this->id_telegram])
            ->andFilterWhere(['like', 'generate_code', $this->generate_code])
            ->andFilterWhere(['like', 'type_user', $this->type_user])
            ->andFilterWhere(['like', 'authKey', $this->authKey])
            ->andFilterWhere(['like', 'accessToken', $this->accessToken])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
