<?php

namespace console\controllers;

use common\models\Ticket;

class TicketController extends \yii\console\Controller {

    public function actionCloseDoneByPerformer() {
        try {
            $command = \Yii::$app->db->createCommand();
            $command->update('ticket', ['status' => Ticket::STATUS_COMPLETED], [
                'and',
                ['ticket.status' => Ticket::STATUS_DONE_BY_PERFORMER],
                'TIMESTAMPDIFF(HOUR,updated_at,CURRENT_TIMESTAMP) >= :autoClosePeriod',
                ['not exists', (new \yii\db\Query)->select('complaint.id')->from('complaint')->where('complaint.ticket_id=ticket.id')],
                    ], [':autoClosePeriod' => \Yii::$app->params['ticket.autoClosePeriod']]
            );
            $rowsAffected = $command->execute();
            \Yii::info($rowsAffected . ' tickets closed automatically', __METHOD__);
            return \yii\console\Controller::EXIT_CODE_NORMAL;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage(), __METHOD__);
        }
        return \yii\console\Controller::EXIT_CODE_ERROR;
    }

}
