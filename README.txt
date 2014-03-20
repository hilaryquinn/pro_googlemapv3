Plugin based on V3 of Google Maps, and also supports 2 markers (Or single marker, or can include more markers over 2 on request!)

Google maps API has changed from V2, you do not generate API keys based on url input anymore, you now use your existing Google account and go to Google API Console here you want to generate a browser based API key. You can generate/use a catch all API key, or define domains. You also need to enable the Maps V3 API, this should be viewable under the list of API’s available to you in the console.

Features:

    Place one or two markers on the same map
    Include custom title and description with each marker
    Google Maps V3 visible on Ipad and mobile devices, Google Maps V2 does not have this functionality. (Just shows blank space where map should be.)
    Contact me if you need to place more than 2 markers or edit the plugin code, should make sense how to do it when you look at it!

Troubleshoot:

    Info window showing white or coloured background, not rendering shadow correctly – this can be due to your existing image styling, you can use the #pro_map_canvas id to style for display issues like this

eg. <style>#pro_map_canvas img{background: transparent;}</style>

    Title styling is implemented as a h2 tag, body content wrapped with p tag, all accessible via #pro_map_canvas, style away! You can even style inside the div tag like:

<div id="pro_map_canvas" style="width:100%;height:360px;z-index:1;padding: 0; margin: 0;"></div>

    Responsive image styling messes up Google Map output, just put max-width: none; into the #pro_map_canvas id using css and this problem will be solved.
