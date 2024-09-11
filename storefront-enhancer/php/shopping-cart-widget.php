<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Shopping_Cart_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'shopping_cart_widget';
    }

    public function get_title() {
        return esc_html__( 'Shopping Cart', 'storefront-enhancer' );
    }

    public function get_icon() {
        return 'eicon-cart';
    }

    public function get_categories() {
        return [ 'custom-widgets-category' ]; // Assign to the custom category
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
                'default' => '#1f3864', // Default background color
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'storefront-enhancer' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF', // Default icon color
            ]
        );

        $this->add_control(
            'tooltip_text',
            [
                'label' => esc_html__( 'Tooltip Text', 'storefront-enhancer' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Cart', 'storefront-enhancer' ),
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

        // Apply inline styles with proper escaping
        $button_style = sprintf('background-color: %s;', esc_attr( $settings['background_color'] ));
        $icon_style = sprintf('fill: %s;', esc_attr( $settings['icon_color'] ));

        // Determine if the tooltip should be displayed
        $tooltip_class = $settings['enable_tooltip'] === 'yes' ? 'albert-tooltip' : '';

        // Fallback URL with escaping
        $fallback_url = !empty($settings['fallback_url']['url']) ? esc_url( $settings['fallback_url']['url'] ) : esc_url(' ');

        ?>

        <button class="<?php echo esc_attr($tooltip_class); ?> albert-button" style="<?php echo esc_attr($button_style); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" height="35" width="35" id="cart" style="<?php echo esc_attr($icon_style); ?>">
                <!-- SVG path data for the cart icon -->
                <path d="M27.47,23.93H14.92A5.09,5.09,0,0,1,10,20L8,11.87a5.11,5.11,0,0,1,5-6.32h16.5a5.11,5.11,0,0,1,5,6.32l-2,8.15A5.1,5.1,0,0,1,27.47,23.93ZM12.94,8.05a2.62,2.62,0,0,0-2.54,3.23l2,8.15a2.6,2.6,0,0,0,2.54,2H27.47a2.6,2.6,0,0,0,2.54-2l2-8.15a2.61,2.61,0,0,0-2.54-3.23Z"></path>
                <path d="M9.46 14a1.25 1.25 0 0 1-1.21-1L6.46 5.23A3.21 3.21 0 0 0 3.32 2.75H1.69a1.25 1.25 0 0 1 0-2.5H3.32A5.71 5.71 0 0 1 8.9 4.66l1.78 7.77a1.24 1.24 0 0 1-.93 1.5A1.43 1.43 0 0 1 9.46 14zM15.11 34.75a4 4 0 1 1 4-4A4 4 0 0 1 15.11 34.75zm0-5.54a1.52 1.52 0 1 0 1.52 1.52A1.52 1.52 0 0 0 15.11 29.21zM28.93 34.75a4 4 0 1 1 4-4A4 4 0 0 1 28.93 34.75zm0-5.54a1.52 1.52 0 1 0 1.53 1.52A1.52 1.52 0 0 0 28.93 29.21z"></path>
                <path d="M28.93,29.21H12.27a3.89,3.89,0,1,1,0-7.78h2.65a1.25,1.25,0,1,1,0,2.5H12.27a1.39,1.39,0,1,0,0,2.78H28.93a1.25,1.25,0,0,1,0,2.5Z"></path>
            </svg>
            <?php if ( 'yes' === $settings['enable_tooltip'] ) : ?>
                <span class="albert-tooltiptext"><?php echo esc_html( $settings['tooltip_text'] ); ?></span>
            <?php endif; ?>
            <span class="cart-counter1" style="background-color: #c6223a; color: #fff;">0</span>
        </button>

        <style>
            .albert-button {
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
                position: relative; /* To position the cart counter */
            }

            .albert-button:hover {
                box-shadow: 3.4px 2.5px 4.9px rgba(0, 0, 0, 0.025),
                8.6px 6.3px 12.4px rgba(0, 0, 0, 0.035),
                17.5px 12.8px 25.3px rgba(0, 0, 0, 0.045),
                36.1px 26.3px 52.2px rgba(0, 0, 0, 0.055),
                99px 72px 143px rgba(0, 0, 0, 0.08);
            }

            .albert-tooltip {
                position: relative;
                display: inline-block;
            }

            .albert-tooltip .albert-tooltiptext {
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

            .albert-tooltip .albert-tooltiptext::after {
                content: "";
                position: absolute;
                top: 50%;
                right: 100%;
                margin-top: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: transparent rgba(0, 0, 0, 0.253) transparent transparent;
            }

            .albert-tooltip:hover .albert-tooltiptext {
                visibility: visible;
            }

            .cart-counter1 {
                position: absolute;
                top: -5px;  /* Adjust as needed */
                right: -5px;  /* Adjust as needed */
                background-color: #c6223a;
                color: #fff;
                border-radius: 50%;
                padding: 2px 5px;
                font-size: 12px;
                line-height: 1;
                min-width: 20px;
                height: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: Poppins, sans-serif;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const button = document.querySelector('.albert-button');  // Select the button

                button.addEventListener('click', function(event) {
                    event.preventDefault();  // Prevent the default button behavior

                    if (window.Ecwid) {
                        Ecwid.openPage('cart');
                    } else {
                        // Fallback to the user-defined URL if Ecwid is not loaded
                        window.location.href = '<?php echo esc_url($fallback_url); ?>';
                    }
                });

                var totalItemsAdded = 0; // Counter variable to track total items added

                // Function to be executed when Ecwid API is loaded
                Ecwid.OnAPILoaded.add(function() {
                    // Function to display initial cart quantity
                    Ecwid.Cart.get(function(cart) {
                        totalItemsAdded = cart.productsQuantity; // Update totalItemsAdded initially
                        updateCartCounter(totalItemsAdded); // Update the cart counter display
                    });

                    // Function to be executed when a new product is added to or removed from the cart
                    Ecwid.OnCartChanged.add(function(cart) {
                        if (cart && cart.items && Array.isArray(cart.items)) {
                            var itemsCount = cart.items.reduce((total, item) => total + item.quantity, 0);
                            totalItemsAdded = itemsCount; // Update totalItemsAdded with the current count
                            updateCartCounter(totalItemsAdded); // Update the cart counter display
                        }
                    });
                });

                // Function to update the cart counter display
                function updateCartCounter(count) {
                    var counterElement = document.querySelector('.cart-counter1');
                    if (counterElement) {
                        counterElement.textContent = count;
                    }
                }
            });
        </script>
        <?php
    }
}
?>
