<?php

namespace app\models\torneio;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\torneio\TorneioModel;

/**
 * TorneioSearch represents the model behind the search form of `app\models\torneio\TorneioModel`.
 */
class TorneioSearch extends TorneioModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'modalidade_torneio', 'esporte_torneio', 'ativo_torneio'], 'integer'],
            [['nome_torneio'], 'safe'],
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
        $query = TorneioModel::find();

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
            'id' => $this->id,
            'modalidade_torneio' => $this->modalidade_torneio,
            'esporte_torneio' => $this->esporte_torneio,
            'ativo_torneio' => $this->ativo_torneio,
        ]);

        $query->andFilterWhere(['like', 'nome_torneio', $this->nome_torneio]);

        return $dataProvider;
    }
}
