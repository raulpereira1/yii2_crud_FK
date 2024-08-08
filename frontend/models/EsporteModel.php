<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "esporte".
 *
 * @property int $id
 * @property string $nome_esporte
 * @property int|null $tipo
 *
 * @property Atletas[] $atletas
 */
class EsporteModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'esporte';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_esporte'], 'required'],
            [['tipo'], 'integer'],
            [['nome_esporte'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_esporte' => 'Nome Esporte',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * Gets query for [[Atletas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAtletasModel()
    {
        return $this->hasMany(AtletasModel::class, ['id_esporte' => 'id']);
    }
}
