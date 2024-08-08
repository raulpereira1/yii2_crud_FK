<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modalidade".
 *
 * @property int $id
 * @property string $tipo_esporte
 *
 * @property Atletas[] $atletas
 */
class ModalidadeModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modalidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_esporte'], 'required'],
            [['tipo_esporte'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_esporte' => 'Tipo Esporte',
        ];
    }

    /**
     * Gets query for [[Atletas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAtletas()
    {
        return $this->hasMany(Atletas::class, ['id_modalidade' => 'id']);
    }
}
