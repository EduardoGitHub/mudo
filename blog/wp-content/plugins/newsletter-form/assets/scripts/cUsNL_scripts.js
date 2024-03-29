
//PLUGIN cUsNL_myjq ENVIROMENT (cUsNL_myjq)
var cUsNL_myjq = jQuery.noConflict();

cUsNL_myjq(window).error(function(e){
    e.preventDefault();
});

//ON READY DOM LOADED
cUsNL_myjq(document).ready(function($) {
    
    try{
        
        //LOADING UI BOX
        cUsNL_myjq( ".cUsNL_preloadbox" ).delay(1500).fadeOut();
        
        //UI TABS
        cUsNL_myjq( "#cUsNL_tabs" ).tabs({active: false});
        
        //GO TO SHORTCODES TABS LINK
        cUsNL_myjq( ".goto_shortcodes" ).click(function(){
            cUsNL_myjq( "#cUsNL_tabs" ).tabs({ active: 2 });
        });
        
        //UNBIND UI TABS LINK ON CLICK
        cUsNL_myjq("li.gotohelp a").unbind('click');
        
        //FORMS AND TABS TEMPLATE SELECTION SLIDER
        cUsNL_myjq('.selectable_cf, .selectable_tabs_cf').bxSlider({
            slideWidth: 160,
            minSlides: 4,
            maxSlides: 4,
            moveSlides:1,
            infiniteLoop:false,
            //captions:true,
            pager:true,
            slideMargin: 5
        });
        
        //PAGES FORM SELECTION SLIDER
        cUsNL_myjq('.template_slider').bxSlider({
            slideWidth: 160,
            minSlides: 4,
            maxSlides: 4,
            moveSlides:1,
            infiniteLoop:false,
            preloadImages:'all',    
            //captions:true,
            pager:true,
            slideMargin: 5
        });
        
        //colorbox window
        cUsNL_myjq(".tooltip_formsett").colorbox({iframe:true, innerWidth:'75%', innerHeight:'80%'});   
        
        //TEMPLATE SELECTION
        cUsNL_myjq( '.options' ).buttonset();
        cUsNL_myjq( '.form_types' ).buttonset();
        cUsNL_myjq( '#inlineradio' ).buttonset();
        
        cUsNL_myjq( '.bx-loading' ).hide(); //DOM BUG FIX
        
        //SELECTED CONTACT FORM TEMPLATE
        cUsNL_myjq(".selectable_cf, .selectable_news").selectable({
            selected: function(event, ui) {
                var idEl = cUsNL_myjq(ui.selected).attr('id');
                cUsNL_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");           
                cUsNL_myjq('#Template_Desktop_Form').val(idEl);           
            }                   
        });
        
        //SELECTED FORM TAB TEMPLATE
        cUsNL_myjq(".selectable_tabs_cf, .selectable_tabs_news").selectable({
            selected: function(event, ui) {
                var idEl = cUsNL_myjq(ui.selected).attr('id');
                cUsNL_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");           
                cUsNL_myjq('#Template_Desktop_Tab').val(idEl);           
            }                   
        });
        
        //SELECTED CONTACT FORM TEMPLATE
        cUsNL_myjq(".selectable_ucf, .selectable_unews").selectable({
            selected: function(event, ui) {
                var idEl = cUsNL_myjq(ui.selected).attr('id');
                cUsNL_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");           
                cUsNL_myjq('#uTemplate_Desktop_Form').val(idEl);           
            }                   
        });
        
        //SELECTED FORM TAB TEMPLATE
        cUsNL_myjq(".selectable_tabs_ucf, .selectable_tabs_unews").selectable({
            selected: function(event, ui) {
                var idEl = cUsNL_myjq(ui.selected).attr('id');
                cUsNL_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");           
                cUsNL_myjq('#uTemplate_Desktop_Tab').val(idEl);           
            }                   
        });

        //UI ACCORDIONS
        cUsNL_myjq( "#terminology" ).accordion({
            collapsible: true,
            heightStyle: "content",
            active: false,
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
        
        cUsNL_myjq( "#user_forms" ).accordion({
            collapsible: true,
            heightStyle: "content",
            active: true,
            icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" }
        });
        
        cUsNL_myjq( ".user_templates" ).accordion({
            collapsible: true,
            active: false,
            heightStyle: "content",
            icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" }
        });
        
        cUsNL_myjq( "#form_examples, #tab_examples" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
        
        cUsNL_myjq( ".form_templates_aCc" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" }
        });
        
        cUsNL_myjq( ".signup_templates" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
       
    }catch(err){
        cUsNL_myjq('.advice_notice').html('Error - please update your version of WordPress to the latest version. If the problem continues, contact us at support@contactus.com.: ' + err ).slideToggle().delay(2000).fadeOut(2000);
    }
    
    //TOOLTIPS
    try{
        //JQ UI TOOLTIPS
        cUsNL_myjq(".setLabels").tooltip();
    }catch(err){
        cUsNL_myjq('.advice_notice').html('Error - please update your version of WordPress to the latest version. If the problem continues, contact us at support@contactus.com. ' + err ).slideToggle().delay(2000).fadeOut(2000);
    }
    
    try{
        cUsNL_myjq('.setDefaulFormKey').change(function(){
            var sRadio = cUsNL_myjq(this);
            var form_key = cUsNL_myjq(this).val();
            cUsNL_myjq('.loadingMessage.def').show();
            cUsNL_myjq('.defaultF li .setLabel').html('<span class="ui-button-text">Set as Default</span>');
            //AJAX POST CALL setDefaulFormKey
            cUsNL_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_setDefaulFormKey',formKey:form_key},
                success: function(data) {

                    switch(data){
                        //SAVED
                        case '1':
                            
                            message = '<p>Form Key saved succesfuly . . . .</p>';
                            sRadio.next().html('<span class="ui-button-text">Default</span>');
                            break;
                        //API OR CONNECTION ISSUES
                        default:
                            message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com.</a></p>';
                            cUsNL_myjq('.advice_notice').html(message).show();
                            break;
                    }

                    cUsNL_myjq('.loadingMessage.def').fadeOut();

                },
                fail: function(){ //AJAX FAIL
                   message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com.</a></p>';
                   cUsNL_myjq('.advice_notice').html(message).show();
                   cUsNL_myjq('.loadingMessage.def').fadeOut();
                },
                async: false
            });
            
        });
    }catch(err){
        console.log(err);
    }
    
    
    //LOGIN ALREADY CUS OR OLD CUS USERS
    try{
        cUsNL_myjq('.cUsNL_LoginUser').click(function(e){
            
            e.preventDefault();
            
            var email = cUsNL_myjq('#login_email').val();
            var pass = cUsNL_myjq('#user_pass').val();
            cUsNL_myjq('.loadingMessage').show();

            //LENGTH VALIDATIONS
            if(!email.length){
                cUsNL_myjq('.advice_notice').html('User Email is a required and valid field').slideToggle().delay(2000).fadeOut(2000);
                cUsNL_myjq('#login_email').focus();
                cUsNL_myjq('.loadingMessage').fadeOut();
            }else if(!pass.length){
                cUsNL_myjq('.advice_notice').html('User password is a required field').slideToggle().delay(2000).fadeOut(2000);
                cUsNL_myjq('#user_pass').focus();
                cUsNL_myjq('.loadingMessage').fadeOut();
            }else{
                var bValid = checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. sergio@cUsNL_myjq.com" );  
                if(!bValid){ //EMAIL VALIDATION
                    cUsNL_myjq('.advice_notice').html('Please enter a valid User Email').slideToggle().delay(2000).fadeOut(2000);
                    cUsNL_myjq('.loadingMessage').fadeOut();
                }else{

                    cUsNL_myjq('.cUsNL_LoginUser').val('Loading . . .').attr('disabled', true);

                    //AJAX POST CALL
                    cUsNL_myjq.ajax({ type: "POST", dataType:'json', url: ajax_object.ajax_url, data: {action:'cUsNL_loginAlreadyUser',email:email,pass:pass},
                        success: function(data) {

                            switch(data.status){

                                //USER CRATED SUCCESS
                                case 1:

                                    cUsNL_myjq('.cUsNL_LoginUser').val('Success . . .');

                                    message = '<p>Welcome to ContactUs.com</p>';

                                    setTimeout(function(){
                                        cUsNL_myjq('#cUsNL_loginform').slideUp().fadeOut();
                                        location.reload();
                                    },2500);

                                    cUsNL_myjq('.notice').html(message).show().delay(3000).fadeOut();
                                    cUsNL_myjq('.cUsNL_LoginUser').val('Login').attr('disabled', false);

                                break;

                                //OLD USER DON'T HAVE DEFAULT CONTACT FORM
                                case 2:

                                    cUsNL_myjq('.cUsNL_LoginUser').val('Error . . .');

                                    message = '<p>To continue, you will need to create a default contact form.</p>';
                                    message += '<p> This takes just a few minutes by logging in to your ContactUs.com admin panel with the credentials you used to setup the plugin. '; 
                                    message += '<a href="https://admin.contactus.com/partners/index.php?loginName='+data.cUs_API_Account;
                                    message += '&userPsswd='+data.cUs_API_Key+'&confirmed=1&redir_url='+data.deep_link_view+'?';
                                    message += encodeURIComponent('pageID=81&id=0&do=addnew&formType=contact_us');
                                    message += ' " target="_blank">Click here to continue</a></p>';
                                    message += '<p>you will be redirected to our admin login page.</p>';

                                    cUsNL_myjq.messageDialogLogin('Default Newsletter Form Required');

                                    cUsNL_myjq('.cUsNL_LoginUser').val('Login').attr('disabled', false);
                                    
                                    cUsNL_myjq('#dialog-message').html(message);


                                break;

                                //API ERROR OR CONECTION ISSUES
                                case 3:
                                    cUsNL_myjq('.cUsNL_LoginUser').val('Login').attr('disabled', false);
                                    message = '<p>Unfortunately, we weren’t able to log you into your ContactUs.com account.</p>';
                                    message += '<p>Please try again with the email address and password used when you created a ContactUs.com account. If you still aren’t able to log in, please submit a ticket to our support team at <a href="http://help.contactus.com" target="_blank">http://help.contactus.com.</a></p>';
                                    message += '<p>Error:  <b>' + data.message + '</b></p>';
                                    cUsNL_myjq('.advice_notice').html(message).show();
                                break;

                                //API ERROR OR CONECTION ISSUES
                                case '':
                                default:
                                    cUsNL_myjq('.cUsNL_LoginUser').val('Login').attr('disabled', false);
                                    message = '<p>Unfortunately, we weren’t able to log you into your ContactUs.com account.</p>';
                                    message += '<p>Please try again with the email address and password used when you created a ContactUs.com account. If you still aren’t able to log in, please submit a ticket to our support team at <a href="http://help.contactus.com" target="_blank">http://help.contactus.com.</a></p>';
                                    message += '<p>Error:  <b>' + data.message + '</b></p>';
                                    cUsNL_myjq('.advice_notice').html(message).show();
                                    break;
                            }

                            cUsNL_myjq('.loadingMessage').fadeOut();


                        },
                        fail: function(){ //AJAX FAIL
                           message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com.</a></p>';
                           cUsNL_myjq('.advice_notice').html(message).show();
                           cUsNL_myjq('.cUsNL_LoginUser').val('Login').attr('disabled', false); 
                        },
                        async: false
                    });
                }
            }
        });
    
    }catch(err){
        message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com.</a></p>';
        cUsNL_myjq('.advice_notice').html(message).show();
        cUsNL_myjq('.cUsNL_LoginUser').val('Login').attr('disabled', false); 
    };
    
    //jQ UI ALERTS & MESSAGE DIALOGS
    cUsNL_myjq.messageDialogLogin = function(title){
        try{
            cUsNL_myjq( "#dialog-message" ).dialog({
                modal: true,
                title: title,
                minWidth: 520,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        }catch(err){
            //console.log(err);
        }
    };
    
    //JUI CUSTOM ALERTS AND MESSAGE DIALOGS
    cUsNL_myjq.messageDialog = function(title, msg){
        try{
            cUsNL_myjq( "#dialog-message" ).html(msg);
            cUsNL_myjq( "#dialog-message" ).dialog({
                modal: true,
                title: title,
                minWidth: 520,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        }catch(err){
            //console.log(err);
        }
    };
    
    
    //SENT LIST ID AJAX CALL /// STEP 2
    try{
        cUsNL_myjq('#cUsNL_CreateCustomer').click(function(e) {
            
            e.preventDefault();
            
            var postData = {};
            
            //GET ALL FORM FIELDS DATA
            var cUsNL_first_name = cUsNL_myjq('#cUsNL_first_name').val();
            var cUsNL_last_name = cUsNL_myjq('#cUsNL_last_name').val();
            var cUsNL_phone = cUsNL_myjq('#cUsNL_phone').val();
            var cUsNL_email = cUsNL_myjq('#cUsNL_email').val();
            //EMAIL VALIDATION FUNCTION
            var cUsNL_emailValid = checkRegexp( cUsNL_email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. sergio@cUsNL_myjq.com" );
            var cUsNL_pass = cUsNL_myjq('#cUsNL_password').val();
            var cUsNL_pass2 = cUsNL_myjq('#cUsNL_password_r').val();
            var cUsNL_web = cUsNL_myjq('#cUsNL_web').val();
            //URL VALIDATION FUNCTION
            var cUsNL_webValid = checkURL(cUsNL_web);
            
           cUsNL_myjq('.loadingMessage').show();
           
           //lenght validations
           if( !cUsNL_first_name.length){
               cUsNL_myjq('.advice_notice').html('Your First Name is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('#cUsNL_first_name').focus();
               cUsNL_myjq('.loadingMessage').fadeOut();
           }else if( !cUsNL_last_name.length){
               cUsNL_myjq('.advice_notice').html('Your Last Name is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('#cUsNL_last_name').focus();
               cUsNL_myjq('.loadingMessage').fadeOut();
           }else if(!cUsNL_email.length){
               cUsNL_myjq('.advice_notice').html('Email is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('#apikey').focus();
               cUsNL_myjq('.loadingMessage').fadeOut();
           }else if(!cUsNL_pass.length){
               cUsNL_myjq('.advice_notice').html('Password is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('#cUsNL_password').focus();
               cUsNL_myjq('.loadingMessage').fadeOut();
           }else if(cUsNL_pass.length < 8){ //PASSWORD 8 CHARS VALIDATION
               cUsNL_myjq('.advice_notice').html('Password must be 8 characters or more').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('#cUsNL_password').focus();
               cUsNL_myjq('.loadingMessage').fadeOut();
           }else if(cUsNL_pass2 != cUsNL_pass){
               cUsNL_myjq('.advice_notice').html('Confirm Password not match').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('#cUsNL_password_r').focus();
               cUsNL_myjq('.loadingMessage').fadeOut();
           }else if(!cUsNL_emailValid){
               cUsNL_myjq('.advice_notice').html('Please, enter a valid Email').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('#cUsNL_email').focus();
               cUsNL_myjq('.loadingMessage').fadeOut();
           }else if(!cUsNL_web.length){
               cUsNL_myjq('.advice_notice').html('Your Website is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('#cUsNL_web').focus();
               cUsNL_myjq('.loadingMessage').fadeOut();
           }else if(!cUsNL_webValid){
               cUsNL_myjq('.advice_notice').html('Please, enter one valid website URL').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('#cUsNL_web').focus();
               cUsNL_myjq('.loadingMessage').fadeOut();
           }else{
                cUsNL_myjq('#cUsNL_CreateCustomer').val('Loading . . .').attr('disabled', true);
                
                postData = {action: 'cUsNL_verifyCustomerEmail', fName:str_clean(cUsNL_first_name),lName:str_clean(cUsNL_last_name),Email:cUsNL_email,Phone:cUsNL_phone,credential:cUsNL_pass,website:cUsNL_web};
                
                //AJAX POST CALL
                cUsNL_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: postData,
                    success: function(data) {
                        switch(data){
                            
                            //NO USER, CONTINUE WITH NEXT STEP
                            case '1':
                                message = '<h4>Continue with Form Design Selection . . .</h4>';
                                
                                setTimeout(function(){
                                    cUsNL_myjq('.step1').slideDown().fadeOut();
                                    cUsNL_myjq('.step2').slideUp().fadeIn();
                                },3000);
                                
                                cUsNL_myjq('#cUsNL_CreateCustomer').val('Next >>').attr('disabled', false);
                                cUsNL_myjq('.notice').html(message).show().delay(8000).fadeOut(2000);
                                
                            break;
                            
                            //OLD USER, LOGIN
                            case '2':
                                message = 'Seems like you already have one Contactus.com Account, Please Login below';
                                cUsNL_myjq('#cUsNL_CreateCustomer').val('Next >>').attr('disabled', false); 
                                setTimeout(function(){
                                    cUsNL_myjq('#login_email').val(cUsNL_email).focus();
                                    cUsNL_myjq('#cUsNL_userdata').fadeOut();
                                    cUsNL_myjq('#cUsNL_settings').slideDown('slow');
                                    cUsNL_myjq('#cUsNL_loginform').delay(1000).fadeIn();
                                },2000);
                                cUsNL_myjq('.advice_notice').html(message).show().delay(8000).fadeOut(2000);
                            break; 
                        
                            //API OR CONNECTION ISSUES
                            case '':
                            default:
                                message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com. <br/>Error: <b>' + data + '</b>.</a></p>';
                                cUsNL_myjq('.advice_notice').html(message).show();
                                cUsNL_myjq('#cUsNL_CreateCustomer').val('Next >>').attr('disabled', false);
                            break;
                        }
                        
                        cUsNL_myjq('.loadingMessage').fadeOut();
                        

                    },
                    fail: function(){ //AJAX FAIL
                       message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com.</a></p>';
                       cUsNL_myjq('.advice_notice').html(message).show();
                       cUsNL_myjq('#cUsNL_CreateCustomer').val('Next >>').attr('disabled', false); 
                    }
                });
           }
           
            
        });
    }catch(err){ //JS ISSUES
        cUsNL_myjq('.advice_notice').html('Unfortunately there has being an error during the application. ' + err).slideToggle().delay(2000).fadeOut(2000);
        cUsNL_myjq('#cUsNL_CreateCustomer').val('Next >>').attr('disabled', false);
    }
    
    //cUsNL_myjq("#cUsNL_SendTemplates").colorbox({inline:true, maxWidth:'100%', minHeight:'425px', scrolling:false });
    
    cUsNL_myjq("#cUsNL_SendTemplates").on('click', function(e) {
           
        e.preventDefault();
        
        var Template_Desktop_Form = cUsNL_myjq('#Template_Desktop_Form').val();
        var Template_Desktop_Tab = cUsNL_myjq('#Template_Desktop_Tab').val();

        if (!Template_Desktop_Form.length) {
            cUsNL_myjq('.advice_notice').html('Please select a form template before continuing.').slideToggle().delay(2000).fadeOut(2000);
            cUsNL_myjq('.loadingMessage').fadeOut();
            cUsNL_myjq(".signup_templates").accordion({active: 0});
        } else if (!Template_Desktop_Tab.length) {
            cUsNL_myjq('.advice_notice').html('Please select a tab template before continuing.').slideToggle().delay(2000).fadeOut(2000);
            cUsNL_myjq('.loadingMessage').fadeOut();
            cUsNL_myjq(".signup_templates").accordion({active: 1});
        } else {
            cUsNL_myjq("#cUsNL_SendTemplates").colorbox({escKey:false,overlayClose:false,closeButton:false, inline: true, maxWidth: '100%', minHeight: '430px', scrolling: false});
        }

    });
    
    //SIGNUP TEMPLATE SELECTION
    try{ cUsNL_myjq('.btn-skip').click(function(e) {
           
           e.preventDefault();
           var oThis = cUsNL_myjq(this);
           oThis.hide();
           cUsNL_myjq('#open-intestes').hide();
           
           //GET SELECTED TEMPLATES
           var Template_Desktop_Form = cUsNL_myjq('#Template_Desktop_Form').val();
           var Template_Desktop_Tab = cUsNL_myjq('#Template_Desktop_Tab').val();
           // this are optional so do not passcheck
           var CU_category 	= cUsNL_myjq('#CU_category').val();
           var CU_subcategory 	= cUsNL_myjq('#CU_subcategory').val();
           
            var new_goals = '';
            var CU_goals = cUsNL_myjq('input[name="the_goals[]"]').each(function(){
                    new_goals += cUsNL_myjq(this).val()+',';	
            });

            if( cUsNL_myjq('#other_goal').val() )
                    new_goals += cUsNL_myjq('#other_goal').val()+',';
           
           cUsNL_myjq(".img_loader").show();
           cUsNL_myjq('.loadingMessage').show();
           
           //VALIDATION
           if(!Template_Desktop_Form.length){
               cUsNL_myjq('.advice_notice').html('Please select a form template before continuing.').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('.loadingMessage').fadeOut();
               cUsNL_myjq( ".signup_templates" ).accordion({ active: 0 });
           }else if(!Template_Desktop_Tab.length){
               cUsNL_myjq('.advice_notice').html('Please select a tab template before continuing.').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('.loadingMessage').fadeOut();
               cUsNL_myjq( ".signup_templates" ).accordion({ active: 1 });
           }else{
                
                cUsNL_myjq('#cUsNL_SendTemplates').val('Loading . . .').attr('disabled', true);
                oThis.attr('disabled', true);
                
                //AJAX POST CALL cUsNL_createCustomer
                cUsNL_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_createCustomer',Template_Desktop_Form:Template_Desktop_Form,Template_Desktop_Tab:Template_Desktop_Tab,CU_category:CU_category,CU_subcategory:CU_subcategory,CU_goals:new_goals },
                    success: function(data) {

                        switch(data){
                            
                            //USER CREATED
                            case '1':
                                message = '<p>Template saved succesfuly . . . .</p>';
                                message += '<p>Welcome to ContactUs.com, and thank you for your registration.</p>';
                                cUsNL_myjq('.notice').html(message).show().delay(4900).fadeOut(800);
                                //cUsNL_myjq("#cUsFC_SendTemplates").colorbox.close();
                                setTimeout(function(){
                                    cUsNL_myjq('.step3').slideUp().fadeOut();
                                    cUsNL_myjq('.step4').slideDown().delay(800);
                                    cUsNL_myjq('#cUsNL_SendTemplates').val('Create my account').attr('disabled', false); 
                                    location.reload();
                                },2000);
                                break;
                             //OLD USER - LOGING
                             case '2':
                                message = 'Seems like you already have one Contactus.com Account, Please Login below';
                                cUsNL_myjq('.advice_notice').html(message).show();
                                cUsNL_myjq('#cUsNL_SendTemplates').val('Create my account').attr('disabled', false);
                                cUsNL_myjq("#cUsNL_SendTemplates").colorbox.close();
                                cUsNL_myjq(".img_loader").hide();
                                setTimeout(function(){
                                    cUsNL_myjq('#login_email').val(cUsNL_email).focus();
                                    cUsNL_myjq('#cUsNL_userdata').fadeOut();
                                    cUsNL_myjq('#cUsNL_settings').slideDown('slow');
                                    cUsNL_myjq('#cUsNL_loginform').delay(1000).fadeIn();
                                },2000);
                                break;
                            //API OR CONNECTION ISSUES
                            case '':
                            default:
                                message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com. <br/>Error: <b>' + data + '</b>.</a></p>';
                                cUsNL_myjq('.advice_notice').html(message).show();
                                cUsNL_myjq('#cUsNL_SendTemplates').val('Create my account').attr('disabled', false);
                                cUsNL_myjq("#cUsNL_SendTemplates").colorbox.close();
                                break;
                        }
                        
                        cUsNL_myjq('.loadingMessage').fadeOut();

                    },
                    async: false
                });
           }
           
            
        });
    }catch(err){
        cUsNL_myjq('.advice_notice').html('Unfortunately there has being an error during the application. ' + err).slideToggle().delay(9000).fadeOut(2000);
        cUsNL_myjq('#cUsNL_SendTemplates').val('Create my account').attr('disabled', false); 
    }
    
    //UPDATE TEMPLATES FOR ALREADY USERS
    try{ cUsNL_myjq('#cUsNL_UpdateTemplates').click(function() {
           
           //GET SELECTED TEMPLATES
           var Template_Desktop_Form = cUsNL_myjq('#uTemplate_Desktop_Form').val();
           var Template_Desktop_Tab = cUsNL_myjq('#uTemplate_Desktop_Tab').val();
           cUsNL_myjq('.loadingMessage').show();
           
           //VALIDATION
           if(!Template_Desktop_Form.length){
               cUsNL_myjq('.advice_notice').html('Please select a form template before continuing.').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('.loadingMessage').fadeOut();
               cUsNL_myjq( "#form_examples" ).accordion({ active: 0 });
           }else if(!Template_Desktop_Tab.length){
               cUsNL_myjq('.advice_notice').html('Please select a tab template before continuing.').slideToggle().delay(2000).fadeOut(2000);
               cUsNL_myjq('.loadingMessage').fadeOut();
               cUsNL_myjq( "#form_examples" ).accordion({ active: 1 });
           }else{
                
                cUsNL_myjq('#cUsNL_UpdateTemplates').val('Loading . . .').attr('disabled', true);
                
                //AJAX POST CALL cUsNL_UpdateTemplates
                cUsNL_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_UpdateTemplates',Template_Desktop_Form:Template_Desktop_Form,Template_Desktop_Tab:Template_Desktop_Tab},
                    success: function(data) {

                        switch(data){
                            //SAVED
                            case '1':
                                message = '<p>Template saved succesfuly . . . .</p>';
                                cUsNL_myjq('.notice').html(message).show();
                                setTimeout(function(){
                                    cUsNL_myjq('.step3').slideUp().fadeOut();
                                    cUsNL_myjq('.step4').slideDown().delay(800);
                                    location.reload();
                                },2000);
                                break;
                            //API OR CONNECTION ISSUES
                            default:
                                message = '<p>Unfortunately there has being an error during the application: <b>' + data + '</b>. Please try again</a></p>';
                                cUsNL_myjq('.advice_notice').html(message).show();
                                cUsNL_myjq('#cUsNL_UpdateTemplates').val('Update my template').attr('disabled', false); 
                                break;
                        }
                        
                        cUsNL_myjq('.loadingMessage').fadeOut();

                    },
                    async: false
                });
           }
           
            
        });
    }catch(err){
        cUsNL_myjq('.advice_notice').html('Unfortunately there has being an error during the application.  '+ err).slideToggle().delay(2000).fadeOut(2000);
        cUsNL_myjq('#cUsNL_UpdateTemplates').val('Update my template').attr('disabled', false); 
    }
    
    //loading default template
    try{ cUsNL_myjq('.load_def_formkey').click(function() { 
            
        cUsNL_myjq('.loadingMessage').show();
          
        cUsNL_myjq('.load_def_formkey').html('Loading . . .');

        cUsNL_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_LoadDefaultKey'},
            success: function(data) {

                switch(data){
                    case '1':
                        message = '<p>New form Loaded correctly. . . .</p>';
                        cUsNL_myjq('.load_def_formkey').html('Completed . . .');
                        setTimeout(function(){
                            location.reload();
                        },2000);
                        break;
                }

                cUsNL_myjq('.loadingMessage').fadeOut();
                cUsNL_myjq('.advice_notice').html(message).show();
                 

            },
            async: false
        });
           
            
        });
    }catch(err){
        cUsNL_myjq('.advice_notice').html('Unfortunately there has being an error during the application.  '+ err).slideToggle().delay(2000).fadeOut(2000);
        cUsNL_myjq('.load_def_formkey').html('Update my template'); 
    }
    
    //JQ FUNCTION - CHANGE PAGE SETTINGS IN PAGE SELECTION
    cUsNL_myjq.changePageSettings = function(pageID, cus_version, form_key) { 
        
        if(!cus_version.length){
            cUsNL_myjq('.advice_notice').html('Please select TAB or INLINE').slideToggle().delay(2000).fadeOut(2000);
        }else if(!form_key.length){
            cUsNL_myjq('.advice_notice').html('Please select your Contact Us Form Template').slideToggle().delay(2000).fadeOut(2000);
        }else{
            
            cUsNL_myjq('.save_message_'+pageID).show();
            
            //AJAX POST CALL cUsNL_changePageSettings
            cUsNL_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_changePageSettings',pageID:pageID,cus_version:cus_version, form_key:form_key },
                success: function(data) {

                    switch(data){
                        case '1':
                            message = '<p>Saved Successfully . . . .</p>';
                            cUsNL_myjq('.save_message_'+pageID).html(message);
                            cUsNL_myjq('.save-page-'+pageID).val('Completed . . .');

                            setTimeout(function(){
                                cUsNL_myjq('.save_message_'+pageID).fadeOut();
                                cUsNL_myjq('.save-page-'+pageID).val('Save');
                                cUsNL_myjq('.form-templates-'+pageID).slideUp();
                            },2000);

                            break;
                    }

                },
                async: false
            });
        }  
            
    };
    
    //JQ FUNCTION - REMOVE PAGE SETTINGS IN PAGE SELECTION
    cUsNL_myjq.deletePageSettings = function(pageID) { 

        cUsNL_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_deletePageSettings',pageID:pageID},
            success: function(data) {
                //console.log('Success . . .');
            },
            async: false
        });
            
    };
    
    
    //CHANGE FORM TEMPLATES
    cUsNL_myjq.changeFormTemplate = function(formID, form_key, Template_Desktop_Form) {
        
        if(!Template_Desktop_Form.length || !form_key.length){
            cUsNL_myjq('.advice_notice').html('Please select your Contact Us Form Template').slideToggle().delay(2000).fadeOut(2000);
        }else{
            
            cUsNL_myjq('.save_message_'+formID).show();
            
            cUsNL_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_changeFormTemplate',Template_Desktop_Form:Template_Desktop_Form, form_key:form_key },
                success: function(data) {

                    switch(data){
                        case '1':
                            message = '<p>Saved Successfully . . . .</p>';
                            cUsNL_myjq('.save_message_'+formID).html(message);
                            cUsNL_myjq('.form_thumb_'+formID).attr('src','https://admin.contactus.com/popup/tpl/'+Template_Desktop_Form+'/scr.png');

                            setTimeout(function(){
                                cUsNL_myjq('.save_message_'+formID).fadeOut();
                            },2000);

                            break
                    }

                },
                async: false
            });
        }  
            
    };
    
    //CHANGE FORM TEMPLATES
    cUsNL_myjq.changeTabTemplate = function(formID, form_key, Template_Desktop_Tab) { //loading default template
        
        
        if(!Template_Desktop_Tab.length || !form_key.length){
            cUsNL_myjq('.advice_notice').html('Please select your Contact Us Tab Template').slideToggle().delay(2000).fadeOut(2000);
        }else{
            
            cUsNL_myjq('.save_tab_message_'+formID).show();
            
            cUsNL_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_changeTabTemplate',Template_Desktop_Tab:Template_Desktop_Tab, form_key:form_key },
                success: function(data) {

                    switch(data){
                        case '1':
                            message = '<p>Saved Successfully . . . .</p>';
                            cUsNL_myjq('.save_tab_message_'+formID).html(message);
                            cUsNL_myjq('.tab_thumb_'+formID).attr('src','https://admin.contactus.com/popup/tpl/'+Template_Desktop_Tab+'/scr.png');

                            setTimeout(function(){
                                cUsNL_myjq('.save_tab_message_'+formID).fadeOut();
                            },2000);

                            break
                    }

                },
                async: false
            });
        }  
            
    };
    
    //UNLINK ACCOUNT AND DELETE PLUGIN OPTIONS AND SETTINGS
    cUsNL_myjq('.cUsNL_LogoutUser').click(function(){
        
        cUsNL_myjq( "#dialog-message" ).html('Please confirm you would like to unlink your account.');
        cUsNL_myjq( "#dialog-message" ).dialog({
            resizable: false,
            width:430,
            title: 'Close your account session?',
            height:180,
            modal: true,
            buttons: {
                "Yes": function() {
                    
                    cUsNL_myjq('.loadingMessage').show();
                    cUsNL_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_logoutUser'},
                        success: function(data) {
                            cUsNL_myjq('.loadingMessage').fadeOut();
                              location.reload();
                        },
                        async: false
                    });
                    
                    cUsNL_myjq( this ).dialog( "close" );
                    
                },
                Cancel: function() {
                    cUsNL_myjq( this ).dialog( "close" );
                }
            }
        });
        
    });
    
    //FORM PLACEMENT SELECITION / DEFAULT FORM OR CUSTOM SETTINGS
    cUsNL_myjq('.form_version').click(function(){
        
        var value = cUsNL_myjq(this).val();
         
        var msg = '';
        switch(value){
            case 'select_version':
                msg = '<p>You are about to change to Custom Form Settings. You need to choose what forms go on each page or home page</p>';
                break;
            case 'tab_version':
                msg = '<p>You are about to change to Default Form Settings, only your Default form will show up in all of your site</p>';
                break;
        }
        
        cUsNL_myjq( "#dialog-message" ).html(msg);
        cUsNL_myjq( "#dialog-message" ).dialog({
            resizable: false,
            width:430,
            title: 'Change your Form Settings?',
            height:180,
            modal: true,
            buttons: {
                "Yes": function() {
                    
                    switch(value){
                        case 'select_version':
                            cUsNL_myjq('.tab_button').addClass('gray').removeClass('green').attr('disabled', false);
                            cUsNL_myjq('.custom').addClass('green').removeClass('disabled').attr('disabled', true);
                            cUsNL_myjq('.ui-buttonset input').removeAttr('checked');
                            cUsNL_myjq('.ui-buttonset label').removeClass('ui-state-active');

                            cUsNL_myjq('.loadingMessage').show();
                            cUsNL_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_saveCustomSettings',cus_version:'selectable',tab_user:0},
                                success: function(data) {
                                    cUsNL_myjq('.loadingMessage').fadeOut();
                                    cUsNL_myjq('.notice_success').html('<p>Custom settings saved . . .</p>').fadeIn().delay(2000).fadeOut(2000);
                                    //location.reload();
                                },
                                async: false
                            });

                            break;
                        case 'tab_version':
                            cUsNL_myjq('.custom').addClass('gray').removeClass('green').attr('disabled', false);
                            cUsNL_myjq('.tab_button').removeClass('gray').addClass('green').attr('disabled', true);

                            cUsNL_myjq('.loadingMessage').show();
                            cUsNL_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsNL_saveCustomSettings',cus_version:'tab',tab_user:1},
                                success: function(data) {
                                    cUsNL_myjq('.loadingMessage').fadeOut();
                                    cUsNL_myjq('.notice_success').html('<p>Tab settings saved . . .</p><p>Your default Form will appear in all your website.</p>').fadeIn().delay(5000).fadeOut(2000);
                                    //location.reload();
                                },
                                async: false
                            });

                            break;
                    }

                    cUsNL_myjq('.cus_versionform').fadeOut();
                    cUsNL_myjq('.' + value).fadeToggle();
                    
                    cUsNL_myjq( this ).dialog( "close" );
                    
                },
                Cancel: function() {
                    cUsNL_myjq( this ).dialog( "close" );
                }
            }
        });
        
    });
    
    cUsNL_myjq('.btab_enabled').click(function(){
        var value = cUsNL_myjq(this).val();
        cUsNL_myjq('.tab_user').val(value);
        cUsNL_myjq('.loadingMessage').show();
       
        setTimeout(function(){
            cUsNL_myjq('#cUsNL_button').submit();
        },1500);
        
    });
    
    cUsNL_myjq('#contactus_settings_page').change(function(){
        cUsNL_myjq('.show_preview').fadeOut();
        cUsNL_myjq('.save_page').fadeOut( "highlight" ).fadeIn().val('>> Save your settings');
    });
    
    cUsNL_myjq('.callout-button').click(function() {
        cUsNL_myjq('.getting_wpr').slideToggle('slow');
    });
    
    cUsNL_myjq('#cUsNL_yes').click(function() {
        cUsNL_myjq('#cUsNL_userdata, #cUsNL_templates').fadeOut();
        cUsNL_myjq('#cUsNL_settings').slideDown('slow');
        cUsNL_myjq('#cUsNL_loginform').delay(600).fadeIn();
    });
    cUsNL_myjq('#cUsNL_no, #cUsNL_signup_cloud').click(function() {
        cUsNL_myjq('#cUsNL_loginform, #cUsNL_templates').fadeOut();
        cUsNL_myjq('#cUsNL_settings').slideDown('slow');
        cUsNL_myjq('#cUsNL_userdata').delay(600).fadeIn();
    });
    
    //DOM ISSUES ON LOAD
    $('.form_template, .step2, #cUsNL_settings').css("display","none");
    
    function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o ) ) ) {
            return false;
        } else {
            return true;
        }
    }
    
    function checkURL(url) {
        return /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
    }
    
    function str_clean(str){
           
        str = str.replace("'" , " ");
        str = str.replace("," , "");
        str = str.replace("\"" , "");
        str = str.replace("/" , "");

        return str;
    }
    
});//ON LOAD