<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Superaddons_Elementor_Signature_Field extends \ElementorPro\Modules\Forms\Fields\Field_Base {
	private $fixed_files_indices = false;
	public function get_type() {
		return 'signature';
	}
	public function editor_preview_footer() {
		add_action( 'wp_footer', array($this,"signature_content_template_script"));
	}
	function signature_content_template_script(){
    ?>
    <script>
    jQuery( document ).ready( () => {
        elementor.hooks.addFilter(
            'elementor_pro/forms/content_template/field/signature',
            function ( inputField, item, i ) {
                return `<img src="<?php echo esc_url(SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_URL."lib/images/images.png") ?>" />`;
            }, 10, 3
        );
    });
    </script>
    <?php
}
	public function get_name() {
		return esc_html__( 'Signature', "signature-field-for-elementor-forms");
	}
	/**
	 * @param Widget_Base $widget
	 */
	public function update_controls( $widget ) {
		$check_pro = get_option( '_redmuber_item_1527');
		$elementor = \ElementorPro\Plugin::elementor();
		$control_data = $elementor->controls_manager->get_control_from_stack( $widget->get_unique_name(), 'form_fields' );
		if ( is_wp_error( $control_data ) ) {
			return;
		}
		if( $check_pro == "ok"){
			$field_controls = [
				'signature_width' => [
					'name' => 'signature_width',
					'label' => esc_html__( 'Width', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => '400',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( 'Width signature pad', "signature-field-for-elementor-forms"),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'signature_height' => [
					'name' => 'signature_height',
					'label' => esc_html__( 'Height', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => '200',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( 'Height signature pad', "signature-field-for-elementor-forms"),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'signature_background' => [
					'name' => 'signature_background',
					'label' => esc_html__( 'Background', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#ffffff',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( 'Background signature pad', "signature-field-for-elementor-forms"),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'signature_color' => [
					'name' => 'signature_color',
					'label' => esc_html__( 'Color', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#000000',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( 'Color signature', "signature-field-for-elementor-forms"),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'signature_fullname' => [
					'name' => 'signature_fullname',
					'label' => esc_html__( 'Enter Full Name', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( 'Customer enters Name', "signature-field-for-elementor-forms"),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'signature_fullname_text' => [
					'name' => 'signature_fullname_text',
					'label' => esc_html__( 'Text Enter Full Name', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'Enter Full Name',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
			];
		}else {
			$field_controls = [
				'signature_width' => [
					'name' => 'signature_width',
					'label' => esc_html__( 'Width', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => '400',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( 'Width signature pad', "signature-field-for-elementor-forms"),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'signature_height' => [
					'name' => 'signature_height',
					'label' => esc_html__( 'Height', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => '200',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( 'Height signature pad', "signature-field-for-elementor-forms"),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'signature_background_pro' => [
					'name' => 'signature_background_pro',
					'label' => esc_html__( 'Background', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Background signature pad ( Default = white Upgrade to pro to change it )', "signature-field-for-elementor-forms" ),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'signature_color_pro' => [
					'name' => 'signature_color_pro',
					'label' => esc_html__( 'Color', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Pen color ( Default = black Upgrade to pro to change it )', "signature-field-for-elementor-forms" ),
					'default' => '#000000',
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( 'Color signature', "signature-field-for-elementor-forms"),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'signature_fullname_pro' => [
					'name' => 'signature_fullname_pro',
					'label' => esc_html__( 'Enter Full Name', "signature-field-for-elementor-forms"),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Customer enters Name ( Upgrade to pro to enable )', "signature-field-for-elementor-forms" ),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
			];
		}
		$control_data['fields'] = $this->inject_field_controls( $control_data['fields'], $field_controls );
		$widget->update_control( 'form_fields', $control_data );
	}
	/**
	 * @param      $item
	 * @param      $item_index
	 * @param Form $form
	 */
	public function render( $item, $item_index, $form ) {	
		$form->add_render_attribute( 'input' . $item_index, 'class', 'elementor-upload-field-signature' );
		$form->add_render_attribute( 'input' . $item_index, 'type', 'hidden', true );		
		$background   = ! empty( $item['signature_background'] ) ? $item['signature_background'] : '#ffffff';
		$color   = ! empty( $item['signature_color'] ) ? $item['signature_color'] : '#000000';
		$width = ! empty( $item['signature_width'] ) ? $item['signature_width'] : '400';
		$height = ! empty( $item['signature_height'] ) ? $item['signature_height'] : '200';
		$text = ! empty( $item['signature_fullname_text'] ) ? $item['signature_fullname_text'] : __( 'Enter Full Name', 'signature-field-for-elementor-forms' );
		$data_attr="";
		$data_attr .= ' data-id="'.$item["custom_id"].'"';
		$data_attr .= ' data-background="'.$background.'"';
		$data_attr .= ' data-color="'.$color.'"';
		$data_attr .= ' data-width="'.$width.'"';
		$data_attr .= ' data-height="'.$height.'"';
		if ( ! empty( $item['signature_fullname'] ) ) {
			$html_name = sprintf("<input type='text' placeholder='%s' style='max-width: %spx; width:%s;' class='elementor_signature_name' />",esc_html($text),esc_attr($width),"100%");
			$data_attr .= ' data-name="1"';
		}else{
			$html_name ="";
			$data_attr .= ' data-name="0"';
		}
		$html_clear ="<div class='elementor_signature_clear'><img src='".SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_URL."lib/images/remove-icon.png' alt='' /></div>";
		$html_container = sprintf("<div class='elementor-signature-container' style='width: %spx' >%s<div class='elementor-signature-field' %s style='width:%spx; height: %spx; background: %s'></div></div>",$width,$html_clear, $data_attr,$width,$height,$background );
		$input = sprintf(
			'<input style="display: none;" type="text" %s>',
			$form->get_render_attribute_string('input' . $item_index )
		); 
		printf( "<div class='width-100'>%s %s %s</div>", $html_container,$html_name,$input); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	/**
	 * process file and move it to uploads directory
	 *
	 * @param array                $field
	 * @param Classes\Form_Record  $record
	 * @param Classes\Ajax_Handler $ajax_handler
	 */
	public function process_field( $field, $record, $ajax_handler) {
		$id = $field['id'];
		$value                = $field["raw_value"];
		$uploads              = wp_upload_dir();
		$form_directory       = absint( $form_data['id'] ) . '-' . md5( $form_data['id'] . $form_data['created'] );
		$elementor_uploads_root = trailingslashit( $uploads['basedir'] ) . 'elementor/signature';
		$elementor_uploads_form = trailingslashit( $elementor_uploads_root ) . $form_directory;
		$file_name            = sanitize_file_name( 'signature-' . uniqid() . '.png' );
		$file_upload             = trailingslashit( $elementor_uploads_form ) . $file_name;
		$file_url             = trailingslashit( $uploads['baseurl'] ) . 'elementor/signature/' . trailingslashit( $form_directory ) . $file_name;
		if ( ! empty( $value ) && substr( $value, 0, 22 ) === 'data:image/png;base64,' ) {
			if ( ! file_exists( $elementor_uploads_form ) ) {
				wp_mkdir_p( $elementor_uploads_form );
			}
			$data = base64_decode( preg_replace( '#^data:image/\w+;base64,#i', '', $value ) );
			$save = file_put_contents( $file_upload, $data );
			if ( false === $save ) {
			} else {
				$value = $file_url;
				$record->add_file( $id, $index,
						[
							'path' => $file_upload,
							'url' => $value,
						]);
			}
		} else {
			$value = '';
		}
	}
	/**
	 * Used to set the upload filed values with
	 * value => file url
	 * raw_value => file path
	 *
	 * @param Classes\Form_Record  $record
	 * @param Classes\Ajax_Handler $ajax_handler
	 */
	public function set_file_fields_values(  $record,  $ajax_handler ) {
		$files = $record->get( 'files' );
		if ( empty( $files ) ) {
			return;
		}
		foreach ( $files as $id => $files_array ) {
			$record->update_field( $id, 'value', implode( ' , ', $files_array['url'] ) );
			$record->update_field( $id, 'raw_value', implode( ' , ', $files_array['path'] ) );
		}
	}
	public function __construct() {
		parent::__construct();
		add_action( 'elementor_pro/forms/process', [ $this, 'set_file_fields_values' ], 10, 2 );
		add_action("wp_enqueue_scripts",array($this,"add_lib"),1000);
		add_action( 'elementor/preview/init', array( $this, 'editor_preview_footer' ) );
	}
	function add_lib(){
		wp_enqueue_script("elementor_signature_lib",SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_URL."lib/js/jquery.signature.js",array('jquery',"jquery-ui-core","jquery-ui-widget","jquery-ui-mouse"));
		wp_enqueue_script("jquery-ui-touch-punch",SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_URL."lib/js/jquery.ui.touch-punch.min.js",array('jquery',"jquery-ui-core","jquery-ui-widget","jquery-ui-mouse"));
		wp_enqueue_script("elementor_signature",SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_URL."lib/js/signature.js",array("jquery","elementor_signature_lib"),time());
		wp_enqueue_style("elementor_signature",SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_URL."lib/css/jquery.signature.css",array( ));
	}
}