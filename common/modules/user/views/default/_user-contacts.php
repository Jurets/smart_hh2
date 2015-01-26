<div class="row user-contact ">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <p class="title">Languages:</p>
        <p>English<a href="#" data-sign="english" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
        <p>Russian<a href="#" data-sign="russian" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
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
        <p class="title">PayPal:</p>
        <p>
            <?php echo isset($profile->paypal) ? $profile->paypal : ''?>
            <a href="#" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
    </div>
</div>  