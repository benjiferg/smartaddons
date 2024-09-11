<?php

class Category_Button_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'category_button';
    }

    public function get_title() {
        return __( 'Custom Ecwid Category Button', 'elementor-custom-widgets' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'custom-widgets-category' ];
    }

    protected function _register_controls() {
        // Content controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'elementor-custom-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'elementor-custom-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Click Me', 'elementor-custom-widgets' ),
                'placeholder' => __( 'Enter button text', 'elementor-custom-widgets' ),
            ]
        );

        $this->add_control(
            'category_id',
            [
                'label' => __( 'Category ID', 'elementor-custom-widgets' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
                'placeholder' => __( 'Enter category ID', 'elementor-custom-widgets' ),
            ]
        );

        $this->end_controls_section();

        // Style controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Button', 'elementor-custom-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Normal & Hover state toggle
        $this->start_controls_tabs( 'button_tabs' );

        // Normal state
        $this->start_controls_tab(
            'tab_normal',
            [
                'label' => __( 'Normal', 'elementor-custom-widgets' ),
            ]
        );

        // Normal text color
        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'elementor-custom-widgets' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-ecwid-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Typography for Normal state
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => __( 'Typography', 'elementor-custom-widgets' ),
                'selector' => '{{WRAPPER}} .custom-ecwid-button',
            ]
        );

        // Normal background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'elementor-custom-widgets' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .custom-ecwid-button',
            ]
        );

        // Normal Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', 'elementor-custom-widgets' ),
                'selector' => '{{WRAPPER}} .custom-ecwid-button',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'elementor-custom-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .custom-ecwid-button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => __( 'Padding', 'elementor-custom-widgets' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .custom-ecwid-button' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        // Normal box shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( 'Box Shadow', 'elementor-custom-widgets' ),
                'selector' => '{{WRAPPER}} .custom-ecwid-button',
            ]
        );

        $this->end_controls_tab();

        // Hover state
        $this->start_controls_tab(
            'tab_hover',
            [
                'label' => __( 'Hover', 'elementor-custom-widgets' ),
            ]
        );

        // Hover text color
        $this->add_control(
            'hover_text_color',
            [
                'label' => __( 'Hover Text Color', 'elementor-custom-widgets' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-ecwid-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Hover background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hover_background',
                'label' => __( 'Hover Background', 'elementor-custom-widgets' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .custom-ecwid-button:hover',
            ]
        );

        // Hover border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hover_border',
                'label' => __( 'Hover Border', 'elementor-custom-widgets' ),
                'selector' => '{{WRAPPER}} .custom-ecwid-button:hover',
            ]
        );

        // Hover box shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_box_shadow',
                'label' => __( 'Hover Box Shadow', 'elementor-custom-widgets' ),
                'selector' => '{{WRAPPER}} .custom-ecwid-button:hover',
            ]
        );

        // Transition Duration
        $this->add_control(
            'transition_duration',
            [
                'label' => __( 'Transition Duration', 'elementor-custom-widgets' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-ecwid-button' => 'transition-duration: {{SIZE}}s;',
                ],
            ]
        );

        // Hover Animation
        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', 'elementor-custom-widgets' ),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $category_id = $settings['category_id'];
        $button_text = $settings['button_text'];

        // Add hover animation class
        $this->add_render_attribute( 'button', 'class', 'custom-ecwid-button' );
        $this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );

        // Output the button with hover animation class
        echo '<button ' . $this->get_render_attribute_string( 'button' ) . ' data-category-id="' . esc_attr( $category_id ) . '">' . esc_html( $button_text ) . '</button>';

        // Inline JavaScript
        ?>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(document).on('click', '.custom-ecwid-button', function() {
                var categoryId = $(this).data('category-id');
                if (categoryId) {
                    setTimeout(function() {
                        Ecwid.openPage('category', { id: categoryId });
                    }, 0);
                }
            });
        });
        </script>
        <?php
    }

    protected function _content_template() {
        ?>
        <# 
        var category_id = settings.category_id;
        var button_text = settings.button_text;
        #>
        <button class="custom-ecwid-button elementor-animation-{{ settings.hover_animation }}" data-category-id="{{ category_id }}">{{ button_text }}</button>
        <?php
    }
}