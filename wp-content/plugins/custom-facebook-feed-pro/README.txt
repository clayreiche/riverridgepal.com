=== Custom Facebook Feed Pro ===
Author: Smash Balloon
Support Website: http://smashballoon/custom-facebook-feed/
Requires at least: 3.0
Tested up to: 3.8.1
Version: 1.4.3
License: Non-distributable, Not for resale

The Custom Facebook Feed allows you to display a completely customizable Facebook feed of any public Facebook page or group on your website.

== Description ==
Display a **completely customizable**, **responsive** and **search engine crawlable** version of your Facebook feed on your website. Completely match the look and feel of the site with tons of customization options!

* **Completely Customizable** - by default inherits your theme's styles
* **Feed content is crawlable by search engines adding SEO value to your site** - other Facebook plugins embed the feed using iframes which are not crawlable
* **Completely responsive and mobile optimized** - works on any screen size
* Display statuses, photos, videos, events, links and offers from your Facebook page or group
* Choose which post types are displayed. Only want to show photos, videos or events? No problem
* Display multiple feeds from different Facebook pages on the same page or throughout your site
* Show likes, shares and comments for each post
* Automatically embeds YouTube and Vimeo videos right in your feed
* Show event information - such as the name, time/date, location, link to a map, description and a link to buy tickets
* Filter posts by string or #hashtag
* Post caching means that your feed is load lightning fast
* Fully internationalized and translatable into any language
* Enter your own custom CSS for even deeper customization

== Installation ==
1. Install the Custom Facebook Feed either via the WordPress plugin directory, or by uploading the files to your web server (in the /wp-content/plugins/ directory).
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to the 'Facebook Feed' settings page to configure your feed.
4. Use the shortcode [custom-facebook-feed] in your page, post or widget to display your feed.
5. You can display multiple feeds of different Facebook pages by specifying a Page ID directly in the shortcode: [custom-facebook-feed id=smashballoon num=5].

== Changelog ==

= 1.4.3 =
* New: Choose to display events from your Events page for up to 1 week after the start time has passed
* Tweak: Changed 'Layout & Style' page name to 'Customize'
* Fix: Added CSS box-sizing property to feed header so that padding doesn't increase its width
* Fix: Fixed showheader=false and headeroutside=false shortcode options
* Fix: Fixed include=author shortcode option
* Fix: More robust method for stripping the URL when user enters Facebook page URL instead of their Page ID
* Fix: Encode URLs so that they pass HTML validation

= 1.4.2 =
* New: Set your timezone so that dates/times are displayed in your local time
* Tweak: Description character limit now also applies to embedded video descriptions
* Fix: Fixed issue with linking the post text to the Facebook post
* Fix: Comments box styling now applies to the 'View previous comments' and 'Comment on Facebook' links
* Fix: Fixed the 'showauthor' shortcode option
* Fix: Added the ability to show or hide the author to the 'include' shortcode option
* Fix: Fixed issue with the comments box not expanding when there were no comments
* Fix: Now using HTML encoding to parse any raw HTML tags in the post text, descriptions or comments
* Fix: Fixed date width issue in IE7
* Fix: Added http protocol to the beginning of links which don't include it
* Fix: Fixed an issue with the venue link when showing events from the Events page
* Fix: Removed stray PHP notices
* Fix: Numerous other minor bug fixes

= 1.4.1 =
* Fix: Fixed some minor bugs introduced in 1.4.0
* Fix: Fixed issue with album names not always displaying
* Fix: Added cURL option to handle gzip compression

= 1.4.0 =
* New: Redesigned comment area to better match Facebook
* New: Now displays the number of likes a comment has
* New: Now shows 4 most recent comments and add a 'View older comments' button to show more
* New: Shows the names of who likes the post at the top of the comments section
* New: Added a 'Comment on Facebook' button at the bottom of the comments section
* New: Can now choose to show posts only by other people
* New: Added ability to add a customizable header to your feed
* New: Added a 'Custom Text / Translate' tab to house all customizable text
* New: Added an icon and CSS class to posts with multiple images
* New: When posting multiple images it states the number of photos after the post text
* New: When sharing photos or links it now states who you shared them from
* Tweak: String/hastag filtering now also applies to the description
* Tweak: Updated video play button to display more consistently across video sizes
* Tweak: Events will now still appear for 6 hours after their start time has passed
* Tweak: Added a button to test the connection to Facebook's API for easier troubleshooting
* Tweak: Plugin now detects whether the page is using SSL and pulls https resources
* Tweak: Post with multiple images now link to the album instead of the individual photo
* Tweak: WordPress 3.8 UI updates
* Fix: Fixed Vimeo embed issue
* Fix: Fixed issue with some event links due to a Facebook API change
* Fix: Fixed an issue with certain photos not displaying correctly

