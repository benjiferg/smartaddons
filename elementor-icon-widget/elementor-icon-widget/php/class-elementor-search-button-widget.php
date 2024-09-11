<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Search_Button_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'search_button_widget';
    }

    public function get_title() {
        return esc_html__( 'Search Button', 'elementor-custom-widgets' );
    }

    public function get_icon() {
        return 'eicon-search';
    }

    public function get_categories() {
        return [ 'custom-widgets-category' ]; // Assign to the custom category
    }



    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'elementor-icon-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor-icon-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1f3864', // Default background color
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'elementor-icon-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF', // Default icon color
            ]
        );

        $this->add_control(
            'tooltip_text',
            [
                'label' => esc_html__( 'Tooltip Text', 'elementor-icon-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Search', 'elementor-icon-widget' ),
            ]
        );

        $this->add_control(
            'fallback_url',
            [
                'label' => esc_html__( 'Fallback URL', 'elementor-icon-widget' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://nursewellness.com/store/category-name', 'elementor-icon-widget' ),
                'show_external' => false,
                'default' => [
                    'url' => 'https://nursewellness.com/store/category-name',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'enable_tooltip',
            [
                'label' => esc_html__( 'Enable Tooltip', 'elementor-icon-widget' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'elementor-icon-widget' ),
                'label_off' => esc_html__( 'No', 'elementor-icon-widget' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Apply inline styles with proper escaping
        $button_style = sprintf('background-color: %s;', esc_attr( $settings['background_color'] ));
        $icon_style = sprintf('fill: %s;', esc_attr( $settings['icon_color'] ));

        // Determine if the tooltip should be displayed
        $tooltip_class = $settings['enable_tooltip'] === 'yes' ? 'dell-tooltip' : '';

        // Fallback URL
        $fallback_url = !empty($settings['fallback_url']['url']) ? esc_url( $settings['fallback_url']['url'] ) : 'https://nursewellness.com/store/category-name';

        ?>

        <button class="<?php echo esc_attr($tooltip_class); ?> dell-button" style="<?php echo $button_style; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="30" width="30" style="<?php echo $icon_style; ?>">
                <!-- SVG path data for the search icon -->
                <path d="M23.384 21.619l-5.754-5.754a9.395 9.395 0 002.177-5.992A9.45 9.45 0 0010.358.432a9.45 9.45 0 00-9.45 9.45 9.45 9.45 0 009.45 9.45 9.394 9.394 0 005.992-2.177l5.754 5.754a.807.807 0 001.142 0 .807.807 0 000-1.142zM10.358 17.345a7.464 7.464 0 01-7.463-7.463 7.464 7.464 0 017.463-7.463 7.464 7.464 0 017.463 7.463 7.464 7.464 0 01-7.463 7.463z"></path>
            </svg>
            <?php if ( 'yes' === $settings['enable_tooltip'] ) : ?>
                <span class="dell-tooltiptext"><?php echo esc_html( $settings['tooltip_text'] ); ?></span>
            <?php endif; ?>
        </button>

        <style>
            .dell-button {
                display: inline-flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border: 0px solid transparent;
                background-color: <?php echo esc_attr( $settings['background_color'] ); ?>;
                border-radius: 0.75em;
                transition: all 0.2s linear;
                padding-top: 7px;
                width: 50px;  /* Adjust width as needed */
                height: 50px;  /* Adjust height as needed */
            }

            .dell-button:hover {
                box-shadow: 3.4px 2.5px 4.9px rgba(0, 0, 0, 0.025),
                8.6px 6.3px 12.4px rgba(0, 0, 0, 0.035),
                17.5px 12.8px 25.3px rgba(0, 0, 0, 0.045),
                36.1px 26.3px 52.2px rgba(0, 0, 0, 0.055),
                99px 72px 143px rgba(0, 0, 0, 0.08);
            }

            .dell-tooltip {
                position: relative;
                display: inline-block;
            }

            .dell-tooltip .dell-tooltiptext {
                visibility: hidden;
                width: 4em;
                background-color: rgba(0, 0, 0, 0.253);
                color: #fff;
                text-align: center;
                border-radius: 6px;
                padding: 5px 0;
                position: absolute;
                z-index: 1;
                top: 25%;
                left: 110%;
            }

            .dell-tooltip .dell-tooltiptext::after {
                content: "";
                position: absolute;
                top: 50%;
                right: 100%;
                margin-top: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: transparent rgba(0, 0, 0, 0.253) transparent transparent;
            }

            .dell-tooltip:hover .dell-tooltiptext {
                visibility: visible;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const button = document.querySelector('.dell-button');  // Select the button

                button.addEventListener('click', function(event) {
                    event.preventDefault();  // Prevent the default button behavior

                    if (window.Ecwid) {
                        Ecwid.openPage('search');
                    } else {
                        // Fallback to the user-defined URL if Ecwid is not loaded
                        window.location.href = '<?php echo $fallback_url; ?>';
                    }
                });
            });
        </script>
        <?php
    }
}
?>