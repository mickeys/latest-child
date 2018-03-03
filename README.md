# latest_child_wordpress_theme

'Latest Child' is a WordPress [child theme](https://codex.wordpress.org/Child_Themes) which modifies the '[latest](http://uxlthemes.com/theme/latest)' theme, by [uXL Themes](http://uxlthemes.com). Both themes are shared with you under the terms of the [GNU General Public License](http://www.gnu.org/licenses/).

![Latest Child WordPress theme logo](./screenshot.png)

I'm using Latest Child as a proving ground for [WordPress](https://wordpress.org/) exploration, while providing added functionality for clients who are running their websites with  the 'Latest' theme.

Added to the `functions.php` file:

* An implementation of the `[link]` shortcode, which implements intra-site cross-document linking described in [
WordPress shortcode link for Posts & Pages](http://sattlers.org/2017/01/25/gist-get-wordpress-permalink-for-posts-pages/). The syntax of the shortcode usage is:

```
[link t="title of page or post" a="optional alternative text"]
```