= 1.3.8 =
* New: Added a 'Custom JavaScript' section to allow you to add your own custom JavaScript or jQuery scripts

= 1.3.7.2 =
* Tweak: Changed site_url to plugins_url
* Fix: Fixed issue with enqueueing JavaScript file

= 1.3.7.1 =
* Tweak: Added option to remove border from the Like box when showing faces
* Tweak: Added ability to manually translate the '2 weeks ago' text
* Tweak: Checks whether the Access Token is inputted in the correct format
* Tweak: Replaced 'View Link' with 'View on Facebook' so that shared links now link to the Facebook post
* Fix: Fixed issue with certain embedded YouTube videos not playing correctly
* Fix: Fixed bug in the 'Show posts on my page by others' option

= 1.3.7 =
* New: Improved shared link and shared video layouts
* New: When only showing events you can now choose to display them from your Events page or timeline
* New: Set "Like" box text color to either blue or white
* Tweak: Displays image caption if no description is available
* Tweak: "Like" box is now responsive
* Tweak: Vertically center multi-line author names rather than bumping them down below the avatar
* Tweak: Various CSS formatting improvements
* Fix: If displaying a group then automatically hide the "Like" box
* Fix: 'others=false' shortcode option now working correctly
* Fix: Fixed formatting issue for videos without poster images
* Fix: Strip any white space characters from beginning or end of Access Token and Page ID

= 1.3.6 =
* Tweak: Embedded videos are now completely responsive
* Tweak: Now displays loading gif while loading in likes and comments counts
* Tweak: Improved documentation within the plugin
* Tweak: Changed order of methods used to retrieve feed data
* Fix: Corrected bug which caused the loading of likes and comments counts to sometimes fail

= 1.3.5 =
* New: Feed is now fully translatable into any language - added i18n support for date translation
* New: Now works with groups
* New: Added support for group events
* Fix: Resolved jQuery UI draggable bug which was causing issues in certain cases with drag and drop
* Fix: Fixed full-width event layout bug
* Fix: Fixed video play button positioning on videos with small poster images

= 1.3.4 =
* New: Added localization support. Full support for various languages coming soon.
* Fix: Fixed an issue regarding statuses linking to the wrong page ID

= 1.3.3 =
* New: Post filtering by string: Ability to display posts based on whether they contain a particular string or #hashtag
* New: Option to link statuses to either the status post itself or the directly to the page/timeline
* New: Added CSS classes to different post types to allow for different styling based on post type
* New: Added option to added thumbnail faces of fans to the Like box
* New: Define your own width for the Like box
* Tweak: Added separate classes to 'View on Facebook' and 'View Link' links so that they can be targeted with CSS
* Tweak: Prefixed every CSS class to prevent styling conflicts with theme stylesheets
* Tweak: Automatically deactivates license key when plugin is uninstalled

= 1.3.2 =
* New: Added support for Facebook 'Offers'
* Fix: Fixes an issue with the 'others' shortcode caused by caching introduced in 1.3.1
* Fix: Prefixed the 'clear' class to prevent conflicts

= 1.3.1 =
* New: Post caching now temporarily stores your post data in your WordPress database to allow for super quick load times
* New: Define your own caching time. Check for new posts every few seconds, minutes, hours or days. You decide.
* New: Display events directly from your Events page
* New: Display event image, customize the date, link to a map of the event location and show a 'Buy tickets' link
* Tweak: Improved layout of admin pages for easier customization
* Fix: Provided a fix for the Facebook API duplicate post bug

= 1.3.0 =
* New: Define your own custom text for the 'See More' and 'See Less' buttons
* New: Add your own CSS class to your feeds with the new shortcode 'class' option
* New: Show actual number of comments when there is more than 25, rather than just '25+'
* New: Define a post limit which is higher or lower than the default 25
* New: Include the Like box inside or outside of the feed's container
* Tweak: Made changes to the plugin to accomodate the October Facebook API changes
* Fix: Fixed bug which ocurred when multiple feeds are displayed on the same page with different text lengths defined

