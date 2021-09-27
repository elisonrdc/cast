<?php

namespace app\controllers;

use app\models\Categoria;
use app\models\CategoriaSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriaController extends Controller
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
     * @SWG\Get(path="/categoria",
     *     tags={"Categoria"},
     *     summary="Lista Todas as Categorias",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Ok",
     *         @SWG\Schema(ref = "#/definitions/Categoria")
     *     ),
     * ),
     *
     * @SWG\Get(path="/categoria/{id}",
     *     tags={"Categoria"},
     *     summary="Lista uma Categoria Específica",
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="integer"
     *      ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Ok",
     *         @SWG\Schema(ref = "#/definitions/Categoria")
     *     ),
     * )
     */
    public function actionIndex()
    {
        $searchModel = new CategoriaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categoria model.
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
     *    path = "/categoria/create",
     *    tags={"Categoria"},
     *    summary = "Cadastra uma Categoria",
     *    description = "Cadastra uma Categoria",
     *    produces = {"application/json"},
     *    consumes = {"application/json"},
     *	@SWG\Parameter(
     *        in = "body",
     *        name = "body",
     *        description = "Conteúdo",
     *        required = true,
     *        type = "string",
     *      @SWG\Schema(ref = "#/definitions/Categoria")
     *    ),
     *	@SWG\Response(
     *     response = 200,
     *     description = "Ok",
     *     @SWG\Schema(ref = "#/definitions/Categoria")
     *  )
     *)
     */
    public function actionCreate()
    {
        $model = new Categoria();

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
     * @SWG\Put(path="/categoria/{id}",
     *  tags={"Categoria"},
     *  summary="Altera uma Categoria Específica",
     *  @SWG\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      type="integer"
     *  ),
     *  @SWG\Parameter(
     *      name="descricao",
     *      in="formData",
     *      required=true,
     *      type="string"
     *  ),
     *  @SWG\Response(
     *      response = 200,
     *      description = "Ok",
     *      @SWG\Schema(ref = "#/definitions/Categoria")
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
     * @SWG\Delete(path="/categoria/{id}",
     *  tags={"Categoria"},
     *  summary="Deleta uma Categoria",
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
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categoria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
