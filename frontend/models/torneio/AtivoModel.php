<?php

namespace app\models\torneio;

use Yii;

/**
 * This is the model class for table "ativo".
 *
 * @property int $id
 * @property string|null $desc_ativo
 *
 * @property Torneio[] $torneios
 */
class AtivoModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ativo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desc_ativo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'desc_ativo' => 'Desc Ativo',
        ];
    }

    /**
     * Gets query for [[Torneios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTorneios()
    {
        return $this->hasMany(TorneioModel::class, ['ativo_torneio' => 'id']);
    }
}
