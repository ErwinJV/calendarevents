<?php 

function get_calendar_posts_metadata()
{    
    global $wpdb;
    try
    {
        $query = "SELECT ID,post_name FROM {$wpdb->prefix}posts";
        $posts = $wpdb->get_results($query,ARRAY_A);
        $calendar_metaboxes =[];
        foreach($posts as $post)
        {
          $start_date = get_post_meta($post['ID'],'start_date',true);
          $end_date = get_post_meta($post['ID'],'end_date',true);
          $calendar_metaboxes = [...$calendar_metaboxes,[
               'post_name'=>$post['post_name'],
               'start_date'=>$start_date,
               'end_date'=>$end_date
          ]];
        }
        return new WP_REST_Response(json_encode($calendar_metaboxes),200);
    }catch(Exception $e)
    {
        return new WP_REST_Response($e->getMessage(),404);
    }
}

function register_calendar_metabox_rest_route()
{
    register_rest_route('calendar/v1','all',[
        'methods'=>'GET',
        'callback'=>'get_calendar_posts_metadata',
        'permission_callback'=>'__return_true'
    ]);
}

add_action('rest_api_init','register_calendar_metabox_rest_route');