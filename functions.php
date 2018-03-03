<?php
add_action( 'wp_enqueue_scripts', 'latest_child_enqueue_styles' );

function latest_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

function my_theme_enqueue_styles() {

    $parent_style = 'latest-style' ; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'latest_child_enqueue_styles' );

/* ----------------------------------------------------------------------------
 | Author: 		Michael Sattler <michael@sattlers.org>
 | Version:		1.0.0 2017-01-24
 | License:		GNU General Public License v3 or better
 | License URL:	https://www.gnu.org/licenses/gpl-3.0.en.html
 |
 | While writing WordPress content I frequently want to link to something I've
 | written before without having to remember whether it was a page or post.
 | This shortcode does just that.
 |
 | Reference:	https://codex.wordpress.org/Shortcode%20API
 |
 | Also, a shout out to Dave Winer's Userland.com 'Radio' and 'Frontier' content
 | management systems, which did this sort of thing effortlessly, making it
 | really easy to write a coherent cross-referenced blogosphere.
 |
 +-----------------------------------------------------------------------------
 | Usage:
 | 
 | Input: [link t="title of page or post" a="optional alternative text"]
 | 
 |      (post) [link t="Styling CODE and PRE"]
 |      (post) [link t="Styling CODE and PRE" a="making pretty"]
 |      (page) [link t="Contact"]
 |      (page) [link t="Contact" a="talk to us!"]
 |      (fail) [link]
 |      (fail) [link t=""]
 |      (fail) [link t="tpyo"]
 | 
 | Output:
 | 
 |      <a href="$permalink">$human_readable_text</a>
 | 
 | where $human_readable_text is $a (if passed; if not $t)
 +-------------------------------------------------------------------------- */
add_shortcode( 'link', '___permalink_by_title' ) ;

function ___permalink_by_title( $args = array() ) {
    extract( shortcode_atts( array(
        't' => '',                              // page or post title
        'a' => ''                               // alternative text to display
    ), $args ) ) ;

    // how we emphasize error messages
    $eo='<font color="red"></strong>' ;         // usage: "{$eo}string{$ec}"
    $ec='</strong></font>' ;

    $types = array( 'post', 'page' ) ;          // look for both page and post
    $p = get_page_by_title( $t, OBJECT, $types ) ;
    if ( empty( $p ) ) {
        $name = "{$eo}[link] shortcode error: can't find \"$t\"{$ec}" ;
        $url = '' ;                             // no href for you :-/
    } else {
        $url = get_permalink( $p->ID ) ;
        if ( empty( $a ) ) {
            $name ="$t" ;                       // use page's name as link text
        } else {
            $name ="$a" ;                       // use alt as the link text
        }
    }
    return "<a href=\"{$url}\">$name</a>" ;
}
?>
