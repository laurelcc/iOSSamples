(function($) {

    $.fn.gms_handler = function() {

        // ====================================================================================

        initUpload();
            
        function initUpload(clone){
            
            var itemToInit = null;
            itemToInit = typeof clone !== 'undefined' ? clone : $('.shortcode-dynamic-item');

            itemToInit.find('.redux-opts-upload').on('click',function( event ) {
                
                var activeFileUploadContext = jQuery(this).parent();
                var relid = jQuery(this).attr('rel-id');

                event.preventDefault();

                // If the media frame already exists, reopen it.
                /*if ( typeof(custom_file_frame)!=="undefined" ) {
                    custom_file_frame.open();
                    return;
                }*/

                // if its not null, its broking custom_file_frame's onselect "activeFileUploadContext"
                custom_file_frame = null;

                // Create the media frame.
                custom_file_frame = wp.media.frames.customHeader = wp.media({
                    // Set the title of the modal.
                    title: jQuery(this).data("choose"),

                    // Tell the modal to show only images. Ignore if want ALL
                    library: {
                        type: 'image'
                    },
                    // Customize the submit button.
                    button: {
                        // Set the text of the button.
                        text: jQuery(this).data("update")
                    }
                });

                custom_file_frame.on( "select", function() {
                    // Grab the selected attachment.
                    var attachment = custom_file_frame.state().get("selection").first();

                    // Update value of the targetfield input with the attachment url.
                    jQuery('.redux-opts-screenshot',activeFileUploadContext).attr('src', attachment.attributes.url);
                    jQuery('#' + relid ).val(attachment.attributes.url).trigger('change');

                    jQuery('.redux-opts-upload',activeFileUploadContext).hide();
                    jQuery('.redux-opts-screenshot',activeFileUploadContext).show();
                    jQuery('.redux-opts-upload-remove',activeFileUploadContext).show();
                });

                custom_file_frame.open();
            });

            itemToInit.find('.redux-opts-upload-remove').on('click', function( event ) {
                var activeFileUploadContext = jQuery(this).parent();
                var relid = jQuery(this).attr('rel-id');

                event.preventDefault();

                jQuery('#' + relid).val('');
                jQuery(this).prev().prev().prev().fadeIn('slow');
                jQuery('.redux-opts-screenshot',activeFileUploadContext).fadeOut('slow');
                jQuery(this).fadeOut('slow');
            });
        }
        
        // ====================================================================================

        var current_menu = '';
        if ( $('.form-item').length ) {
            current_menu = $('.form-item.active').attr('class').replace('form-item','').replace('active', '').trim();
        }

        // ====================================================================================
        //  Navigation 
        var nav_item = $('.nav-type .item');
        nav_item.click( function() {

            if ( !$(this).hasClass('active') ) {
                // Set Current Menu Active
                current_menu = $(this).attr('class').replace('item','').trim();

                $('.nav-type .item').removeClass('active');
                $(this).addClass('active');
                $('.nav-form-title').text($(this).text());

                // Set related form Active
                $('.nav-form .form-item').removeClass('active');
                if ( $('.nav-form .form-item.'+current_menu).length ) {
                    $('.nav-form .form-item.'+current_menu).addClass('active');
                }
            }

        });


        // ====================================================================================
        // Group Control - Add
        var add_group_control = $('.group-control .add-group');
        add_group_control.click( function(){
            var mps_wrap = $(this).parents('.form-item.active').find('.mps-wrap');
            var new_group = $('.form-group:first-child', mps_wrap).clone();

            new_group.appendTo(mps_wrap);
            
            mps_wrap.find('.form-group:last-child input, .form-group:last-child textarea').val('');
        })

        // Group Control - Remove
        var remove_group_control = $('.group-control .remove-group');
        remove_group_control.click( function(){
            var mps_wrap = $(this).parents('.form-item.active').find('.mps-wrap');

            if ( mps_wrap.find('.form-group').length > 1 ) {

                $('.form-group:last-child', mps_wrap).slideUp( function(){
                    $(this).remove();
                });
            }
            
        })


        // ====================================================================================
        
        // Clearer
        var clearer = $('#clearer');
        clearer.click( function(){
            $('.form-item.'+current_menu+' input, .form-item.'+current_menu+' textarea').val('');
        })

        // Close
        var close_ui = $('#close_ui');
        close_ui.click( function(){
            $.magnificPopup.close();
        })


        // ====================================================================================
        // InsertShortcode
        var btn_insert_shortcode = $('#insert_shortcode');
        btn_insert_shortcode.click( function() {

            if ( current_menu != '' ) {

                var inst = tinyMCE.get('content');
                var html = inst.selection.getContent();
                var shortcodeData = '';

                switch( current_menu ){

                    case 'mps-column':
                        shortcodeData = insert_column(html);
                        break;

                    case 'mps-button':
                        shortcodeData = insert_button(html);
                        break;
                    case 'mps-divider':
                        shortcodeData = insert_divider(html);
                        break;
                    case 'mps-dropcap':
                        shortcodeData = insert_dropcap(html);
                        break;
                    case 'mps-highlight':
                        shortcodeData = insert_highlight(html);
                        break;
                    case 'mps-message-box':
                        shortcodeData = insert_message_box(html);
                        break;
                    case 'mps-tabs':
                        shortcodeData = insert_tabs(html);
                        break;
                    case 'mps-toggle':
                        shortcodeData = insert_toggles(html);
                        break;
                    case 'mps-video':
                        shortcodeData = insert_video(html);
                        break;
                    case 'mps-full':
                        shortcodeData = insert_full(html);
                        break;
                    case 'mps-maps':
                        shortcodeData = insert_maps(html);
                        break;
                }

                if ( window.wp.media.editor ) {
                		window.wp.media.editor.insert( shortcodeData );
                    $.magnificPopup.close();
                }

            } else {
                $.magnificPopup.close();
            }
            return false;

            // ====================================================================================
            
            function checkboxr(element) { if ( $(element).is(':checked') ) { return true; } else { return false; } }

            function last_col(val) { if ( val == true ) { return "text-center"; } else { return ""; } }

            // ====================================================================================
            
            function insert_column () {
                var data = "[row]";
                var length = $('.mps-column .row.active').children().length;
                var reverse = $('.mps-column .form-content .reverse').prop('checked');
                var col = '';
                var column = '';
                var column_2 = '';
               
                if ( $('.mps-column .row.active').children().hasClass('cl-9') ){
                    col = 'cl-9';
                } else if ( $('.mps-column .row.active').children().hasClass('cl-8') ){
                    col = 'cl-8';
                } else if ( $('.mps-column .row.active').children().hasClass('cl-6') ){
                    col = 'one_half';
                } else if ( $('.mps-column .row.active').children().hasClass('cl-4') ){
                    col = 'one_third';
                } else if ( $('.mps-column .row.active').children().hasClass('cl-3') ){
                    col = 'one_fourth';
                }

                if ( col == 'cl-9' ) {
                    column = "<p>[three_fourths]</p><p>Your Text Here!</p><p>[/three_fourths]</p>";
                    column_2 = "<p>[one_fourth]</p><p>Your Text Here!</p><p>[/one_fourth]</p>";
                    if ( reverse == true ) {
                        data = data + column + column_2;
                    } else {
                        data = data + column_2 + column;
                    }
                } else if ( col == 'cl-8' ) {
                    column = "<p>[two_thirds]</p><p>Your Text Here!</p><p>[/two_thirds]</p>";
                    column_2 = "<p>[one_third]</p><p>Your Text Here!</p><p>[/one_third]</p>";
                    if (reverse == true ) {
                        data = data + column + column_2;
                    } else {
                        data = data + column_2 + column;
                    }
                } else {
                    for (var i = 1; i <= length; i++) {
                        console.log(column);
                        column = column + "<p>["+ col +"]</p><p>Your Text Here!</p><p>[/"+ col +"]</p>";
                    }
                    data = data + column;
                }

                data = data + "[/row]";
                return data;

            }

            // function insert_one_half () {
            //     var data = '[one_half text_align="'+last_col(checkboxr('.form-item.'+current_menu+' .center-text'))+'"] '+$( '.form-item.'+current_menu+' .field-content' ).val()+' [/one_half]';
            //     return data;
            // }


            // ====================================================================================
            // ====================================================================================

            function insert_button () {
                var button_size = $('.form-item.'+current_menu+' input[name=button-size]:checked').val();
                var button_url = $('.form-item.'+current_menu+' .link-url').val();
                var button_text = $('.form-item.'+current_menu+' .button-text').val();

                var new_tab = '';
                if ( checkboxr('.form-item.'+current_menu+' .blank') == true ) { new_tab = '_blank'; }
                var button_color = $('.form-item.'+current_menu+' input[name=button-color]:checked').val();

                var data = '[button size="'+button_size+'" url="'+button_url+'" text="'+button_text+'" target="'+new_tab+'" color="'+button_color+'" ]';
                return data;
            }

            // ====================================================================================

            function insert_divider () {
            		var divider_style = $('.form-item.'+current_menu+' input[name=divider-style]:checked').val();
            		var divider_title = $('.form-item.'+current_menu+' .divider-title').val();
            		var divider_align = $('.form-item.'+current_menu+' .divider-align').val();

                var data = '[divider style="'+divider_style+'" title="'+divider_title+'" text_align="'+divider_align+'"]';
                return data;
            }

            // ====================================================================================

            function insert_dropcap () {
            		var dropcap_style = $('.form-item.'+current_menu+' input[name=dropcap-style]:checked').val();
            		var dropcap_title = $('.form-item.'+current_menu+' .dropcap-title').val();                    

                var data = '[dropcap style="'+dropcap_style+'" title="'+dropcap_title+'"]';
                return data;
            }

            // ====================================================================================

            function insert_highlight () {
            		var hl_text = $('.form-item.'+current_menu+' .highlight-text').val();
                    if ( checkboxr('.form-item.'+current_menu+' .blank') == true ) { new_tab = '_blank'; }
                    var highlight_color = $('.form-item.'+current_menu+' input[name=highlight-color]:checked').val();

                var data = '[highlight text="'+hl_text+'" color="'+highlight_color+'"]';
                return data;
            }

            // ====================================================================================

            function insert_message_box () {
            		var mb_title = $('.form-item.'+current_menu+' .message-title').val();
            		var mb_text = $('.form-item.'+current_menu+' .message-box').val();

                var data = '[message_box title="'+mb_title+'" text="'+mb_text+'"]';
                return data;
            }

            // ====================================================================================

            function insert_tabs () {
                var position = $('.form-item.'+current_menu+' input[name=tab-position]:checked').val();

                var data = '[tabs position="'+position+'"]';
                var id_tab = 1;

                $('.form-item.'+current_menu+' .mps-wrap').children('.form-group').each( function() {
                    data += '<p>[tab title="'+$(this).find('.field-item .tab-title').val()+'"]</p><p>'+$(this).find('.field-item .tab-content').val()+'</p><p>[/tab]</p>';
                });

                data += '[/tabs]';
                return data;
            }

            // ====================================================================================

            function insert_toggles () {
                var style = 'toggles';
                if ( checkboxr('.form-item.'+current_menu+' .field-item .accordion') == true ) {
                    style = 'accordion';
                }

                var data = '[toggles style="'+style+'"]';
                var id_toggle = 1;

                $('.form-item.'+current_menu+' .mps-wrap').children('.form-group').each( function() {
                    data += '<p>[toggle title="'+$(this).find('.field-item .tab-title').val()+'"]</p><p>'+$(this).find('.field-item .tab-content').val()+'</p><p>[/toggle]</p>';
                });

                data += '[/toggles]';
                return data;
            }

            function insert_video () {
                var video_type = $('.form-item.'+current_menu+' input[name=video-type]:checked').val();
                if ( checkboxr('.form-item.'+current_menu+' .vidtitle') == true ) { video_title = '1'; } else {video_title = '0'}
                if ( checkboxr('.form-item.'+current_menu+' .vidplaybar') == true ) { video_playbar = '1'; } else {video_playbar = '0'}
                var video_url = $('.form-item.'+current_menu+' .video-url').val();

                var data = '[videoembed type="'+video_type+'" url="'+video_url+'" title="'+video_title+'" playbar="'+video_playbar+'"]';
                
                return data;
            }

            function insert_full () {
                var content = $('.form-item.'+current_menu+' .content-box').val();
                var data = '<p>[content_full]</p>'+ content +'<p>[/content_full]</p>';
                
                return data;
            }

            function insert_maps () {
                var point = $('.form-item.'+current_menu+' .maps-point').val();
                var width = $('.form-item.'+current_menu+' .maps-width').val();
                var height = $('.form-item.'+current_menu+' .maps-height').val();
                var zoom = $('.form-item.'+current_menu+' .maps-zoom').val();
                var data = '[googlemaps point="'+point+'" width="'+width+'" height="'+height+'" zoom="'+zoom+'"][/googlemaps]';
                
                return data;
            }


        });

    }

})(jQuery);