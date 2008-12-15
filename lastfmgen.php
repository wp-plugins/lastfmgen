<?php
/*
Plugin Name: LastFmGen
Plugin URI: http://lastfmgen.web44.net
Description: Last Fm Audio Embed Code Generator
Author: Roto (Script), Fira (Plugin)
Version: 0.3
Author URI: http://leafblade.net
*/ 

/*  Copyright 2008  Fira  (email : info@leafblade.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists('lfm_lastfmgen')) {
    class lfm_lastfmgen	{

		
		/**
		* PHP 4 Compatible Constructor
		*/
		function lfm_lastfmgen(){$this->__construct();}
		
		/**
		* PHP 5 Constructor
		*/		
		function __construct(){


		add_action("admin_menu", array(&$this,"add_admin_pages"));


		}
		

		function add_admin_pages(){
				add_submenu_page('index.php', "LastFmGen", "LastFmGen", 10, "LastFmGen", array(&$this,"output_sub_admin_page_2"));
		}
		
		/**
		* Outputs the HTML for the admin sub page.
		*/
		function output_sub_admin_page_2(){
			?>
			<div class="wrap">


<?php
echo '<h3>LastFmGen</h3><hr><form method="post" action="' . $PHP_SELF . '"><br />';      
echo 'Enter Last Fm Song URL <input type="text" size="140" maxlength="255" name="url"><br />';
echo '<input type="submit" value="Generate" name="submit"></form><br />';

if (isset($_POST['submit']))
{
    $content = file_get_contents($_POST['url']);
    if ($content !== false)
    {
        $pattern = '/"id":"(\d+)","type"/';
        preg_match($pattern,$content, $matches);
        echo '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="13" height="13" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"><param name="allowScriptAccess" value="sameDomain" /><param name="FlashVars" value="resourceID=' . $matches[1] . '&flp=true" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="src" value="http://static.last.fm/webclient/inline/6/inlinePlayer.swf";; /><embed type="application/x-shockwave-flash" width="13" height="13" src="http://static.last.fm/webclient/inline/6/inlinePlayer.swf";; bgcolor="#ffffff" quality="high" flashvars="resourceID=' . $matches[1] . '&flp=true" allowscriptaccess="sameDomain"></embed></object> <b>- Preview Song</b><br />';
        echo "id: $matches[1]<br />";
        echo '<textarea rows="10" cols="100" name="results" wrap="physical"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="13" height="13" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"><param name="allowScriptAccess" value="sameDomain" /><param name="FlashVars" value="resourceID=' . $matches[1] . '&flp=true" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="src" value="http://static.last.fm/webclient/inline/6/inlinePlayer.swf";; /><embed type="application/x-shockwave-flash" width="13" height="13" src="http://static.last.fm/webclient/inline/6/inlinePlayer.swf";; bgcolor="#ffffff" quality="high" flashvars="resourceID=' . $matches[1] . '&flp=true" allowscriptaccess="sameDomain"></embed></object></textarea>'; 
echo '<hr>Script by <b>Roto</b>, Plugin by <a href="http://leafblade.net">Fira</a><br /><hr>';   
    }
    else
    {
         echo "EPIC PHAIL!!! (No song at this URL)\n";
    }
}
?>                              
                           
			</div>

<div class="wrap">
<P><P><h3>Leave a comment on the Last.Fm-Gen website :</h1><P><P>

<form action="http://lastfmgen.web44.net/lastfmgen/wp-comments-post.php" method="post" id="commentform">
                            <p>

                <input type="text" name="author" id="author" value="" size="22" tabindex="1" class="form-text"/>
                <label for="author"><small>Name </small></label>
              </p>
              <p>
                <input type="text" name="email" id="email" value="" size="22" tabindex="2" class="form-text"/>
                <label for="email"><small>Mail (will not be published) </small></label>
              </p>
              <p>

                <input type="text" name="url" id="url" value="" size="22" tabindex="3" class="form-text"/>
                <label for="url"><small>Website</small></label>
              </p>
                            <p><textarea name="comment" id="comment" cols="50%" rows="10" tabindex="4" class="form-textarea"></textarea></p>
              <p>
                <input name="submit" type="submit" id="submit" tabindex="5" value="Comment now" class="form-submit"/>
                <input type="hidden" name="comment_post_ID" value="4" />
              </p>

              <script src="http://lastfmgen.web44.net/?live-comment-preview.js" type="text/javascript"></script><div id="commentPreview"></div>            </form></div>



			<?php
		} 

    }
}

//instantiate the class
if (class_exists('lfm_lastfmgen')) {
	$lfm_lastfmgen = new lfm_lastfmgen();
}







?>

