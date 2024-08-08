<?php

namespace app\models\pais;

use Yii;

/**
 * This is the model class for table "pais".
 *
 * @property int $id
 * @property string $nome_pais
 *
 * @property Atletas[] $atletas
 */
class PaisModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pais';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_pais'], 'required'],
            [['nome_pais'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_pais' => 'Nome Pais',
        ];
    }

    /**
     * Gets query for [[Atletas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAtletas()
    {
        return $this->hasMany(Atletas::class, ['id_pais' => 'id']);
    }
}
