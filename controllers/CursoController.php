<?php

namespace app\controllers;

use app\models\Curso;
use app\models\CursoSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * CursoController implements the CRUD actions for Curso model.
 */
class CursoController extends Controller
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
     * @SWG\Get(path="/curso",
     *     tags={"Curso"},
     *     summary="Lista Todos os Cursos",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Ok",
     *         @SWG\Schema(ref = "#/definitions/Curso")
     *     ),
     * ),
     *
     * @SWG\Get(path="/curso/{id}",
     *     tags={"Curso"},
     *     summary="Lista um Curso Específico",
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *      ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Ok",
     *         @SWG\Schema(ref = "#/definitions/Curso")
     *     ),
     * )
     */
    public function actionIndex()
    {
        $searchModel = new CursoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Curso model.
     * @param integer $id
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
     *    path = "/curso/create",
     *    tags={"Curso"},
     *    summary = "Cadastra um Curso",
     *    description = "Cadastra um Curso",
     *    produces = {"application/json"},
     *    consumes = {"application/json"},
     *	@SWG\Parameter(
     *        in = "body",
     *        name = "body",
     *        description = "Conteúdo",
     *        required = true,
     *        type = "string",
     *      @SWG\Schema(ref = "#/definitions/Curso")
     *    ),
     *	@SWG\Response(
     *     response = 200,
     *     description = "Ok",
     *     @SWG\Schema(ref = "#/definitions/Curso")
     *  )
     *)
     */
    public function actionCreate()
    {
        $model = new Curso();

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
     * @SWG\Put(path="/curso/{id}",
     *  tags={"Curso"},
     *  summary="Altera um Curso Específico",
     *  @SWG\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      type="integer"
     *  ),
     *     @SWG\Parameter(
     *      name="id_categoria",
     *      in="formData",
     *      required=false,
     *      type="integer"
     *  ),
     *  @SWG\Parameter(
     *      name="descricao",
     *      in="formData",
     *      required=true,
     *      type="string"
     *  ),
     *     @SWG\Parameter(
     *      name="data_inicio",
     *      in="formData",
     *      required=true,
     *      type="string"
     *  ),
     *     @SWG\Parameter(
     *      name="data_fim",
     *      in="formData",
     *      required=true,
     *      type="string"
     *  ),
     *     @SWG\Parameter(
     *      name="qtd_alunos_turma",
     *      in="formData",
     *      required=false,
     *      type="integer"
     *  ),
     *  @SWG\Response(
     *      response = 200,
     *      description = "Ok",
     *      @SWG\Schema(ref = "#/definitions/Curso")
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
     * @SWG\Delete(path="/curso/{id}",
     *  tags={"Curso"},
     *  summary="Deleta um Curso",
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
     * Finds the Curso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Curso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Curso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
