<?
	// Include this anywhere within your theme
	// Buttons will be set up automatically using the current page/post url and title

	global $post;
	// twitter account name
	$twitter_account = 'mattberridge';
	// related account (if applicable, if not delete '&amp;related=' from twitter href)
	$twitter_related = 'mixd';
	// get post content and urlencode it
	$browser_title_encoded = urlencode(wp_title('', false));
	$page_title_encoded = urlencode(get_the_title());
	$page_url_encoded = urlencode(get_permalink($post->ID));
?>
<ul class="share">
	<li class="share-item">
		<a class="share-link ico-facebook" href="http://www.facebook.com/sharer.php?u=<?= $page_url_encoded ?>&amp;t=<?= $browser_title_enconded ?>" rel="nofollow">Share on Facebook</a>
	</li>
	<li class="share-item">
		<a class="share-link ico-twitter" href="http://twitter.com/share?text=<?= $page_title_encoded; ?>&amp;url=<?= $page_url_encoded ?>&amp;via=<?= $twitter_account ?>&amp;related=<?= $twitter_related ?>" rel="nofollow">Share on Twitter</a>
	</li>
	<li class="share-item">
		<a class="share-link ico-google" href="http://plus.google.com/share?url=<?= $page_url_encoded ?>" rel="nofollow">Share on Google+</a>
	</li>
</ul>