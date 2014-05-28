<?php 
/*
Plugin Name: Custom Facebook Feed Pro
Plugin URI: http://smashballoon.com/custom-facebook-feed
Description: Add a completely customizable Facebook feed to your WordPress site
Version: 1.4.3
Author: Smash Balloon
Author URI: http://smashballoon.com/
*/
/* 
Copyright 2013  Smash Balloon  (email: hey@smashballoon.com)
This program is paid software; you may not redistribute it under any
circumstances without the expressed written consent of the plugin author.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/
// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define( 'WPW_SL_STORE_URL', 'http://smashballoon.com/' ); // IMPORTANT: change the name of this constant to something unique to prevent conflicts with other plugins using this system
// the name of your product. This is the title of your product in EDD and should match the download title in EDD exactly
define( 'WPW_SL_ITEM_NAME', 'Custom Facebook Feed WordPress Plugin Personal' ); // IMPORTANT: change the name of this constant to something unique to prevent conflicts with other plugins using this system
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
    // load our custom updater if it doesn't already exist
    include( dirname( __FILE__ ) . '/plugin_updater.php' );
}
// retrieve our license key from the DB
$license_key = trim( get_option( 'cff_license_key' ) );
// setup the updater
$edd_updater = new EDD_SL_Plugin_Updater( WPW_SL_STORE_URL, __FILE__, array( 
        'version'   => '1.4.2',           // current version number
        'license'   => $license_key,        // license key (used get_option above to retrieve from DB)
        'item_name' => WPW_SL_ITEM_NAME,    // name of this plugin
        'author'    => 'Smash Balloon'      // author of this plugin
    )
);
//Include admin
include dirname( __FILE__ ) .'/custom-facebook-feed-admin.php';
// Add shortcodes
add_shortcode('custom-facebook-feed', 'display_cff');
function display_cff($atts, $content = null) {
    
    //Style options
    $options = get_option('cff_style_settings');
    //Create the types string to set as shortcode default
    $type_string = '';
    if($options[ 'cff_show_links_type' ]) $type_string .= 'links,';
    if($options[ 'cff_show_event_type' ]) $type_string .= 'events,';
    if($options[ 'cff_show_video_type' ]) $type_string .= 'videos,';
    if($options[ 'cff_show_photos_type' ]) $type_string .= 'photos,';
    if($options[ 'cff_show_status_type' ]) $type_string .= 'statuses,';
    //Create the types string to set as shortcode default
    $include_string = '';
    if($options[ 'cff_show_author' ]) $include_string .= 'author,';
    if($options[ 'cff_show_text' ]) $include_string .= 'text,';
    if($options[ 'cff_show_desc' ]) $include_string .= 'desc,';
    if($options[ 'cff_show_shared_links' ]) $include_string .= 'sharedlinks,';
    if($options[ 'cff_show_date' ]) $include_string .= 'date,';
    if($options[ 'cff_show_media' ]) $include_string .= 'media,';
    if($options[ 'cff_show_event_title' ]) $include_string .= 'eventtitle,';
    if($options[ 'cff_show_event_details' ]) $include_string .= 'eventdetails,';
    if($options[ 'cff_show_meta' ]) $include_string .= 'social,';
    if($options[ 'cff_show_link' ]) $include_string .= 'link,';
    if($options[ 'cff_show_like_box' ]) $include_string .= 'likebox,';
    //Pass in shortcode attrbutes
    $atts = shortcode_atts(
    array(
        'id' => get_option('cff_page_id'),
        'pagetype' => get_option('cff_page_type'),
        'num' => get_option('cff_num_show'),
        'limit' => get_option('cff_post_limit'),
        'others' => '',
        'showpostsby' => get_option('cff_show_others'),
        'cachetime' => get_option('cff_cache_time'),
        'cacheunit' => get_option('cff_cache_time_unit'),
        'locale' => get_option('cff_locale'),
        'width' => $options[ 'cff_feed_width' ],
        'height' => $options[ 'cff_feed_height' ],
        'padding' => $options[ 'cff_feed_padding' ],
        'bgcolor' => $options[ 'cff_bg_color' ],
        'showauthor' => '',
        'showauthornew' => $options[ 'cff_show_author' ],
        'class' => $options[ 'cff_class' ],
        'layout' => $options[ 'cff_preset_layout' ],
        'type' => $type_string,
        'eventsource' => $options[ 'cff_events_source' ],
        'eventoffset' => $options[ 'cff_event_offset' ],
        'include' => $include_string,
        'filter' => $options[ 'cff_filter_string' ],
        //Typography
        'textformat' => $options[ 'cff_title_format' ],
        'textsize' => $options[ 'cff_title_size' ],
        'textweight' => $options[ 'cff_title_weight' ],
        'textcolor' => $options[ 'cff_title_color' ],
        'textlink' => $options[ 'cff_title_link' ],
        'descsize' => $options[ 'cff_body_size' ],
        'descweight' => $options[ 'cff_body_weight' ],
        'desccolor' => $options[ 'cff_body_color' ],
        //Event title
        'eventtitleformat' => $options[ 'cff_event_title_format' ],
        'eventtitlesize' => $options[ 'cff_event_title_size' ],
        'eventtitleweight' => $options[ 'cff_event_title_weight' ],
        'eventtitlecolor' => $options[ 'cff_event_title_color' ],
        'eventtitlelink' => $options[ 'cff_event_title_link' ],
        //Event date
        'eventdatesize' => $options[ 'cff_event_date_size' ],
        'eventdateweight' => $options[ 'cff_event_date_weight' ],
        'eventdatecolor' => $options[ 'cff_event_date_color' ],
        'eventdatepos' => $options[ 'cff_event_date_position' ],
        'eventdateformat' => $options[ 'cff_event_date_formatting' ],
        'eventdatecustom' => $options[ 'cff_event_date_custom' ],
        //Event details
        'eventdetailssize' => $options[ 'cff_event_details_size' ],
        'eventdetailsweight' => $options[ 'cff_event_details_weight' ],
        'eventdetailscolor' => $options[ 'cff_event_details_color' ],
        //Date
        'datepos' => $options[ 'cff_date_position' ],
        'datesize' => $options[ 'cff_date_size' ],
        'dateweight' => $options[ 'cff_date_weight' ],
        'datecolor' => $options[ 'cff_date_color' ],
        'dateformat' => $options[ 'cff_date_formatting' ],
        'datecustom' => $options[ 'cff_date_custom' ],
        'timezone' => isset($options[ 'cff_timezone' ]) ? $options[ 'cff_timezone' ] : 'America/Chicago',

        //Link to Facebook
        'linksize' => $options[ 'cff_link_size' ],
        'linkweight' => $options[ 'cff_link_weight' ],
        'linkcolor' => $options[ 'cff_link_color' ],
        'viewlinktext' => $options[ 'cff_view_link_text' ],
        'linktotimeline' => $options[ 'cff_link_to_timeline' ],
        //Social
        'iconstyle' => $options[ 'cff_icon_style' ],
        'socialtextcolor' => $options[ 'cff_meta_text_color' ],
        'socialbgcolor' => $options[ 'cff_meta_bg_color' ],
        //Misc
        'textlength' => get_option('cff_title_length'),
        'desclength' => get_option('cff_body_length'),
        'likeboxpos' => $options[ 'cff_like_box_position' ],
        'likeboxoutside' => $options[ 'cff_like_box_outside' ],
        'likeboxcolor' => $options[ 'cff_likebox_bg_color' ],
        'likeboxtextcolor' => $options[ 'cff_like_box_text_color' ],
        'likeboxwidth' => $options[ 'cff_likebox_width' ],
        'likeboxfaces' => $options[ 'cff_like_box_faces' ],
        'likeboxborder' => $options[ 'cff_like_box_border' ],

        //Page Header
        'showheader' => $options[ 'cff_show_header' ],
        'headeroutside' => $options[ 'cff_header_outside' ],
        'headertext' => $options[ 'cff_header_text' ],
        'headerbg' => $options[ 'cff_header_bg_color' ],
        'headerpadding' => $options[ 'cff_header_padding' ],
        'headertextsize' => $options[ 'cff_header_text_size' ],
        'headertextweight' => $options[ 'cff_header_text_weight' ],
        'headertextcolor' => $options[ 'cff_header_text_color' ],
        'headericon' => $options[ 'cff_header_icon' ],
        'headericoncolor' => $options[ 'cff_header_icon_color' ],
        'headericonsize' => $options[ 'cff_header_icon_size' ],

        'videoheight' => $options[ 'cff_video_height' ],
        'videoaction' => $options[ 'cff_video_action' ],
        'sepcolor' => $options[ 'cff_sep_color' ],
        'sepsize' => $options[ 'cff_sep_size' ],

        //Translate
        'seemoretext' => $options[ 'cff_see_more_text' ],
        'seelesstext' => $options[ 'cff_see_less_text' ],
        'buyticketstext' => $options[ 'cff_buy_tickets_text' ],
        'maptext' => $options[ 'cff_map_text' ],
        'facebooklinktext' => $options[ 'cff_facebook_link_text' ],

        'previouscommentstext' => $options[ 'cff_translate_view_previous_comments_text' ],
        'commentonfacebooktext' => $options[ 'cff_translate_comment_on_facebook_text' ],
        'photostext' => $options[ 'cff_translate_photos_text' ],
        'likesthistext' => $options[ 'cff_translate_likes_this_text' ],
        'likethistext' => $options[ 'cff_translate_like_this_text' ],
        'andtext' => $options[ 'cff_translate_and_text' ],
        'othertext' => $options[ 'cff_translate_other_text' ],
        'otherstext' => $options[ 'cff_translate_others_text' ]

    ), $atts);
    /********** GENERAL **********/
    $cff_page_type = $atts[ 'pagetype' ];
    $cff_is_group = false;
    if ($cff_page_type == 'group') $cff_is_group = true;

    $cff_feed_width = $atts[ 'width' ];
    $cff_feed_height = $atts[ 'height' ];
    $cff_feed_padding = $atts[ 'padding' ];
    $cff_bg_color = $atts[ 'bgcolor' ];
    $cff_show_author = $atts[ 'showauthornew' ];
    $cff_cache_time = $atts[ 'cachetime' ];
    $cff_locale = $atts[ 'locale' ];

    if ( empty($cff_locale) || !isset($cff_locale) || $cff_locale == '' ) $cff_locale = 'en_US';
    if (!isset($cff_cache_time)) $cff_cache_time = 0;
    $cff_cache_time_unit = $atts[ 'cacheunit' ];
    $cff_class = $atts['class'];
    //Compile feed styles
    $cff_feed_styles = 'style="';
    if ( !empty($cff_feed_width) ) $cff_feed_styles .= 'width:' . $cff_feed_width . '; ';
    if ( !empty($cff_feed_height) ) $cff_feed_styles .= 'height:' . $cff_feed_height . '; ';
    if ( !empty($cff_feed_padding) ) $cff_feed_styles .= 'padding:' . $cff_feed_padding . '; ';
    if ( !empty($cff_bg_color) ) $cff_feed_styles .= 'background-color:#' . $cff_bg_color . '; ';
    $cff_feed_styles .= '"';
    //Like box
    $cff_like_box_position = $atts[ 'likeboxpos' ];
    $cff_like_box_outside = $atts[ 'likeboxoutside' ];
    //Open links in new window?
    $target = 'target="_blank"';
    /********** POST TYPES **********/
    $cff_types = $atts[ 'type' ];
    //Look for non-plural version of string in the types string in case user specifies singular in shortcode
    $cff_show_links_type = false;
    $cff_show_event_type = false;
    $cff_show_video_type = false;
    $cff_show_photos_type = false;
    $cff_show_status_type = false;
    if ( stripos($cff_types, 'link') !== false ) $cff_show_links_type = true;
    if ( stripos($cff_types, 'event') !== false ) $cff_show_event_type = true;
    if ( stripos($cff_types, 'video') !== false ) $cff_show_video_type = true;
    if ( stripos($cff_types, 'photo') !== false ) $cff_show_photos_type = true;
    if ( stripos($cff_types, 'status') !== false ) $cff_show_status_type = true;
    $cff_events_only = false;
    $cff_events_source = $atts[ 'eventsource' ];
    if ( empty($cff_events_source) || !isset($cff_events_source) ) $cff_events_source = 'eventspage';

    $cff_event_offset = $atts[ 'eventoffset' ];
    if ( empty($cff_event_offset) || !isset($cff_event_offset) ) $cff_event_offset = '6';

    //Are we showing ONLY events?
    if ($cff_show_event_type && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type) $cff_events_only = true;
    /********** LAYOUT **********/
    $cff_includes = $atts[ 'include' ];
    //Look for non-plural version of string in the types string in case user specifies singular in shortcode
    $cff_show_author = false;
    $cff_show_text = false;
    $cff_show_desc = false;
    $cff_show_shared_links = false;
    $cff_show_date = false;
    $cff_show_media = false;
    $cff_show_event_title = false;
    $cff_show_event_details = false;
    $cff_show_meta = false;
    $cff_show_link = false;
    $cff_show_like_box = false;
    if ( stripos($cff_includes, 'author') !== false ) $cff_show_author = true;
    if ( stripos($cff_includes, 'text') !== false ) $cff_show_text = true;
    if ( stripos($cff_includes, 'desc') !== false ) $cff_show_desc = true;
    if ( stripos($cff_includes, 'sharedlink') !== false ) $cff_show_shared_links = true;
    if ( stripos($cff_includes, 'date') !== false ) $cff_show_date = true;
    if ( stripos($cff_includes, 'media') !== false ) $cff_show_media = true;
    if ( stripos($cff_includes, 'eventtitle') !== false ) $cff_show_event_title = true;
    if ( stripos($cff_includes, 'eventdetail') !== false ) $cff_show_event_details = true;
    if ( stripos($cff_includes, 'social') !== false ) $cff_show_meta = true;
    if ( stripos($cff_includes, ',link') !== false ) $cff_show_link = true; //comma used to separate it from 'sharedlinks' - which also contains 'link' string
    if ( stripos($cff_includes, 'like') !== false ) $cff_show_like_box = true;
    $cff_preset_layout = $atts[ 'layout' ];
    //Default is thumbnail layout
    $cff_thumb_layout = false;
    $cff_half_layout = false;
    $cff_full_layout = true;
    if (($cff_preset_layout == 'thumb' || empty($cff_preset_layout)) && $cff_show_media) {
        $cff_thumb_layout = true;
    } else if ($cff_preset_layout == 'half'  && $cff_show_media) {
        $cff_half_layout = true;
    } else {
        $cff_full_layout = true;
    }

    //If the old shortcode option 'showauthor' is being used then apply it
    $cff_show_author_old = $atts[ 'showauthor' ];
    if( $cff_show_author_old == 'false' ) $cff_show_author = false;
    if( $cff_show_author_old == 'true' ) $cff_show_author = true;
    
    /********** META **********/
    $cff_icon_style = $atts[ 'iconstyle' ];
    $cff_meta_text_color = $atts[ 'socialtextcolor' ];
    $cff_meta_bg_color = $atts[ 'socialbgcolor' ];
    $cff_meta_styles = 'style="';
    if ( !empty($cff_meta_text_color) ) $cff_meta_styles .= 'color:#' . $cff_meta_text_color . ';';
    if ( !empty($cff_meta_bg_color) ) $cff_meta_styles .= 'background-color:#' . $cff_meta_bg_color . ';';
    $cff_meta_styles .= '"';
    // $cff_nocomments_text = $options[ 'cff_nocomments_text' ];
    // $cff_hide_comments = $options[ 'cff_hide_comments' ];
    // if (!isset($cff_nocomments_text) || empty($cff_nocomments_text)) $cff_hide_comments = true;
    /********** TYPOGRAPHY **********/
    //See More text
    $cff_see_more_text = $atts[ 'seemoretext' ];
    $cff_see_less_text = $atts[ 'seelesstext' ];
    //See Less text
    //Title
    $cff_title_format = $atts[ 'textformat' ];
    if (empty($cff_title_format)) $cff_title_format = 'p';
    $cff_title_size = $atts[ 'textsize' ];
    $cff_title_weight = $atts[ 'textweight' ];
    $cff_title_color = $atts[ 'textcolor' ];
    $cff_title_styles = 'style="';
    if ( !empty($cff_title_size) && $cff_title_size != 'inherit' ) $cff_title_styles .=  'font-size:' . $cff_title_size . 'px; ';
    if ( !empty($cff_title_weight) && $cff_title_weight != 'inherit' ) $cff_title_styles .= 'font-weight:' . $cff_title_weight . '; ';
    if ( !empty($cff_title_color) ) $cff_title_styles .= 'color:#' . $cff_title_color . ';';
    $cff_title_styles .= '"';
    $cff_title_link = $atts[ 'textlink' ];
    if( $cff_title_link == 'on' || $cff_title_link == 'true' || $cff_title_link == true ) {
        $cff_title_link = true;
    } else {
        $cff_title_link = false;
    }

    //Description
    $cff_body_size = $atts[ 'descsize' ];
    $cff_body_weight = $atts[ 'descweight' ];
    $cff_body_color = $atts[ 'desccolor' ];
    $cff_body_styles = 'style="';
    if ( !empty($cff_body_size) && $cff_body_size != 'inherit' ) $cff_body_styles .=  'font-size:' . $cff_body_size . 'px; ';
    if ( !empty($cff_body_weight) && $cff_body_weight != 'inherit' ) $cff_body_styles .= 'font-weight:' . $cff_body_weight . '; ';
    if ( !empty($cff_body_color) ) $cff_body_styles .= 'color:#' . $cff_body_color . ';';
    $cff_body_styles .= '"';
    //Event Title
    $cff_event_title_format = $atts[ 'eventtitleformat' ];
    if (empty($cff_event_title_format)) $cff_event_title_format = 'p';
    $cff_event_title_size = $atts[ 'eventtitlesize' ];
    $cff_event_title_weight = $atts[ 'eventtitleweight' ];
    $cff_event_title_color = $atts[ 'eventtitlecolor' ];
    $cff_event_title_styles = 'style="';
    if ( !empty($cff_event_title_size) && $cff_event_title_size != 'inherit' ) $cff_event_title_styles .=  'font-size:' . $cff_event_title_size . 'px; ';
    if ( !empty($cff_event_title_weight) && $cff_event_title_weight != 'inherit' ) $cff_event_title_styles .= 'font-weight:' . $cff_event_title_weight . '; ';
    if ( !empty($cff_event_title_color) ) $cff_event_title_styles .= 'color:#' . $cff_event_title_color . ';';
    $cff_event_title_styles .= '"';
    $cff_event_title_link = $atts[ 'eventtitlelink' ];
    //Event Date
    $cff_event_date_size = $atts[ 'eventdatesize' ];
    $cff_event_date_weight = $atts[ 'eventdateweight' ];
    $cff_event_date_color = $atts[ 'eventdatecolor' ];
    $cff_event_date_position = $atts[ 'eventdatepos' ];
    $cff_event_date_formatting = $atts[ 'eventdateformat' ];
    $cff_event_date_custom = $atts[ 'eventdatecustom' ];
    $cff_event_date_styles = 'style="';
    if ( !empty($cff_event_date_size) && $cff_event_date_size != 'inherit' ) $cff_event_date_styles .=  'font-size:' . $cff_event_date_size . 'px; ';
    if ( !empty($cff_event_date_weight) && $cff_event_date_weight != 'inherit' ) $cff_event_date_styles .= 'font-weight:' . $cff_event_date_weight . '; ';
    if ( !empty($cff_event_date_color) ) $cff_event_date_styles .= 'color:#' . $cff_event_date_color . ';';
    $cff_event_date_styles .= '"';
    //Event Details
    $cff_event_details_size = $atts[ 'eventdetailssize' ];
    $cff_event_details_weight = $atts[ 'eventdetailsweight' ];
    $cff_event_details_color = $atts[ 'eventdetailscolor' ];
    $cff_event_details_styles = 'style="';
    if ( !empty($cff_event_details_size) && $cff_event_details_size != 'inherit' ) $cff_event_details_styles .=  'font-size:' . $cff_event_details_size . 'px; ';
    if ( !empty($cff_event_details_weight) && $cff_event_details_weight != 'inherit' ) $cff_event_details_styles .= 'font-weight:' . $cff_event_details_weight . '; ';
    if ( !empty($cff_event_details_color) ) $cff_event_details_styles .= 'color:#' . $cff_event_details_color . ';';
    $cff_event_details_styles .= '"';
    //Date
    $cff_date_position = $atts[ 'datepos' ];
    if (!isset($cff_date_position)) $cff_date_position = 'below';
    $cff_date_size = $atts[ 'datesize' ];
    $cff_date_weight = $atts[ 'dateweight' ];
    $cff_date_color = $atts[ 'datecolor' ];
    $cff_date_styles = 'style="';
    if ( !empty($cff_date_size) && $cff_date_size != 'inherit' ) $cff_date_styles .=  'font-size:' . $cff_date_size . 'px; ';
    if ( !empty($cff_date_weight) && $cff_date_weight != 'inherit' ) $cff_date_styles .= 'font-weight:' . $cff_date_weight . '; ';
    if ( !empty($cff_date_color) ) $cff_date_styles .= 'color:#' . $cff_date_color . ';';
    $cff_date_styles .= '"';
    $cff_date_before = $options[ 'cff_date_before' ];
    $cff_date_after = $options[ 'cff_date_after' ];

    //Set user's timezone based on setting
    $cff_timezone = $atts['timezone'];
    date_default_timezone_set($cff_timezone);

    //Link to Facebook
    $cff_link_size = $atts[ 'linksize' ];
    $cff_link_weight = $atts[ 'linkweight' ];
    $cff_link_color = $atts[ 'linkcolor' ];
    $cff_link_styles = 'style="';
    if ( !empty($cff_link_size) && $cff_link_size != 'inherit' ) $cff_link_styles .=  'font-size:' . $cff_link_size . 'px; ';
    if ( !empty($cff_link_weight) && $cff_link_weight != 'inherit' ) $cff_link_styles .= 'font-weight:' . $cff_link_weight . '; ';
    if ( !empty($cff_link_color) ) $cff_link_styles .= 'color:#' . $cff_link_color . ';';
    $cff_link_styles .= '"';
    $cff_facebook_link_text = $atts[ 'facebooklinktext' ];
    $cff_view_link_text = $atts[ 'viewlinktext' ];
    $cff_link_to_timeline = $atts[ 'linktotimeline' ];
    /********** MISC **********/
    //Like Box styles
    $cff_likebox_bg_color = $atts[ 'likeboxcolor' ];

    $cff_like_box_text_color = $atts[ 'likeboxtextcolor' ];
    $cff_like_box_colorscheme = 'light';
    if ($cff_like_box_text_color == 'white') $cff_like_box_colorscheme = 'dark';

    $cff_likebox_width = $atts[ 'likeboxwidth' ];
    if ( !isset($cff_likebox_width) || empty($cff_likebox_width) || $cff_likebox_width == '' ) $cff_likebox_width = '100%';
    $cff_like_box_faces = $atts[ 'likeboxfaces' ];
    if ( !isset($cff_like_box_faces) || empty($cff_like_box_faces) ) $cff_like_box_faces = 'false';
    $cff_like_box_border = $atts[ 'likeboxborder' ];
    if ($cff_like_box_border) {
        $cff_like_box_border = 'true';
    } else {
        $cff_like_box_border = 'false';
    }

    //Compile Like box styles
    $cff_likebox_styles = 'style="width: ' . $cff_likebox_width . ';';
    if ( !empty($cff_likebox_bg_color) ) $cff_likebox_styles .= 'background-color: #' . $cff_likebox_bg_color . ';';
    if ( empty($cff_likebox_bg_color) && $cff_like_box_faces == 'false' ) $cff_likebox_styles .= ' margin-left: -10px;';
    $cff_likebox_styles .= '"';

    //Get feed header settings
    $cff_header_bg_color = $atts['headerbg'];
    $cff_header_padding = $atts['headerpadding'];
    $cff_header_text_size = $atts['headertextsize'];
    $cff_header_text_weight = $atts['headertextweight'];
    $cff_header_text_color = $atts['headertextcolor'];

    //Compile feed header styles
    $cff_header_styles = 'style="';
    if ( !empty($cff_header_bg_color) ) $cff_header_styles .= 'background-color: #' . $cff_header_bg_color . ';';
    if ( !empty($cff_header_padding) ) $cff_header_styles .= ' padding: ' . $cff_header_padding . ';';
    if ( !empty($cff_header_text_size) ) $cff_header_styles .= ' font-size: ' . $cff_header_text_size . 'px;';
    if ( !empty($cff_header_text_weight) ) $cff_header_styles .= ' font-weight: ' . $cff_header_text_weight . ';';
    if ( !empty($cff_header_text_color) ) $cff_header_styles .= ' color: #' . $cff_header_text_color . ';';
    $cff_header_styles .= '"';


    //Video
    //Dimensions
    $cff_video_height = $atts[ 'videoheight' ];
    //Action
    $cff_video_action = $atts[ 'videoaction' ];
    //Separating Line
    $cff_sep_color = $atts[ 'sepcolor' ];
    if (empty($cff_sep_color)) $cff_sep_color = 'ddd';
    $cff_sep_size = $atts[ 'sepsize' ];
    if (empty($cff_sep_size)) $cff_sep_size = 0;
    //CFF item styles
    $cff_item_styles = 'style="';
    $cff_item_styles .= 'border-bottom: ' . $cff_sep_size . 'px solid #' . $cff_sep_color . '; ';
    $cff_item_styles .= '"';
   
    //Text limits
    $title_limit = $atts['textlength'];
    if (!isset($title_limit)) $title_limit = 9999;
    $body_limit = $atts['desclength'];

    //Assign the Access Token and Page ID variables
    $access_token = trim( get_option('cff_access_token') );
    $page_id = trim( $atts['id'] );

    //If user is retarded and pastes their full URL into the Page ID field then strip it out
    $cff_facebook_string = 'facebook.com';
    $cff_page_id_url_check = stripos($page_id, $cff_facebook_string);

    if ( $cff_page_id_url_check ) {
        //Remove trailing slash if exists
        $page_id = preg_replace('{/$}', '', $page_id);
        //Get last part of url
        $page_id = substr( $page_id, strrpos( $page_id, '/' )+1 );
    }

    //Get show posts attribute. If not set then default to 25
    $show_posts = $atts['num'];
    if (empty($show_posts)) $show_posts = 25;
    if ( $show_posts == 0 || $show_posts == 'undefined' ) $show_posts = 25;
    //Check whether the Access Token is present and valid
    if ($access_token == '') {
        echo 'Please enter a valid Access Token. You can do this in the Custom Facebook Feed plugin settings.<br /><br />';
        return false;
    }
    //Check whether a Page ID has been defined
    if ($page_id == '') {
        echo "Please enter the Page ID of the Facebook feed you'd like to display.  You can do this in either the Custom Facebook Feed plugin settings or in the shortcode itself. For example [custom_facebook_feed id=<b>YOUR_PAGE_ID</b>].<br /><br />";
        return false;
    }

    //Is it SSL?
    $cff_ssl = '';
    if (is_ssl()) $cff_ssl = '&return_ssl_resources=true';

    //Use posts? or feed?
    $show_others = $atts['others'];
    $show_posts_by = $atts['showpostsby'];
    $graph_query = 'posts';
    $cff_show_only_others = false;

    //If 'others' shortcode option is used then it overrides any other option
    if ($show_others) {

        //Show posts by everyone
        if ( $show_others == 'on' || $show_others == 'true' || $show_others == true || $cff_is_group ) $graph_query = 'feed';

        //Only show posts by me
        if ( $show_others == 'false' ) $graph_query = 'posts';

    } else {
    //Else use the settings page option or the 'showpostsby' shortcode option

        //Only show posts by me
        if ( $show_posts_by == 'me' ) $graph_query = 'posts';

        //Show posts by everyone
        if ( $show_posts_by == 'others' || $cff_is_group ) $graph_query = 'feed';

        //Show posts ONLY by others
        if ( $show_posts_by == 'onlyothers' && !$cff_is_group ) {
            $graph_query = 'feed';
            $cff_show_only_others = true;
        }

    }


    $cff_post_limit = $atts['limit'];
    //Calculate the cache time in seconds
    if($cff_cache_time_unit == 'minutes') $cff_cache_time_unit = 60;
    if($cff_cache_time_unit == 'hours') $cff_cache_time_unit = 60*60;
    if($cff_cache_time_unit == 'days') $cff_cache_time_unit = 60*60*24;
    $cache_seconds = $cff_cache_time * $cff_cache_time_unit;

    //Set like box variable
    $like_box = '<div class="cff-likebox';
    if ($cff_like_box_outside) $like_box .= ' cff-outside';
    $like_box .= ($cff_like_box_position == 'top') ? ' top' : ' bottom';
    $like_box .= '" ' . $cff_likebox_styles . '><script src="https://connect.facebook.net/' . $cff_locale . '/all.js#xfbml=1"></script><fb:like-box href="http://www.facebook.com/' . $page_id . '" show_faces="'.$cff_like_box_faces.'" stream="false" header="false" colorscheme="'. $cff_like_box_colorscheme .'" show_border="'. $cff_like_box_border .'"></fb:like-box></div>';
    //Don't show like box if it's a group
    if($cff_is_group) $like_box = '';


    //Feed header
    $cff_show_header = $atts['showheader'];
    ($cff_show_header == 'true' || $cff_show_header == 'on') ? $cff_show_header = true : $cff_show_header = false;

    $cff_header_outside = $atts['headeroutside'];
    ($cff_header_outside == 'true' || $cff_header_outside == 'on') ? $cff_header_outside = true : $cff_header_outside = false;

    $cff_header_text = $atts['headertext'];
    $cff_header_icon = $atts['headericon'];
    $cff_header_icon_color = $atts['headericoncolor'];
    $cff_header_icon_size = $atts['headericonsize'];

    $cff_header = '<h3 class="cff-header';
    if ($cff_header_outside) $cff_header .= ' cff-outside';
    $cff_header .= '"' . $cff_header_styles . '>';
    $cff_header .= '<i class="fa fa-' . $cff_header_icon . '"';
    if(!empty($cff_header_icon_color) || !empty($cff_header_icon_size)) $cff_header .= ' style="';
    if(!empty($cff_header_icon_color)) $cff_header .= 'color: #' . $cff_header_icon_color . ';';
    if(!empty($cff_header_icon_size)) $cff_header .= ' font-size: ' . $cff_header_icon_size . 'px;';
    if(!empty($cff_header_icon_color) || !empty($cff_header_icon_size))$cff_header .= '"';
    $cff_header .= '></i>';
    $cff_header .= $cff_header_text;
    $cff_header .= '</h3>';

    //***START FEED***
    $cff_content = '';

    //Add the page header to the outside of the top of feed
    if ($cff_show_header && $cff_header_outside) $cff_content .= $cff_header;

    //Add like box to the outside of the top of feed
    if ($cff_like_box_position == 'top' && $cff_show_like_box && $cff_like_box_outside) $cff_content .= $like_box;

    //Create CFF container HTML
    $cff_content .= '<div id="cff" rel="'.$title_limit.'" class="';
    if( !empty($cff_class) ) $cff_content .= $cff_class . ' ';
    if ( !empty($cff_feed_height) ) $cff_content .= 'cff-fixed-height ';
    if ( $cff_thumb_layout ) $cff_content .= 'cff-thumb-layout ';
    if ( $cff_half_layout ) $cff_content .= 'cff-half-layout ';
    $cff_content .= '" ' . $cff_feed_styles . '>';

    //Add the page header to the inside of the top of feed
    if ($cff_show_header && !$cff_header_outside) $cff_content .= $cff_header;

    //Add like box to the inside of the top of feed
    if ($cff_like_box_position == 'top' && $cff_show_like_box && !$cff_like_box_outside) $cff_content .= $like_box;
    //Limit var
    $i = 0;
    
    //EVENTS ONLY
    if ($cff_events_only && $cff_events_source == 'eventspage'){
        //Get the user's ID
        $get_page_info = cff_fetchUrl('https://graph.facebook.com/' . $page_id . '?access_token=' . $access_token);
        $page_info = json_decode($get_page_info);
        //Get user ID
        $u_id = $page_info->id;

        //Add 6 hours to the current time. This means events will still be shown for 6 hours after their start time has passed.
        $cff_event_offset_time = '-' . $cff_event_offset . ' hours';

        $curtimeplus = strtotime($cff_event_offset_time, time());
        //Set the query
        $fql = "SELECT%20eid,name,attending_count,ticket_uri,pic_big,start_time,end_time,timezone,venue,location,description%20FROM%20event%20WHERE%20eid%20IN%20(SELECT%20eid%20FROM%20event_member%20WHERE%20uid='".$u_id."')%20AND%20start_time>=".$curtimeplus."%20ORDER%20BY%20start_time%20&access_token=" . $access_token . '&format=json-strings' . $cff_ssl;
        //https://graph.facebook.com/fql?q=SELECT%20eid,name,attending_count,ticket_uri,pic_big,start_time,end_time,timezone,venue,location,description%20FROM%20event%20WHERE%20eid%20IN%20(SELECT%20eid%20FROM%20event_member%20WHERE%20uid='452500544793207')%20AND%20start_time>=now()%20ORDER%20BY%20start_time%20&format=json-strings%20&access_token=352340714888355|mJFDH7fvp5h9tJe4-5-gkEIvy2E

        // Get any existing copy of our transient data
        $cff_events_json_url = "https://graph.facebook.com/fql?q=" . $fql;

        if ($cff_cache_time != 0){
            $transient_name = 'cff_events_json_' . $page_id;
            if ( false === ( $events_json = get_transient( $transient_name ) ) || $events_json === null ) {
                //Get the contents of the events page
                $events_json = cff_fetchUrl($cff_events_json_url);
                //Cache the JSON
                set_transient( $transient_name, $events_json, $cache_seconds );
            } else {
                $events_json = get_transient( $transient_name );
            }
        } else {
            $events_json = cff_fetchUrl($cff_events_json_url);
        }

        //Interpret data with JSON
        //Convert eid integer to a string otherwise json_decode returns it as a float
        $events_json = preg_replace('/"eid":(\d+)/', '"eid":"$1"', $events_json);
        $events_json = preg_replace('/"id":(\d+)/', '"id":"$1"', $events_json);
        $event_data = json_decode($events_json);
        //EVENTS LOOP
        foreach ($event_data->data as $event )
        {
            //Only create posts for the amount of posts specified
            if ( $i == $show_posts ) break;
            $i++;
            isset($event->eid) ? $eid = $event->eid : $eid = '';
            isset($event->name) ? $event_name = $event->name : $event_name = '';
            isset($event->attending_count) ? $attending_count = $event->attending_count : $attending_count = '';
            isset($event->ticket_uri) ? $ticket_uri = $event->ticket_uri : $ticket_uri = '';
            isset($event->pic_big) ? $pic_big = $event->pic_big : $pic_big = '';
            isset($event->start_time) ? $start_time = $event->start_time : $start_time = '';
            isset($event->end_time) ? $end_time = $event->end_time : $end_time = '';
            isset($event->timezone) ? $timezone = $event->timezone : $timezone = '';
            //Venue
            isset($event->venue->latitude) ? $venue_latitude = $event->venue->latitude : $venue_latitude = '';
            isset($event->venue->longitude) ? $venue_longitude = $event->venue->longitude : $venue_longitude = '';
            isset($event->venue->city) ? $venue_city = $event->venue->city : $venue_city = '';
            isset($event->venue->state) ? $venue_state = $event->venue->state : $venue_state = '';
            isset($event->venue->country ) ? $venue_country = $event->venue->country : $venue_country = '';
            isset($event->venue->id) ? $venue_id = $event->venue->id : $venue_id = '';
            $venue_link = 'https://facebook.com/' . $venue_id;
            isset($event->venue->street) ? $venue_street = $event->venue->street : $venue_street = '';
            isset($event->venue->zip) ? $venue_zip = $event->venue->zip : $venue_zip = '';
            isset($event->location) ? $location = $event->location : $location = '';
            isset($event->description) ? $description = $event->description : $description = '';
            $event_link = 'https://facebook.com/events/' . $eid;
            //Event date
            $event_time = $start_time;
            //If timezone migration is enabled then remove last 5 characters
            if ( strlen($event_time) == 24 ) $event_time = substr($event_time, 0, -5);
            if (!empty($start_time)) $cff_event_date = '<p class="cff-date" '.$cff_event_date_styles.'>' . cff_eventdate(strtotime($event_time), $cff_event_date_formatting, $cff_event_date_custom) . '</p>';
            //Event title
            $cff_event_title = '';
            if ($cff_event_title_link) $cff_event_title .= '<a href="'.$event_link.'">';
            $cff_event_title .= '<' . $cff_event_title_format . ' ' . $cff_event_title_styles . '>' . $event_name . '</' . $cff_event_title_format . '>';
            if ($cff_event_title_link) $cff_event_title .= '</a>';
            
            //***************************//
            //***CREATE THE EVENT HTML***//
            //***************************//
            $cff_event = '<div class="cff-item cff-event" ' . $cff_item_styles . '>';
            //Picture
            if($cff_show_media) $cff_event .= '<a title="' . $cff_facebook_link_text . '" class="cff-photo" href="'.$event_link.'" '.$target.'><img src="'. $pic_big .'" border="0" /></a>';
            //Start text wrapper
            if ( ($cff_thumb_layout || $cff_half_layout) ) $cff_event .= '<div class="cff-details">';
                //show event date above title
                if ($cff_event_date_position == 'above') $cff_event .= $cff_event_date;
                //Show event title
                if ($cff_show_event_title && !empty($event_name)) $cff_event .= $cff_event_title;
                //show event date below title
                if ($cff_event_date_position !== 'above') $cff_event .= $cff_event_date;
                //Show event details
                if ($cff_show_event_details){
                    if (!empty($location)) $cff_event .= '<p class="cff-location" ' . $cff_event_details_styles . '>';
                    if (!empty($venue_id)) $cff_event .= '<a href="'. $venue_link .'" target="_blank">';
                    if (!empty($location)) $cff_event .= '<b>' . $location . '</b>';
                    if (!empty($venue_id)) $cff_event .= '</a>';
                    if (!empty($venue_street)) $cff_event .= '<br />' . $venue_street;
                    if (!empty($venue_city)) $cff_event .= '<br />' . $venue_city . ', ' . $venue_state . ' &nbsp;' . $venue_zip;
                    $cff_map_text = $atts[ 'maptext' ];
                    if (!empty($venue_latitude)) $cff_event .= ' <a href="https://maps.google.com/maps?q=' . $venue_latitude . ',+' . $venue_longitude . '" target="_blank">'.$cff_map_text.'</a>';
                    if (!empty($location)) $cff_event .= '</p>';
                    if (!empty($description) && $cff_show_desc){
                        if (!empty($body_limit)) {
                            if (strlen($description) > $body_limit) $description = substr($description, 0, $body_limit) . '...';
                        }
                        $cff_event .= '<p ' . $cff_event_details_styles . '>' . cff_make_clickable($description) . '</p>';
                    }
                }
            //End details
            if ( ($cff_thumb_layout || $cff_half_layout) ) $cff_event .= '</div>';
            $cff_event .= '<div class="cff-meta-links">';
            if ($cff_facebook_link_text == '') $cff_facebook_link_text = 'View on Facebook';
            $cff_buy_tickets_text = $atts[ 'buyticketstext' ];
            $cff_event .= '<a class="cff-viewpost" href="' . $event_link . '" ' . $target . ' ' . $cff_link_styles . '>'.$cff_facebook_link_text.'</a>';
            if ( $ticket_uri ) $cff_event .= '<a class="cff-viewpost" href="' . $ticket_uri . '" ' . $target . ' ' . $cff_link_styles . '>'.$cff_buy_tickets_text.'</a>';
            $cff_event .= '</div></div><div class="cff-clear"></div>';
            $cff_content .= $cff_event;
        } // End the loop
    } //End EVENTS ONLY
    
    //ALL POSTS
    if (!$cff_events_only || ($cff_events_only && $cff_events_source == 'timeline') ){

        $cff_posts_json_url = 'https://graph.facebook.com/' . $page_id . '/' . $graph_query . '?access_token=' . $access_token . '&limit=' . $cff_post_limit . '&locale=' . $cff_locale . $cff_ssl;

        //Don't use caching if the cache time is set to zero
        if ($cff_cache_time != 0){
            // Get any existing copy of our transient data
            $transient_name = 'cff_'. $graph_query .'_json_' . $page_id;
            if ( false === ( $posts_json = get_transient( $transient_name ) ) || $posts_json === null ) {
                //Get the contents of the Facebook page
                $posts_json = cff_fetchUrl($cff_posts_json_url);
                //Cache the JSON
                set_transient( $transient_name, $posts_json, $cache_seconds );
            } else {
                $posts_json = get_transient( $transient_name );
            }
        } else {
            $posts_json = cff_fetchUrl($cff_posts_json_url);
        }

        
        //Interpret data with JSON
        $FBdata = json_decode($posts_json);
        //***STARTS POSTS LOOP***
        foreach ($FBdata->data as $news )
        {
            //Explode News and Page ID's into 2 values
            $PostID = explode("_", $news->id);
            //Check the post type
            $cff_post_type = $news->type;
            if ($cff_post_type == 'link') {
                isset($news->story) ? $story = $news->story : $story = '';
                //Check whether it's an event
                $event_link_check = "facebook.com/events/";
                $event_link_check = stripos($news->link, $event_link_check);
                if ( $event_link_check ) $cff_post_type = 'event';
            }
            //Should we show this post or not?
            $cff_show_post = false;
            switch ($cff_post_type) {
                case 'link':
                    if ( $cff_show_links_type ) $cff_show_post = true;
                    break;
                case 'event':
                    if ( $cff_show_event_type ) $cff_show_post = true;
                    break;
                case 'video':
                     if ( $cff_show_video_type ) $cff_show_post = true;
                    break;
                case 'swf':
                     if ( $cff_show_video_type ) $cff_show_post = true;
                    break;
                case 'photo':
                     if ( $cff_show_photos_type ) $cff_show_post = true;
                    break;
                case 'offer':
                     if ( $cff_show_links_type ) $cff_show_post = true;
                    break;
                case 'status':
                    //Check whether it's a status (author comment or like)
                    if ( $cff_show_status_type && !empty($news->message) ) $cff_show_post = true;
                    break;
            }


            //ONLY show posts by others
            if ( $cff_show_only_others ) {
                //Get the numeric ID of the page
                $page_object = cff_fetchUrl('https://graph.facebook.com/' . $page_id);
                $page_object = json_decode($page_object);
                $numeric_page_id = $page_object->id;

                //If the post author's ID is the same as the page ID then don't show the post
                if ( $numeric_page_id == $news->from->id ) $cff_show_post = false;
            }


            //Only show posts containing specified string
            //Get post text
            $post_text = '';
            if (!empty($news->story)) $post_text = $news->story;
            if (!empty($news->message)) $post_text = $news->message;
            if (!empty($news->name) && empty($news->story) && empty($news->message)) $post_text = $news->name;

            //Get description text
            if( isset($news->description) ){
                $description_text = $news->description;
            } else {
                isset( $news->caption ) ? $description_text = $news->caption : $description_text = '';
            }

            //Get the filter string
            $cff_filter_string = $atts[ 'filter' ];

            if ( $cff_filter_string != '' ){
                //Explode it into multiples
                $cff_filter_strings_array = explode(',', $cff_filter_string);
                //Hide the post if both the post text and description don't contain the string
                $string_in_post_text = true;
                $string_in_desc = true;
                if ( stripos_arr($post_text, $cff_filter_strings_array) === false ) $string_in_post_text = false;
                if ( stripos_arr($description_text, $cff_filter_strings_array) === false ) $string_in_desc = false;

                if( $string_in_post_text == false && $string_in_desc == false ) $cff_show_post = false;
            }


            //Is it a duplicate post?
            if (!isset($prev_post_message)) $prev_post_message = '';
            if (!isset($prev_post_link)) $prev_post_link = '';
            if (!isset($prev_post_description)) $prev_post_description = '';
            isset($news->message) ? $pm = $news->message : $pm = '';
            isset($news->link) ? $pl = $news->link : $pl = '';
            isset($news->description) ? $pd = $news->description : $pd = '';

            if ( ($prev_post_message == $pm) && ($prev_post_link == $pl) && ($prev_post_description == $pd) ) $cff_show_post = false;

            //Check post type and display post if selected
            if ( $cff_show_post ) {
                //If it isn't then create the post
                //Only create posts for the amount of posts specified
                if ( $i == $show_posts ) break;
                $i++;
                //********************************//
                //***COMPILE SECTION VARIABLES***//
                //********************************//
                //Change image size based on layout
                if (!empty($news->picture)) {
                    $picture = $news->picture;

                    /*If the image doesn't have a _b version then the URL looks like this:
                    http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                    So check for this kind of string below and don't replace _s. with _b.
                    */
                    $bigjpg = '_s.jpg?';
                    $bigpng = '_s.png?';
                    $biggif = '_s.gif?';
                    $bigbmp = '_s.bmp?';
                    $imagecheck1 = stripos($picture, $bigjpg);
                    $imagecheck2 = stripos($picture, $bigpng);
                    $imagecheck3 = stripos($picture, $biggif);
                    $imagecheck4 = stripos($picture, $bigbmp);

                    if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4) ) {
                        //Show larger image
                        $picture = str_replace('_s.','_b.',$picture);
                        $picture = str_replace('_q.','_b.',$picture);
                        $picture = str_replace('_t.','_b.',$picture);
                    }


                }
                //Set the post link
                isset($news->link) ? $link = htmlspecialchars($news->link) : $link = '';

                //1. check for relevant_count= string
                //2. check the value after =
                //3. Is it bigger than 1?

                //Is it an album?
                $cff_album = false;
                $album_string = 'relevant_count=';
                $relevant_count = stripos($link, $album_string);

                if ( $relevant_count ) {
                    //If relevant_count is larger than 1 then there are multiple photos
                    $relevant_count = explode('relevant_count=', $link);
                    $num_photos = intval($relevant_count[1]);
                    if ( $num_photos > 1 ) {
                        $cff_album = true;
                    
                        //Link to the album instead of the photo
                        $album_link = str_replace('photo.php?','media/set/?',$link);
                        $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];
                    }
                }

                //If there's no link provided then link to the individual post
                if (empty($news->link)) {
                    //Link to individual post
                    $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];
                }

                //POST AUTHOR
                $cff_author = '<a class="cff-author" href="https://facebook.com/' . $news->from->id . '" '.$target.' title="'.$news->from->name.' on Facebook">';
                $cff_author .= '<img src="https://graph.facebook.com/' . $news->from->id . '/picture" width=50 height=50>';
                $cff_author .= '<span class="cff-page-name">'.$news->from->name.'</span>';
                $cff_author .= '</a>';

                //POST TEXT
                $cff_translate_photos_text = $atts['photostext'];
                if (!isset($cff_translate_photos_text) || empty($cff_translate_photos_text)) $cff_translate_photos_text = 'photos';
                $cff_post_text = '<' . $cff_title_format . ' class="cff-post-text" ' . $cff_title_styles . '>';
                //__ shared __'s photo
                // if ($news->type == 'photo' && !empty($news->story) ) $cff_post_text .= '<span class="cff-byline" '.$cff_body_styles.'>' . $news->story . '</span>';
                // $cff_post_text = '<div class="cff-post-text" ' . $cff_title_styles . '>';
                $cff_post_text .= '<span class="cff-text">';
                if ($cff_title_link == 'true') $cff_post_text .= '<a class="cff-post-text-link" href="'.$link.'" '.$target.'>';
                if (!empty($news->story)) $post_text = $news->story;
                if (!empty($news->message)) $post_text = $news->message;
                if (!empty($news->name) && empty($news->story) && empty($news->message)) $post_text = $news->name;
                if ($cff_album) {
                    if (!empty($news->name)) $post_text = $news->name;
                    if (!empty($news->message) && empty($news->name)) $post_text = $news->message;
                    $post_text .= ' (' . $num_photos . ' '.$cff_translate_photos_text.')';
                }

                //OFFER TEXT
                if ($cff_post_type == 'offer'){
                    $post_text = $news->story . '<br /><br />';
                    $post_text .= $news->name;
                }

                //If the text is wrapped in a link then don't hyperlink any text within
                if ($cff_title_link == 'true') {
                    //Wrap links in a span so we can break the text if it's too long
                    $cff_post_text .= cff_wrap_span( htmlspecialchars($post_text) ) . ' ';
                } else {
                    $cff_post_text .= cff_make_clickable( htmlspecialchars($post_text) ) . ' ';
                }
                
                if ($cff_title_link == 'true') $cff_post_text .= '</a>';
                $cff_post_text .= '</span>';
                //'See More' link
                $cff_post_text .= '<span class="cff-expand">... <a href="#"><span class="cff-more">' . $cff_see_more_text . '</span><span class="cff-less">' . $cff_see_less_text . '</span></a></span>';
                $cff_post_text .= '</' . $cff_title_format . '>';
                // $cff_post_text .= '</div>';

                //DESCRIPTION
                $cff_description = '';
                if ( !empty($news->description) || !empty($news->caption) ) {
                    $description_text = '';
                    if ( !empty($news->description) ) $description_text = $news->description;

                    if (!isset($description_text)) $description_text = $news->caption;

                    if (!empty($body_limit)) {
                        if (strlen($description_text) > $body_limit) $description_text = substr($description_text, 0, $body_limit) . '...';
                    }
                    $cff_description .= '<p class="cff-post-desc" '.$cff_body_styles.'><span>' . cff_make_clickable( htmlspecialchars($description_text) ) . '</span></p>';
                }

                //LINK
                $cff_shared_link = '';
                //Display shared link
                if ($news->type == 'link') {
                    $cff_shared_link .= '<div class="cff-shared-link">';

                    if ( isset($news->picture) ){
                        //Check whether the image is a 1x1 placeholder
                        $cff_link_image = true;
                        $cff_one_x_one = '1x1.';
                        if( stripos($news->picture, $cff_one_x_one) == true || empty($news->picture) ) $cff_link_image = false;

                        //If there's a picture accompanying the link then display it
                        if ($cff_link_image && $cff_show_media) {
                            $cff_shared_link .= '<a class="cff-link" href="'.$link.'" '.$target.'>';
                            $cff_shared_link .= '<img src="'. $picture .'" border="0" />';
                            $cff_shared_link .= '</a>';
                        }
                    }

                    //Display link name and description
                    if (!empty($news->description)) {
                        $cff_shared_link .= '<div class="cff-text-link ';
                        if (!$cff_link_image) $cff_shared_link .= 'cff-no-image';
                        $cff_shared_link .= '"><a class="cff-link-title" href="'.$link.'" '.$target.'>'. '<b>' . $news->name . '</b></a>';
                        if(!empty($news->caption)) $cff_shared_link .= '<p class="cff-link-caption">'.$news->caption.'</p>';
                        $cff_shared_link .= $cff_description;
                        $cff_shared_link .= '</div>';
                    }

                    $cff_shared_link .= '</div>';

                }
                //DATE
                $cff_date_formatting = $atts[ 'dateformat' ];
                $cff_date_custom = $atts[ 'datecustom' ];
                
                $post_time = $news->created_time;
                $cff_date = '<p class="cff-date" '.$cff_date_styles.'>'. $cff_date_before . ' ' . cff_getdate(strtotime($post_time), $cff_date_formatting, $cff_date_custom) . ' ' . $cff_date_after . '</p>';
                //EVENT
                $cff_event = '';
                if ($cff_show_event_title || $cff_show_event_details) {
                    //Check for media
                    if ($cff_post_type == 'event') {

                        //Get the event id from the event URL. eg: http://www.facebook.com/events/123451234512345/
                        $event_url = parse_url($link);
                        $url_parts = explode('/', $event_url['path']);
                        //Get the id from the parts
                        $eventID = $url_parts[count($url_parts)-2];

                        //Get the contents of the event using the WP HTTP API
                        $event_json = cff_fetchUrl('https://graph.facebook.com/'.$eventID.'?access_token=' . $access_token . $cff_ssl);
                        //Interpret data with JSON
                        $event_object = json_decode($event_json);
                        //Picture
                        if($cff_show_media) $cff_event .= '<a title="'.$cff_facebook_link_text.'" class="cff-event-thumb" href="'.$link.'" '.$target.'><img src="https://graph.facebook.com/'.$eventID.'/picture" border="0" /></a>';
                        //Event date
                        $event_time = $event_object->start_time;
                        //If timezone migration is enabled then remove last 5 characters
                        if ( strlen($event_time) == 24 ) $event_time = substr($event_time, 0, -5);
                        if (!empty($event_time)) $cff_event_date = '<p class="cff-date" '.$cff_event_date_styles.'>' . cff_eventdate(strtotime($event_time), $cff_event_date_formatting, $cff_event_date_custom) . '</p>';
                        //EVENT
                        //Display the event details
                        $cff_event .= '<div class="cff-details">';
                        //show event date above title
                        if ($cff_event_date_position == 'above') $cff_event .= $cff_event_date;
                        //Show event title
                        if ($cff_show_event_title && !empty($event_object->name)) {
                            if ($cff_event_title_link) $cff_event .= '<a href="'.$link.'">';
                            $cff_event .= '<' . $cff_event_title_format . ' ' . $cff_event_title_styles . '>' . $event_object->name . '</' . $cff_event_title_format . '>';
                            if ($cff_event_title_link) $cff_event .= '</a>';
                        }
                        //show event date below title
                        if ($cff_event_date_position !== 'above') $cff_event .= $cff_event_date;
                        //Show event details
                        if ($cff_show_event_details){
                            //Location
                            if (!empty($event_object->location)) $cff_event .= '<p class="cff-where" ' . $cff_event_details_styles . '>' . $event_object->location . '</p>';
                            //Description
                            if (!empty($event_object->description)){
                                $description = $event_object->description;
                                if (!empty($body_limit)) {
                                    if (strlen($description) > $body_limit) $description = substr($description, 0, $body_limit) . '...';
                                }
                                $cff_event .= '<p class="cff-info" ' . $cff_event_details_styles . '>' . cff_make_clickable($description) . '</p>';
                            }
                        }
                        $cff_event .= '</div>';
                        
                    }
                }
                //MEDIA
                $cff_is_video_embed = false;
                $cff_media = '';
                if ($news->type == 'photo' || $news->type == 'offer') {
                    if ($cff_thumb_layout){
                        //Show small image
                        // $picture = str_replace('_b.','_s.',$picture);
                    }
                    if ($cff_facebook_link_text == '') $cff_facebook_link_text = 'View on Facebook';
                    $link_text = $cff_facebook_link_text;

                    $cff_media = '<a title="'.$link_text.'" class="cff-photo" href="';
                    //If it's an album then link the photo to the album
                    if ($cff_album) {
                        $cff_media .= $album_link;
                    } else {
                        $cff_media .= $link;
                    }
                    $cff_media .= '" '.$target.'>';

                    if ($cff_album) $cff_media .= '<div class="cff-album-icon"></div>';
                    $cff_media .= '<img src="'. $picture .'" border="0" />';
                    $cff_media .= '</a>';
                }
                if ($news->type == 'swf') {
                    $cff_swf_url = 'http://www.facebook.com/permalink.php?story_fbid='.$PostID["1"].'&amp;id='.$PostID['0'];
                    $cff_media = '<a href="'.$cff_swf_url.'" class="cff-photo" '.$target.'><img src="'. $picture .'" border="0" /></a>';
                }
                if ($news->type == 'video') {
                    // url of video
                    $url = $news->source;
                    //Embeddable video strings
                    $youtube = 'youtube';
                    $youtu = 'youtu';
                    $vimeo = 'vimeo';
                    $youtubeembed = 'youtube.com/embed';
                    //Check whether it's a youtube video
                    $youtube = stripos($url, $youtube);
                    $youtu = stripos($url, $youtu);
                    $youtubeembed = stripos($url, $youtubeembed);
                    //Check whether it's a youtube video
                    if($youtube || $youtu || $youtubeembed) {
                        $cff_is_video_embed = true;
                        //Get the unique video id from the url by matching the pattern
                        if ($youtube || $youtubeembed) {
                            if (preg_match("/v=([^&]+)/i", $url, $matches)) {
                                $id = $matches[1];
                            }   elseif(preg_match("/\/v\/([^&]+)/i", $url, $matches)) {
                                $id = $matches[1];
                            }   elseif(preg_match("/\/embed\/([^&]+)/i", $url, $matches)) {
                                $id = $matches[1];
                            }
                        } elseif ($youtu) {
                            $id = end(explode('/', $url));
                        }
                        // this is your template for generating embed codes
                        $code = '<iframe class="youtube-player" type="text/html" src="https://www.youtube.com/embed/{id}" allowfullscreen frameborder="0"></iframe>';
                        // we replace each {id} with the actual ID of the video to get embed code for this particular video
                        $code = str_replace('{id}', $id, $code);
                        $cff_media = '<div class="cff-iframe-wrap" style="height: '. $cff_video_height .'">' . $code . '</div>';
                    //Check whether it's a vimeo
                    } else if(stripos($url, $vimeo) !== false) {
                        $url = htmlspecialchars($news->link);
                        $cff_is_video_embed = true;
                        // we get the unique video id from the url by matching the pattern
                        preg_match("/\/(\d+)$/", $url, $matches);
                        $id = $matches[1];
                        // this is your template for generating embed codes
                        $code = '<iframe src="https://player.vimeo.com/video/{id}" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                        // we replace each {id} with the actual ID of the video to get embed code for this particular video
                        $code = str_replace('{id}', $id, $code);
                        $cff_media = '<div class="cff-iframe-wrap" style="height: '. $cff_video_height .'">' . $code . '</div>';
                    //Else link to the video file
                    } else {
                        //Show play button over video thumbnail
                        //Show thumbnail image
                        if ($cff_thumb_layout){
                            $picture = str_replace('_b','_t',$picture);
                        }
                        $vid_link = $news->source;
                        $vid_title = '';
                        if(!empty($news->name)){
                            $vid_title = $news->name;
                        } else {
                            $vid_title = $vid_link;
                        }

                        if ($cff_video_action == 'post') {
                            $vid_link = $link;
                        }
                        isset($news->description) ? $image_desc = $news->description : $image_desc = 'Video screenshot';
                        $cff_media = '<a title="' . $vid_title . '" class="cff-vidLink" href="' . $vid_link . '" target="_blank"><i class="fa fa-play cff-playbtn"></i><img class="cff-poster" src="' . $picture . '" alt="' . $image_desc . '" /></a>';

                        if (empty($picture)) {
                            $cff_is_video_embed = true;
                            $cff_media = '<a class="cff-playbtn-solo" title="' . $vid_title . '" href="' . $vid_link . '" target="_blank"><i class="fa fa-play cff-playbtn no-poster"></i></a>';
                        }
                    }
                    //Add the name to the description if it's a video embed
                    if($cff_is_video_embed) {
                        $cff_description = '<div class="cff-desc-wrap ';
                        if (empty($picture)) $cff_description .= 'cff-no-image';
                        $cff_description .= '"><a class="cff-link-title" href="'.$link.'" '.$target.'>'. '<b>' . $news->name . '</b></a>';

                        if (!empty($body_limit)) {
                            if (strlen($description_text) > $body_limit) $description_text = substr($description_text, 0, $body_limit) . '...';
                        }

                        $cff_description .= '<p class="cff-post-desc" '.$cff_body_styles.'><span>' . cff_make_clickable( htmlspecialchars($description_text) ) . '</span></p></div>';
                    }
                }
                //META
                //how many comments are there?
                $comment_count = 0;
                $comment_count_display = '0';
                if (!empty($news->comments)) {
                    $comment_count = count($news->comments->data);
                    $comment_count_display = $comment_count;
                    if ($comment_count > 20) $comment_count_display = '<div class="cff-loader"></div><span class="cff-replace">20+</span>';
                }

                $cff_meta_total = '<div class="cff-meta-wrap">';
                //Check for likes
                $cff_meta = '';
                $cff_meta .= '<a href="javaScript:void(0);" class="cff-view-comments" ' . $cff_meta_styles . '><ul class="cff-meta ';
                $cff_meta .= $cff_icon_style;
                $cff_meta .= '"><li class="cff-likes"><span class="cff-icon">Likes:</span> <span class="cff-count">';
                //How many likes are there?
                if (!empty($news->likes)) {
                    $like_count = count($news->likes->data);
                } else {
                    $like_count = '0';
                }
                //If there is no likes then display zero
                if ($like_count == 0) {
                    $cff_meta .= '0';
                } else if ($like_count < 25) {
                    $cff_meta .= $like_count;
                } else {
                    $cff_meta .= '<div class="cff-loader"></div>';
                    $cff_meta .= '<span class="cff-replace">' . $like_count . '+</span>';
                }
                //Check for shares
                $cff_meta .= '</span></li><li class="cff-shares"><span class="cff-icon">Shares:</span> <span class="cff-count">';
                if (empty($news->shares->count)) { $cff_meta .= '0'; }
                    else { $cff_meta .= $news->shares->count; }
                //Check for comments
                $cff_meta .= '</span></li><li class="cff-comments"><span class="cff-icon">Comments:</span> <span class="cff-count">';
                //How many comments are there?
                $cff_meta .= $comment_count_display;
                $cff_meta .= '</span></li></ul></a>';
                //Display the link to the Facebook post or external link
                $cff_link = '';
                //Default link
                $cff_viewpost_class = 'cff-viewpost-facebook';
                if ($cff_facebook_link_text == '') $cff_facebook_link_text = 'View on Facebook';
                $link_text = $cff_facebook_link_text;

                //Link to the Facebook post if it's a link or a video
                if($cff_post_type == 'link' || $cff_post_type == 'video') $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];

                if ($cff_post_type == 'offer') $link_text = 'View Offer';
                $cff_link = '<a class="' . $cff_viewpost_class . '" href="' . $link . '" title="' . $link_text . '" ' . $target . ' ' . $cff_link_styles . '>' . $link_text . '</a>';
                //Compile the meta and link if included
                if ($cff_show_meta) $cff_meta_total .= $cff_meta;
                if ($cff_show_link) $cff_meta_total .= $cff_link;
                $cff_meta_total .= '</div>';
                $cff_comments = '';

                //Get custom text strings
                $cff_translate_view_previous_comments_text = $atts['previouscommentstext'];
                $cff_translate_comment_on_facebook_text = $atts['commentonfacebooktext'];
                $cff_translate_likes_this_text = $atts['likesthistext'];
                $cff_translate_like_this_text = $atts['likethistext'];
                $cff_translate_and_text = $atts['andtext'];
                $cff_translate_other_text = $atts['othertext'];
                $cff_translate_others_text = $atts['otherstext'];

                if (!isset($cff_translate_view_previous_comments_text) || empty($cff_translate_view_previous_comments_text)) $cff_translate_view_previous_comments_text = 'View previous comments';
                if (!isset($cff_translate_comment_on_facebook_text) || empty($cff_translate_comment_on_facebook_text)) $cff_translate_comment_on_facebook_text = 'Comment on Facebook';
                if (!isset($cff_translate_likes_this_text) || empty($cff_translate_likes_this_text)) $cff_translate_likes_this_text = 'likes this';
                if (!isset($cff_translate_like_this_text) || empty($cff_translate_like_this_text)) $cff_translate_like_this_text = 'like this';
                if (!isset($cff_translate_and_text) || empty($cff_translate_and_text)) $cff_translate_and_text = 'and';
                if (!isset($cff_translate_other_text) || empty($cff_translate_other_text)) $cff_translate_other_text = 'other';
                if (!isset($cff_translate_others_text) || empty($cff_translate_others_text)) $cff_translate_others_text = 'others';

                //Create the comments box
                $cff_comments .= '<div class="cff-comments-box ' . $cff_icon_style . '" >';
                
                //Get the likes
                if (!empty($news->likes->data)){

                    $liker_one = '';
                    $liker_two = ''; 

                    if ( $news->likes->data[0] ) $liker_one = '<a href="https://facebook.com/'.$news->likes->data[0]->id.'" '.$cff_meta_styles.' target="_blank">' . $news->likes->data[0]->name . '</a>';
                    if ( $like_count > 1 ) $liker_two = '<a href="https://facebook.com/'.$news->likes->data[1]->id.'" '.$cff_meta_styles.' target="_blank">' . $news->likes->data[1]->name . '</a>';

                    if ($like_count > 0) $cff_comments .= '<p class="cff-comment-likes cff-likes" ' . $cff_meta_styles . '><span class="cff-icon"></span>';
                    if ($like_count == 1){
                        $cff_comments .= $liker_one.' '.$cff_translate_likes_this_text;
                    } else if ($like_count == 2){
                        $cff_comments .= $liker_one.' '.$cff_translate_and_text.' '.$liker_two.' '.$cff_translate_like_this_text;
                    } else if ($like_count == 3){
                        $cff_comments .= $liker_one.', '.$liker_two.' '.$cff_translate_and_text.' 1 '.$cff_translate_other_text.' '.$cff_translate_like_this_text;
                    } else {
                        $cff_comments .= $liker_one.', '.$liker_two.' '.$cff_translate_and_text.' ';
                        if ($like_count == 25) $cff_comments .= '<span class="cff-comment-likes-count">';
                        $cff_comments .= intval($like_count)-2;
                        if ($like_count == 25) $cff_comments .= '</span>';
                        $cff_comments .= ' '.$cff_translate_others_text.' '.$cff_translate_like_this_text;
                    }
                    if ($like_count > 0) $cff_comments .= '</p>';

                }

                //Show more comments
                if ( $comment_count > 4 ) $cff_comments .= '<p class="cff-comments cff-show-more-comments" ' . $cff_meta_styles . '><a href="javascript:void(0);"><span class="cff-icon"></span>'.$cff_translate_view_previous_comments_text.'</a></p>';

                //Get the comments
                if (!empty($news->comments->data)){
                    foreach ($news->comments->data as $comment_item ) {
                        $comment_likes = $comment_item->like_count;
                        $comment = $comment_item->message;
                        // $cff_comments .= '<p><img src="https://graph.facebook.com/' . $comment_item->from->id . '/picture" alt="'.$comment_item->from->name.'" />';
                        $cff_comments .= '<p class="cff-comment" ' . $cff_meta_styles . '><a href="https://facebook.com/'. $comment_item->from->id .'" class="cff-name" '.$target.' ' . $cff_meta_styles . '>' . $comment_item->from->name . '</a>' . cff_make_clickable( htmlspecialchars($comment) );
                        $cff_comments .= '<span class="cff-time">';
                        if ( $comment_likes > 0 ) $cff_comments .= '<span class="cff-comment-likes"><b></b>' . $comment_likes . ' &nbsp; &middot; &nbsp;</span>';
                        $cff_comments .= cff_timeSince(strtotime($comment_item->created_time)) . ' ' . $cff_date_after . '</span></p>';
                    }
                }
                $cff_comments .= '<p class="cff-comments" ' . $cff_meta_styles . '><a href="'.$link.'" target="_blank"><span class="cff-icon"></span>'.$cff_translate_comment_on_facebook_text.'</a></p>';
                $cff_comments .= '</div>';
                
                //Compile comments if meta is included
                if ($cff_show_meta) $cff_meta_total .= $cff_comments;
                //**************************//
                //***CREATE THE POST HTML***//
                //**************************//
                //Start the container
                $cff_content .= '<div class="cff-item ';
                if ($cff_post_type == 'link') $cff_content .= 'cff-link-item';
                if ($cff_post_type == 'event') $cff_content .= 'cff-timeline-event';
                if ($cff_post_type == 'photo') $cff_content .= 'cff-photo-post';
                if ($cff_post_type == 'video') $cff_content .= 'cff-video-post';
                if ($cff_post_type == 'swf') $cff_content .= 'cff-swf-post';
                if ($cff_post_type == 'status') $cff_content .= 'cff-status-post';
                if ($cff_post_type == 'offer') $cff_content .= 'cff-offer-post';
                if ($cff_album) $cff_content .= ' cff-album';
                $cff_content .=  '" id="'. $news->id .'" ' . $cff_item_styles . '>';

                //POST AUTHOR
                if($cff_is_video_embed){
                    if($cff_show_author) $cff_content .= $cff_author;
                    //DATE ABOVE
                    if ($cff_show_date && $cff_date_position == 'above') $cff_content .= $cff_date;
                    //If embedded video then show post text above the wrapper
                    if($cff_show_text) $cff_content .= $cff_post_text;
                    
                    $cff_content .= '<div class="cff-embed-wrap">';
                }

                //Start text wrapper
                if ( ($cff_thumb_layout || $cff_half_layout) && !empty($news->picture) ) $cff_content .= '<div class="cff-text-wrapper">';
                    //POST AUTHOR
                    if($cff_show_author && !$cff_is_video_embed) $cff_content .= $cff_author;
                    //DATE ABOVE
                    if ($cff_show_date && $cff_date_position == 'above' && !$cff_is_video_embed) $cff_content .= $cff_date;
                    //POST TEXT
                    if($cff_show_text && !$cff_is_video_embed) $cff_content .= $cff_post_text;
                    //DESCRIPTION
                    if($cff_show_desc && $cff_post_type != 'offer' && $cff_post_type != 'link') $cff_content .= $cff_description;
                    //LINK
                    if($cff_show_shared_links) $cff_content .= $cff_shared_link;
                    //DATE BELOW
                    if ($cff_show_date && $cff_date_position == 'below' && !$cff_is_video_embed) $cff_content .= $cff_date;
                //End text wrapper
                if ( ($cff_thumb_layout || $cff_half_layout) && !empty($news->picture) ) $cff_content .= '</div>';
                
                //EVENT
                if($cff_show_event_title || $cff_show_event_details) $cff_content .= $cff_event;
                //MEDIA
                if($cff_show_media) $cff_content .= $cff_media;
                if($cff_is_video_embed) $cff_content .= '</div>';
                //DATE BELOW
                if ($cff_show_date && $cff_date_position == 'below' && $cff_is_video_embed) $cff_content .= $cff_date;
                //META
                if($cff_show_meta || $cff_show_link) $cff_content .= $cff_meta_total;
                //End the post item
                $cff_content .= '</div><div class="cff-clear"></div>';
            } // End post type check
            if (isset($news->message)) $prev_post_message = $news->message;
            if (isset($news->link))  $prev_post_link = $news->link;
            if (isset($news->description))  $prev_post_description = $news->description;
        } // End the loop
    } // End ALL POSTS
    //Load more posts
    // $cff_content .= '<button class="loadmore">Load More Posts</button>';
    //Add the Like Box inside
    if ($cff_like_box_position == 'bottom' && $cff_show_like_box && !$cff_like_box_outside) $cff_content .= $like_box;
    //End the feed
    $cff_content .= '</div><div class="cff-clear"></div>';
    //Add the Like Box outside
    if ($cff_like_box_position == 'bottom' && $cff_show_like_box && $cff_like_box_outside) $cff_content .= $like_box;
    //Return our feed HTML to display
    return $cff_content;
}
//Get JSON object of feed data
function cff_fetchUrl($url){
    //Can we use cURL?
    if(is_callable('curl_init')){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
        $feedData = curl_exec($ch);
        curl_close($ch);
    //If not then use file_get_contents
    } elseif ( ini_get('allow_url_fopen') == 1 || ini_get('allow_url_fopen') === TRUE ) {
        $feedData = @file_get_contents($url);
    //Or else use the WP HTTP API
    } else {
        if( !class_exists( 'WP_Http' ) ) include_once( ABSPATH . WPINC. '/class-http.php' );
        $request = new WP_Http;
        $result = $request->request($url);
        $feedData = $result['body'];
    }
    
    return $feedData;
}
//***FUNCTIONS***
//Make links in text clickable
function cff_make_clickable($text) {
    $pattern  = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
    return preg_replace_callback($pattern, 'cff_auto_link_text_callback', $text);
}
function cff_auto_link_text_callback($matches) {
    $max_url_length = 50;
    $max_depth_if_over_length = 2;
    $ellipsis = '&hellip;';
    $target = 'target="_blank"';
    $url_full = $matches[0];
    $url_short = '';
    if (strlen($url_full) > $max_url_length) {
        $parts = parse_url($url_full);
        $url_short = $parts['scheme'] . '://' . preg_replace('/^www\./', '', $parts['host']) . '/';
        $path_components = explode('/', trim($parts['path'], '/'));
        foreach ($path_components as $dir) {
            $url_string_components[] = $dir . '/';
        }
        if (!empty($parts['query'])) {
            $url_string_components[] = '?' . $parts['query'];
        }
        if (!empty($parts['fragment'])) {
            $url_string_components[] = '#' . $parts['fragment'];
        }
        for ($k = 0; $k < count($url_string_components); $k++) {
            $curr_component = $url_string_components[$k];
            if ($k >= $max_depth_if_over_length || strlen($url_short) + strlen($curr_component) > $max_url_length) {
                if ($k == 0 && strlen($url_short) < $max_url_length) {
                    // Always show a portion of first directory
                    $url_short .= substr($curr_component, 0, $max_url_length - strlen($url_short));
                }
                $url_short .= $ellipsis;
                break;
            }
            $url_short .= $curr_component;
        }
    } else {
        $url_short = $url_full;
    }
    if( substr( $url_full, 0, 4 ) !== "http" ) $url_full = 'http://' . $url_full;
    return "<a class='cff-break-word' rel=\"nofollow\" href=\"$url_full\">$url_full</a>";
}
//Make links into span instead when the post text is made clickable
function cff_wrap_span($text) {
    $pattern  = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
    return preg_replace_callback($pattern, 'cff_wrap_span_callback', $text);
}
function cff_wrap_span_callback($matches) {
    $max_url_length = 50;
    $max_depth_if_over_length = 2;
    $ellipsis = '&hellip;';
    $target = 'target="_blank"';
    $url_full = $matches[0];
    $url_short = '';
    if (strlen($url_full) > $max_url_length) {
        $parts = parse_url($url_full);
        $url_short = $parts['scheme'] . '://' . preg_replace('/^www\./', '', $parts['host']) . '/';
        $path_components = explode('/', trim($parts['path'], '/'));
        foreach ($path_components as $dir) {
            $url_string_components[] = $dir . '/';
        }
        if (!empty($parts['query'])) {
            $url_string_components[] = '?' . $parts['query'];
        }
        if (!empty($parts['fragment'])) {
            $url_string_components[] = '#' . $parts['fragment'];
        }
        for ($k = 0; $k < count($url_string_components); $k++) {
            $curr_component = $url_string_components[$k];
            if ($k >= $max_depth_if_over_length || strlen($url_short) + strlen($curr_component) > $max_url_length) {
                if ($k == 0 && strlen($url_short) < $max_url_length) {
                    // Always show a portion of first directory
                    $url_short .= substr($curr_component, 0, $max_url_length - strlen($url_short));
                }
                $url_short .= $ellipsis;
                break;
            }
            $url_short .= $curr_component;
        }
    } else {
        $url_short = $url_full;
    }
    return "<span class='cff-break-word'>$url_short</span>";
}
//2013-04-28T21:06:56+0000
//Time stamp function - used for posts
function cff_getdate($original, $date_format, $custom_date) {

    switch ($date_format) {
        
        case '2':
            $print = date_i18n('F jS, g:i a', $original);
            break;
        case '3':
            $print = date_i18n('F jS', $original);
            break;
        case '4':
            $print = date_i18n('D F jS', $original);
            break;
        case '5':
            $print = date_i18n('l F jS', $original);
            break;
        case '6':
            $print = date_i18n('D M jS, Y', $original);
            break;
        case '7':
            $print = date_i18n('l F jS, Y', $original);
            break;
        case '8':
            $print = date_i18n('l F jS, Y - g:i a', $original);
            break;
        case '9':
            $print = date_i18n("l M jS, 'y", $original);
            break;
        case '10':
            $print = date_i18n('m.d.y', $original);
            break;
        case '11':
            $print = date_i18n('m/d/y', $original);
            break;
        case '12':
            $print = date_i18n('d.m.y', $original);
            break;
        case '13':
            $print = date_i18n('d/m/y', $original);
            break;
        default:

            $options = get_option('cff_style_settings');

            $cff_second = $options['cff_translate_second'];
            if ( empty($cff_second) ) $cff_second = 'second';

            $cff_seconds = $options['cff_translate_seconds'];
            if ( empty($cff_seconds) ) $cff_seconds = 'seconds';

            $cff_minute = $options['cff_translate_minute'];
            if ( empty($cff_minute) ) $cff_minute = 'minute';

            $cff_minutes = $options['cff_translate_minutes'];
            if ( empty($cff_minutes) ) $cff_minutes = 'minutes';

            $cff_hour = $options['cff_translate_hour'];
            if ( empty($cff_hour) ) $cff_hour = 'hour';

            $cff_hours = $options['cff_translate_hours'];
            if ( empty($cff_hours) ) $cff_hours = 'hours';

            $cff_day = $options['cff_translate_day'];
            if ( empty($cff_day) ) $cff_day = 'day';

            $cff_days = $options['cff_translate_days'];
            if ( empty($cff_days) ) $cff_days = 'days';

            $cff_week = $options['cff_translate_week'];
            if ( empty($cff_week) ) $cff_week = 'week';

            $cff_weeks = $options['cff_translate_weeks'];
            if ( empty($cff_weeks) ) $cff_weeks = 'weeks';

            $cff_month = $options['cff_translate_month'];
            if ( empty($cff_month) ) $cff_month = 'month';

            $cff_months = $options['cff_translate_months'];
            if ( empty($cff_months) ) $cff_months = 'months';

            $cff_year = $options['cff_translate_year'];
            if ( empty($cff_year) ) $cff_year = 'year';

            $cff_years = $options['cff_translate_years'];
            if ( empty($cff_years) ) $cff_years = 'years';

            $cff_ago = $options['cff_translate_ago'];
            if ( empty($cff_ago) ) $cff_ago = 'ago';

            
            $periods = array($cff_second, $cff_minute, $cff_hour, $cff_day, $cff_week, $cff_month, $cff_year, "decade");
            $periods_plural = array($cff_seconds, $cff_minutes, $cff_hours, $cff_days, $cff_weeks, $cff_months, $cff_years, "decade");

            $lengths = array("60","60","24","7","4.35","12","10");
            $now = time();
            
            // is it future date or past date
            if($now > $original) {    
                $difference = $now - $original;
                $tense = $cff_ago;
            } else {
                $difference = $original - $now;
                $tense = $cff_ago;
            }
            for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                $difference /= $lengths[$j];
            }
            
            $difference = round($difference);
            
            if($difference != 1) {
                $periods[$j] = $periods_plural[$j];
            }
            $print = "$difference $periods[$j] {$tense}";
            break;
        
    }
    if ( !empty($custom_date) ){
        $print = date_i18n($custom_date, $original);
    }
    return $print;
}
function cff_eventdate($original, $date_format, $custom_date) {
    switch ($date_format) {
        
        case '2':
            $print = date_i18n('F jS, g:ia', $original);
            break;
        case '3':
            $print = date_i18n('g:ia - F jS', $original);
            break;
        case '4':
            $print = date_i18n('g:ia, F jS', $original);
            break;
        case '5':
            $print = date_i18n('l F jS - g:ia', $original);
            break;
        case '6':
            $print = date_i18n('D M jS, Y, g:iA', $original);
            break;
        case '7':
            $print = date_i18n('l F jS, Y, g:iA', $original);
            break;
        case '8':
            $print = date_i18n('l F jS, Y - g:ia', $original);
            break;
        case '9':
            $print = date_i18n("l M jS, 'y", $original);
            break;
        case '10':
            $print = date_i18n('m.d.y - g:iA', $original);
            break;
        case '11':
            $print = date_i18n('m/d/y, g:ia', $original);
            break;
        case '12':
            $print = date_i18n('d.m.y - g:iA', $original);
            break;
        case '13':
            $print = date_i18n('d/m/y, g:ia', $original);
            break;
        default:
            $print = date_i18n('F j, Y, g:ia', $original);
            break;
    }
    if ( !empty($custom_date) ){
        $print = date_i18n($custom_date, $original);
    }
    return $print;
}
//Time stamp function - used for comments
function cff_timesince($original) {

    $options = get_option('cff_style_settings');

    $cff_second = $options['cff_translate_second'];
    if ( empty($cff_second) ) $cff_second = 'second';

    $cff_seconds = $options['cff_translate_seconds'];
    if ( empty($cff_seconds) ) $cff_seconds = 'seconds';

    $cff_minute = $options['cff_translate_minute'];
    if ( empty($cff_minute) ) $cff_minute = 'minute';

    $cff_minutes = $options['cff_translate_minutes'];
    if ( empty($cff_minutes) ) $cff_minutes = 'minutes';

    $cff_hour = $options['cff_translate_hour'];
    if ( empty($cff_hour) ) $cff_hour = 'hour';

    $cff_hours = $options['cff_translate_hours'];
    if ( empty($cff_hours) ) $cff_hours = 'hours';

    $cff_day = $options['cff_translate_day'];
    if ( empty($cff_day) ) $cff_day = 'day';

    $cff_days = $options['cff_translate_days'];
    if ( empty($cff_days) ) $cff_days = 'days';

    $cff_week = $options['cff_translate_week'];
    if ( empty($cff_week) ) $cff_week = 'week';

    $cff_weeks = $options['cff_translate_weeks'];
    if ( empty($cff_weeks) ) $cff_weeks = 'weeks';

    $cff_month = $options['cff_translate_month'];
    if ( empty($cff_month) ) $cff_month = 'month';

    $cff_months = $options['cff_translate_months'];
    if ( empty($cff_months) ) $cff_months = 'months';

    $cff_year = $options['cff_translate_year'];
    if ( empty($cff_year) ) $cff_year = 'year';

    $cff_years = $options['cff_translate_years'];
    if ( empty($cff_years) ) $cff_years = 'years';

    $cff_ago = $options['cff_translate_ago'];
    if ( empty($cff_ago) ) $cff_ago = 'ago';

    
    $periods = array($cff_second, $cff_minute, $cff_hour, $cff_day, $cff_week, $cff_month, $cff_year, "decade");
    $periods_plural = array($cff_seconds, $cff_minutes, $cff_hours, $cff_days, $cff_weeks, $cff_months, $cff_years, "decade");

    $lengths = array("60","60","24","7","4.35","12","10");
    $now = time();
    
    // is it future date or past date
    if($now > $original) {    
        $difference = $now - $original;
        $tense = $cff_ago;;
    } else {
        $difference = $original - $now;
        $tense = $cff_ago;
    }
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j] = $periods_plural[$j];
    }
    return "$difference $periods[$j] {$tense}";
            
}
//Use custom stripos function if it's not available (only available in PHP 5+)
if(!is_callable('stripos')){
    function stripos($haystack, $needle){
        return strpos($haystack, stristr( $haystack, $needle ));
    }
}
function stripos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = stripos($haystack, trim($what) ))!==false) return $pos;
    }
    return false;
}


