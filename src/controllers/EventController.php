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
    public function actionCreate($date=null,$dstart=null,$dend=null)
    {
        $model = new Event();
        $model->s_date = $date;
        $model->e_date = $date;
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model->validate() && isset($_POST['submit']))
            {
              $model->save();
              $result = array();
              $result['message'] = 'success';
              return $this->updateView($model,$dstart,$dend,$result);
            }
            else {
              return \yii\widgets\ActiveForm::validate($model);
            }
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
    public function actionUpdate($dstart=null,$dend=null,$id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
          Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
          if($model->validate() && isset($_POST['submit']))
          {
            $model->save();
            $result = array();
            $result['message'] = 'success';
            $result['id'] = $id;
            return $this->updateView($model,$dstart,$dend,$result);
          }
          else {
            return \yii\widgets\ActiveForm::validate($model);
          }
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }


    private function updateView($model,$dstart=null,$dend=null,$result)
    {
      //process for recurring events
      if($model->recurrence != '')
      {
        $models = Event::getRecurringEventbyDateRange($dstart,$dend,$model->id);
        $result['data'] = CalendarHelper::convertCalendar($models);
      }
      //process for non-recurring events
      else {
        $result['data'] = CalendarHelper::convertCalendar($model);
      }
      return $result;
    }
    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $result = array();
        if(isset($_POST['id']) && $this->findModel($_POST['id'])->delete())
        {
            $result['message'] = 'success';
            $result['id'] = $_POST['id'];
        }
        \Yii::$app->response->format = 'json';
        return $result;
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

    //This action return ajax events for main view
    public function actionEvents($start, $end)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = Event::getEventbyDateRange($start,$end);
        $events = CalendarHelper::convertCalendar($model);
        return $events;
    }
}
