<?php

class VOTE_Public {

    private $auto_add_post_types = array();

    public function __construct() {

        $this->auto_add_post_types = array('literature');
        add_filter( 'the_content', array( $this, 'add_button_after_content' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ), 99 );
        add_action ( 'wp_ajax_do_vote', array( $this, 'do_vote' ),100 );
        add_action ( 'wp_ajax_nopriv_do_vote', array( $this, 'do_vote' ),100 );
    }

    public function load_assets() {
        wp_enqueue_style( 'vote-style', plugins_url ( '/css/vote.css', __FILE__ ), array(), '1.0.1' );
        wp_register_script ( 'vote-script', plugins_url ( '/script/vote.js', __FILE__ ), array (
            'jquery'
        ) );
        wp_localize_script ( 'vote-script', 'custAjax', array (
                'ajaxurl' => admin_url ( 'admin-ajax.php' )
        ) );
        wp_enqueue_script ( 'vote-script' );
    }

    public function add_button_after_content( $content ){
        $options = get_option('cust_vote_manager');

        $today = time();
        $expDate = time();
        if(isset($options['voting_end_date']) && $options['voting_end_date']) {
            $expDate = strtotime(date("Y-m-d H:i:s",strtotime($options['voting_end_date'])));
        }

        if($expDate < $today || !in_array( get_post_type(), $this->auto_add_post_types )) {
            return $content;
        } 
        return $content . $this->cust_vote();
    }

    public function cust_vote() {
        $votpopup = $this->get_vote_popup();
        $voteIcon = '<div class="cust-vote"> Vote </div>';
        return $votpopup . $voteIcon;
    }

    public static function get_vote($voteID) {
        global $wpdb;
        return $wpdb->get_var ( "SELECT count(*) FROM " . $wpdb->prefix . "article_vote WHERE post_id = '" . $voteID . "'" );
    }

    public static function check_new($publish_date) {
        $options = get_option('cust_vote_manager');
        $year = isset($options['articles_published_in']) ? $options['articles_published_in'] : '0';
        
        if(date('Y', strtotime($publish_date)) == $year ) {
            return true;
        }

        return false;
    }

    public function do_vote() {

        global $wpdb;

        $options = get_option('cust_vote_manager');

        $today = time();
        $expDate = time();
        if(isset($options['voting_end_date']) && $options['voting_end_date']) {
            $expDate = strtotime(date("Y-m-d H:i:s",strtotime($options['voting_end_date'])));
        }

        if($expDate < $today) {
            $response['status'] = 'error';
            $response['msg'] = 'Voting time is over';
            echo json_encode($response);
            die;
        }

        $voteID = isset($_POST ['voteID']) ? trim ( esc_sql ( $_POST ['voteID'] ) ) : '';
        $name = isset($_POST ['name']) ? trim ( esc_sql ( $_POST ['name'] ) ) : '';
        $company = isset($_POST ['company']) ? trim ( esc_sql ( $_POST ['company'] ) ) : '';
        $email = isset($_POST ['email']) ? trim ( esc_sql ( $_POST ['email'] ) ) : '';
        $voteID = base64_decode($voteID);

        if(!$voteID || !is_numeric ($voteID)) {
            $response['status'] = 'error';
            $response['msg'] = 'Invalid article';
            echo json_encode($response);
            die;
        }

        $curPost = get_post($voteID);
    
        if(empty($curPost)) {
            $response['status'] = 'error';
            $response['msg'] = 'Invalid article';
            echo json_encode($response);
            die;
        }
        
        if($curPost->post_type != 'literature') {
            $response['status'] = 'error';
            $response['msg'] = 'Invalid article';
            echo json_encode($response);
            die;
        }

        $count = $wpdb->get_var ( "SELECT count(*) FROM " . $wpdb->prefix . "article_vote WHERE post_id = '" . $voteID . "' AND email = '" . $email. "'" );

        if( $count > 0  ) {
          $response['status'] = 'error';
          $response['msg'] = 'Already voted';
          echo json_encode($response);
          die;  
        }

        $data = array (
            'post_id' => $voteID,
            'name' => $name,
            'company' => $company,
            'email' => $email,
            'date' => date('Y-m-d H:is')
        );

        $wpdb->insert ( $wpdb->prefix . "article_vote", $data );
        if( $wpdb->insert_id ) {
            $response['status'] = 'success';
            $response['msg'] = 'Successfully voted';
            echo json_encode($response);
            die; 
        }
    }

    public function get_vote_popup() {

        $popup = '<div class="modal fade" id="voteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            $popup .= '<div class="modal-dialog">';
                $popup .= '<div class="modal-content">';
                    $popup .= '<div class="modal-header">';
                        $popup .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        $popup .= '<h4 class="modal-title" id="myModalLabel">Vote</h4>';
                    $popup .= '</div>';
                    $popup .= '<div class="modal-body">';
                    $popup .= '<div class="success"></div>';
                        $popup .= '<div class="form-group">';
                            $popup .= '<input type="text" class="form-control" id="voteName"
                                 placeholder="Enter your name">';
                        $popup .= '</div>';
                        $popup .= '<div class="form-group">';
                             $popup .= '<input type="text" class="form-control" id="voteCompany"
                                     placeholder="Enter your company name">';
                        $popup .= '</div>';
                        $popup .= '<div class="form-group">';
                            $popup .= '<input type="email" class="form-control" id="voteEmail"
                                             placeholder="Enter your email address">';
                        $popup .= '</div>';
                        $popup .= '<div class="error"></div>';
                    $popup .= '</div>';
                    $popup .= '<div class="modal-footer">';
                        $popup .= '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                        $popup .= '<button id="'.base64_encode(get_the_ID()).'" type="button" class="btn btn-primary vote-post">Vote</button>';
                    $popup .= '</div>';
                $popup .= '</div>';
            $popup .= '</div>';
        $popup .= '</div>';

        return $popup;
    }
}