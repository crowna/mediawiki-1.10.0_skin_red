<?php
/**
 * MediaWikiGiz nouveau
 *
 * Translated from gwicke's previous TAL template version to remove
 * dependency on PHPTAL.
 *
 * @todo document
 * @addtogroup Skins
 * @author Jeremy Crowe
 * @version 270815_001
 * @version_mw 1.10.0
 */

if( !defined( 'MEDIAWIKI' ) )
	die( -1 );

/** */
require_once('includes/SkinTemplate.php');

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @addtogroup Skins
 */
class SkinMediaWikiGiz extends SkinTemplate {
	/** Using mediawikigiz. */
	function initPage( &$out ) {
		SkinTemplate::initPage( $out );
		$this->skinname  = 'mediawikigiz';
		$this->stylename = 'mediawikigiz';
		$this->template  = 'MediaWikiGizTemplate';
		$this->request_uri  = $_SERVER["REQUEST_URI"];
	}
}


/**
* #JC removed from template
* css and script calls {?<?php echo $GLOBALS['wgStyleVersion'] ?>} resulted in {?63}
* 
*/

/**
 * @todo document
 * @addtogroup Skins
 */
class MediaWikiGizTemplate extends QuickTemplate {
	/**
	 * Template filter callback for MediaWikiGiz skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
		global $wgUser, $wgSitename, $wgServer , $wgScriptPath;
		$skin = $wgUser->getSkin();

		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<?php $this->text('xhtmldefaultnamespace') ?>" <?php 
	foreach($this->data['xhtmlnamespaces'] as $tag => $ns) {
		?>xmlns:<?php echo "{$tag}=\"{$ns}\" ";
	} ?>xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
	<head>
		<meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
		<?php $this->html('headlinks') ?>
		<title><?php $this->text('pagetitle') ?></title>
		
		<!-- <style type="text/css" media="screen,projection"> @import "https://gc21.giz.de/ibt/eacad/area=module/style=eacad/paint=eacad/en/sys/mode/public/style/liny/css/main.css"; </style> -->
		<!-- <style type="text/css" media="screen,projection"> @import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/resources/css/main_gc21.css"; </style> -->
		<style type="text/css" media="screen,projection"> @import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/resources/css/main.css"; </style>
		
		
		<script src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/resources/javascript/jquery-1.11.3.min.js"></script>
		<script src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/resources/javascript/jquery-mw1.10.0-giz.js"></script>
		
		<link rel="stylesheet" type="text/css" <?php if(empty($this->data['printable']) ) { ?>media="print"<?php } ?> href="<?php $this->text('stylepath') ?>/common/commonPrint.css" />
		<link rel="stylesheet" type="text/css" media="handheld" href="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/resources/css/handheld.css" />
		
		
		<?php print Skin::makeGlobalVariablesScript( $this->data ); ?>
                
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath' ) ?>/common/wikibits.js"><!-- wikibits js --></script>
<?php	if($this->data['jsvarurl'  ]) { ?>
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl'  ) ?>"><!-- site js --></script>
<?php	} ?>
<?php	if($this->data['pagecss'   ]) { ?>
		<style type="text/css"><?php $this->html('pagecss'   ) ?></style>
<?php	}
		if($this->data['usercss'   ]) { ?>
		<style type="text/css"><?php $this->html('usercss'   ) ?></style>
<?php	}
		if($this->data['userjs'    ]) { ?>
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs' ) ?>"></script>
<?php	}
		if($this->data['userjsprev']) { ?>
		<script type="<?php $this->text('jsmimetype') ?>"><?php $this->html('userjsprev') ?></script>
<?php	}
		if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?>
		<!-- Head Scripts -->
<?php $this->html('headscripts') ?>
	</head>
<body <?php if($this->data['body_ondblclick']) { ?>ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
<?php if($this->data['body_onload'    ]) { ?>onload="<?php     $this->text('body_onload')     ?>"<?php } ?>
 class="mediawiki <?php $this->text('nsclass') ?> <?php $this->text('dir') ?> <?php $this->text('pageclass') ?>">
	<div id="headerbar">
		<div id="headerbar-title">
			<img id="logo-icon" alt="Media Wiki" src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/resources/images/mediawiki.gif">
			<a href="<?php echo $wgServer . $wgScriptPath ; ?>/index.php?title=Main_Page"><?php echo $wgSitename; ?></a> 
			<div id="mwgiz-search"> <?php /*--search--*/?>
				<div id="mwgiz-search-inner">
					<form action="<?php $this->text('searchaction') ?>" id="searchform">
						<input id="searchInput" name="search" type="text"<?php echo $skin->tooltipAndAccesskey('search'); if( isset( $this->data['search'] ) ) {?> value="<?php $this->text('search') ?>"<?php } ?> />
						<input type='submit' name="go" class="searchButton" id="searchGoButton"	value="<?php $this->msg('searcharticle') ?>" />&nbsp;
						<input type='submit' name="fulltext" class="searchButton" id="mw-searchButton" value="<?php $this->msg('searchbutton') ?>" />
					</form>
				</div>
			</div>
		</div>
		<div id="mwgiz-menu" class="dropper" style="display: block;">
			<div id="mwgiz-menu-inner">
				<div id="menu-head">
					<div id="tabnav">
						<?php foreach ($this->data['sidebar'] as $bar => $cont) { ?>
						<a href="#head-<?php echo Sanitizer::escapeId($bar) ?>"><?php $out = wfMsg( $bar ); if (wfEmptyMsg($bar, $out)) echo $bar; else echo $out; ?></a>
						<?php } ?>
						<a href="#head-actions">Actions</a>
						<a href="#head-personal"><?php $this->msg('personaltools') ?></a>
						<a href="#head-toolbox"><?php $this->msg('toolbox') ?></a>
						<?php if( $this->data['language_urls'] ) { ?> <a href="#head-lang"><?php $this->msg('otherlanguages') ?></a> <?php } ?>
					</div>
					<?php foreach ($this->data['sidebar'] as $bar => $cont) { ?>
					<ul id="head-<?php echo Sanitizer::escapeId($bar) ?>" style="display: none;">
						<?php foreach($cont as $key => $val) { ?> <?php /*--navigation-- this a loop through simalar objects*/?>
						<li id="<?php echo Sanitizer::escapeId($val['id']) ?>"<?php
							if ( $val['active'] ) { ?> class="active" <?php }
						?>><a href="<?php echo htmlspecialchars($val['href']) ?>"<?php echo $skin->tooltipAndAccesskey($val['id']) ?>><?php echo htmlspecialchars($val['text']) ?></a></li>
						<?php } ?>
					</ul>
					<?php } ?>
					<ul id="head-actions" style="display: none;"> <?php /*--page Actions--*/?>
						<?php foreach($this->data['content_actions'] as $key => $tab) { ?>
						 <li id="ca-<?php echo Sanitizer::escapeId($key) ?>"<?php
								if($tab['class']) { ?> class="<?php echo htmlspecialchars($tab['class']) ?>"<?php }
							 ?>><a href="<?php echo htmlspecialchars($tab['href']) ?>"<?php echo $skin->tooltipAndAccesskey('ca-'.$key) ?>><?php
							 echo htmlspecialchars($tab['text']) ?></a></li>
						<?php } ?>
					</ul>
					<ul id="head-personal" style="display: none;"> 
						<?php foreach($this->data['personal_urls'] as $key => $item) { ?> <?php /*--personaltools--*/?>
						<li id="pt-<?php echo Sanitizer::escapeId($key) ?>"<?php
							if ($item['active']) { ?> class="active"<?php } ?>><a href="<?php
						echo htmlspecialchars($item['href']) ?>"<?php echo $skin->tooltipAndAccesskey('pt-'.$key) ?><?php
						if(!empty($item['class'])) { ?> class="<?php
						echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php
						echo htmlspecialchars($item['text']) ?></a></li>
						<?php } ?>
					</ul>
					<ul id="head-toolbox" style="display: none;"><?php /*--toolbox--*/?>
		<?php if($this->data['notspecialpage']) { ?>
						<li id="t-whatlinkshere"><a href="<?php
						echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href'])
						?>"<?php echo $skin->tooltipAndAccesskey('t-whatlinkshere') ?>><?php $this->msg('whatlinkshere') ?></a></li>
		<?php if( $this->data['nav_urls']['recentchangeslinked'] ) { ?>
						<li id="t-recentchangeslinked"><a href="<?php
						echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href'])
						?>"<?php echo $skin->tooltipAndAccesskey('t-recentchangeslinked') ?>><?php $this->msg('recentchangeslinked') ?></a></li>
		<?php 		}
				}
				if(isset($this->data['nav_urls']['trackbacklink'])) { ?>
					<li id="t-trackbacklink"><a href="<?php
						echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href'])
						?>"<?php echo $skin->tooltipAndAccesskey('t-trackbacklink') ?>><?php $this->msg('trackbacklink') ?></a></li>
		<?php 	}
				if($this->data['feeds']) { ?>
					<li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) {
							?><span id="feed-<?php echo Sanitizer::escapeId($key) ?>"><a href="<?php
							echo htmlspecialchars($feed['href']) ?>"<?php echo $skin->tooltipAndAccesskey('feed-'.$key) ?>><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;</span>
							<?php } ?></li><?php
				}
				foreach( array('contributions', 'blockip', 'emailuser', 'upload', 'specialpages') as $special ) {

					if($this->data['nav_urls'][$special]) {
						?><li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href'])
						?>"<?php echo $skin->tooltipAndAccesskey('t-'.$special) ?>><?php $this->msg($special) ?></a></li>
		<?php		}
				}

