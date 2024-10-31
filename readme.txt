=== RSS Mixer ===
Contributors: Ideum
Donate link: http://rssmixer.com/
Tags: rss, feeds, atom, mixes, aggregator
Requires at least: 2.0.2
Tested up to: 2.6.2
Stable tag: trunk

Display your RSS Mixer mix on your blog

== Description ==

RSS Mixer combines multiple feeds into one simple, standardized version. This simple widget displays a mix in your
blog's sidebar with two tabs - one for the most recent posts available from the mix and one for the feeds in this mix. Use
the numerous formatting options to display only the data you're interested in.

== Installation ==

1. Upload `rssmixer.php` to your blog's `/wp-content/plugins` directory.
2. Click the `Plugins` tab.
3. Enable the RSS Mixer plugin.
4. Click the `Design` tab and then the `Widgets` tab.
5. Ensure you have a dynamic sidebar enabled blog template. This is *easy* to add.
6. Look for `RSS Mixer Widget` in the list on the left. Click `Add.`
7. Click 'Edit' in the upper right corner of the blue box that just appeared in the right column.
8. Copy and paste your mix's URL into the box.
9. Click `Save Changes` and check your home page.

== Frequently Asked Questions ==

= How often is my feed updated? =

RSS Mixer updates occur frequently and constantly. Your widget is cached for around five minutes to help speed up rendering.

= Images and other tags are being displayed. How can I stop this? =

Use the `Strip HTML from description tags` checkbox in the settings for your widget. This will cause the RSS Mixer server to
remove any HTML tags from the descriptions. HTML is disallowed in all other fields by default.

= How do I style this widget? =

Generally your theme's default styles should apply well to this widget's appearance. Thus, no external styles are
automatically applied. Please take a look at the generated HTML for class names you can use to define your own styles.

If you're looking to set the highlight state of the Posts/Feeds tabs, use the `current` class name. Considering that your sidebar
is probably using the #sidebar identifier, the following would cause the inactive tab to be gray and the active tab black:

	#sidebar lh a { color:#aaa; }
	#sidebar lh.current a { color:#000; }

== Screenshots ==

1. A large number of settings let you fully customize the appearance of the widget in your sidebar.
2. The default setup provides a 'Feeds' and 'Posts' tab.
