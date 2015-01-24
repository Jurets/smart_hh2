<?php
use common\components\CabinetWidget;

echo CabinetWidget::widget([
            'popup' => '/default/popup-layout',
            'path' => '/default/cabinet',
            'signature' => $signature,
            'dataSet' => $dataSet,
            'destinationClass' => $destinationClass
        ]);

?>