<?php
/**
 * Plugin Name: LearnPress Stats Dashboard
 * Description: Dashboard widget và shortcode thống kê LearnPress.
 * Version: 1.0
 * Author: Tên của bạn
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ===== Dashboard Widget =====
function lp_dashboard_widget() {
    wp_add_dashboard_widget(
        'lp_stats_widget',
        'LearnPress Stats Dashboard',
        'lp_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'lp_dashboard_widget');

function lp_dashboard_widget_content() {
    $courses = wp_count_posts('lp_course')->publish ?? 0;
    $lessons = wp_count_posts('lp_lesson')->publish ?? 0;
    $quizzes = wp_count_posts('lp_quiz')->publish ?? 0;

    echo "<p><strong>Tổng khóa học:</strong> {$courses}</p>";
    echo "<p><strong>Tổng bài học:</strong> {$lessons}</p>";
    echo "<p><strong>Tổng bài kiểm tra:</strong> {$quizzes}</p>";
}

// ===== Shortcode [lp_total_stats] =====
function lp_total_stats_shortcode() {
    $courses = wp_count_posts('lp_course')->publish ?? 0;
    $lessons = wp_count_posts('lp_lesson')->publish ?? 0;
    $quizzes = wp_count_posts('lp_quiz')->publish ?? 0;

    ob_start();
    ?>
    <div style="padding:15px; border:1px solid #ccc; border-radius:8px; max-width:400px;">
        <h3>LearnPress Statistics</h3>
        <p><strong>Tổng khóa học:</strong> <?php echo $courses; ?></p>
        <p><strong>Tổng bài học:</strong> <?php echo $lessons; ?></p>
        <p><strong>Tổng bài kiểm tra:</strong> <?php echo $quizzes; ?></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('lp_total_stats', 'lp_total_stats_shortcode');