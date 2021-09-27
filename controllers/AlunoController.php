<?php

namespace app\controllers;

use app\models\Aluno;
use app\models\AlunoSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * AlunoController implements the CRUD actions for Aluno model.
 */
class AlunoController extends Controller
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
     * @SWG\Get(path="/aluno",
     *     tags={"Aluno"},
     *     summary="Lista Todos os Alunos",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Ok",
     *         @SWG\Schema(ref = "#/definitions/Aluno")
     *     ),
     * ),
     *
     * @SWG\Get(path="/aluno/{id}",
     *     tags={"Aluno"},
     *     summary="Lista um Aluno Específico",
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *      ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Ok",
     *         @SWG\Schema(ref = "#/definitions/Aluno")
     *     ),
     * )
     */
    public function actionIndex()
    {
        $searchModel = new AlunoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aluno model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @SWG\Post(
     *    path = "/aluno/create",
     *    tags={"Aluno"},
     *    summary = "Cadastra um Aluno",
     *    description = "Cadastra um Aluno",
     *    produces = {"application/json"},
     *    consumes = {"application/json"},
     *	@SWG\Parameter(
     *        in = "body",
     *        name = "body",
     *        description = "Conteúdo",
     *        required = true,
     *        type = "string",
     *      @SWG\Schema(ref = "#/definitions/Aluno")
     *    ),
     *	@SWG\Response(
     *     response = 200,
     *     description = "Ok",
     *     @SWG\Schema(ref = "#/definitions/Aluno")
     *  )
     *)
     */
    public function actionCreate()
    {
        $model = new Aluno();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, 'Registro criado com sucesso.');
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * @SWG\Put(path="/aluno/{id}",
     *  tags={"Aluno"},
     *  summary="Altera um Aluno Específico",
     *  @SWG\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      type="integer"
     *  ),
     *  @SWG\Parameter(
     *      name="nome",
     *      in="formData",
     *      required=true,
     *      type="string"
     *  ),
     *     @SWG\Parameter(
     *      name="matricula",
     *      in="formData",
     *      required=true,
     *      type="string"
     *  ),
     *     @SWG\Parameter(
     *      name="email",
     *      in="formData",
     *      required=false,
     *      type="string"
     *  ),
     *     @SWG\Parameter(
     *      name="telefone",
     *      in="formData",
     *      required=false,
     *      type="string"
     *  ),
     *  @SWG\Response(
     *      response = 200,
     *      description = "Ok",
     *      @SWG\Schema(ref = "#/definitions/Aluno")
     *  ),
     * )
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, 'Registro atualizado com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * @SWG\Delete(path="/aluno/{id}",
     *  tags={"Aluno"},
     *  summary="Deleta um Aluno",
     *  @SWG\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      type="integer"
     *  ),
     *  @SWG\Response(
     *      response=200,
     *      description="Ok"
     *  ),
     * )
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, 'Registro excluído com sucesso.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aluno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Aluno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aluno::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
