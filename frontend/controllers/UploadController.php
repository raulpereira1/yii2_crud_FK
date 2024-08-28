<?php

namespace frontend\controllers;

use app\models\AtletasModel;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\pessoas\PessoasModel;

class UploadController extends Controller
{
    public function actionUpdateFoto()
    {
        $post = Yii::$app->getRequest()->post();
        $model = new AtletasModel();

        if ($model->load($post) && $model->validate()) {
            $model->foto_pessoa = UploadedFile::getInstance($model, 'foto_pessoa');

            $model->pessoa_foto = $model->foto_pessoa->nome;
            $model->save();

            $uploadPath = Yii::getAlias('@frontend/web/files/');

            $model->foto_pessoa->saveAs($uploadPath . '/' . $model->foto_pessoa);

        }
    }

}