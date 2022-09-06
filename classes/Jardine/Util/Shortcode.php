<?php

namespace jardine\Util;

class Shortcode {
    private static $instance;

    public static function loadInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function __construct()
    {
        global $opt_settings;
        $GLOBALS['opt_settings'] = $opt_settings;

        $this->registerShortcodes();
    }

    public function registerShortcodes()
    {
        add_shortcode('social-media-icon', array($this, 'socialMediaShortcode'));

        add_shortcode('ize-location', array($this, 'locationContent'));
        add_shortcode('room-content', array($this, 'roomshortcodeContent'));
        add_shortcode('special-offer-content', array($this, 'specialOfferContent'));
        add_shortcode('related', array($this, 'relatedPostCarousel'));
        add_shortcode('booking-widget', array($this, 'bookingWidget'));
        add_shortcode('booking-header', array($this, 'bookingHeader'));
        add_shortcode('banner-image', array($this, 'bannerImage'));
        add_shortcode('copyright-text', array($this, 'copyrightText'));
        add_shortcode('developer-signature', array($this, 'developerSignature'));
        add_shortcode('location-address', array($this, 'locationAddress'));
        add_shortcode('phone-number', array($this, 'phoneNumber'));
        add_shortcode('company-name', array($this, 'companyName'));
        add_shortcode('email-address', array($this, 'emailAddress'));
        add_shortcode('contact-menu-list', array($this, 'contactMenuList'));
    }

    public function companyName()
    {
        return $GLOBALS['opt_settings']['opt-company-name'];
    }

    public function emailAddress()
    {
        return $GLOBALS['opt_settings']['opt-email'];
    }

    public function phoneNumber()
    {
        return $GLOBALS['opt_settings']['opt-phone'];
    }

    public function locationAddress()
    {
        return $GLOBALS['opt_settings']['opt-address'];
    }

    public function contactMenuList()
    {
        return $GLOBALS['opt_settings']['opt-menu-list'];
    }

    public function copyrightText()
    {
        $copyright_text = $GLOBALS['opt_settings']['opt-copyright-text'];
        if (strpos($copyright_text, '[current-year]') !== false) {
            $copyright_text = str_replace('[current-year]', date('Y'), $copyright_text );
        }
        return '<p class="copyright-text">'.$copyright_text.'</p>';
    }

    public function developerSignature()
    {
        if( is_front_page() ) {
            return '<p class="developer-signature">'.$GLOBALS['opt_settings']['opt-developer-signature'].'</p>';
        }

        return '';
    }

    public function bannerImage()
    {
        ob_start();
        get_template_part( 'inc/shortcode-template/shortcode', 'bannerimage' );
        return ob_get_clean();
    }

    public function bookingWidget()
    {
        ob_start();
        get_template_part( 'inc/shortcode-template/shortcode', 'booking-widget' );
        return ob_get_clean();
    }

    public function bookingHeader()
    {
        ob_start();
        get_template_part( 'inc/shortcode-template/shortcode', 'booking-header' );
        return ob_get_clean();
    }

    public function relatedPostCarousel()
    {
        ob_start();
        require get_template_directory() . '/inc/shortcode-template/shortcode-related.php';
        return ob_get_clean();
    }

    public function specialOfferContent()
    {
        ob_start();
        require get_template_directory() . '/inc/shortcode-template/shortcode-special-offer.php';
        return ob_get_clean();
    }

    public function roomshortcodeContent()
    {
        ob_start();
        require get_template_directory() . '/inc/shortcode-template/shortcode-listroom.php';
        return ob_get_clean();
    }

    public function locationContent()
    {
        ob_start();
        require get_template_directory() . '/inc/shortcode-template/shortcode-location.php';
        return ob_get_clean();
    }

    public function socialMediaShortcode()
    {
        ob_start();
        echo '<ul class="social-media-icon">';
        if($GLOBALS['opt_settings']['opt-enable-facebook'] == true &&  $GLOBALS['opt_settings']['opt-facebook-url'] !== ''){
            echo '<li class="facebook-icon"><a href="'.$GLOBALS['opt_settings']['opt-facebook-url'].'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
        }
        if($GLOBALS['opt_settings']['opt-enable-twitter'] == true &&  $GLOBALS['opt_settings']['opt-twitter-url'] !== ''){
            echo '<li class="twitter-icon"><a href="'.$GLOBALS['opt_settings']['opt-twitter-url'].'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
        }
        if($GLOBALS['opt_settings']['opt-enable-google-plus'] == true &&  $GLOBALS['opt_settings']['opt-google-plus-url'] !== ''){
            echo '<li class="google-plus-icon"><a href="'.$GLOBALS['opt_settings']['opt-google-plus-url'].'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
        }
        if($GLOBALS['opt_settings']['opt-enable-instagram'] == true &&  $GLOBALS['opt_settings']['opt-instagram-url'] !== ''){
            echo '<li class="instagram-icon"><a href="'.$GLOBALS['opt_settings']['opt-instagram-url'].'" target="_blank"><i class="fa fa-instagram"></i></a></li>';
        }
        if($GLOBALS['opt_settings']['opt-enable-youtube'] == true &&  $GLOBALS['opt_settings']['opt-youtube-url'] !== ''){
            echo '<li class="youtube-icon"><a href="'.$GLOBALS['opt_settings']['opt-youtube-url'].'" target="_blank"><i class="fa fa-youtube"></i></a></li>';
        }
        if($GLOBALS['opt_settings']['opt-enable-linkedin'] == true &&  $GLOBALS['opt_settings']['opt-linkedin-url'] !== ''){
            echo '<li class="linkedin-icon"><a href="'.$GLOBALS['opt_settings']['opt-linkedin-url'].'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
        }
        if($GLOBALS['opt_settings']['opt-enable-pinterest'] == true &&  $GLOBALS['opt_settings']['opt-pinterest-url'] !== ''){
            echo '<li class="pinterest-icon"><a href="'.$GLOBALS['opt_settings']['opt-pinterest-url'].'" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
        }
        echo '</ul>';

        return ob_get_clean();
    }
}