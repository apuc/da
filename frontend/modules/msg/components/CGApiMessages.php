<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 13.06.19
 * Time: 9:31
 */

namespace frontend\modules\msg\components;


use vision\messages\components\MyMessages;
use vision\messages\models\Messages;
use yii\db\Query;

class CGApiMessages extends MyMessages
{
    /**
     * Method to getMessages.
     *
     * @param $whom_id
     * @param $from_id
     * @param $last_id
     * @param $type
     *
     * @throws ExceptionMessages
     * @return array
     */
    public function getMessages($whom_id, $from_id = null, $offset = null, $type = null, $last_id = null) {
        $table_name = Messages::tableName();
        $my_id = $this->getIdCurrentUser();
        $query = (new Query())
            ->select([
                'msg.created_at',
                'msg.id',
                'msg.status',
                'msg.message',
                'from_id'   => 'usr1.id',
                'from_name' => "usr1.{$this->attributeNameUser}",
                'whom_id'   => 'usr2.id',
                'whom_name' => "usr2.{$this->attributeNameUser}"
            ])
            ->from(['msg' => $table_name])
            ->leftJoin(['usr1' => $this->userTableName], 'usr1.id = msg.from_id')
            ->leftJoin(['usr2' => $this->userTableName], 'usr2.id = msg.whom_id')
            ->limit(10)
            ->offset($offset);

        if($from_id) {
            $query
                ->where(['msg.whom_id' => $whom_id, 'msg.from_id' => $from_id])
                ->orWhere(['msg.from_id' => $whom_id, 'msg.whom_id' => $from_id]);
        } else {
            $query->where(['msg.whom_id' => $whom_id]);
        }


        //if not set type
        //send all message where no delete
        if($type) {
            $query->andWhere(['=', 'msg.status', $type]);
        } else {
            /*
            $query->andWhere('((msg.is_delete_from != 1 AND from_id = :my_id) OR (msg.is_delete_whom != 1 AND whom_id = :my_id) ) ', [
                ':my_id' => $my_id,
            ]);
            */
        }

        $query->andWhere('((msg.is_delete_from != 1 AND from_id = :my_id) OR (msg.is_delete_whom != 1 AND whom_id = :my_id) ) ', [
            ':my_id' => $my_id,
        ]);

        if($last_id){
            $query->andWhere(['>', 'msg.id', $last_id]);
        }

        $return = $query->orderBy('msg.id')->all();
        $ids = [];
        foreach($return as $m) {
            if($m['whom_id'] == $my_id) {
                $ids[] = $m['id'];
            }
        }

        //change status to is_read
        if(count($ids) > 0) {
            Messages::updateAll(['status' => Messages::STATUS_READ], ['in', 'id', $ids]);
        }

        $user_id = $this->getIdCurrentUser();
        return array_map(function ($r) use ($user_id) {
            $r['i_am_sender'] = $r['from_id'] == $user_id;
            $r['created_at'] = \DateTime::createFromFormat('U', $r['created_at'])->format('d-m-Y H-i-s');
            return $r;
        },
            $return
        );
    }

    public function getAllMessages($whom_id, $from_id) {
        return $this->getMessages($whom_id, $from_id);
    }

}