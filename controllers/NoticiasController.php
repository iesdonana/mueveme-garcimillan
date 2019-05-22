<?php

namespace app\controllers;

use app\models\Categorias;
use app\models\Noticias;
use app\models\NoticiasSearch;
use app\models\Votaciones;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * NoticiasController implements the CRUD actions for Noticias model.
 */
class NoticiasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Noticias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoticiasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'listaCategorias' => $this->listaCategorias(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Noticias model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Noticias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Noticias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = 'uploads/' . $model->id . '.jpg';
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            $model->imagen->saveAs($file);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $initValueText = empty($model->categoria_id) ? '' : Categorias::findOne($model->categoria_id)->categoria;

        return $this->render('create', [
            'model' => $model,
            'initValueText' => $initValueText,
        ]);
    }

    /**
     * Updates an existing Noticias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = 'uploads/' . $model->id . '.jpg';
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            $model->imagen->saveAs($file);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $initValueText = empty($model->categoria_id) ? '' : Categorias::findOne($model->categoria_id)->categoria;

        return $this->render('update', [
            'model' => $model,
            'initValueText' => $initValueText,
        ]);
    }

    /**
     * Deletes an existing Noticias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCategorias($q = null, $id = null)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if ($q !== null) {
            $out['results'] = Categorias::find()
                ->select('id, categoria AS text')
                ->where(['ilike', 'categoria', $q])
                ->asArray()
                ->all();
        } elseif ($id > 0) {
            $out['results'] = [
                'id' => $id,
                'text' => Categorias::findOne($id)->categoria,
            ];
        }
        return $out;
    }

    /**
     * Finds the Noticias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Noticias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Noticias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function listaCategorias()
    {
        return Categorias::find()
            ->select('categoria, id')
            ->indexBy('id')
            ->column();
    }

    public function actionVotar($noticia_id, $usuario_id)
    {
        $noticia = $this->findModel($noticia_id);
        $model = new Votaciones(['usuario_id' => $usuario_id, 'noticia_id' => $noticia_id]);
        if (Yii::$app->request->isAjax) {
            if ($model->save()) {
                $noticia->votos++;
                if ($noticia->save()) {
                    return true;
                }
            }
        }

        return false;
    }

    public function actionFiltrar($categoria_id)
    {
        $searchModel = new NoticiasSearch();

        if (Yii::$app->request->isAjax) {
            $query = Noticias::find()->where(['categoria_id' => $categoria_id]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->renderAjax('_listaNoticias', [
                'dataProvider' => $dataProvider,
            ]);
        }

        $query = Noticias::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->renderAjax('_listaNoticias', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
