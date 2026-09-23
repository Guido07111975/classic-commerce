<?php
/*
 *  Author: Sean Thompson
 *  URL: OldTownWeb.com
 *  Functions and Optimization for the Classic Commerce ClassicPress Theme
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*--- Root Relative URLs ---*/

function fix_links($input) {
    return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
}

/*--- Schema

function otw_schema_markup() {
    $schema = array();
    $schema['@context'] = "https://schema.org";
    if (is_page() && !is_page( array('contact', 'custom-website', 'ecommerce-website'))) {
        $post_id = get_the_ID();
        $schema['@type']             = 'WebPage';
        $schema['headline']          = get_the_title($post_id);
        $schema['accountablePerson'] = 'Sean Thompson';
        $schema['publisher'] = array(
            "@type" => "Organization",
            "name"  => "Old Town Web llc",
            "logo"  => array(
                "@type" => "ImageObject",
                "url"   => "https://oldtownweb.com/library/logo.png"
            )
        );
        $schema['url'] = get_permalink($post_id);
        $img_url = get_the_post_thumbnail_url($post_id, 'full');
        if ($img_url) {
            $schema['thumbnailUrl'] = $img_url;
        }
    }
    if (is_front_page() && !is_paged()) {
        $schema['@type']             = 'WebSite';
        $schema['name']              = 'Old Town Web';
        $schema['accountablePerson'] = 'Sean Thompson';
        $schema['url'] = 'https://oldtownweb.com';
        $schema['thumbnailUrl'] = '/library/website-design.jpg';
        $schema['publisher'] = array(
            "@type" => "Organization",
            "name"  => "Old Town Web llc",
            "logo"  => array(
                "@type" => "ImageObject",
                "url"   => "https://oldtownweb.com/library/logo.png"
            )
        );
    }
    if (is_page('contact')) {
        $post_id = get_the_ID();
        $img_url = get_the_post_thumbnail_url($post_id, 'full');
        $schema['@type'] = 'LocalBusiness';
        $schema['mainEntityOfPage'] = array(
            "@type"             => "WebPage",
            "url"               => get_permalink($post_id),
            "name"              => get_the_title($post_id),
            "publisher"         => "Old Town Web llc",
            "accountablePerson" => "Sean Thompson",
            "thumbnailUrl"      => $img_url
        );
        $schema['name'] = "Old Town Web";
        $schema['legalName'] = 'Old Town Web llc';
        $schema['url'] = 'https://oldtownweb.com';
        $schema['logo'] = 'https://oldtownweb.com/library/logo.png';
        $schema['foundingDate'] = '2016';
        $schema['founder'] = array(
            "@type" => "Person",
            "name"  => "Sean Thompson"
        );
        $schema['contactPoint'] = array(
            "@type"       => "ContactPoint",
            "contactType" => "owner",
            "telephone"   => antispambot('570-995-2022'),
            "email"       => antispambot('sean@oldtownweb.com')
        );
        $schema['address'] = array(
            "@type"           => "PostalAddress",
            "streetAddress"   => "466 Laurel Hill Rd.",
            "addressLocality" => "Bangor",
            "addressRegion"   => "PA",
            "postalCode"      => "18013",
            "addressCountry"  => "USA"
        );
		$schema['openingHours'] = '["Mo-Sa 8:00-20:00"]';
        $schema['sameAs'] = '["https://g.page/old-town-web?gm", "https://www.bing.com/maps?q=old+town+web", "https://twitter.com/OldTownWeb"]';
    }
    if (is_page( array('custom-website', 'ecommerce-website'))) {
        $post_id = get_the_ID();
        $img_url = get_the_post_thumbnail_url($post_id, 'full');
        $schema['@type'] = 'Product';
        $schema['mainEntityOfPage'] = array(
            "@type"             => "WebPage",
            "url"               => get_permalink($post_id),
            "name"              => get_the_title($post_id),
            "publisher"         => array(
                "@type" => "Organization",
                "name"  => "Old Town Web llc",
                "logo"  => array(
                    "@type" => "ImageObject",
                    "url"   => "https://oldtownweb.com/logo.png"
                )
            ),
            "accountablePerson" => "Sean Thompson",
            "thumbnailUrl"      => $img_url
        );
        if (is_page('custom-website')) {
            $schema['description'] = 'I will design, build and optimize a superior quality website for you at an affordable price you will absolutely love.';
            $schema['name'] = 'Custom Website Designed Built and Optimized';
            $schema['image'] = 'https://oldtownweb.com/library/custom-website.jpg';
            $schema['offers'] = array(
                "@type"         => "Offer",
                "availability"  => "https://schema.org/InStock",
                "price"         => "1450",
                "priceCurrency" => "USD",
                "priceValidUntil" => "2025-12-31"
            );
            $schema['aggregateRating'] = array(
                "@type"       => "AggregateRating",
                "bestRating"  => "5",
                "worstRating" => "1",
                "ratingValue" => "5",
                "reviewCount" => "4"
            );
        }
        if (is_page('ecommerce-website')) {
            $schema['description'] = 'If you need a website to sell products or services online, I can build you a custom fully optimized online shop at an excellent price.';
            $schema['name'] = 'eCommerce Website; Sell Products or Services Online';
            $schema['image'] = 'https://oldtownweb.com/library/ecommerce-website.png';
            $schema['offers'] = array(
                "@type"         => "Offer",
                "availability"  => "https://schema.org/InStock",
                "price"         => "1950",
                "priceCurrency" => "USD",
                "priceValidUntil" => "2025-12-31"
            );
            $schema['aggregateRating'] = array(
                "@type"       => "AggregateRating",
                "bestRating"  => "5",
                "worstRating" => "1",
                "ratingValue" => "5",
                "reviewCount" => "2"
            );
        }
    }
    if (is_single()) {
        $post_id = get_the_ID();
		$category = get_the_category();
        $schema['@type'] = 'BlogPosting';
        $schema['mainEntityOfPage'] = array(
            "@type" => "WebPage",
            "@id"   => get_permalink($post_id),
			"breadcrumb" => array(
                "@type" => "BreadcrumbList",
                "itemListElement"  => array(
                    "@type" => "ListItem",
                    "position"   => "2",
                    "item"     => array(
                        "@id" => get_category_link($category),
                        "name"   => get_cat_name($category)
                    )
                )
            )
        );
        $schema['headline']      = get_the_title($post_id);
        $schema['datePublished'] = get_the_date(DATE_W3C, $post_id);
        $schema['dateModified']  = get_the_modified_date(DATE_W3C, $post_id);
        $schema['author'] = array(
            "@type" => "Person",
            "name"  => get_the_author_meta('display_name', get_post_field('post_author', $post_id)),
            "url"   => "https://oldtownweb.com/sean-thompson"
        );
        $schema['publisher'] = array(
            "@type" => "Organization",
            "name"  => "Old Town Web llc",
            "logo"  => array(
                "@type" => "ImageObject",
                "url"   => "https://oldtownweb.com/library/logo.png"
            )
        );
        $img_url = get_the_post_thumbnail_url($post_id, 'full');
        if ($img_url) {
            $schema['image'] = $img_url;
        }
    }
    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
}

/*--- Read More ---*/

