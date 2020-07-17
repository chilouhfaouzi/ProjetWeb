<?php 
session_start();
$pageTitle="Help"; 
include "admin/init.php";
?>
<section class="help text-center">
    
<div class="container ">

<h1>Help</h1>
</div>
<?php
if (!isset($_SESSION['username'])) { 
?>
<div class="sign_more_help">
    <div class="container text-center">
    <h4>Get personalized help and see your recent orders</h4>
    <a class="btn btn-primary" href="login.php">Sign</a>
    <p>Don't have an account? <a class="register_now" href="login.php">Register now <i class="fa fa-arrow-right"></i> </a></p>
    </div> <!--ENd Container -->
</div>
<?php
}
?>
<div class="frequently_ques ">
    <div class="container">

    
        <h2 >Commonly Asked Questions</h2>
        <h4>How do I contact Customer Service?</h4>
        <p>Check out our Help Page on Contacting Customer Service for a link to contact us as well as additional details that may help you find an answer to your question. We are available by phone 7 days a week, 5:00 am to 10:00 pm PT for most topics and 24 hours a day for some Account Security concerns. While only certain topics offer email or chat support at this time, we’re always working to expand our contact options.</p>
        <h4>What do I do if I experience a technical issue on Bouki?</h4>
        <p>From time to time you may experience an issue on the site and we recommend trying the following steps to rule out a localized cause:
        Clear your browsing history
        Try accessing the same page in another browser, device and/or private browsing window
        Ensure your browser, app and/or device are all up to date
        Check your Internet or mobile data connection
        Make sure that your security software is not interfering with any site features or pages
        Disable any browser add-ons or plugins (such as adblockers) that may cause interference</p>
        <h4>Who is responsible for a package lost in transit?</h4>
        <p>The party that pays for the shipping label is typically responsible for any loss or damage that occurs in transit, as they would have had the option to buy insurance for added protection.

        If you have sold an item and it goes missing on the way to its destination, we recommend that you can work with your chosen courier to locate it. If it becomes clear the package cannot be recovered, a refund will need to be issued to your customer.</p>
        <h4>How do I bid/buy and pay for a car on Bouki?</h4>
        <p>Unlike most other purchases on eBay, buying a car on eBay Motors won't be through eBay Checkout. You will actually work with the dealer directly for payment arrangements, which typically include a deposit. Depending on the listing format, you can Bid on vehicles, Buy It Now or Make an Offer when the option is available.</p>
    </div>
</div>
<div class="contact-us">
<div class="container">
    <h2>Contact US</h2>
    <div class="row">
        <div class="col-md-6">
         <h3 class="H-contact"> <i class="fas fa-phone"></i> Call Us </h3>  
         <p class="tel"> + 212 706 342 827 </p>
         <p>5 min wait time</p>
        </div>
        <div class="col-md-6">
         <h3 class="H-contact"> <i class="fas fa-phone"></i> Chat With Us </h3>  
         <p class="tel"> <a href="mailto:bouki@gmail.com">bouki@gmail.com </a></p>
         <p>8 min wait time</p>
        </div>
    </div>
    
</div>    
</div>

</div> 
</section>
<?php  include $tpl.'footer.php'; ?>