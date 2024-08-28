<?php

namespace app\models\pessoaendereco;

use app\models\pessoas\PessoasModel;
use Yii;

/**
 * This is the model class for table "pessoa_endereco".
 *
 * @property int $id
 * @property int $cep
 * @property int $numero
 * @property string $cidade
 * @property string $estado
 * @property string $logradouro
 */
class PessoaEndereco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa_endereco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cep', 'numero','cidade', 'estado', 'logradouro'], 'required'],
            [['cep', 'numero'], 'integer'],
            [['cidade', 'estado', 'logradouro'], 'string', 'max' => 50],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cep' => 'Cep',
            'numero' => 'Numero',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'logradouro' => 'Logradouro',
        ];
    }
    public function getPessoa(){
        return $this->hasMany(PessoasModel::class,['id'=>'pessoa']);
    }
}
