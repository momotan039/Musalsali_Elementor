<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class Filter_Widget extends Widget_Base {
    public function get_name() {
        return 'hero_widget';
    }

    public function get_title() {
        return __('Filter Pro', 'hello-child');
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return ['general'];
    }

    public function render() {
        include get_stylesheet_directory() . '/parts/pro-search-filter.php';
    }
}
