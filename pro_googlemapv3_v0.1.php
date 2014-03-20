<?php

// This is a PLUGIN TEMPLATE for Textpattern CMS.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Plugin names should start with a three letter prefix which is
// unique and reserved for each plugin author ("abc" is just an example).
// Uncomment and edit this line to override:
$plugin['name'] = 'pro_googlemapv3';

// Allow raw HTML help, as opposed to Textile.
// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 1;

$plugin['version'] = '0.1';
$plugin['author'] = 'Hilary Quinn';
$plugin['author_uri'] = 'http://www.proximowebdesign.ie';
$plugin['description'] = 'Google Maps Plugin based on JavaScript API V3';

// Plugin load order:
// The default value of 5 would fit most plugins, while for instance comment
// spam evaluators or URL redirectors would probably want to run earlier
// (1...4) to prepare the environment for everything else that follows.
// Values 6...9 should be considered for plugins which would work late.
// This order is user-overrideable.
$plugin['order'] = '5';

// Plugin 'type' defines where the plugin is loaded
// 0 = public              : only on the public side of the website (default)
// 1 = public+admin        : on both the public and admin side
// 2 = library             : only when include_plugin() or require_plugin() is called
// 3 = admin               : only on the admin side (no AJAX)
// 4 = admin+ajax          : only on the admin side (AJAX supported)
// 5 = public+admin+ajax   : on both the public and admin side (AJAX supported)
$plugin['type'] = '1';

// Plugin "flags" signal the presence of optional capabilities to the core plugin loader.
// Use an appropriately OR-ed combination of these flags.
// The four high-order bits 0xf000 are available for this plugin's private use
if (!defined('PLUGIN_HAS_PREFS')) define('PLUGIN_HAS_PREFS', 0x0001); // This plugin wants to receive "plugin_prefs.{$plugin['name']}" events
if (!defined('PLUGIN_LIFECYCLE_NOTIFY')) define('PLUGIN_LIFECYCLE_NOTIFY', 0x0002); // This plugin wants to receive "plugin_lifecycle.{$plugin['name']}" events

$plugin['flags'] = '0';

// Plugin 'textpack' is optional. It provides i18n strings to be used in conjunction with gTxt().
// Syntax:
// ## arbitrary comment
// #@event
// #@language ISO-LANGUAGE-CODE
// abc_string_name => Localized String

/** Uncomment me, if you need a textpack
$plugin['textpack'] = <<< EOT
#@admin
#@language en-gb
abc_sample_string => Sample String
abc_one_more => One more
#@language de-de
abc_sample_string => Beispieltext
abc_one_more => Noch einer
EOT;
**/
// End of textpack

if (!defined('txpinterface'))
        @include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
