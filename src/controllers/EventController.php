<?php

namespace phucnguyenvn\yii2evecalendar\controllers;

use Yii;
use phucnguyenvn\yii2evecalendar\models\Event;
use phucnguyenvn\yii2evecalendar\models\EventSearch;
use phucnguyenvn\yii2evecalendar\models\DisplayEvents;
use phucnguyenvn\yii2evecalendar\helpers\CalendarHelper;
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
        // $model = Event::getEventbyDateRange(date(DATE_W3C, strtotime('2016-11-10')),date(DATE_W3C, strtotime('2016-12-29')));
        // //$result = CalendarHelper::convertCalendar($model);
        // var_dump($model); die;

        return $this->render('index');
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
    public function actionCreate($date=null)
    {
        $model = new Event();
        $model->s_date = $date;//date('m/d/Y', strtotime($date));
        //var_dump($model->s_date); die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $result = array();
            $result['message'] = 'success';
            if($model->recurrence != '')
            {
              $result['data'] = CalendarHelper::convertCalendar($model);
            }
            else {
              $result['data'] = CalendarHelper::convertCalendar($model);
            }
            return $result;
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    //update view when create success
    public function actionSuccess($model=null){
      //var_dump($model); die;
      return;
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
            return;
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

    public function actionEvents($start, $end)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = Event::getEventbyDateRange($start,$end);
        $events = CalendarHelper::convertCalendar($model);
        return $events;
    }
}
