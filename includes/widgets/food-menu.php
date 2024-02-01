<?php
class Widget_1 extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'sd-food-menu';
    }

    public function get_title()
    {
        return esc_html__('Food Menu');
    }

    public function get_icon()
    {
        return 'eicon-bullet-list';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['elementor', 'menu', 'food', 'sd'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'sd_food_menu_item_start',
            [
                'label' => esc_html__('Food Menu', 'sd-food-menu'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sd_food_menu_title',
            [
                'label' => esc_html__('Food Menu Title', 'sd-food-menu'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Palestinsk Cuisine', 'sd-food-menu'),
                'label_block' => true,
                'separator' => 'after'
            ]
        );

        $sd_menu_reps = new \Elementor\Repeater();

        $sd_menu_reps->add_control(
            'sd_food_menu_item_title',
            [
                'label' => esc_html__('Menu Item Title', 'sd-food-menu'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('List Title', 'sd-food-menu'),
                'label_block' => true,
            ]
        );

        $sd_menu_reps->add_control(
            'sd_food_menu_item_desc',
            [
                'label' => esc_html__('Menu Item Description', 'sd-food-menu'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('aving good restaurant reviews is crucial these day', 'sd-food-menu'),
                'separator' => 'before'
            ]
        );

        $sd_menu_reps->add_control(
            'sd_food_menu_item_img',
            [
                'label' => esc_html__('Choose Menu Image', 'sd-food-menu'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'sd_food_menu_item_list',
            [
                'label' => esc_html__('Food Menu List', 'sd-food-menu'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $sd_menu_reps->get_controls(),
                'default' => [
                    [
                        'sd_food_menu_item_title' => esc_html__('Menu Item Title', 'sd-food-menu'),
                    ]
                ],
                'title_field' => '{{{ sd_food_menu_item_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sd_food_menu_item_style_start',
            [
                'label' => esc_html__('Food Menu Style', 'sd-food-menu'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sd_food_menu_title_color',
            [
                'label' => esc_html__('Food Menu Title Color', 'sd-food-menu'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .foods .section-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sd_food_menu_title_typo',
                'selector' => '{{WRAPPER}} .foods .section-heading',
            ]
        );

        $this->add_control(
            'sd_food_menu_item_title_color',
            [
                'label' => esc_html__('Menu Item Title Color', 'sd-food-menu'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .foods .content h3' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sd_food_menu_item_title_type',
                'selector' => '{{WRAPPER}} .foods .content h3',
            ]
        );

        $this->add_control(
            'sd_food_menu_item_desc_color',
            [
                'label' => esc_html__('Menu Item Description Color', 'sd-food-menu'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .foods .content p' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sd_food_menu_item_desc_type',
                'selector' => '{{WRAPPER}} .foods .content p',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $sd_food_menu_title = $settings['sd_food_menu_title'];
        $sd_food_menu_item_list = $settings['sd_food_menu_item_list'];
        ?>
        <section class="foods bg-image">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-12">
                        <h1 class="section-heading">
                            <?php echo esc_html($sd_food_menu_title); ?>
                        </h1>
                    </div>
                    <?php foreach ($sd_food_menu_item_list as $single_menu_item): ?>
                        <div class="col-md-8 d-flex align-items-center  ">
                            <div class="content">
                                <h3>
                                    <?php echo esc_html($single_menu_item['sd_food_menu_item_title']); ?>
                                </h3>
                                <p>
                                    <?php echo esc_html($single_menu_item['sd_food_menu_item_desc']); ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="food-image">
                                <img src="<?php echo esc_url($single_menu_item['sd_food_menu_item_img']['url']); ?>" alt="">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