//Add wpautop
// add_filter( 'the_content', 'wpautop', 99 );

//Doesn't fix wpautop
// add_filter('the_content', 'display_cff', 99);


//Enqueue stylesheet
add_action( 'wp_enqueue_scripts', 'cff_add_my_stylesheet' );
function cff_add_my_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'cff', plugins_url('css/cff-style.css?6', __FILE__) );
    wp_enqueue_style( 'cff' );
    wp_enqueue_style( 'cff-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
}
//Enqueue scripts
add_action( 'wp_enqueue_scripts', 'cff_scripts_method' );
function cff_scripts_method() {
    //Register the script to make it available
    wp_register_script( 'cffscripts', plugins_url( '/js/cff-scripts.js?6' , __FILE__ ), array('jquery'), '1.8', true );
    //Enqueue it to load it onto the page
    wp_enqueue_script('cffscripts');
}

//Allows shortcodes in theme
add_filter('widget_text', 'do_shortcode');

//Run function on plugin activate
function cff_activate() {
    $options = get_option('cff_style_settings');
    $options[ 'cff_show_links_type' ] = true;
    $options[ 'cff_show_event_type' ] = true;
    $options[ 'cff_show_video_type' ] = true;
    $options[ 'cff_show_photos_type' ] = true;
    $options[ 'cff_show_status_type' ] = true;
    // Show all parts of the feed by default on activation
    $options[ 'cff_show_author' ] = true;
    $options[ 'cff_show_text' ] = true;
    $options[ 'cff_show_desc' ] = true;
    $options[ 'cff_show_shared_links' ] = true;
    $options[ 'cff_show_date' ] = true;
    $options[ 'cff_show_media' ] = true;
    $options[ 'cff_show_event_title' ] = true;
    $options[ 'cff_show_event_details' ] = true;
    $options[ 'cff_show_meta' ] = true;
    $options[ 'cff_show_link' ] = true;
    $options[ 'cff_show_like_box' ] = true;
    update_option( 'cff_style_settings', $options );
}
register_activation_hook( __FILE__, 'cff_activate' );
//Uninstall
function cff_uninstall()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    //Settings
    delete_option( 'cff_access_token' );
    delete_option( 'cff_page_id' );
    delete_option( 'cff_num_show' );
    delete_option( 'cff_post_limit' );
    delete_option( 'cff_show_others' );
    delete_option( 'cff_cache_time' );
    delete_option( 'cff_cache_time_unit' );
    delete_option( 'cff_locale' );
    //Style & Layout
    delete_option( 'cff_title_length' );
    delete_option( 'cff_body_length' );
    delete_option( 'cff_style_settings' );

    //Deactivate and delete license
    // retrieve the license from the database
    $license = trim( get_option( 'cff_license_key' ) );
    // data to send in our API request
    $api_params = array( 
        'edd_action'=> 'deactivate_license', 
        'license'   => $license, 
        'item_name' => urlencode( WPW_SL_ITEM_NAME ) // the name of our product in EDD
    );
    // Call the custom API.
    $response = wp_remote_get( add_query_arg( $api_params, WPW_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
    delete_option( 'cff_license_status' );
    delete_option( 'cff_license_key' );
}
register_uninstall_hook( __FILE__, 'cff_uninstall' );
add_action( 'wp_head', 'cff_custom_css' );
function cff_custom_css() {
    $options = get_option('cff_style_settings');
    $cff_custom_css = $options[ 'cff_custom_css' ];
    if( !empty($cff_custom_css) ) echo '<!-- Custom Facebook Feed Custom CSS -->';
    if( !empty($cff_custom_css) ) echo "\r\n";
    if( !empty($cff_custom_css) ) echo '<style type="text/css">';
    if( !empty($cff_custom_css) ) echo "\r\n";
    if( !empty($cff_custom_css) ) echo stripslashes($cff_custom_css);
    if( !empty($cff_custom_css) ) echo "\r\n";
    if( !empty($cff_custom_css) ) echo '</style>';
    if( !empty($cff_custom_css) ) echo "\r\n";
}
add_action( 'wp_footer', 'cff_js' );
function cff_js() {
    $options = get_option('cff_style_settings');
    $cff_custom_js = $options[ 'cff_custom_js' ];

    $url = plugins_url();
    $path = urlencode(ABSPATH);
    echo '<!-- Custom Facebook Feed JS -->';
    echo "\r\n";
    echo '<script type="text/javascript">';
    echo "\r\n";
    echo 'var siteURL = "' . $url . '";';
    echo "\r\n";
    echo 'var rootPath = "' . $path . '";';
    echo "\r\n";
    if( !empty($cff_custom_js) ) echo "jQuery( document ).ready(function($) {";
    if( !empty($cff_custom_js) ) echo "\r\n";
    if( !empty($cff_custom_js) ) echo stripslashes($cff_custom_js);
    if( !empty($cff_custom_js) ) echo "\r\n";
    if( !empty($cff_custom_js) ) echo "});";
    if( !empty($cff_custom_js) ) echo "\r\n";
    echo '</script>';
    echo "\r\n";
}
//Comment out the line below to view errors
error_reporting(0);
?>