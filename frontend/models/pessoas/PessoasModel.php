<?php

namespace app\models\pessoas;

use app\models\EsporteModel;
use Yii;

/**
 * This is the model class for table "pessoa".
 *
 * @property int $id
 * @property string $nome
 * @property int $data_nascimento
 * @property int $id_cargo
 *
 * @property Cargo $cargo
 * @property EsporteModel[] $esportes
 * @property pessoaEsporte $pessoaEsporte
 */
class PessoasModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'data_nascimento', 'id_cargo'], 'required'],
            [[ 'id_cargo'], 'integer'],
            [['nome','data_nascimento'], 'string', 'max' => 50],
            [['id_cargo'], 'exist', 'skipOnError' => true, 'targetClass' => Cargo::class, 'targetAttribute' => ['id_cargo' => 'id']],
            [['esporte'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'data_nascimento' => 'data_nascimento',
            'id_cargo' => 'Id Cargo',
        ];
    }
    public function SalvarEsportes($pessoaId, $esportes)
    {
        PessoaEsporte::deleteAll(['id_pessoa' => $pessoaId]);
        if(!empty($esportes)){
            foreach ($esportes as $esporteId){
                $pessoaEsporte = new PessoaEsporte();
                $pessoaEsporte->id_pessoa = $pessoaId;
                $pessoaEsporte->id_esporte = $esporteId;
                $pessoaEsporte->save();

            }

        }
    }
  /**
   * @return void;
   */
    public function converterDataInt(){
        if(!empty($this->data_nascimento)){
            $this->data_nascimento = strtotime($this->data_nascimento);
        }
}



    /**
     * Gets query for [[Cargo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargo()
    {
        return $this->hasOne(Cargo::class, ['id' => 'id_cargo']);
    }

    /**
     * Gets query for [[Esportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEsportes()
    {
        return $this->hasMany(EsporteModel::class, ['id' => 'id_esporte'])
            ->via('pessoaEsportes');
    }

    /**
     * Gets query for [[PessoaEsportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPessoaEsportes()
    {
        return $this->hasMany(PessoaEsporte::class, ['id_pessoa' => 'id']);
    }


}
