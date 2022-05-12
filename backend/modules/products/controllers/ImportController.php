<?php

namespace backend\modules\products\controllers;

use backend\modules\products\forms\UploadForm;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\filters\VerbFilter;
use yii\web\Request;
use yii\web\UploadedFile;

class ImportController extends \yii\web\Controller
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
                    'import' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function actionImport(Request $request)
    {
        $model = new UploadForm();
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        $model->upload();

        $inputFileName = 'uploads/' . $model->imageFile->name;
        $spreadsheet = IOFactory::load($inputFileName);

        $oCells = $spreadsheet->getActiveSheet()->getCellCollection();

        $data = '';

        for ($iRow = 1; $iRow <= $oCells->getHighestRow(); $iRow++)
        {
            for ($iCol = 'A'; $iCol <= $oCells->getHighestColumn(); $iCol++)
            {
                $oCell = $oCells->get($iCol.$iRow);
                if($oCell)
                {
                    $data .= $oCell->getValue() . '<br />';
                }
            }
            $data .= '<hr />';
        }

        return $this->render('preview', [
            'data' => $oCells,
        ]);
    }
}