<?php

namespace phucnguyenvn\yii2evecalendar\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use phucnguyenvn\yii2evecalendar\models\Event;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventtController extends Controller
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
        // $evs = Event::find()->all();
        // $events = Event::setFullCalendar($evs);
        return $this->render('index', [
            //'events' => $events
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
        $model->created_date = $date;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
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
            return $this->redirect(['view', 'id' => $model->id]);
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
            new \edofre\fullcalendar\models\Event([
                'title' => 'Appointment #' . rand(1, 999),
                'start' => '2016-03-18T14:00:00',
            ]),
            // Everything editable
            new \edofre\fullcalendar\models\Event([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2016-03-17T12:30:00',
                'end'              => '2016-03-17T13:30:00',
            ]),
            // No overlap
            new \edofre\fullcalendar\models\Event([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2016-03-17T15:30:00',
                'end'              => '2016-03-17T19:30:00',
                'overlap'          => false, // Overlap is default true
            ]),
            // Only duration editable
            new \edofre\fullcalendar\models\Event([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2016-03-16T11:00:00',
                'end'              => '2016-03-16T11:30:00',
            ]),
            // Only start editable
            new \edofre\fullcalendar\models\Event([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2016-03-15T14:00:00',
                'end'              => '2016-03-15T15:30:00',
            ]),
        ];
    }
}
