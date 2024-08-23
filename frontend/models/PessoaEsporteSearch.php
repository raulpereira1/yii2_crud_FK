<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pessoas\PessoaEsporte;

/**
 * PessoaEsporteSearch represents the model behind the search form of `app\models\pessoas\PessoaEsporte`.
 */
class PessoaEsporteSearch extends PessoaEsporte
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_esporte', 'id_pessoa'], 'integer'],
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
        $query = PessoaEsporte::find();

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
            'id_esporte' => $this->id_esporte,
            'id_pessoa' => $this->id_pessoa,
        ]);

        return $dataProvider;
    }
}
