<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MenuUser;

/**
 * MenuUserSearch represents the model behind the search form of `app\models\MenuUser`.
 */
class MenuUserSearch extends MenuUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user_menu', 'id_menu', 'create', 'update', 'read', 'delete'], 'integer'],
            [['user_id'], 'safe'],
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
        $query = MenuUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_user_menu' => $this->id_user_menu,
            'id_menu' => $this->id_menu,
            'create' => $this->create,
            'update' => $this->update,
            'read' => $this->read,
            'delete' => $this->delete,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
