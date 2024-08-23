<?php

namespace frontend\controllers;

use app\models\pessoas\PessoaEsporte;
use app\models\PessoaEsporteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PessoaEsporteController implements the CRUD actions for PessoaEsporte model.
 */
class PessoaEsporteController extends Controller
{
    /**
     * @inheritDoc
     */
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
     * Lists all PessoaEsporte models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PessoaEsporteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PessoaEsporte model.
     * @param int $id_esporte Id Esporte
     * @param int $id_pessoa Id Pessoa
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_esporte, $id_pessoa)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_esporte, $id_pessoa),
        ]);
    }

    /**
     * Creates a new PessoaEsporte model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model1 = new PessoaEsporte();

        if ($this->request->isPost) {
            if ($model1->load($this->request->post()) && $model1->save()) {
                return $this->redirect(['view', 'id_esporte' => $model1->id_esporte, 'id_pessoa' => $model1->id_pessoa]);
            }
        } else {
            $model1->loadDefaultValues();
        }

        return $this->render('create', [
            'model1' => $model1,
        ]);
    }

    /**
     * Updates an existing PessoaEsporte model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_esporte Id Esporte
     * @param int $id_pessoa Id Pessoa
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_esporte, $id_pessoa)
    {
        $model = $this->findModel($id_esporte, $id_pessoa);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_esporte' => $model->id_esporte, 'id_pessoa' => $model->id_pessoa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PessoaEsporte model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_esporte Id Esporte
     * @param int $id_pessoa Id Pessoa
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_esporte, $id_pessoa)
    {
        $this->findModel($id_esporte, $id_pessoa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PessoaEsporte model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_esporte Id Esporte
     * @param int $id_pessoa Id Pessoa
     * @return PessoaEsporte the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_esporte, $id_pessoa)
    {
        if (($model = PessoaEsporte::findOne(['id_esporte' => $id_esporte, 'id_pessoa' => $id_pessoa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
