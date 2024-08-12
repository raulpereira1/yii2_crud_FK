<?php

namespace frontend\controllers;

use app\models\AtletasModel;
use app\models\AtletasSearch;
use app\models\EsporteModel;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AtletasController implements the CRUD actions for AtletasModel model.
 */
class AtletasController extends Controller
{
    /**
     * @inheritDoc
     */


    public function actionGetEsportes($modalidade_id)
    {
        $esporte = EsporteModel::find()->where(['tipo' => $modalidade_id])->all();
        if (!empty($esporte)) {
            foreach ($esporte as $esporte) {
                echo "<option value='" . $esporte->id . "'>" . $esporte->nome . "</option>";
            }
        } else {
            echo "<option>- Nenhum esporte encontrado -</option>";
        }
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all AtletasModel models.
     *
     * @return string
     */
    public function actionIndex()
    {


        $searchModel = new AtletasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,


        ]);

    }

    /**
     * Displays a single AtletasModel model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AtletasModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        $model = new AtletasModel();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        $esporteTipo1 = EsporteModel::find()->where(['tipo' => 1])->all();
        $esporteTipo2 = EsporteModel::find()->where(['tipo' => 2])->all();
        return $this->render('create', [
            'model' => $model,
            'esporteTipo1' => $esporteTipo1,
            'esporteTipo2' => $esporteTipo2,
        ]);
    }

    /**
     * Updates an existing AtletasModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AtletasModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AtletasModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AtletasModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtletasModel::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
