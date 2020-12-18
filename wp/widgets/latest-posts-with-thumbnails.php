<?php
/**
 * Widget API: Latest_Posts_With_Thumbnails_Widget class
 * Displays custom latest posts with options
 * Options:
 *     - widget title
 *     - number of posts
 *     - random order?
 *     - show date?
 *     - show thumbnail?
 *         - select thumbnail size
 */

class Latest_Posts_With_Thumbnails_Widget extends WP_Widget {


    /**
     * Sets up a new widget instance.
     */
    function __construct() {

        $widget_ops = array(
			'classname'                   => 'widget_latest_entries',
			'description'                 => __( 'Your site&#8217;s latest Posts.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'latest-posts', __( 'Latest Posts with Thumbnails' ), $widget_ops );
		$this->alt_option_name = 'widget_latest_entries';

    }





    /**
     * Creating widget front-end
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

        // title
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : 'Latest Posts';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        // number of posts
        $num_of_posts = ( ! empty( $instance['num_of_posts'] ) ) ? absint( $instance['num_of_posts'] ) : 5;
		if ( ! $num_of_posts ) $num_of_posts = 5;

        $show_date = ! empty( $instance['show_date'] ) ? '1' : '0';
        $random_order = ! empty( $instance['random_order'] ) ? '1' : '0';
        $show_thumbnail = ! empty( $instance['show_thumbnail'] ) ? '1' : '0';
        $thumbnail_size  = ! empty( $instance['thumbnail_size'] ) ? $instance['thumbnail_size'] : 'thumbnail';



        // standard params
        $query_args = array(
            'posts_per_page'  => $num_of_posts,
            'no_found_rows'   => true,
            'post_status'     => 'publish'
        );

        // set order of posts in widget
        $query_args[ 'orderby' ] = ( $random_order ) ? 'rand' : 'date';
        $query_args[ 'order' ] = 'DESC';

        // run the query: get the latest posts
        $r = new WP_Query( $query_args );

        // stop if no posts found
        if ( ! $r->have_posts() ) return;


        // START HTML
        echo $args['before_widget'];
        // title
        if ( $title ) echo $args['before_title'] . $title . $args['after_title'];
        ?>

		<ul>
            <?php while ( $r->have_posts() ) : $r->the_post(); ?>

                <li class="custom-latest-post">
                    <a href="<?php the_permalink(); ?>">
                        <!-- thumbnail -->
                        <?php if ( $show_thumbnail ) :
                            $thumb = '';

                            // if there is featured image then show it
                            if ( has_post_thumbnail() ) :
                                $thumb = get_the_post_thumbnail( null, $thumbnail_size );
                            endif;

                            if ( $thumb ) echo $thumb;
                        endif;
                        ?>
                        <!-- !thumbnail -->

                        <!-- post data -->
                        <div class="post-data">

                            <!-- post title -->
                            <h2 class="post-title">
                                <?php
                                $post_title = $this->get_the_trimmed_post_title();
                                if ( $post_title ) echo $post_title;
                                ?>
                            </h2>
                            <!-- !post title -->

                            <?php if ( $show_date ) : ?>
                                <!-- post-date -->
                                <span class="post-date">
                                    <i class="fa fa-calendar-o"></i>
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                </span>
                                <!-- !post-date -->
                            <?php endif; ?>
                        </div>
                        <!-- !post data -->
                    </a>
                </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
		</ul>

        <?php
        // END HTML
        echo $args['after_widget'];
    }




    /**
     * Updating widget - replacing old instances with new
     */
    public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['num_of_posts'] = (int) $new_instance['num_of_posts'];
        $instance['show_date'] = ! empty( $new_instance['show_date'] ) ? 1 : 0;
        $instance['random_order'] = ! empty( $new_instance['random_order'] ) ? 1 : 0;
        $instance['show_thumbnail'] = ! empty( $new_instance['show_thumbnail'] ) ? 1 : 0;


        $thumbnail_sizes = wp_get_registered_image_subsizes();
        $thumbnail_sizes_arr = array();
        foreach ( $thumbnail_sizes as $key => $value ) {
            array_push( $thumbnail_sizes_arr, $key );
        }

        if ( in_array( $new_instance['thumbnail_size'], $thumbnail_sizes_arr, true ) ) {
			$instance['thumbnail_size'] = $new_instance['thumbnail_size'];
		} else {
			$instance['thumbnail_size'] = 'thumbnail';
		}

        return $instance;
	}




    /**
     * Widget Backend: outputs the settings form for widget.
     */
    public function form( $instance ) {

        // Defaults
        // $instance = wp_parse_args(
		// 	(array) $instance,
		// 	array(
		// 		'title' => 'Latest Posts',
		// 		'num_of_posts' => 5,
		// 		'show_date' => false,
		// 		'random_order' => false,
		// 		'show_thumbnail' => false,
		// 		'thumbnail_size' => 'thumbnail'
		// 	)
		// );


        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Latest Posts';
        $num_of_posts = isset( $instance['num_of_posts'] ) ? absint( $instance['num_of_posts'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        $random_order = isset( $instance['random_order'] ) ? (bool) $instance['random_order'] : false;
        $show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false;
        $thumbnail_size = isset( $instance['thumbnail_size'] ) ? esc_attr( $instance['thumbnail_size'] ) : 'thumbnail';
        ?>

        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'num_of_posts' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'num_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'num_of_posts' ); ?>" type="number" step="1" min="1" value="<?php echo $num_of_posts; ?>" size="3" />
		</p>

        <p>
            <input class="checkbox" type="checkbox"<?php checked( $random_order ); ?> id="<?php echo $this->get_field_id( 'random_order' ); ?>" name="<?php echo $this->get_field_name( 'random_order' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'random_order' ); ?>"><?php _e( 'Show posts in random order?' ); ?></label>
            <br />

			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show post date?' ); ?></label>
            <br />

            <input class="checkbox" type="checkbox"<?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php _e( 'Show thumbnail?' ); ?></label>
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'thumbnail_size' ) ); ?>"><?php _e( 'Thumbnail size:' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'thumbnail_size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'thumbnail_size' ) ); ?>" class="widefat">
                <?php
                $thumbnail_sizes = wp_get_registered_image_subsizes();
                foreach ( $thumbnail_sizes as $key => $value ) :
                    if( is_integer( $key ) ) continue;
                ?>
                    <option value="<?php echo esc_html( $key ); ?>"<?php selected( $thumbnail_size, $key ); ?>><?php echo esc_html( $key ); ?> (<?php echo absint( $value[ 'width' ] ); ?> &times; <?php echo absint( $value[ 'height' ] ); ?>)</option>
                <?php endforeach; ?>
            </select>
        </p>


        <?php
    }







    /**
	 * Returns the shortened post title, must use in a loop.
	 */
	private function get_the_trimmed_post_title () {

		// get current post's post_title
		$post_title = get_the_title();

        $title = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );

		// get post_title in desired length
		$post_title = mb_substr( $post_title, 0, 25 );
		// append ellipses
		$post_title .= '...';

		// return text
		return $post_title;
	}


}




// Register and load the widget
function custom_load_widget() {
    register_widget( 'Latest_Posts_With_Thumbnails_Widget' );
}
add_action( 'widgets_init', 'custom_load_widget' );
?>
