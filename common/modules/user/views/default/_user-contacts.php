<?php
use yii\helpers\Html;
use frontend\helpers\ContactsHelper;
?>

<div class="row user-contact ">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <p class="title">Languages:</p>
        <?php
            $languages = ContactsHelper::getLanguages($profile->user);
            foreach ($languages as $language) {
        ?>
        <p style="font-weight: <?= empty($language['is_native']) ? 'normal' : 'bold'; ?>">
            <?=Html::encode($language['full_name']); ?>
            <a href="#" data-sign="<?=$language['name']; ?>" class="edit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>
        </p>
        <?php
            }
        ?>
        <p class="title">Verified Contacts:</p>
        <p>
            <?php echo isset($profile->adress_mailing) ? $profile->adress_mailing : ''?>
            <a href="#" data-sign="AdressMailing" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
        <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
            <?php echo isset($profile->phone) ? $profile->phone : ''?>
            <a href="#" data-sign="Phone" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <p class="title">Mailing Address:</p>
        <p>
            <?php echo isset($profile->adress_billing) ? $profile->adress_billing : '' ?>
            <a href="#" data-sign="BillingAddress" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
        <p class="title"><?=Yii::t('app','Ppayee Details').':'?>:</p>
        <p>
            <?php echo $paymentProfileChoiseMessage ?>
            <a href="#" data-sign="PayeeProfile" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
    </div>
</div>  