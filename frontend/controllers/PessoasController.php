<?php

namespace frontend\controllers;

use app\models\pessoas\PessoaEsporte;
use app\models\pessoas\PessoasModel;
use app\models\PessoasSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/** @var PessoasModel SalvarEsportes */
/**
 *
 * */
/**
 * PessoasController implements the CRUD actions for PessoasModel model.
 */
class PessoasController extends Controller
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
     * Lists all PessoasModel models.
     *
     * @return string
     */
    public function actionIndex()
    {
       $pessoas = PessoasModel::find()->with('cargo')->with('pessoaEsportes.esporte')->all();
        $searchModel = new PessoasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pessoas' => $pessoas,
        ]);
    }

    /**
     * Displays a single PessoasModel model.
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
     * Creates a new PessoasModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PessoasModel(); // Instância do model PessoasModel
        $post = Yii::$app->request->post(); // Captura os dados submetidos via POST

        // Carrega os dados no model e tenta salvar
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Captura os esportes selecionados no formulário
            $esportes = Yii::$app->request->post('PessoasModel')['esportes'];

            // Itera sobre os esportes e associa à pessoa
            foreach ($esportes as $esporteId) {
                $pessoaEsporte = new PessoaEsporte(); // Cria uma nova instância do model intermediário
                $pessoaEsporte->id_pessoa = $model->id; // Associa o ID da pessoa
                $pessoaEsporte->id_esporte = $esporteId; // Associa o ID do esporte
                $pessoaEsporte->save(); // Salva o registro na tabela pessoa_esporte
            }

            // Redireciona para a view após o salvamento
            return $this->redirect(['view', 'id' => $model->id]);
        }

        // Renderiza o formulário de criação se o salvamento não for bem-sucedido
        return $this->render('create', [
            'model' => $model,
        ]);
    }



    /**
     * Updates an existing PessoasModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = PessoasModel::findOne($id);
        $esporteSelecionado = ArrayHelper::getColumn($model->esportes, 'id');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $postData = Yii::$app->request->post();

            if ($model->save()){
                $model->salvarEsportes($model->id,$postData['PessoasModel']['esportes']);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', ['model' => $model,
            'esporteSelecionado' => $esporteSelecionado,]);
    }


    /**
     * Deletes an existing PessoasModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //rodar um foreach para apagar o relacionamento antes
        foreach ($this->findModel($id)->pessoaEsportes as $pessoaEsporte) {
            $pessoaEsporte->delete();
        }



        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PessoasModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PessoasModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PessoasModel::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
