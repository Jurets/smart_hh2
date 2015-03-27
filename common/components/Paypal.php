<?php

namespace common\components;

use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use PayPal\Api\Address;
use PayPal\Api\CreditCard;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\FundingInstrument;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\RedirectUrls;
use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;


class Paypal extends \marciocamello\Paypal{
    
    /** @var ApiContext */
    protected $_apiContext;
    
    /**
     * @setConfig 
     * _apiContext in init() method
     */
    public function init()
    {
        $this->setConfig();
    }
    
    /**
     * @inheritdoc
     */
    protected function setConfig()
    {
        // ### Api context
        // Use an ApiContext object to authenticate
        // API calls. The clientId and clientSecret for the
        // OAuthTokenCredential class can be retrieved from
        // developer.paypal.com

        $this->_apiContext = new ApiContext(
            new OAuthTokenCredential(
                $this->clientId,
                $this->clientSecret
            )
        );

        // Set file name of the log if present
        if (isset($this->config['log.FileName'])
            && isset($this->config['log.LogEnabled'])
            && ((bool)$this->config['log.LogEnabled'] == true)
        ) {
            $logFileName = \Yii::getAlias($this->config['log.FileName']);

            if ($logFileName) {
                if (!file_exists($logFileName)) {
                    if (!touch($logFileName)) {
                        throw new ErrorException('Can\'t create paypal.log file at: ' . $logFileName);
                    }
                }
            }

            $this->config['log.FileName'] = $logFileName;
        }
                // #### SDK configuration

        // Comment this line out and uncomment the PP_CONFIG_PATH
        // 'define' block if you want to use static file
        // based configuration
        $this->_apiContext->setConfig(ArrayHelper::merge(
            [
                'mode'                      => self::MODE_SANDBOX, // development (sandbox) or production (live) mode
                'http.ConnectionTimeOut'    => 30,
                'http.Retry'                => 1,
                'log.LogEnabled'            => YII_DEBUG ? 1 : 0,
                'log.FileName'              => Yii::getAlias('@runtime/logs/paypal.log'),
                'log.LogLevel'              => self::LOG_LEVEL_FINE,
                'validation.level'          => 'log',
                'cache.enabled'             => 'true'
            ],$this->config)
        );

        return $this->_apiContext;
    }
    
    /**
     * 
     * @param \common\models\Ticket $ticket
     * @param integer $performerId
     * @param float $price
     * 
     * @return Payment Payment created
     */
    public function createPayment($ticket, $performerId, $price){
        //TODO make editable        
        $currency = 'USD';
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        $item = new Item();
        $postbackData = \yii\helpers\Json::encode([
                    'ticketId' => $ticket->id,
                    'performerId' => $performerId
        ]);
        $item->setName('Payment for ' . $ticket->title)
                //->setPostbackData($postbackData)
                ->setPrice($price)
                ->setSku($ticket->id)
                ->setCurrency($currency)
                //->setUrl(Url::to(['/ticket/view', 'id' => $ticket->id],true))
                ->setQuantity(1);
        
        $itemList = new ItemList();
        $itemList->addItem($item);
        
        $amount = new Amount();
        $amount->setTotal($price)->setCurrency($currency);
        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription(Yii::t('app', 'Payment for job'))
                ->setInvoiceNumber(uniqid());
        
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(Url::to(
                [
                    'ticket/execute-payment', 'success' => true,
                    'fusr' => $ticket->user_id,
                    'tusr' => $performerId,
                    'p' => $price,
                    't' => $ticket->id
                ],
                true))
                ->setCancelUrl(Url::to(['ticket/execute-payment', 'success' => false], true));
        
        $payment = new Payment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);
        try {
            $payment->create($this->_apiContext);
        } catch (\Exception $ex) {
            Yii::error($ex->getMessage());
        }
        
        return $payment;
    }
    
    /**
     * 
     * @param string $paymentId
     * @param string $payerId
     * @return \PayPal\Api\Payment|boolean
     */
    public function executePayment($paymentId, $payerId){
        $payment = Payment::get($paymentId, $this->_apiContext);
        
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
        
        try{
            $result = $payment->execute($execution, $this->_apiContext);
            
        } catch (\Exception $ex) {
            Yii::error($ex->getMessage());
            return false;
        }
        return $result;
    }
    
    /**
     * 
     * @param Payment $result
     */
    public function processResult($result, $offer){
        if($result->getState() !== 'approved'){
            return false;
        }
        
    }
}
