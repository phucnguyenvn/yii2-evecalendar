<?php

namespace phucnguyenvn\yii2evecalendar\controllers;

use Yii;
use phucnguyenvn\yii2evecalendar\models\Event;
use phucnguyenvn\yii2evecalendar\models\EventSearch;
use phucnguyenvn\yii2evecalendar\models\DisplayEvents;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($date)
    {
        $model = new Event();
        $model->s_date = $date;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('success');
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    //update view when create success
    public function actionSuccess($model=null){
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return [
          // minimum
          new DisplayEvents([
              'title' => 'hehehehe' . rand(1, 999),
              'start' => '2016-12-18T14:00:00',
          ]),
          new DisplayEvents([
              'title' => 'hihihihi' . rand(1, 999),
              'start' => '2016-12-17T14:00:00',
          ]),
        ];
    }
    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('success');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionEvents($id, $start, $end)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            // minimum
            new DisplayEvents([
                'title' => 'Appointment #' . rand(1, 999),
                'start' => '2016-12-18T14:00:00',
            ]),
            // Everything editable
            new DisplayEvents([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2016-12-17T12:30:00',
                'end'              => '2016-12-17T13:30:00',
            ]),
            // No overlap
            new \edofre\fullcalendar\models\Event([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2016-12-17T15:30:00',
                'end'              => '2016-12-17T19:30:00',
                'overlap'          => false, // Overlap is default true
            ]),
            // Only duration editable
            new DisplayEvents([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2016-12-16T11:00:00',
                'end'              => '2016-12-16T11:30:00',
            ]),
            // Only start editable
            new DisplayEvents([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2016-12-15T14:00:00',
                'end'              => '2016-12-15T15:30:00',
            ]),
        ];
    }
}
