<?php

namespace frontend\controllers;

use app\models\pessoaendereco\PessoaEndereco;
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
        $dataProvider->query->with(['pessoaEndereco', 'cargo', 'pessoaEsportes']);

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
     */public function actionCreate()
{
    $model = new PessoasModel(); // carrega o PessoasModel e armazena na variavel $model
    $modelEndereco = new PessoaEndereco(); // carrega o PessoaEndereco e armazena na variavel $modelEndereco
    $post = Yii::$app->request->post(); // carrega as informações via metodo post
    if ($model->load($post) && $model->save()) { // carrega e salva o model
        $esportes = $post['PessoasModel']['esportes']; // $esportes recebe o que o model Pessoas está recebendo via função getEsportes que conecta com a tabela pessoa_esporte do banco.
        foreach ($esportes as $esporteId) { // laço de repetição
            $pessoaEsporte = new PessoaEsporte(); // variavel $pessoaEsporte recebe um novo PessoaEsporteModel
            $pessoaEsporte->id_pessoa = $model->id; // concatena o pessoa esporte->id_pessoa com o id dentro do $model
            $pessoaEsporte->id_esporte = $esporteId;  // concatena o pessoaEsporte->idEsporte com o esporte do foreach que foi atribuido o $esportes da relação do banco
            $pessoaEsporte->save(); // salva
        }
        if ($modelEndereco->load($post)) {
            $modelEndereco->id_pessoa = $model->id;

            if ($modelEndereco->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao salvar endereço');
            }
        }
    }
    return $this->render('create', [
        'model' => $model,
        'modelEndereco' => $modelEndereco,
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
        $modelEndereco = PessoaEndereco::findOne(['id_pessoa' => $model->id]);
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->validate()) {
            if ($modelEndereco->load($post)) {
                $modelEndereco->id_pessoa = $model->id;
                if ($model->save() && $modelEndereco->save()) { // se tudo for carregado certo, salva a pessoa e o endereço
                    $postData = Yii::$app->request->post(); // a partir daqui é o salvamento dos esportes
                    $model->salvarEsportes($model->id, $postData['PessoasModel']['esportes']);

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao salvar pessoa ou endereço.'); // o setFlash funciona como um "alert", para exibir uma mensagem e nesse caso ele está setado para mostrar se ocorrer algum erro
                }
            }
        }
        return $this->render('update', ['model' => $model,
            'modelEndereco' => $modelEndereco,]);
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
        foreach ($this->findModel($id)->pessoaEndereco as $pessoaEndereco) {
            $pessoaEndereco->delete();
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
