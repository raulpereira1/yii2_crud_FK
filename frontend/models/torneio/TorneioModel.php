<?php

namespace app\models\torneio;

use app\models\AtletasModel;
use app\models\EsporteModel;
use app\models\ModalidadeModel;
use Yii;

/**
 * This is the model class for table "torneio".
 *
 * @property int $id
 * @property string $nome_torneio
 * @property int $modalidade_torneio
 * @property int $esporte_torneio
 * @property int $ativo_torneio
 *
 * @property AtletasModel[] $atletas
 * @property EsporteModel $esporteTorneio
 * @property ModalidadeModel $modalidadeTorneio
 */
class TorneioModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'torneio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_torneio', 'modalidade_torneio', 'esporte_torneio', 'ativo_torneio'], 'required'],
            [['modalidade_torneio', 'esporte_torneio', 'ativo_torneio'], 'integer'],
            [['nome_torneio'], 'string', 'max' => 50],
            [['esporte_torneio'], 'exist', 'skipOnError' => true, 'targetClass' => EsporteModel::class, 'targetAttribute' => ['esporte_torneio' => 'id']],
            [['modalidade_torneio'], 'exist', 'skipOnError' => true, 'targetClass' => ModalidadeModel::class, 'targetAttribute' => ['modalidade_torneio' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_torneio' => 'Nome Torneio',
            'modalidade_torneio' => 'Modalidade Torneio',
            'esporte_torneio' => 'Esporte Torneio',
            'ativo_torneio' => 'Ativo Torneio',
        ];
    }

    /**
     * Gets query for [[Atletas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAtletas()
    {
        return $this->hasMany(AtletasModel::class, ['id_torneio' => 'id']);
    }

    /**
     * Gets query for [[EsporteTorneio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEsporteTorneio()
    {
        return $this->hasOne(EsporteModel::class, ['id' => 'esporte_torneio']);
    }

    /**
     * Gets query for [[ModalidadeTorneio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModalidadeTorneio()
    {
        return $this->hasOne(ModalidadeModel::class, ['id' => 'modalidade_torneio']);
    }
}
