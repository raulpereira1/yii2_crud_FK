<?php

namespace frontend\controllers;

use app\models\AtletasModel;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    public function actionUpdateFoto()
    {
        $post = Yii::$app->getRequest()->post();
        $model = new AtletasModel();

        if ($model->load($post) && $model->validate()) {
            $model->atleta_foto = UploadedFile::getInstance($model, 'foto_atleta');

            $model->foto_atleta = $model->atleta_foto->name;
            $model->save();

            $uploadPath = Yii::getAlias('@frontend/web/files');

            $model->atleta_foto->saveAs($uploadPath . '/' . $model->foto_atleta);

        }
    }

}