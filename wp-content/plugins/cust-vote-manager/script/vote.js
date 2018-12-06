function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email )
}


jQuery(document).ready(function(){

    jQuery('.cust-vote').on('click', function() {
         jQuery('#voteModal').modal('show');
    });

    jQuery('.vote-post').on('click', function() {

        var self = this;
        var voteID = jQuery(this).attr('id');
        var voteName = jQuery('#voteName').val();
        var voteCompany = jQuery('#voteCompany').val();
        var voteEmail = jQuery('#voteEmail').val();
        var msg = '';

        jQuery('.error').empty();
        jQuery('.success').empty();
        jQuery(this).attr('disabled', 'disabled');

        if(!validateEmail(voteEmail)) {     
            msg = 'Please enter valid email address';    
        }

        if(!voteID || !voteName || !voteCompany || !voteEmail) {
            msg = 'Please enter all details';
        }

        if(msg) {
            jQuery(this).removeAttr('disabled');
            jQuery('.error').html(msg);
            return false;
        }

        var data = {
            action: 'do_vote',
            voteID: voteID,
            name : voteName,
            company : voteCompany,
            email : voteEmail,
        };

        jQuery.post(custAjax.ajaxurl, data, function(response) {
            
            var obj = jQuery.parseJSON( response );
            if( obj.status === "error" ) {
                jQuery('.error').html(obj.msg);
            } else {
                jQuery('.success').html(obj.msg);
            }

            setTimeout(function() {
                jQuery('.error').empty();
                jQuery('.success').empty();
                jQuery(self).removeAttr('disabled');
                jQuery('#voteModal').modal('toggle');
            }, 1000);
        });
    });

    jQuery(document).click(function() {
        jQuery('.wrapper-dropdown').removeClass('active');
    });

    jQuery('#dd').live('click',function(event){
        jQuery(this).toggleClass('active');
        event.stopPropagation();
     });
    jQuery('.article-category').live('click',function(){

            var list_type = jQuery(this).attr('data-list-type');
            jQuery('#dd .dropdown li').removeClass('active');
            jQuery('.filters li').removeClass('active');
            jQuery("#dd-active").html(jQuery(this).html());
            jQuery(this).parent().addClass('active');
            var data = {
                    action: list_type == 'card' ? 'get_forecast_card' : 'get_forecast_list',
                    category : jQuery(this).attr('data-cat'),
                    post_type : jQuery(this).attr('data-type'),
                };
             jQuery.post(forecastAjax.ajaxurl, data, function(response) {

                 jQuery(".search-result-text").slideUp( "slow" );
                 if(list_type == 'card') {
                     jQuery('.article_container').html(response);
                 } else {
                     jQuery('.article_container .list-view').html(response);
                 }
                 //loadAddtoCalendar();
             });

    });

    // function loadAddtoCalendar(){
    //     var calendarscript = 'http://addtocalendar.com/atc/1.5/atc.min.js';
    //     jQuery.getScript( calendarscript );
    // }
});

