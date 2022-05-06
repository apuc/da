<?php

namespace backend\modules\products\controllers;

use backend\modules\products\forms\UploadForm;
use Exception;
use PHPExcel_IOFactory;
use yii\filters\VerbFilter;
use PHPExcel;
use yii\web\Request;
use yii\web\UploadedFile;

class ImportController extends \yii\web\Controller
{
//
//    /**
//     * @inheritdoc
//     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'import' => ['POST'],
//                ],
//            ],
//        ];
//    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionImport(Request $request)
    {
        $model = new UploadForm();

        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        $uploadSuccess = $model->upload();

        return $this->render('preview', [
            'model' => $model,
            'uploadSuccess' => $uploadSuccess
        ]);
    }
}