function pro_googlemapv3($atts, $thing=NULL){

extract(lAtts(array(
                'apikey'        => '',
                'zoom'	        => '14',
                'center'	=> '',
                'loc1'		=> '',
                'loc2'		=> '',
                'heading1'	=> '',
                'heading2'	=> '',
                'bodycontent1'	=> '',
                'bodycontent2'	=> ''		
	), $atts));

return "
<script type=\"text/javascript\" src=\"http://maps.googleapis.com/maps/api/js?key=$apikey&amp;sensor=false\"></script>

<script type=\"text/javascript\">

var chosenloc = new google.maps.LatLng($center);
var loc1 = new google.maps.LatLng($loc1);
var loc2 = new google.maps.LatLng($loc2);
var marker;
var map;

function initialize() {

  var mapOptions = {
    zoom: $zoom,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: chosenloc
  };

  map = new google.maps.Map(document.getElementById(\"pro_map_canvas\"),
      mapOptions);

  var contentString1 =
    '<div id=\"pro_siteNotice\">'+
    '<h2 id=\"pro_firstHeading\" class=\"pro_firstHeading\">$heading1'+
    '</h2>'+
    '<div id=\"pro_bodyContent\">'+
    '<p>$bodycontent1' +
    '</p>'+
    '</div>'+
    '</div>';

  var infowindow1 = new google.maps.InfoWindow({
    content: contentString1
  });

  var contentString2 = '<div id=\"content\">'+
    '<div id=\"pro_siteNotice\">'+
    '<h2 id=\"pro_firstHeading\" class=\"pro_firstHeading\">$heading2'+
    '</h2>'+
    '<div id=\"pro_bodyContent\">'+
    '<p>$bodycontent2' +
    '</p>'+
    '</div>'+
    '</div>';

  var infowindow2 = new google.maps.InfoWindow({
    content: contentString2
  });

  marker = new google.maps.Marker({
    map:map,
    draggable:false,
    title:\"$heading1\",
    animation: google.maps.Animation.DROP,
    position: loc1 
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow1.open(map,marker);
  });

  marker1 = new google.maps.Marker({
    map:map,
    draggable:false,
    title:\"$heading2\",
    animation: google.maps.Animation.DROP,
    position: loc2
 });

  google.maps.event.addListener(marker1, 'click', function() {
    infowindow2.open(map,marker1);
  });

}

</script>

<script type=\"text/javascript\">
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
";
}
# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN CSS ---
<style type="text/css">
h1{font-weight: bold; margin: 20px 0;}
p{margin: 10px 0;}
pre{padding: 10px;}
.code{background: #F4F3ED; border-top: 1px dotted #DBD7C5; border-bottom: 1px dotted #DBD7C5; padding: 10px;}
</style>
# --- END PLUGIN CSS ---
-->
<!--
# --- BEGIN PLUGIN HELP ---
<h1>1. Insert plugin tag in the head of your page:</h1>

<div class="code">&lt;txp:pro_googlemapv3 apikey="pasteyourapikeyhere" zoom="14" center="51.896777,-8.4763924" loc1="51.896777,-8.4763924" heading1="My Company Name" bodycontent1="My First Location" loc2="51.898281,-8.475543" heading2="My Company Name" bodycontent2="My Second Location" /&gt;</div>

<p>I recommend only executing the code <strong>on the page you need it:</strong></p>

<div class="code">&lt;txp:if_section name="contact"&gt;
&lt;txp:pro_googlemapv3 apikey="pasteyourapikeyhere" zoom="14" center="51.896777,-8.4763924" loc1="51.896777,-8.4763924" heading1="My Company Name" bodycontent1="My First Location" loc2="51.898281,-8.475543" heading2="My Company Name" bodycontent2="My Second Location" /&gt;
&lt;/txp:if_section&gt;</div>

<p>The above code will place 2 markers on one map, to only <strong>insert a single marker</strong> use the below code:</p>

<div class="code">&lt;txp:if_section name="contact"&gt;
&lt;txp:pro_googlemapv3 apikey="pasteyourapikeyhere" zoom="14" center="51.896777,-8.4763924" loc1="51.896777,-8.4763924" heading1="My Company Name" bodycontent1="My Location" /&gt;
&lt;/txp:if_section&gt;</div>

<h1>2. Insert html code in page article:</h1>

<div class="code">&lt;div id="pro_map_canvas"  &gt;&lt;/div&gt;</div>

<h1>3. CSS</h1>

<p>In your main stylesheet css:</p>

<div class="code">#pro_map_canvas{
    width: 100%;
    height: 360px;
    z-index: 1;
    margin-bottom: 10px;
    position: relative;
}</div>

<p>In your mobile stylesheet css:</p>

<div class="code">#pro_map_canvas{
    max-width: 100%;
    height: 300px;
    margin-bottom: 10px;
    position: relative;
}
<br />
#pro_map_canvas img{
    max-width: none;
    background: transparent;
}</div>

<p>Feel free to change width,height,z-index as you see fit. This plugin works on mobile devices any plugin based on Google Maps V2 will not display on mobile and is deprecated, so it's a good idea to update now!</p>
# --- END PLUGIN HELP ---
-->
<?php
}
?>