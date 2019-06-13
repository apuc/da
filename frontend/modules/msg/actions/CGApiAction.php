<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 12.06.19
 * Time: 17:32
 */

namespace frontend\modules\msg\actions;


use frontend\modules\msg\components\CGApiMessages;
use vision\messages\actions\MessageApiAction;

class CGApiAction extends MessageApiAction
{
    protected $offset;

    /**
     *
     */
    public function init()
    {
        $method = "get";
        if (\Yii::$app->request->isPost)
        {
            $method = "post";
        }
        $request = \Yii::$app->request;
        $this->action  = $request->$method('action', 'undefined');
        $this->whom_id = $request->$method('whom_id', false);
        $this->isEmail = $request->$method('isEmail', false);
        $this->message = $request->$method('text', false);
        $this->from_id = $request->$method('from_id', false);
        $this->offset = $request->$method('offset',false);
    }

    protected function getMessage() {
        $mess = new CGApiMessages();
        $data['messages'] = $this->getMessageComponent();
        $data['messages'] = $mess->getMessages(\Yii::$app->user->getId(), $this->from_id, $this->offset);
        $data['from_id'] = $this->from_id;
        return $data;
    }


}