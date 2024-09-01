<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Icon_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom_icon_widget';
    }

    public function get_title() {
        return esc_html__( 'Custom Icon', 'elementor-custom-widgets' );
    }

    public function get_icon() {
        return 'eicon-star';
    }

    public function get_categories() {
        return [ 'custom-widgets-category' ]; // Assign to the custom category
    }

    // Rest of the widget code...



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
                'default' => esc_html__( 'Tooltip', 'elementor-icon-widget' ),
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
        $tooltip_class = $settings['enable_tooltip'] === 'yes' ? 'owen-tooltip' : '';

        // Fallback URL
        $fallback_url = !empty($settings['fallback_url']['url']) ? esc_url( $settings['fallback_url']['url'] ) : 'https://nursewellness.com/store/category-name';

        ?>

        <button class="<?php echo esc_attr($tooltip_class); ?> owen-button" style="<?php echo $button_style; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" id="home" style="<?php echo $icon_style; ?>">
                <path d="M6.64373233,18.7821107 L6.64373233,15.7152449 C6.64371685,14.9380902 7.27567036,14.3067075 8.05843544,14.3018198 L10.9326107,14.3018198 C11.7188748,14.3018198 12.3562677,14.9346318 12.3562677,15.7152449 L12.3562677,15.7152449 L12.3562677,18.7732212 C12.3562498,19.4472781 12.9040221,19.995083 13.5829406,20 L15.5438266,20 C16.4596364,20.0023291 17.3387522,19.6427941 17.9871692,19.0007051 C18.6355861,18.3586161 19,17.4867541 19,16.5775231 L19,7.86584638 C19,7.13138763 18.6720694,6.43471253 18.1046183,5.96350064 L11.4429783,0.674268354 C10.2785132,-0.250877524 8.61537279,-0.22099178 7.48539114,0.745384082 C7.48539114,0.745384082 0.967012253,5.96350064 0.967012253,5.96350064 C0.37274068,6.42082162 0.0175522924,7.11956262 0,7.86584638 L0,16.5686336 C0,18.463707 1.54738155,20 3.45617342,20 L5.37229029,20 C5.69917279,20.0023364 6.01348703,19.8750734 6.24547302,19.6464237 C6.477459,19.417774 6.60792577,19.1066525 6.60791706,18.7821107 L6.64373233,18.7821107 Z" transform="translate(2.5 2)"></path>
            </svg>
            <?php if ( 'yes' === $settings['enable_tooltip'] ) : ?>
                <span class="owen-tooltiptext"><?php echo esc_html( $settings['tooltip_text'] ); ?></span>
            <?php endif; ?>
        </button>

        <style>
            .owen-button {
                display: inline-flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border: 0px solid transparent;
                background-color: <?php echo esc_attr( $settings['background_color'] ); ?>;
                border-radius: 0.75em;
                transition: all 0.2s linear;
                width: 50px;  /* Adjust width as needed */
                height: 50px;  /* Adjust height as needed */
                padding-top: 5px;
                position: relative; /* To position the tooltip */
            }

            .owen-button:hover {
                box-shadow: 3.4px 2.5px 4.9px rgba(0, 0, 0, 0.025),
                8.6px 6.3px 12.4px rgba(0, 0, 0, 0.035),
                17.5px 12.8px 25.3px rgba(0, 0, 0, 0.045),
                36.1px 26.3px 52.2px rgba(0, 0, 0, 0.055),
                99px 72px 143px rgba(0, 0, 0, 0.08);
            }

            .owen-tooltip {
                position: relative;
                display: inline-block;
            }

            .owen-tooltip .owen-tooltiptext {
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

            .owen-tooltip .owen-tooltiptext::after {
                content: "";
                position: absolute;
                top: 50%;
                right: 100%;
                margin-top: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: transparent rgba(0, 0, 0, 0.253) transparent transparent;
            }

            .owen-tooltip:hover .owen-tooltiptext {
                visibility: visible;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const button = document.querySelector('.owen-button');  // Select the button

                button.addEventListener('click', function(event) {
                    event.preventDefault();  // Prevent the default button behavior

                    if (window.Ecwid) {
                        // Open the desired Ecwid page (e.g., home category page)
                        Ecwid.openPage('category');
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