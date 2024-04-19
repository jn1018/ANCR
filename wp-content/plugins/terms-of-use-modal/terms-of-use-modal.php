<?php
/**
 * Plugin Name: Terms of Use Modal
 * Plugin URI: https://www.iccsafe.org/
 * Description: Plugin to Handle Terms of Use Modal in all Websites
 * Author: ICC
 * Author URI: https://www.iccsafe.org/
 * Version: 1.0
 * */
 
    /**
     * Activate the plugin.
    */
    
    add_action('admin_menu', 'terms_of_use_model_options_page');
    add_action( 'wp_footer', 'term_cookie_popup_model_content' );
    register_deactivation_hook( __FILE__, 'plugin_function_to_run_deactive_plugin' );

    /**
     * backfill the str_contains function
     */
    if (!function_exists('str_contains')) {
        function str_contains($haystack, $needle)
        {
            return $needle !== '' && mb_strpos($haystack, $needle) !== false;
        }
    }

    /**
     * Function for register menu.
    */
    function terms_of_use_model_options_page() {
        add_submenu_page(
            'themes.php',
            'Terms of Use Modal',
            'Terms of Use Modal',
            'manage_options',
            'terms_of_use_model_options',
            'terms_of_use_model_options_callback' );
        default_term_cookie_values();

    
    }
    
    /**
     * Function for load Terms Cookie setting form .
    */
    function terms_of_use_model_options_callback() {
        
        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
            echo '<h2>Terms of Use Modal And Cookie Settings</h2>';
        echo '</div>';

        $message = '';
        if ( isset( $_POST['terms_setting_save'] ) ) { 
            $update = update_term_cookie_settings();
            $message = 'Cookie Settings Updated successfully';
        }

        include plugin_dir_path( __FILE__ ) . 'options.php';
    }
    
    /**
     * Function for update Terms Cookie setting form value .
    */
    function update_term_cookie_settings(){
   
      $cookie_expiration_date = (!empty($_POST['cookie_expiration_date'])) ? $_POST['cookie_expiration_date']: '2023-01-15';
      $cookie_domain = (!empty($_POST['cookie_domain'])) ? $_POST['cookie_domain']: '';
      $effective_date = (!empty($_POST['effective_date'])) ? $_POST['effective_date']: 'January 1, 2023';
      $link_url = (!empty($_POST['link_url'])) ? $_POST['link_url']: 'https://www.iccsafe.org/about/terms-of-use/';
      update_option('cookie_expiration_date',$cookie_expiration_date);
      update_option('cookie_domain',$cookie_domain);
      update_option('effective_date',$effective_date);
      update_option('link_url',$link_url);
    }

    /**
     * Function for dafault Terms Cookie setting form value .
    */
    function default_term_cookie_values(){
        
        $cookie_domain = '';
        
        if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') { // is localhost
            $cookie_domain ='';
        } else {
            if (str_contains($_SERVER['SERVER_NAME'], 'iccsafe')) {
                $cookie_domain = '.iccsafe.org';
            }
        }

        $cookie_expiration_date = get_option( 'cookie_expiration_date','2023-01-15');
        $cookie_domain = get_option( 'cookie_domain',$cookie_domain );
        $effective_date = get_option( 'effective_date','January 1, 2023');
        $link_url = get_option( 'link_url','https://www.iccsafe.org/about/terms-of-use/' );
        
        update_option('cookie_expiration_date',$cookie_expiration_date);
        update_option('cookie_domain',$cookie_domain);
        update_option('effective_date',$effective_date);
        update_option('link_url',$link_url);
    }

    /**
     * Function for load cookie model popup .
    */
    function term_cookie_popup_model_content(){
      
      include plugin_dir_path( __FILE__ ) . 'template/termcookie-popup.php';

    }
    
    /**
     * Function for delete default value plugin deactivation.
    */
    function plugin_function_to_run_deactive_plugin(){
        delete_option('cookie_expiration_date');
        delete_option('cookie_domain');
        delete_option('effective_date');
        delete_option('link_url');
    }