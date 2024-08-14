<?php

namespace app\models;

use app\models\pais\PaisModel;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\EsporteModel;
use yii\web\UploadedFile;

/**
 * This is the model class for table "atletas".
 *
 * @property int $id
 * @property string $nome
 * @property int $id_pais
 * @property int $id_esporte
 * @property int $id_modalidade
 * @property string $foto_atleta
 * @property Esporte $esporte
 * @property Modalidade $modalidade
 * @property Pais $pais
 */
class AtletasModel extends \yii\db\ActiveRecord
{
    /** @var UploadedFile */
    public $atleta_foto;
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'atletas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['id_pais', 'id_esporte', 'id_modalidade'], 'integer'],
            [['foto_atleta'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['nome'], 'string', 'max' => 255],
            [['id_esporte'], 'exist', 'skipOnError' => true, 'targetClass' => EsporteModel::class, 'targetAttribute' => ['id_esporte' => 'id']],
            [['id_modalidade'], 'exist', 'skipOnError' => true, 'targetClass' => ModalidadeModel::class, 'targetAttribute' => ['id_modalidade' => 'id']],
            [['id_pais'], 'exist', 'skipOnError' => true, 'targetClass' => PaisModel::class, 'targetAttribute' => ['id_pais' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'foto_atleta' => 'Foto Atleta',
            'nome' => 'Nome',
            'id_pais' => 'Pais',
            'id_esporte' => 'Esporte',
            'id_modalidade' => 'Modalidade',
        ];
    }

    /**
     * Gets query for [[Esporte]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEsporte()
    {
        return $this->hasOne(EsporteModel::class, ['id' => 'id_esporte']);
    }

    /**
     * Gets query for [[Modalidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModalidade()
    {
        return $this->hasOne(ModalidadeModel::class, ['id' => 'id_modalidade']);
    }

    /**
     * Gets query for [[Pais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPais()
    {
        return $this->hasOne(PaisModel::class, ['id' => 'id_pais']);
    }

    public function uploadAndSave()
    {
        if ($this->validate()) {
            if ($this->atleta_foto) {
                $uploadPath = Yii::getAlias('@frontend/web/files/').'/'. $this->atleta_foto->name;

            if ($this->atleta_foto->saveAs($uploadPath)) {
                $this->foto_atleta = $this->atleta_foto->baseName.'.'.$this->atleta_foto->extension;
            }

            }
            return $this->save(false);


        }
return false;
    }
}