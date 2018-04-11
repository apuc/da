<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 11.04.2018
 * Time: 11:19
 */

namespace common\classes;

class DaMail
{
    public $subject;
    public $to;
    public $from;
    public $tpl;
    public $content;

    public function setSubject($subject)
    {
        if (!empty($subject)) {
            $this->subject = $subject;
        }
        return $this;
    }

    public function setTo($to)
    {
        if (!empty($to)) {
            $this->to = $to;
        }
        return $this;
    }

    public function setFrom($from)
    {
        if (!empty($from)) {
            $this->from = $from;
        }
        return $this;
    }

    public function setTpl($tpl)
    {
        if (!empty($tpl)) {
            $this->tpl = $tpl;
        }
        return $this;
    }

    public function setContent($content)
    {
        if (!empty($content)) {
            $this->content = $content;
        }
        return $this;
    }

    public function send()
    {
        return \Yii::$app->mailer->compose($this->tpl, ['content' => $this->content])
            ->setFrom($this->from)
            ->setTo($this->to)
            ->setSubject($this->subject)
            ->send();
    }

    public static function createMsg()
    {
        return new self();
    }

}