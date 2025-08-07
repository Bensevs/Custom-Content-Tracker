<?php
namespace CustomContentTicker\Widget;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

class ContentTicker extends Widget_Base {

    public function get_name() {
        return 'custom_content_ticker';
    }

    public function get_title() {
        return __('Content Ticker', 'custom-content-ticker');
    }

    public function get_icon() {
        return 'eicon-news-ticker';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['ticker', 'news', 'scroll', 'content'];
    }

    protected function register_controls() {
        // --- Content Tab ---

        $this->start_controls_section(
            'section_content_source',
            ['label' => __('Content Source', 'custom-content-ticker')]
        );

        $this->add_control(
            'content_source',
            [
                'label' => __('Source', 'custom-content-ticker'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'custom' => __('Custom Content', 'custom-content-ticker'),
                    'posts' => __('WordPress Posts', 'custom-content-ticker'),
                ],
                'default' => 'custom',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_custom_content',
            [
                'label' => __('Custom Items', 'custom-content-ticker'),
                'condition' => ['content_source' => 'custom'],
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control('title', [
            'label' => __('Title', 'custom-content-ticker'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Sample Title', 'custom-content-ticker'),
        ]);
        $repeater->add_control('desc', [
            'label' => __('Description', 'custom-content-ticker'),
            'type' => Controls_Manager::TEXTAREA,
        ]);
        $repeater->add_control('image', [
            'label' => __('Image', 'custom-content-ticker'),
            'type' => Controls_Manager::MEDIA,
        ]);

        $this->add_control('items', [
            'label' => __('Ticker Items', 'custom-content-ticker'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['title' => __('Item #1', 'custom-content-ticker')],
                ['title' => __('Item #2', 'custom-content-ticker')],
            ],
            'title_field' => '{{{ title }}}',
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_posts_content',
            [
                'label' => __('Posts Settings', 'custom-content-ticker'),
                'condition' => ['content_source' => 'posts'],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Count', 'custom-content-ticker'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
                'min' => 1,
                'max' => 20,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            ['label' => __('Ticker Settings', 'custom-content-ticker')]
        );

        $this->add_control(
            'show_title',
            [
                'label' => __('Show Ticker Title', 'custom-content-ticker'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __('Title Text', 'custom-content-ticker'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Latest News', 'custom-content-ticker'),
                'condition' => ['show_title' => 'yes'],
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => __('Direction', 'custom-content-ticker'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'left' => __('Left', 'custom-content-ticker'),
                    'right' => __('Right', 'custom-content-ticker'),
                ],
                'default' => 'left',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __('Autoplay Speed (ms)', 'custom-content-ticker'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => __('Pause on Hover', 'custom-content-ticker'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => __('Show Arrows', 'custom-content-ticker'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        // --- Style Tab ---

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Ticker Style', 'custom-content-ticker'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'custom-content-ticker'),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .cct__title' => 'color: {{VALUE}};'],
                'condition' => ['show_title' => 'yes'],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'custom-content-ticker'),
                'selector' => '{{WRAPPER}} .cct__title',
                'condition' => ['show_title' => 'yes'],
            ]
        );

        $this->add_control(
            'item_color',
            [
                'label' => __('Item Title Color', 'custom-content-ticker'),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .cct__item-title' => 'color: {{VALUE}};'],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_typography',
                'label' => __('Item Title Typography', 'custom-content-ticker'),
                'selector' => '{{WRAPPER}} .cct__item-title',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => __('Item Description Color', 'custom-content-ticker'),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .cct__item-desc' => 'color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Arrow Color', 'custom-content-ticker'),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .slick-arrow' => 'color: {{VALUE}};'],
                'condition' => ['show_arrows' => 'yes'],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', [
            'class' => 'custom-content-ticker-wrapper',
            'data-speed' => intval($settings['speed']),
            'data-direction' => sanitize_key($settings['direction']),
            'data-pause-on-hover' => esc_attr($settings['pause_on_hover']),
            'data-show-arrows' => esc_attr($settings['show_arrows']),
        ]);
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div class="cct">
                <?php if ($settings['show_title'] === 'yes' && !empty($settings['title_text'])) : ?>
                    <div class="cct__title"><?php echo esc_html($settings['title_text']); ?></div>
                <?php endif; ?>

                <div class="cct__slider">
                    <?php
                    if ($settings['content_source'] === 'posts') {
                        $query = new \WP_Query([
                            'posts_per_page' => intval($settings['posts_per_page']),
                            'post_type' => 'post',
                            'post_status' => 'publish',
                        ]);
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                ?>
                                <div class="cct__item">
                                    <strong class="cct__item-title"><?php echo esc_html(get_the_title()); ?></strong>
                                    <span class="cct__item-desc"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 10)); ?></span>
                                </div>
                                <?php
                            }
                        }
                        wp_reset_postdata();
                    } else {
                        foreach ($settings['items'] as $item) {
                            ?>
                            <div class="cct__item">
                                <?php if (!empty($item['image']['url'])) : ?>
                                    <img class="cct__item-img" src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                                <?php endif; ?>
                                <strong class="cct__item-title"><?php echo esc_html($item['title']); ?></strong>
                                <?php if (!empty($item['desc'])) : ?>
                                    <span class="cct__item-desc"><?php echo esc_html($item['desc']); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}
