<style>

    /* The Modal (background) */
    .icc-modal-container {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        padding-top: 20%; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        z-index: 9999;
    }

    /* Modal Content */
    .icc-modal-content {
        background-color: #fefefe;
        margin: auto;
        width: 40%;
        border: solid 4px red;
    }

    /* The Close Button */
    .icc-close-modal {
        color: #fff;
        background-color: #035841;
        border-color: #035841;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        position: absolute;
        right: 10px;
    }
    .icc-close-modal-term {
        color: red;
        font-size: 15px;
        font-weight: bold;
    }
    .icc-modal-content p {
        text-align: center;
    }
    .icc-modal-container .btn-primary {
        color: #fff;
        background-color: #035841;
        border-color: #035841;
    }
    .icc-modal-container .btn-primary:hover {
        color: #fff;
        background-color: #49a942;
        border-color: #49a942;
    }
    .icc-modal-container .btn-primary:not(:disabled):not(.disabled):active {
        color: #fff;
        background-color: #0062cc;
        border-color: #005cbf;
    }
    .icc-modal-container .icc-modal-header {
        background: #035841;
        height: 45px;
        text-align: center;
        color: #ffffff;
        margin: 0;
        padding: 0;
        vertical-align: middle;
        margin-bottom: 20px;
    }
    .icc-modal-header .icc-modal-h2 {
        color: #fff;
        font-size: 28px;
        padding: 0;
        margin: 5px;
    }
    .icc-modal-container .modal-data{
        padding: 10px 20px 10px 20px;
    }
    .icc-modal-container .align-center{
        text-align: center;
    }
    .icc-modal-container .btn-container{
        padding: 0 0 7px 0;
    }
    .icc-modal-container a.link-modal {
        text-decoration: underline;
        color: #035841;
    }
    .icc-notice-bar {
        width: 100% !important;
        position: relative;
    }
    .icc-modal-content-box {
        display: block !important;
    }
    @media (max-width: 768px) {
        .icc-modal-content {
            width: 90%;
        }
    }
</style>

<div id="sessionPopUp" class="icc-modal-container">
    <!-- Modal content -->
    <div class="icc-modal-content">
        <div class="row icc-modal-header">
            <div class="icc-notice-bar col-lg-12">
                <h2 class="icc-modal-h2">Notice <span class="icc-close-modal">&times;</span></h2>
            </div>
        </div>
        <div class="icc-modal-content-box row">
            <div class="col-lg-12">
                <p class="modal-data">Welcome! By using this website, you agree to our updated Website <a class="link-modal" href="<?php echo get_option('link_url','https://www.iccsafe.org/about/terms-of-use/') ; ?>">Terms of Use</a>, which will become effective on <?php echo get_option('effective_date','January 1, 2023') ; ?>.
                <br>
                <a class="link-modal" href="<?php echo get_option('link_url','https://www.iccsafe.org/about/terms-of-use/') ; ?>"> View Updated Website Terms of Use </a></p>
                <br>
            </div>
            <div class="col-lg-12 align-center btn-container">
                <button type="button" class="form-action btn btn-primary icc-close-modal-term ">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var pathname = window.location.pathname;
    var cookie_domain = '';
    var expiredate = '';
    cookie_domain = "<?php echo get_option('cookie_domain') ; ?>";
    expiredate = "<?php echo get_option('cookie_expiration_date','2023-01-15'); ?>";
    jQuery(document).ready(function(){
    var hasSeenModal = getTermsCookie('hasSeenModal');
    if (hasSeenModal || pathname == '/about/terms-of-use') {
       jQuery('#sessionPopUp').hide();
    } else {
       jQuery('#sessionPopUp').show();
    }
    jQuery(".icc-close-modal, .icc-close-modal-term").click(function(){
        jQuery('#sessionPopUp').hide();
    });
    createTermsCookie('hasSeenModal',true,30);
});
function createTermsCookie(name,value,days) {
    var expires = ""; 
        expiredate = expiredate.replace(/-/g, '/');
    var date = new Date(expiredate);
    if (days && !isNaN(date.getTime())) {
        //date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    if(cookie_domain!=''){
        document.cookie = name + "=" + (value || "")  + expires + "; domain= "+cookie_domain+"; path=/"; 
    }else{
        document.cookie = name + "=" + (value || "")  + expires + "; path=/"; 
    }
    
}
function getTermsCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name +'=; domain= '+cookie_domain+'; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
</script>