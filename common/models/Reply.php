<?php
namespace common\models;

interface Reply {
    /**
     * @return \yii\db\ActiveQuery Performer who replied
     */
    public function getPerformer();
    /**
     * @return string
     */
    public function getDate();
    /**
     * @return float
     */
    public function getPrice();
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket();
    /**
     * @return string
     */
    public function getMessage();
}
