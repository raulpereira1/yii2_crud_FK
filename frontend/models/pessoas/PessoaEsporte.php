<?php

namespace app\models\pessoas;

use app\models\EsporteModel;
use Yii;
/**
 * This is the model class for table "pessoa_esporte".
 *
 * @property int $id_esporte
 * @property int $id_pessoa
 *
 * @property EsporteModel $esporte
 * @property PessoasModel $pessoa
 */
class PessoaEsporte extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa_esporte';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_esporte', 'id_pessoa'], 'required'],
            [['id_esporte', 'id_pessoa'], 'integer'],
            [['id_esporte', 'id_pessoa'], 'unique', 'targetAttribute' => ['id_esporte', 'id_pessoa']],
            [['id_esporte'], 'exist', 'skipOnError' => true, 'targetClass' => EsporteModel::class, 'targetAttribute' => ['id_esporte' => 'id']],
            [['id_pessoa'], 'exist', 'skipOnError' => true, 'targetClass' => PessoasModel::class, 'targetAttribute' => ['id_pessoa' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_esporte' => 'Id Esporte',
            'id_pessoa' => 'Id Pessoa',
        ];
    }

    /**
     * Gets query for [[Esporte]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEsporte()
    {
        return $this->hasMany(EsporteModel::class, ['id' => 'id_esporte'])
            ->viaTable('pessoa_esporte', ['id_pessoa' => 'id']);
    }


    /**
     * Gets query for [[Pessoa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPessoa()
    {
        return $this->hasOne(PessoasModel::class, ['id' => 'id_pessoa']);
    }
}
