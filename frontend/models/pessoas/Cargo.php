<?php

namespace app\models\pessoas;

use Yii;

/**
 * This is the model class for table "cargo".
 *
 * @property int $id
 * @property string $nome_cargo
 *
 * @property Pessoa[] $pessoas
 */
class Cargo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cargo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_cargo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_cargo' => 'Nome Cargo',
        ];
    }

    /**
     * Gets query for [[Pessoas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPessoas()
    {
        return $this->hasMany(PessoasModel::class, ['id_cargo' => 'id']);
    }
}