function otw_excerpt_more( $more ) {
    return ' [&#8230;]';
}
add_filter( 'excerpt_more', 'otw_excerpt_more' );

/*--- Archive Pagination ---*/

function otw_pagination($pages = '', $range = 2) {
    
	$showitems = ($range * 2) + 1;
	global $paged;
	
	if(empty($paged)) $paged = 1;

  if($pages == '') {
      
		global $wp_query;
		$pages = $wp_query->max_num_pages;

		if(!$pages)
			$pages = 1;
	}

	if(1 != $pages) {
        echo ' <ul id="pagination">
        ';

	 	if($paged > 2 && $paged > $range+1 && $showitems < $pages)
			echo '
            <li><a href="'.get_pagenum_link(1).'">&laquo;First </a></li>';

	 	if($paged > 1 && $showitems < $pages)
			echo '
	        <li><a href="'.get_pagenum_link($paged - 1).'">&lsaquo;Previous </a></li>';

		for ($i=1; $i <= $pages; $i++) {
		    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				echo ($paged == $i)? '    <li>'.$i.'.. </li>' : '
		    <li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
    }
}

/*--- Custom Comment List ---*/

function otw_comment($comment, $args, $depth) {
     
    $GLOBALS['comment'] = $comment;

?>
<li>
    <article id="comment-<?php comment_ID() ?>">
        <footer>By: <?php comment_author_link(); ?> on <time datetime="<?php echo get_comment_date('Y-m-d'); ?>"><?php echo get_comment_date('F j, Y'); ?></time></footer>
        <?php if ($comment->comment_approved == '0') { ?>
            <em>Your comment is awaiting moderation.</em><br>
        <?php }
        
        comment_text(); ?>
        <div class="reply">
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
    </article>
<?php
}

/*--- Honeypot ---*/

function otw_preprocess_new_comment($commentdata) {
    
if( isset($commentdata['nickname']) ) { return; }

    return $commentdata;
}
add_filter('preprocess_comment', 'otw_preprocess_new_comment');