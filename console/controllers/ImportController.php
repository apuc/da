<?php

namespace console\controllers;

use common\models\db\MissingPerson;
use DOMElement;
use DOMXPath;
use PhpOffice\PhpSpreadsheetTests\Reader\Html\HtmlHelper;
use yii\console\Controller;
use yii\helpers\Html;

class ImportController extends Controller
{
    public $path, $moderated;

    function init()
    {
        parent::init();
    }

    public function options($actionID)
    {
        $options = parent::options($actionID);

        switch ($actionID) {
            case 'missing-person':
                $options[] = 'path';
                $options[] = 'moderated';
                break;
            default:
                break;
        }

        return $options;
    }

    /**
     * Метод для импорта талицы с сайта министерства
     *
     * @return void
     */
    public function actionMissingPerson()
    {
        if (isset($this->path)) {
            $html = file_get_contents($this->path);
            $dom = new \DOMDocument();
            $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'utf-8'));
            $rows = $dom->getElementsByTagName('tr');

            /** @var DOMElement $row */
            foreach ($rows as $key => $row) {
                if ($key != 0) {
                    if (\frontend\modules\missing_person\models\MissingPerson::findOne([
                        'date_of_birth' => strtotime($row->childNodes[1]->textContent),
                        'fio' => $row->childNodes[0]->textContent,
                    ])) {
                        echo "\033[90mУже существует: {$row->childNodes[0]->textContent} : {$row->childNodes[1]->textContent}\n";
                    } else {
                        $missing_person = new MissingPerson();
                        $missing_person->setAttribute('fio', $row->childNodes[0]->textContent);
                        $missing_person->setAttribute('date_of_birth', strtotime($row->childNodes[1]->textContent));
                        $missing_person->setAttribute('user_id', 1);
                        $missing_person->setAttribute('user_ip', 'local');
                        $missing_person->setAttribute('moderated', $this->moderated ?? 0);
                        $missing_person->save();

                        echo ($missing_person->moderated ? "\033[32mОпубликован" : "\033[33mДобавлен") . ": {$row->childNodes[0]->textContent} : {$row->childNodes[1]->textContent}\n";
                    }
                }
            }
        } else {
            echo "\033[31m\033[1m Path unsetted! \n";
        }
    }
}