				if(!empty($this->data['nav_urls']['print']['href'])) { ?>
						<li id="t-print"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href'])
						?>"<?php echo $skin->tooltipAndAccesskey('t-print') ?>><?php $this->msg('printableversion') ?></a></li><?php
				}

				if(!empty($this->data['nav_urls']['permalink']['href'])) { ?>
						<li id="t-permalink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href'])
						?>"<?php echo $skin->tooltipAndAccesskey('t-permalink') ?>><?php $this->msg('permalink') ?></a></li><?php
				} elseif ($this->data['nav_urls']['permalink']['href'] === '') { ?>
						<li id="t-ispermalink"<?php echo $skin->tooltip('t-ispermalink') ?>><?php $this->msg('permalink') ?></li><?php
				}

				wfRunHooks( 'MediaWikiGizTemplateToolboxEnd', array( &$this ) );
		?>
					</ul>
				<?php if( $this->data['language_urls'] ) { ?>
					<ul id="head-lang" style="display: none;">
		<?php		foreach($this->data['language_urls'] as $langlink) { ?>
						<li class="<?php echo htmlspecialchars($langlink['class'])?>"><?php
						?><a href="<?php echo htmlspecialchars($langlink['href']) ?>"><?php echo $langlink['text'] ?></a></li>
		<?php		} ?>
					</ul>
				<?php	} ?>
				</div>
			</div>
		</div><!-- end of the left (by default at least) column -->
	</div>
	
<!-- 	<div id="drop-fade"><a id="searchopen" class="top" href="#">Search</a></div> -->
	<div class="content">
		<div class="post">
			<?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>
			<h2 class="firstHeading"><?php $this->data['displaytitle']!=""?$this->html('title'):$this->text('title') ?></h2>
			<h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
			<hr>
			<div class="clearer"></div>
			<div class="mainentry mw-body">
				<div id="mw-content-text" class="mw-content-ltr" lang="en" dir="ltr">
					<div id="contentSub"><?php $this->html('subtitle') ?></div>
					<?php if($this->data['undelete']) { ?><div id="contentSub2"><?php     $this->html('undelete') ?></div><?php } ?>
					<?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
					<?php if($this->data['showjumplinks']) { ?><div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div><?php } ?>
					<!-- start content -->
					<?php $this->html('bodytext') ?>
					<?php if($this->data['catlinks']) { ?><div id="catlinks"><?php       $this->html('catlinks') ?></div><?php } ?>
					<!-- end content -->
				</div>
			</div>
		</div>
	</div>
	<div class="cleared"></div>
	<div class="visualClear"></div>
<?php 
	//footer
	
