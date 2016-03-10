<?php
/**
 * Plugin Name: Social Share Widget
 * Plugin URI: https://github.com/darrenthomas5
 * Description: Social Share Widget is a lightweight Wordpress plugin that adds social share icons. It currently supports Facebook, Twitter, Pintrest, Google+ and linkedin.
 * Version: 1.0
 * Author: Darren Thomas
 * Author URI: http://darrenthomas.me.uk
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/Licenses/gpl-2.0.html
 *
 * Copyright (C) 2016 Darren Thomas (support@darrenthomas.me.uk)
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

class Social_Share_Widget extends WP_Widget {

  // Create widget
  function __construct() {

    parent::__construct(

      // Base ID of the widget
      'social-share',
      // Name of the widget as in UI
      'Social Share Icons',
      // Widget description and classname
      array (
        'classname'   => 'social_share_wrapper',
        'description' => 'Social Share Widget is a lightweight Wordpress plugin that adds social share icons. It currently supports Facebook, Twitter, Pintrest, Google+ and linkedin.'
      )
    );
  }

  // Back-end form of the widget
  function form( $instance ) {

    $instance = wp_parse_args(
      (array)$instance,
      array(
        'title'     => '',
        'facebook'  => '',
        'twitter'   => '',
        'pintrest'  => '',
        'google'    => '',
        'linkedin'  => ''
      )
    );

  	// markup for form
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance[ 'title' ]; ?>">
    </p>

    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="1" "<?php checked( 1, $instance[ 'facebook' ], true); ?>" >
      <label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook</label>
      <br>
    </p>

    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="1" "<?php checked( 1, $instance[ 'twitter' ], true); ?>" >
      <label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter</label>
      <br>
    </p>

    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'pintrest' ); ?>" name="<?php echo $this->get_field_name( 'pintrest' ); ?>" value="1" "<?php checked( 1, $instance[ 'pintrest' ], true); ?>" >
      <label for="<?php echo $this->get_field_id( 'pintrest' ); ?>">Pintrest</label>
      <br>
    </p>

    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>" value="1" "<?php checked( 1, $instance[ 'google' ], true); ?>" >
      <label for="<?php echo $this->get_field_id( 'google' ); ?>">Google+</label>
      <br>
    </p>

    <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="1" "<?php checked( 1, $instance[ 'linkedin' ], true); ?>" >
      <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>">LinkedIn</label>
      <br>
    </p>

    <?php

  }

  function update( $new_instance, $old_instance ) {

    $instance = $old_instance;
    $instance[ 'title'    ] = $new_instance[ 'title'    ];
    $instance[ 'facebook' ] = $new_instance[ 'facebook' ];
    $instance[ 'twitter'  ] = $new_instance[ 'twitter'  ];
    $instance[ 'pintrest' ] = $new_instance[ 'pintrest' ];
    $instance[ 'google'   ] = $new_instance[ 'google'   ];
    $instance[ 'linkedin' ] = $new_instance[ 'linkedin' ];

    return $instance;

  }

  function widget( $args, $instance ) {

    global $share_page_url;

    if(empty($share_page_url))
    {
      $share_page_url = esc_url(get_permalink());
    }

    ?>

    <div class="social_share_icons">

      <?php
      $title = apply_filters( 'widget_title', $instance['title'] );
      // before and after widget arguments are defined by themes
      echo $args['before_widget'];
      if ( ! empty( $title ) )
      echo $args['before_title'] . $title . $args['after_title'];
      // Code to run and display the output ?>
      <ul>
        <?php if( 1 == $instance['facebook']) { ?>
          <li><a title="<?php _e( 'Share On Facebook', THEMEDOMAIN ); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($share_page_url); ?>"><i class="fa fa-facebook marginright"></i></a></li><?php
        } ?>
        <?php if( 1 == $instance['twitter']) { ?>
          <li><a title="<?php _e( 'Share On Twitter', THEMEDOMAIN ); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo $share_page_url; ?>&amp;url=<?php echo $share_page_url; ?>"><i class="fa fa-twitter marginright"></i></a></li><?php
        } ?>
        <?php if( 1 == $instance['pintrest']) { ?>
          <li><a title="<?php _e( 'Share On Pinterest', THEMEDOMAIN ); ?>" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode($share_page_url); ?>&amp;media=<?php echo urlencode($pin_thumb[0]); ?>"><i class="fa fa-pinterest marginright"></i></a></li><?php
        } ?>
        <?php if( 1 == $instance['google']) { ?>
          <li><a title="<?php _e( 'Share On Google+', THEMEDOMAIN ); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo $share_page_url; ?>"><i class="fa fa-google-plus marginright"></i></a></li><?php
        } ?>
        <?php  if( 1 == $instance['linkedin']) { ?>
          <li><a title="<?php _e( 'Share On LinkedIn', THEMEDOMAIN ); ?>" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($share_page_url); ?>&amp;title=<?php echo get_the_title(); ?>&amp;summary=<?php get_the_excerpt(); ?>&amp;source=<?php get_the_author_id(); ?>"><i class="fa fa-linkedin marginright"></i></a></li><?php
        } ?>
      </ul>
      <?php echo $args['after_widget']; ?>
    </div>

<?php

  }

}

function register_social_share_widget() {
  register_widget( 'Social_Share_Widget' );
}
add_action( 'widgets_init', 'register_social_share_widget' );
