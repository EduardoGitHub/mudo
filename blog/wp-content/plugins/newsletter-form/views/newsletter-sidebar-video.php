<?php
/**
 * 
 * NEWSLETTER FORM BY CONTACTUS.COM
 * 
 * Initialization Newsletter Sidebar View
 * @since 1.0 First time this was introduced into Newsletter Form plugin.
 * @author ContactUs.com <support@contactus.com>
 * @copyright 2014 ContactUs.com Inc.
 * Company      : contactus.com
 * Updated  	: 20140127
 * */
?>

<?php if(!empty($cUs_API_Account)){ ?>
    <div class="premium_chat">
        <a href="http://wordpress.org/plugins/contactus-chat/" target="_blank">
            <img src="<?php echo plugins_url('assets/style/images/upgrade-banner-admin.png', dirname(__FILE__)); ?>" width="100%" height="auto" alt="Upgrade for Awesome Chat Features"  />
        </a>
    </div>
<?php } ?>
<div id="plugin-banner">
    <h2 class="plugin-banner-title">ContactUs.com</h2>
    <h3 class="plugin-banner-subtitle"> offers so much more than what we could fit into this plugin. </h3>
    <a href="http://www.contactus.com/product-tour/" target="_blank" class="btnpb-green btnpb">Tour Our Products</a>
    <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($default_deep_link)); ?>" target="_blank" class="btnpb-orange btnpb">Visit Your Admin Panel</a>
    <p class="plugin-banner-content">ContactUs.com builds customer acquisition software to make your website work better for your business. We  provide lots of free tools, and valuable premium tools, to help you grow and manage online customers.</p>
</div>
<div class="video">
    <h2>Plugin Overview</h2>
    <iframe width="100%" height="auto" src="//www.youtube.com/embed/8UR24VcOnBY" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>