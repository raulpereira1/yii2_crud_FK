<?php

namespace app\models\pessoaendereco;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pessoaendereco\PessoaEndereco;

/**
 * PessoaEnderecoSearch represents the model behind the search form of `app\models\pessoa-endereco\PessoaEndereco`.
 */
class PessoaEnderecoSearch extends PessoaEndereco
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cep', 'numero'], 'integer'],
            [['cidade', 'estado', 'logradouro'], 'safe'],
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
        $query = PessoaEndereco::find();

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
            'cep' => $this->cep,
            'numero' => $this->numero,
        ]);

        $query->andFilterWhere(['like', 'cidade', $this->cidade])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'logradouro', $this->logradouro]);

        return $dataProvider;
    }
}
