<?php
/**
* Plugin Name: Simple contact form
*/
if(!class_exists('SCF_Class')){
    
    
    class SCF_Class {
        var $ap_setting;

        function __construct(){
            // add_action("init", array($this, 'simple_contact_form'));
            $this -> ap_setting = get_option( 'ap_setting' );
            $this -> define_constants();
            add_shortcode('durga',array($this, 'simple_contact_form'));
            add_action('admin_post_contact_form_submit',array($this, 'form_submit_handler') );
            add_action( 'admin_post_sp_settings_action', array( $this, 'sp_settings_handler' ) ); //settings action
            add_action( 'admin_menu', array( $this, 'add_ap_menu' ) ); //add plugins in wordpress menu
            register_activation_hook( __FILE__, array( $this, 'load_default_setting' ) ); //loads default settings for the plugin while activating the plugin
            register_deactivation_hook(__FILE__,array($this, 'delete_default_options') );
            add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_assets' ) ); //registers scripts and styles for front end
        }                                                                               
      
        function simple_contact_form()
        {  
          $ap_setting = $this -> ap_setting;
         
        //   Array ( [form_title] => contact us! [first_name] => johnm [last_name] => bhujelree [admin_email_url] => admin@gbvjfhg [your_message] => [submit_your_message] => sdfghdf )
            ob_start()
            ?>
            <div class="form-wrapper">
                <h2> <?php echo esc_html( $ap_setting['form_title']) ?></h2>
                <form action="<?php echo admin_url('admin-post.php');?>" method="post">
                    <input type="hidden" name="action" value="contact_form_submit">
                    <div class="input-group">
                        <label for="first_name"><?php esc_html_e($ap_setting['first_name'])?></label>
                        <input  class="input-text" type="text" name="first_name" id="first_name">
                    </div>
                    <div class="input-group">
                        <label for="last_name"><?php esc_html_e($ap_setting['last_name']) ?></label>
                        <input class="input-text" type="text" name="last_name" id="last-name"required>
                    </div>
                       <div class="input-group">
                       <label for="email"><?php esc_html_e($ap_setting['admin_email_url']) ?></label>
                        <input class="input-text" type="email" name="email" id="email"required>
                    </div>
                    <div class="input-group"><label for="your_message"><?php echo esc_html($ap_setting['your_message'])?></label>
                        <textarea  class="message" name="your_message" id="your_message" cols="10" rows="10" placeholder="your message"></textarea>
                    </div>
                    <div class="btn-group">
                        <input type="submit" name="contact_form_submit" value="<?php esc_html_e($ap_setting['submit_your_message']) ?>">

                    </div>
                        
                    
                </form>
            </div>
            <?php
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
            
        }
        function form_submit_handler()
        {
            if(isset($_POST['contact_form_submit']))
            {
                $first_name1 = ($_POST['first_name']);
                $first_name = sanitize_text_field($first_name1);
                $last_name =sanitize_text_field($_POST['last_name']);
                $email = sanitize_email($_POST['email'] );
               filter_var($email, FILTER_VALIDATE_EMAIL);
               $message = sanitize_textarea_field($_POST['your_message']);
               $to = 'example@gmail.com';
               $subject = 'test plugin-message';
                $message = ''.$first_name.'-'.$last_name.'-'.$message;
                if(wp_mail($to,$subject,$message)){
                    echo "thank you for submit your query?";
                    die();
                }else{
                    echo "sorry your message is not submit?";
                    die();
                 }
               
            }
        }
        function define_constants(){
            defined( 'DB_JS_DIR' ) or define( 'DB_JS_DIR', plugin_dir_url( __FILE__ ) . 'js' );
            defined( 'DB_CSS_DIR' ) or define( 'DB_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css' );
        }
        function load_default_setting()
        {
            $ap_setting = array(); //array for saving all plugin's setting in single array
            $ap_setting['form_title'] = __('contact us!');
            $ap_setting['first_name'] = __('durga');
            $ap_setting['last_name'] = __('cena');
            $ap_setting['admin_email_url'] = __('admin@gmail.com');
            $ap_setting['taxonomy_reference' ] = 'category,post_tag';
            $ap_setting['your_message'] = '';
            $ap_setting['submit_your_message'] = __('Submit');
            if ( ! get_option( 'ap_setting' ) ) {
                update_option( 'ap_setting', $ap_setting ); //update as default option while activating for the first time.
            }

        }
        function delete_default_options()
        {
            if ( get_option( 'ap_setting' ) ) {
                delete_option( 'ap_setting' ); //update as default option while activating for the first time.
            }

        }
        //Adds admin menu
        function add_ap_menu(){
            add_menu_page( __( 'simple contact form Settings' ), ('Simple Settings' ), 'manage_options', 'simple-contact-form', array( $this, 'ap_setting' ), '' );
            // add_submenu_page( 'anonymous-post', __( 'Documentation', 'accesspress-anonymous-post' ), __( 'Documentation', 'accesspress-anonymous-post' ), 'manage_options', 'ap-doc', '__return_false', null, 9 );
            // add_submenu_page( 'anonymous-post', __( 'Check Premium Version', 'accesspress-anonymous-post' ), __( 'Check Premium Version', 'accesspress-anonymous-post' ), 'manage_options', 'ap-premium', '__return_false', null, 9 );
        }
        //plugin backend settings page
        function ap_setting(){
            include_once('inc/settings.php');
        }
        //save all setting
        function sp_settings_handler()
        {
            if(!isset($_POST['sp_setting_action']))
                die("Not allowed, could not pass first security check.");
            $nonce = $_POST['sp_setting_action'];  
            if ( isset( $_POST[ 'sp_setting_action' ], $_POST[ 'sp_setting_submit' ] ) && wp_verify_nonce($nonce, 'sp_settings_action') ) {
                include_once('inc/cores/save-settings.php');
            } else {
                die("Not allowed, could not pass second security check.");
            }
        }
        function register_frontend_assets()
        {
            wp_enqueue_style( 'db-front-styles', DB_CSS_DIR . '/frontend-style.css', false, '1.0', 'all' );
        }

        
    } // class end
    $scf_class_obj = new SCF_Class();
} // exists
