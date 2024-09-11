<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Account_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'account_widget';
    }

    public function get_title() {
        return esc_html__( 'Ecwid Account Button', 'storefront-enhancer' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'custom-widgets-category' ]; // Custom category for your widgets
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'storefront-enhancer' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background Color', 'storefront-enhancer' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1f3864',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'storefront-enhancer' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
            ]
        );

        $this->add_control(
            'tooltip_text',
            [
                'label' => esc_html__( 'Tooltip Text', 'storefront-enhancer' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Account', 'storefront-enhancer' ),
            ]
        );

        $this->add_control(
            'fallback_url',
            [
                'label' => esc_html__( 'Fallback URL', 'storefront-enhancer' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( ' ', 'storefront-enhancer' ),
                'default' => [
                    'url' => ' ',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'enable_tooltip',
            [
                'label' => esc_html__( 'Enable Tooltip', 'storefront-enhancer' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'storefront-enhancer' ),
                'label_off' => esc_html__( 'No', 'storefront-enhancer' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Escape output
        $button_style = sprintf('background-color: %s;', esc_attr( $settings['background_color'] ));
        $icon_style = sprintf('fill: %s;', esc_attr( $settings['icon_color'] ));
        $tooltip_class = $settings['enable_tooltip'] === 'yes' ? 'vegetable-tooltip' : '';

        $fallback_url = !empty($settings['fallback_url']['url']) ? esc_url( $settings['fallback_url']['url'] ) : esc_url( ' ' );

        ?>
        <button class="<?php echo esc_attr($tooltip_class); ?> vegetable-button" style="<?php echo esc_attr($button_style); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" height="40" width="40" style="<?php echo esc_attr($icon_style); ?>">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
            </svg>
            <?php if ( 'yes' === $settings['enable_tooltip'] ) : ?>
                <span class="vegetable-tooltiptext"><?php echo esc_html( $settings['tooltip_text'] ); ?></span>
            <?php endif; ?>
        </button>

        <style>
            .vegetable-button {
                display: inline-flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: em;
                border: 0px solid transparent;
                background-color: <?php echo esc_attr( $settings['background_color'] ); ?>;
                border-radius: .75em;
                transition: all 0.2s linear;
                width: 50px;
                height: 50px;
            }

            .vegetable-button:hover {
                box-shadow: 3.4px 2.5px 4.9px rgba(0, 0, 0, 0.025),
                8.6px 6.3px 12.4px rgba(0, 0, 0, 0.035),
                17.5px 12.8px 25.3px rgba(0, 0, 0, 0.045),
                36.1px 26.3px 52.2px rgba(0, 0, 0, 0.055),
                99px 72px 143px rgba(0, 0, 0, 0.08);
            }

            .vegetable-tooltip {
                position: relative;
                display: inline-block;
            }

            .vegetable-tooltip .vegetable-tooltiptext {
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

            .vegetable-tooltip .vegetable-tooltiptext::after {
                content: "";
                position: absolute;
                top: 50%;
                right: 100%;
                margin-top: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: transparent rgba(0, 0, 0, 0.253) transparent transparent;
            }

            .vegetable-tooltip:hover .vegetable-tooltiptext {
                visibility: visible;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const button = document.querySelector('.vegetable-button');
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    if (window.Ecwid) {
                        Ecwid.openPage('account');
                    } else {
                        window.location.href = '<?php echo esc_url($fallback_url); ?>';
                    }
                });
            });
        </script>
        <?php
    }
}
?>
