<?php

use yii\helpers\Url;
use common\components\Commonhelper;

Yii::$app->language = Commonhelper::getLanguage();

?>
<?php
$this->title = Yii::t('app', 'FAQ');
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->language = Commonhelper::getLanguage();

?>


<div class="row">
    <div class="left-column col-xs-12 col-sm-12 col-md-4 col-lg-4">



        <div class="sidebar">
            <ul class="sidebar-holder">
                <li>
                    <a href="<?= Url::to(['site/aboutus', 'language' => Commonhelper::getLanguage()], true) ?>"><img alt="icon" src="../../frontend/web/images/categories/AllTask.png"><?= Yii::t('app', 'About Us') ?></a>
                </li>
                <li>
                    <a href="<?= Url::to(['site/faq', 'language' => Commonhelper::getLanguage()], true) ?>"><img alt="icon" src="../../frontend/web/images/categories/Miscellaneous.png"><?= Yii::t('app', 'FAQ') ?></a>
                </li>
                <li>
                    <a href="<?= Url::to(['site/termsandagreements', 'language' => Commonhelper::getLanguage()], true) ?>"><img alt="icon" src="../../frontend/web/images/categories/webDisignInternet.png"><?= Yii::t('app', 'Terms & Agreement') ?></a>
                </li>
                <li>
                    <a href="<?= Url::to(['site/contactus', 'language' => Commonhelper::getLanguage()], true) ?>"><img alt="icon" src="../../frontend/web/images/categories/VirtualAssistant.png"><?= Yii::t('app', 'Contact US') ?></a>
                </li>
            </ul>
        </div>



    </div>
    <div class="right-column col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="static-right-text">
            <!-- begin content -->

            <p>Helping Hut SPANISH FAQ</p>
            <h4>¿Qué es Helping Hut?</h4>
            <p>Helping Hut es una plataforma donde se puede conectar con la gente para realizar un trabajo. Tiene el propósito de conectar con personas cercanas que pueden completar una trabajo con cual necesita ayuda. Usted puede enumerar un trabajo que hay que hacer, y un “Helper”, la persona que puede hacer el trabajo, le puede ofrecer un precio o aceptar su oferta de precio para hacer el trabajo.</p>

            <h4>¿Cómo puedo publicar un trabajo?</h4>
            <p>Publicar un trabajo es libre y fácil. Usted necesitará una cuenta de PayPal (sólo se le cobrará cuando usted se compromete a contratar a alguien). Primero hay que registrarse y crear su perfil, Despues, en la página principal, bajo "Recibe ayuda y ahorra tiempo", elija "enlista ayuda". Usted será redirigido a una forma que tiene que ser llenada en las especificaciones necesarias para describir el trabajo. Puede establecer sus condiciones y precio. Cuando encuentre un ayudante y los dos conceden a las condiciones de cada uno, se le pedirá que hacer un pago que se aguanta por Helping Hut y se otorgará a el ayudante cuando el trabajo se confirma ser terminado.</p>

            <h4>¿Puedo pagar por un trabajo con dinero en efectivo?</h4>
            <p>El pago de el trabajo debe hacerse a través de PayPal. Si hay cargos extra (por ejemplo, propinas o millas de vehiculos) debe negociarse con el Helper para pagar en efectivo. </p>

            <h4>¿Cómo puedo ser un Helper?</h4>
            <p>Para convertirse en un Helper, usted puede enumerar sus especialidades en su perfil, a continuación, se puede establecer</p>
            <p>su tarifa por hora. Si alguien está buscando a un Helper para realizar un trabajo en su especialidad, la persona le puede ofrecer el trabajo. Usted también puede buscar trabajos disponible en su área y ofrecer sus servicios.</p>
            <h4>¿A quién debo hablar sobre una asociación de marketing?</h4>
            <p>Por favor contacte a info@helpinghut.com con sus preguntas.</p>

            <h4>¿Cuándo expira un trabajo que esta disponible en la lista de Helping Hut?</h4>
            <p>Si no a encontrado a alguien que haga el trabajo, el trabajo expira cuando la fecha en que debe realizarse pasa.</p>

            <h4>¿Cómo desactivo mi cuenta?</h4>
            <p>Por favor contacte a support@helpinghut.com para desactivar su cuenta.</p>

            <h4>¿Puedo contratar a más de una persona para hacer un trabajo?</h4>
            <p>No se puede crear una forma para dos o más personas. Por cada persona que necesita para un trabajo, puede hacer una forma de trabajo independiente.</p>

            <h4>¿Qué pasa si tengo una duda, problema o disputa?</h4>
            <p>Helping Hut no emplea ningunos de los Helpers. Si usted tiene cualquier pregunta específica con respecto a el trabajo, debe dirigir la pregunta a su Helper. Si se encuentra con un problema que el Helper no puede contestar, puede comunicarse con nosotros por support@helpinghut.com</p>

            <h4>¿Qué hago si veo contenido que es inapropiado?</h4>
            <p>Si encuentra algún contenido que usted cree que es inadecuado, por favor contacte a support@helpinghut.com y retiraramos el contenido si lo consideramos inadecuados.</p>


            <h4>¿Cómo y cuándo me pagan por mi trabajo?</h4>
            <p>Helping Hut le paga por PayPal cuando cliente marca el trabajo como terminado. Si a usted le gustaría ser pagado a través de cheque, la cantidad de dinero debe ser $200, mínimo.</p>

            <h4>¿Me reembolsarán los gastos extra, po ejemplo para los autos alquilados, los gastos de estacionamiento, o otros gastos similares ?</h4>
            <p>Helping Hut no es asociado, ni emplea cualquier de los Helpers. Si el trabajo o Helper necesita gastos adicionales, usted debe negociar con el Helper. Helping Hut no reembolsa ningun cargo extra. Le pedimos que usted hable con su Helper al respecto de la posibilidad de gastos adicionales, antes de comenzar con el trabajo.</p>

            <h4>¿Helping Hut tiene una aplicación para Android o iPhone?</h4>
            <p>No, por el momento no tenemos una aplicación. Nuestra pagina está disponible para en dispositivos móviles.</p>

            <h4>¿Qué es la comisión de servicio de Helping Hut?</h4>
            <p>La comisión de servicio de Helping Hut es el 7% de cada partido. Por ejemplo, digamos un trabajo costará $ 100: El cliente pagando para el trabajo tendrá que pagar $107 y el Helper va a recibir $97 cuando se haya completado el trabajo.</p>

            <h4>¿Cuál es la políza de cancelación de un trabajo?</h4>
            <p>Usted puede cancelar un trabajo en cualquier momento antes que el Helper empieza el trabajo. Si ha hecho su depósito la comisión de 7% de Helping Hut será deducido de su reembolso.</p>

            <!-- end content -->
        </div>
        <br>
        <a style="width:250px;" href="<?= Url::to('#') ?>" class="btn btn-big btn-width joinNow"><?= Yii::t('app', 'WANNA BE A HELPER').'?' ?></a>
        &nbsp;
        <a style="width:250px;" href="<?= Url::to(['/ticket/create'], true) ?>" class="btn btn-big btn-width btn-red"><?= Yii::t('app', 'CREATE A TASK') ?></a>

    </div>
</div>


<div class="clear"></div>