	echo '	<div id="footer">';
	/*
	if($this->data['poweredbyico'])
	echo '		<div id="f-poweredbyico">'.$this->html('poweredbyico') .'</div>';

	if($this->data['copyrightico']) 
	echo '		<div id="f-copyrightico">'. $this->html('copyrightico') .'</div>';
	*/
	// Generate additional footer links
	echo '		<ul id="f-list">';

	//$footerlinks = array('lastmod', 'viewcount', 'numberofwatchingusers', 'credits', 'copyright','privacy', 'about', 'disclaimer', 'tagline',);
	$footerlinks = array( 'copyright','privacy', 'about', 'disclaimer', 'tagline',);
	foreach( $footerlinks as $aLink ) {
		if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) 
			echo '			<li id="'.$aLink.'">'; $this->html($aLink); echo '</li>';
	}

	echo '		<li id="design">Design by <a href="http://crowna.co.nz" target="_blank">Crowna</a> for GIZ</li></ul>
	</div>';
	
	?>	
	<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>

<?php $this->html('reporttime') ?>
<?php if ( $this->data['debug'] ): ?>
<!-- Debug output:
<?php $this->text( 'debug' ); ?>

-->
<?php endif; ?>
</body></html>
<?php
	wfRestoreWarnings();
	} // end of execute() method
} // end of class
?><?php /**#jc
	<div class="portlet" id="p-logo">
		<a style="background-image: url(<?php $this->text('logopath') ?>);" <?php
			?>href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>"<?php
			echo $skin->tooltipAndAccesskey('n-mainpage') ?>></a>
	</div>  **/  ?>
