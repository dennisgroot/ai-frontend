<?php
    if ( is_blog_installed() ) {
        if ( in_array( 'sitepress-multilingual-cms/sitepress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            function raadhuis_lang_switcher(){
                $languages = apply_filters( 'wpml_active_languages', NULL, 'skip_missing=1&orderby=code' ); 

                if( !empty( $languages ) ){

                    echo '<ul class="nav__languages" role="menu">';
                        foreach( $languages as $lang ){
                            $url = $lang['url'];
                            $code = $lang['code'];
                            $class = '';
                            if($lang['active']) {
                                $class .= 'active';
                            }
                            else {
                                $class .= null;
                            }

                            echo '<li role="menuitem" lang="'.$code.'" class="'.$class.'">';
                                echo '<a href="'.$url.'" lang="'.$code.'" hreflang="'.$code.'" role="menuitem">';
                                    echo '<img src="'.get_stylesheet_directory_uri().'/dist/assets/img/language-'.$code.'.svg" alt="'.$code.'">';
                                echo '</a>';
                            echo '</li>';               
                            
                        }

                    echo '</ul>';
                }
            }

            // WPML - Add language class to body element
            function append_language_class($classes) {
                $classes[] = 'lang-' . ICL_LANGUAGE_CODE;
                return $classes;
            }
            add_filter('body_class', 'append_language_class');
        }
    }
?>