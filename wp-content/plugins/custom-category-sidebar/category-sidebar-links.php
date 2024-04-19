<?php

/*
    Plugin Name: Current Category Archives
    Plugin URI: https://github.com/InternationalCodeCouncil/iccsafe
    Description: Widget for displaying current category sidebar archive links
    Author: Jeff Nishihira
    Version: 1.0
    Author URI: https://www.iccsafe.org
    */

class Current_Category_Archives extends WP_Widget {

    /**
     * Current_Category_Archives constructor.
     */
    public function __construct() {
        $widget_ops = [
            'classname'   => 'Current_Category_Archives',
            'description' => 'A widget that outputs category archive links for the current category',
        ];
        parent::__construct('Current_Category_Archives', 'Current Category Archives', $widget_ops);
    }


    /**
     * widget() - WP method that includes the logic and echoes the widget content
     * Info https://developer.wordpress.org/reference/classes/wp_widget/widget/
     * @param array $args
     * @param array $instance
     * @return string|void
     */
    public function widget ($args, $instance) {

        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Get the current category ID
        $current_category = get_the_category();
        $category_id      = $current_category[0]->cat_ID;

        // Set query to get all posts by the current category ID
        $query_args = [
            'cat'     => $category_id,
            'orderby' => 'date'
        ];
        $query = new WP_Query($query_args);

        // Initialize date var outside query loop
        $date = '';
        // Query date
        $query_month = get_query_var('monthnum');
        // Query year
        $query_year = get_query_var('year');
        $month_name = 'January';
        $dateObj = DateTime::createFromFormat('!m', $query_month);
        if (!empty($dateObj)) {
            // Store the month name to variable
            $month_name = $dateObj->format('F');
        }

        $query_month_year = $month_name . ' ' . $query_year;

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post();

                $currentYM = get_the_date('Y/m');

                // Compare $date var value with current record.  If it's different, echo a link to year/month archive
                if ($date !== $currentYM) {

                    $date = $currentYM;
                    $link_label = get_the_date('F Y');
                    $cat_id = $query->get_queried_object_id();

                    // Compare query month and year with date link month and year.  Bold if it's the same.
                    $style = is_date() && $link_label === $query_month_year ? " selected" : "";

                    echo '<a class="custom-archive' .$style.'" href="/' . $date . '/?cat_id=' . $cat_id . '">' . $link_label . '</a><br />';
                }

            }
        }

        wp_reset_postdata();

        echo $args['after_widget'];

    }


    /**
     * form() - WP method that outputs the settings form
     * Info https://developer.wordpress.org/reference/classes/wp_widget/form/
     * @param array $instance
     * @return string|void
     */
    public function form ($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Archive', 'ancr-child');
        $esc_field_id = esc_attr($this->get_field_id('title'));
        ?>
        <p>
            <label for="<?= $esc_field_id; ?>">
                <?= $title; ?>
            </label>

            <input
                class="widefat"
                id="<?= $esc_field_id; ?>"
                name="<?= esc_attr( $this->get_field_name('title')); ?>"
                type="text"
                value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }


    /**
     * update() - WP method that updates a particular instance of a widget from input from form() method
     * Info https://developer.wordpress.org/reference/classes/wp_widget/update/
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update($new_instance, $old_instance) : array
    {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }
}

add_action( 'widgets_init', function() {
    register_widget('Current_Category_Archives');
});
