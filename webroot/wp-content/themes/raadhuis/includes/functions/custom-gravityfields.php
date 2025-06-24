<?php

if ( class_exists( 'GFCommon' ) ) {


    /**
     * custom saving JSON for Gravity Forms
     * installereen hiervoor ook Power Boost for Gravity Forms ( Breakfast Co.)
     */
    
     function custom_power_boost_json_save_path( ) {
        // Definieer hier je aangepaste pad voor de opgeslagen JSON-bestanden
        // maak ook de folder aan (gf-json)
        $custom_path = get_template_directory().'/gf-json/';
    
        // Retourneer de aangepaste opslagpad
        return $custom_path;
    }
    // add_filter( 'gravityforms_local_json_save_path', 'custom_power_boost_json_save_path', 10 );


    //custom big radio block (example: yes or no)
    class GF_Field_BigRadio extends GF_Field_Radio {
    
        public $type = 'BigRadio';

        public function get_form_editor_field_title() {
            return esc_attr__( 'Enkele keuze (radio button)', 'raadhuis' );
        }

        public function add_button( $field_groups ) {
            $field_groups = $this->maybe_add_field_group( $field_groups );
         
            return parent::add_button( $field_groups );
        }

        public function maybe_add_field_group( $field_groups ) {
            foreach ( $field_groups as $field_group ) {
                if ( $field_group['name'] == 'rh_custom_blocks' ) {
         
                    return $field_groups;
                }
            }
         
            $field_groups[] = array(
                'name'   => 'rh_custom_blocks',
                'label'  => __( 'Raadhuis', 'raadhuis' ),
                'fields' => array()
            );
         
            return $field_groups;
        }

        public function get_form_editor_button() { // added button to editor
            return array(
                'group' => 'rh_custom_blocks',
                'text'  => $this->get_form_editor_field_title()
            );
        }

        //prefill choices
        public $choices = [
			[ 'text' => 'Ja', 'value' => 'ja' ],
			[ 'text' => 'Nee', 'value' => 'nee' ],
		];

        public $cssClass = 'fullwidth-true-false';
    
        public function is_conditional_logic_supported() {
            return true;
        }

        public function get_form_editor_field_settings() {
			return [
                'label_setting',
				'admin_label_setting',
				'choices_setting',
				'description_setting',
				'rules_setting',
				'error_message_setting',
				'conditional_logic_field_setting',
                'duplicate_setting',
			];
		}
    }

    //custom error block
    class GF_Field_CustomError extends GF_Field_HTML {
    
        public $type = 'CustomError';

        public function get_form_editor_field_title() {
            return esc_attr__( 'Validatiemelding', 'raadhuis' );
        }

        public function get_form_editor_field_description() {
            return esc_attr__( 'Hiermee kun je een eigen validatiemelding toevoegen op het formulier.', 'raadhuis' );
        }

        public function add_button( $field_groups ) {
            $field_groups = $this->maybe_add_field_group( $field_groups );
         
            return parent::add_button( $field_groups );
        }

        public function maybe_add_field_group( $field_groups ) {
            foreach ( $field_groups as $field_group ) {
                if ( $field_group['name'] == 'rh_custom_blocks' ) {
         
                    return $field_groups;
                }
            }
         
            $field_groups[] = array(
                'name'   => 'rh_custom_blocks',
                'label'  => __( 'Raadhuis', 'raadhuis' ),
                'fields' => array()
            );
         
            return $field_groups;
        }

        public function get_form_editor_button() {
            return array(
                'group' => 'rh_custom_blocks',
                'text'  => $this->get_form_editor_field_title()
            );
        }
    
        public function is_conditional_logic_supported() {
            return true;
        }

        public $cssClass = 'error'; //prefil css
    
    }


    // register fields
    GF_Fields::register( new GF_Field_BigRadio() );
    GF_Fields::register( new GF_Field_CustomError() );
}
?>