= 1.2.9 =
* New: Added a 'See More' link to expand any text which is longer than the character limit defined
* New: Choose to show posts by other people in your feed
* New: Option to show the post author's profile picture and name above each post
* New: Specify the format of the Event date
* Tweak: Default date format is less specific and better mimics Facebook's - credit Mark Bebbington
* Fix: When a photo album is shared it now links to the album itself and not just the cover photo
* Fix: Fixed issue with hyperlinks in post text which don't have a space before them not being converted to links
* Minor fixes

= 1.2.8 =
* Tweak: Added links to statuses which link to the Facebook page
* Tweak: Added classes to event date, location and description to allow custom styling
* Tweak: Removed 'Where' and 'When' text from events and made bold instead
* Tweak: Added custom stripos function for users who aren't running PHP5+

= 1.2.7 =
* Fix: Fixes the ability to hide the 'View on Facebook/View Link' text displayed with posts

= 1.2.6 =
* Fix: Prevents the WordPress wpautop bug from breaking some of the post layouts
* Fix: Event timezone fix when timezone migration is enabled

= 1.2.5 =
* Tweak: Replaced jQuery 'on' function with jQuery 'click' function to allow for compatibilty with older jQuery versions
* Minor bug fix regarding hyperlinking the post text

= 1.2.4 =
* New: Added a ton more shortcode options
* New: Added options to customize and format the date
* New: Add your own text before and after the date and in place of the 'View on Facebook' and 'View Link' links
* New: If there are no comments on a post then choose whether to hide the comment box or use your own custom text
* Tweak: Separated the video/photo descriptions and link descriptions into separate checkboxes in the Post Layout section
* Tweak: Changed the layout of the Typography section to allow for the additional options
* Tweak: Added a System Info section to the Settings page to allow for simpler debugging of issues related to PHP settings

= 1.2.3 =
* New: Choose to only show certain types of posts (eg. events, photos, videos, links)
* New: Add your own custom CSS to allow for even deeper customization
* New: Optionally link your post text to the Facebook post
* New: Optionally link your event title to the Facebook event page
* Fix: Only show the name of a photo or video if there is no accompanying text
* Some minor modifications

= 1.2.2 =
* Fix: Set all parts of the feed to display by default

= 1.2.1 =
* Select whether to hide or show certain parts of the posts
* Minor bug fixes

= 1.2.0 =
* Major Update!
* New: Loads of customization, layout and styling options for your feed
* New: Define feed width, height, padding and background color
* New: Choose from 3 preset post layouts; thumbnail, half-width, and full-width
* New: Change the font-size, font-weight and color of the post text, description, date, links and event details
* New: Style the comments text and background color
* New: Choose from light or dark icons
* New: Select whether the Like box is shown at the top of bottom of the feed
* New: Choose Like box background color
* New: Define the height of the video (if required)

= 1.1.1 =
* New: Shared events now display event details (name, location, date/time, description) directly in the feed

= 1.1.0 =
* New: Added embedded video support for youtu.be URLs
* New: Email addresses within the post text are now hyperlinked
* Fix: Links beginning with 'www' are now also hyperlinked

= 1.0.9 =
* Bug fixes

= 1.0.8 =
* New: Most recent comments are displayed directly below each post using the 'View Comments' button
* New: Added support for events - display the event details (name, location, date/time, description) directly in the feed
* Fix: Links within the post text are now hyperlinked

= 1.0.7 =
* Fix: Fixed issue with certain statuses not displaying correctly
* Fix: Now using the built-in WordPress HTTP API to get retrieve the Facebook data

= 1.0.6 =
* Fix: Now using cURL instead of file_get_contents to prevent issues with php.ini configuration on some web servers

= 1.0.5 =
* Fix: Fixed bug caused in previous update when specifying the number of posts to display

= 1.0.4 =
* Tweak: Prevented likes and comments by the page author showing up in the feed

= 1.0.3 =
* Tweak: Open links to Facebook in a new tab/window by default
* Fix: Added clear fix
* Fix: CSS image sizing fix

= 1.0.2 =
* New: Added ability to set a maximum length on both title and body text either on the plugin settings screen or directly in the shortcode

= 1.0.1 =
* Fix: Minor bug fixes.

= 1.0 =
* Launch!