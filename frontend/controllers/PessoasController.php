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
use yii\web\UploadedFile;

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
     */
    public function actionCreate()
{
    $model = new PessoasModel(); // carrega o PessoasModel e armazena na variável $model
    $modelEndereco = new PessoaEndereco(); // carrega o PessoaEndereco e armazena na variável $modelEndereco

    $post = Yii::$app->request->post(); // carrega as informações via método POST

    // Carregar os dados do POST no model antes de processar o upload da imagem
    if ($model->load($post) && $model->validate()) {
        // Manipular upload da imagem
        $model->pessoa_foto = UploadedFile::getInstance($model, 'foto_pessoa');

        if ($model->pessoa_foto) {
            $uploadPath = Yii::getAlias('@frontend/web/files/') . $model->pessoa_foto->name;

            if ($model->pessoa_foto->saveAs($uploadPath)) {
                $model->foto_pessoa = $model->pessoa_foto->name;  // Armazena o nome da imagem no banco de dados
            }
        }

        // Salvar o model da pessoa após upload da imagem
        if ($model->save(false)) {
            // Salvar os esportes associados
            $esportes = $post['PessoasModel']['esportes']; // $esportes recebe os esportes selecionados
            foreach ($esportes as $esporteId) {
                $pessoaEsporte = new PessoaEsporte();
                $pessoaEsporte->id_pessoa = $model->id;
                $pessoaEsporte->id_esporte = $esporteId;
                $pessoaEsporte->save();
            }

            // Salvar o endereço associado
            if ($modelEndereco->load($post)) {
                $modelEndereco->id_pessoa = $model->id;
                if ($modelEndereco->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao salvar endereço');
                }
            }
        }
    }

    // Renderizar a view com os models
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
            // Manipular upload da imagem
            $model->pessoa_foto = UploadedFile::getInstance($model, 'foto_pessoa');

            if ($model->pessoa_foto) {
                $uploadPath = Yii::getAlias('@frontend/web/files/') . $model->pessoa_foto->name;

                if ($model->pessoa_foto->saveAs($uploadPath)) {
                    $model->foto_pessoa = $model->pessoa_foto->name;  // Armazena o nome da imagem no banco de dados
                }
            }

            // Salvar o model da pessoa após upload da imagem
            if ($model->save(false)) {
                // Salvar os esportes associados
                $esportes = $post['PessoasModel']['esportes']; // $esportes recebe os esportes selecionados
                foreach ($esportes as $esporteId) {
                    $pessoaEsporte = new PessoaEsporte();
                    $pessoaEsporte->id_pessoa = $model->id;
                    $pessoaEsporte->id_esporte = $esporteId;
                    $pessoaEsporte->save();
                }

                // Salvar o endereço associado
                if ($modelEndereco->load($post)) {
                    $modelEndereco->id_pessoa = $model->id;
                    if ($modelEndereco->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Erro ao salvar endereço');
                    }
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
        // necessário mudar a logica pois estava puxando o dado int e não um objeto.
        // agora o model está garantindo que vai ser do tipo objeto para ser tratado e deletado
        $model = $this->findModel($id);
        // loop para garantir que o objeto não estará vazio
        if ($model !== null) {
            // logica para deletar da tabela esporte
            foreach ($model->pessoaEsportes as $pessoaEsporte) {
                $pessoaEsporte->delete();
            }
            // logica para deletar da tabela pessoa_endereco
            if ($model->pessoaEndereco) {
                $model->pessoaEndereco->delete();
            }

            // deletar da tabela pessoas
            $model->delete();}

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
