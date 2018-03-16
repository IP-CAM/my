<?php 
		$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."setting` (`setting_id`, `store_id`, `code`, `key`, `value`, `serialized`) VALUES
		(NULL, 0, 'ncategory', 'ncategory_bnews_twitter_tags', '1', 0),
		(NULL, 0, 'ncategory', 'ncategory_bnews_facebook_tags', '1', 0),
		(NULL, 0, 'ncategory', 'ncategory_bnews_desc_length', '600', 0),
		(NULL, 0, 'ncategory', 'ncategory_bnews_headlines_url', 'blog-headlines', 0),
		(NULL, 0, 'ncategory', 'ncategory_bnews_admin_limit', '20', 0),
		(NULL, 0, 'ncategory', 'ncategory_bnews_display_elements', 'a:13:{i:0;s:4:\"name\";i:1;s:5:\"image\";i:2;s:2:\"da\";i:3;s:2:\"du\";i:4;s:6:\"author\";i:5;s:8:\"category\";i:6;s:4:\"desc\";i:7;s:6:\"button\";i:8;s:3:\"com\";i:9;s:7:\"custom1\";i:10;s:7:\"custom2\";i:11;s:7:\"custom3\";i:12;s:7:\"custom4\";}', 1),
		(NULL, 0, 'ncategory', 'ncategory_bnews_catalog_limit', '14', 0),
		(NULL, 0, 'ncategory', 'ncategory_bnews_order', '1', 0),
		(NULL, 0, 'ncategory', 'ncategory_status', '1', 0)
		");	
		
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_nauthor`
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_nauthor_description`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_ncategory`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_ncategory_description`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_ncategory_to_layout`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_ncategory_to_store`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_ncomments`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_news`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_news_archive`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_news_description`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_news_gallery`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_news_related`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_news_to_layout`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_news_to_ncategory`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_news_to_store`
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS `".DB_PREFIX ."sb_news_video`
		");

		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_archive (
						`news_archive_id` int(11) NOT NULL AUTO_INCREMENT,
						`store_id` int(3) NOT NULL,
						`year` int(4) NOT NULL,
						`months` varchar(1024) DEFAULT NULL,
						PRIMARY KEY (`news_archive_id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
		
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_ncategory (
							`ncategory_id` int(11) NOT NULL AUTO_INCREMENT,
							`image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
							`parent_id` int(11) NOT NULL DEFAULT '0',
							`top` tinyint(1) NOT NULL,
							`column` int(3) NOT NULL,
							`sort_order` int(3) NOT NULL DEFAULT '0',
							`status` tinyint(1) NOT NULL,
							`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
							`date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
							PRIMARY KEY (`ncategory_id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=59");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_ncategory_description (
							`ncategory_id` int(11) NOT NULL,
							`language_id` int(11) NOT NULL,
							`name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
							`description` text COLLATE utf8_bin NOT NULL,
							`meta_description` varchar(255) COLLATE utf8_bin NOT NULL,
							`meta_keyword` varchar(255) COLLATE utf8_bin NOT NULL,
							PRIMARY KEY (`ncategory_id`,`language_id`),
							KEY `name` (`name`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_ncategory_to_layout (
							`ncategory_id` int(11) NOT NULL,
							`store_id` int(11) NOT NULL,
							`layout_id` int(11) NOT NULL,
							PRIMARY KEY (`ncategory_id`,`store_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_ncategory_to_store (
							`ncategory_id` int(11) NOT NULL,
							`store_id` int(11) NOT NULL,
							PRIMARY KEY (`ncategory_id`,`store_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_ncomments (
							`ncomment_id` int(11) NOT NULL AUTO_INCREMENT,
							`news_id` int(11) NOT NULL,
							`language_id` int(2) NOT NULL,
							`reply_id` int(11) NOT NULL DEFAULT '0',
							`author` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
							`text` text COLLATE utf8_bin NOT NULL,
							`status` tinyint(1) NOT NULL DEFAULT '0',
							`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
							`date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
							PRIMARY KEY (`ncomment_id`),
							KEY `news_id` (`news_id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=37");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news (
							`news_id` int(11) NOT NULL AUTO_INCREMENT,
							`nauthor_id` int(11) NOT NULL,
							`status` int(1) NOT NULL DEFAULT '0',
							`image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
							`acom` int(1) NOT NULL DEFAULT '0',
							`date_added` datetime DEFAULT NULL,
							`date_updated` datetime DEFAULT NULL,
							`image2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
							`sort_order` int(11) DEFAULT NULL,
							`gal_thumb_w` int(5) NOT NULL,
							`gal_thumb_h` int(5) NOT NULL,
							`gal_popup_w` int(5) NOT NULL,
							`gal_popup_h` int(5) NOT NULL,
							`gal_slider_h` int(4) NOT NULL,
							`gal_slider_t` int(1) NOT NULL,
							`date_pub` datetime DEFAULT NULL,
							`gal_slider_w` int(4) NOT NULL,
							PRIMARY KEY (`news_id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_description (
							`news_id` int(11) NOT NULL DEFAULT '0',
							`language_id` int(11) NOT NULL DEFAULT '0',
							`title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							`ctitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							`description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
							`description2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
							`meta_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
							`meta_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
							`ntags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
							`cfield1` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							`cfield2` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							`cfield3` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							`cfield4` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							PRIMARY KEY (`news_id`,`language_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_related (
							`news_id` int(11) NOT NULL,
							`product_id` int(11) NOT NULL,
							PRIMARY KEY (`news_id`,`product_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_to_layout (
							`news_id` int(11) NOT NULL,
							`store_id` int(11) NOT NULL,
							`layout_id` int(11) NOT NULL,
							PRIMARY KEY (`news_id`,`store_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_to_ncategory (
							`news_id` int(11) NOT NULL,
							`ncategory_id` int(11) NOT NULL,
							PRIMARY KEY (`news_id`,`ncategory_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_to_store (
							`news_id` int(11) NOT NULL,
							`store_id` int(11) NOT NULL DEFAULT '0',
							PRIMARY KEY (`news_id`,`store_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_nauthor (
							`nauthor_id` int(11) NOT NULL AUTO_INCREMENT,
							`adminid` varchar(64) NOT NULL,
							`name` varchar(64) NOT NULL,
							`image` varchar(255) DEFAULT NULL,
							PRIMARY KEY (`nauthor_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_nauthor_description (
							`nauthor_id` int(11) NOT NULL,
							`language_id` int(11) NOT NULL,
							`ctitle` varchar(255) NOT NULL,
							`description` text NOT NULL,
							`meta_description` varchar(255) NOT NULL,
							`meta_keyword` varchar(255) NOT NULL,
							PRIMARY KEY (`nauthor_id`,`language_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
	$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_gallery (
						`news_image_id` int(11) NOT NULL AUTO_INCREMENT,
						`news_id` int(11) NOT NULL,
						`image` varchar(512) DEFAULT NULL,
						`text` text NOT NULL,
						`sort_order` int(3) NOT NULL DEFAULT '0',
						PRIMARY KEY (`news_image_id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
	$query = $this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_video (
						`news_video_id` int(11) NOT NULL AUTO_INCREMENT,
						`news_id` int(11) NOT NULL,
						`text` text COLLATE utf8_bin NOT NULL,
						`video` varchar(255) COLLATE utf8_bin DEFAULT NULL,
						`width` int(11) NOT NULL,
						`height` int(11) NOT NULL,
						`sort_order` int(3) NOT NULL DEFAULT '0',
						PRIMARY KEY (`news_video_id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1");
		$this->db->query('DELETE FROM '. DB_PREFIX . 'url_alias WHERE `query` = "news/headlines"');
		$this->db->query("INSERT INTO ". DB_PREFIX ."url_alias (query, keyword) VALUES ('news/headlines', 'blogspage')");
	
	
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_ncategory` (`ncategory_id`, `image`, `parent_id`, `top`, `column`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
		(59, '', 0, 0, 10, 1, 1, '2015-06-05 18:23:31', '2015-06-10 13:07:01'),
		(60, '', 0, 0, 10, 2, 1, '2015-06-05 18:23:31', '2015-06-10 13:07:01'),
		(61, '', 0, 0, 10, 3, 1, '2015-06-05 18:23:31', '2015-06-10 13:07:01'),
		(62, '', 0, 0, 10, 4, 1, '2015-06-05 18:23:31', '2015-06-10 13:07:01')
		");	
		
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_ncategory_description` (`ncategory_id`, `language_id`, `name`, `description`, `meta_description`, `meta_keyword`) VALUES
		(59, 1, 'Fashion', '', '', ''),
		(60, 1, 'Technology', '', '', ''),
		(61, 1, 'Home &amp; Life', '', '', ''),
		(62, 1, 'Hot Trends', '', '', '')
		");		
		
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_ncategory_to_layout` (`ncategory_id`, `store_id`, `layout_id`) VALUES
		(59, 0, 0),
		(60, 0, 0),
		(61, 0, 0),
		(62, 0, 0)
		");		
		
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_ncategory_to_store` (`ncategory_id`, `store_id`) VALUES
		(59, 0),
		(60, 0),
		(61, 0),
		(62, 0)
		");		
		
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_news` (`news_id`, `nauthor_id`, `status`, `image`, `acom`, `date_added`, `date_updated`, `image2`, `sort_order`, `gal_thumb_w`, `gal_thumb_h`, `gal_popup_w`, `gal_popup_h`, `gal_slider_h`, `gal_slider_t`, `date_pub`, `gal_slider_w`) VALUES
		(4, 0, 1, 0, 1, '2015-09-26 10:08:25', '2015-09-26 10:08:25', 'catalog/superstar/blog/news1.jpg', 0, 180, 270, 500, 750, 0, 0, '2015-09-26 10:08:25', 0),
		(3, 0, 1, 0, 1, '2015-09-26 10:08:25', '2015-09-26 10:08:25', 'catalog/superstar/blog/news2.jpg', 1, 150, 150, 700, 700, 0, 0, '2015-09-26 10:08:25', 0),
		(2, 0, 1, 0, 1, '2015-09-26 10:08:25', '2015-09-26 10:08:25', 'catalog/superstar/blog/news3.jpg', 2, 150, 150, 700, 700, 0, 0, '2015-09-26 10:08:25', 0),
		(1, 0, 1, 0, 1, '2015-09-26 10:08:25', '2015-09-26 10:08:25', 'catalog/superstar/blog/news4.jpg', 3, 150, 150, 700, 700, 0, 0, '2015-09-26 10:08:25', 0)
		");			
	
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_news_description` (`news_id`, `language_id`, `title`, `ctitle`, `description`, `description2`, `meta_desc`, `meta_key`, `ntags`, `cfield1`, `cfield2`, `cfield3`, `cfield4`) VALUES
		(4, 1, '10 Things to Know About Versace&prime;s Spring 2016', '', '&lt;p&gt;Who runs the world? Donatella Versace&prime;s girls, as proved by the army of miniskirt-clad and animal print-wearing women she sent out for Spring 2016. Get all the details of the celebrity-filled affair here.&lt;br&gt;&lt;br&gt;&lt;img src=&quot;http://oc.themeglobal.com/images/superstar/news1a.jpg&quot;&gt;&lt;br&gt;&lt;br&gt;1. She might have a thing for hip-hop stars, but Donatella Versace&prime;s soundtrack this season was a dance beat with a spoken-word track that kicked off with the proclamation: This song is dedicated to women everywhere regardless of color, religion, sexuality, or what sex they were born with.&lt;/p&gt;&lt;p&gt;&lt;br&gt;2. Versace muses Naomi Campbell and Heidi Klum sat front row alongside Gigi Hadid paramour Joe Jonas.&lt;/p&gt;&lt;p&gt;Who is the Versace woman? This is the fundamental question that Donatella Versace will revisit tonight, when the house&prime;s Spring 2016 show bows in Milan. In the past, the Italian designer has found inspiration in boldface names—Elizabeth Hurley, Jennifer Lopez—and other striking women with boundless confidence, but a quick glance at the runway reveals that when it comes to the backstage beauty regimens, the designer&prime;s own signature look offers a slick, high-impact statement to flatter the plunging necklines and thigh-high slits in each collection.&lt;br&gt;&lt;br&gt;It&prime;s a simple formula that has stayed constant for years, no matter the clothes. There are always swipes of pitch-black liner tightly encircling the eyes in a dramatic gesture. Sometimes there&prime;s shadow, too, pressed deep into the socket—Donatella is never seen without it—that equally complements black leather bustiers and flowing Grecian gowns. Faces are left quite bare, showcasing models&prime; sculpted cheekbones, while nude lips ground the look in nonchalance.&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '', '', 'versace, fashion, 2016, paris 2016', '', '', '', ''),
		(3, 1, 'iPhone 6s - The only thing that&prime;s changed is everything.', '', '&lt;p&gt;&lt;/p&gt;&lt;p&gt;Big screens won.For the past three years, the most meaningful change to the iPhone has been the size of its screen. After years of sticking with a 3.5-inch display and watching Android-powered competitors bite off a piece of the market with ever-larger screens, Apple relented ever-so-slightly with the 4-inch iPhone 5 and 5S, and then finally gave in to obvious trends with the much larger 4.7-inch iPhone 6 and massive 5.5-inch iPhone 6 Plus.Big screens are all people really wanted in a phone; when they couldn&prime;t get big screens from Apple, they bought big screens from Samsung, and when Apple finally put out big screens, Samsung&prime;s sales tanked.So now we have an iPhone with a big screen, with skyrocketing sales. There&prime;s no obvious reason to make it better; almost every major competitor has actually put out multiple high-end phones this year in an effort to compete and it still hasn&prime;t been enough. What&prime;s Apple&prime;s next move?Turns out that the answer isn&prime;t a taller or wider display - it&prime;s a deeper one.&lt;/p&gt;&lt;img src=&quot;http://oc.themeglobal.com/images/superstar/news2b.jpg&quot;&gt;&lt;p&gt;&lt;br&gt;That extra weight comes from 3D Touch, which is the highlight feature of the iPhone 6S. 3D Touch makes the iPhone screen pressure-sensitive, literally adding a new layer of interactions and information to iOS. The iPhone 6S is the third major Apple product line to gain pressure-sensitive touch after the Apple Watch and MacBooks introduced Force Touch, and it is by far the most successful at integrating the feature into the natural flow of the interface.&lt;/p&gt;&lt;img src=&quot;http://oc.themeglobal.com/images/superstar/news2c.jpg&quot;&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;The only other changes to the iPhone 6S really and truly worth discussing in detail are the cameras. I&prime;ve been interested in switching to Android for the better part of a year now, but there isn&prime;t a single Android phone that consistently takes great photos the way the iPhone does. Some take great photos - the Galaxy S6 and Note 6, LG G4, and Sony Xperia Z4 all have excellent cameras - but it&prime;s the consistency that matters. The iPhone takes excellent, realistic photos in virtually every situation, and no other phone comes close.&lt;/p&gt;So the new cameras on the iPhone 6S - a new 5-megapixel front-facing camera, and a 12-megapixel unit on the rear - are a big deal.&lt;p&gt;&lt;/p&gt;&lt;p&gt;Apple&prime;s also taken a great idea from Snapchat and improved it with a feature called Retina Flash: the entire screen blinks white when you take a selfie in low light, serving as a makeshift flash. Apple says it&prime;s tuned the screen backlight to go three times brighter than normal when it&prime;s flashing in this way, and it even looks at the color temperature of the scene to color-correct the screen flash in the same way the two-color LED flash on the rear of the phone works. It&prime;s neat, and it works well. You will be the monster taking selfies with a flashing white screen in the bar, but you&prime;ll be the monster with usable pictures the next day.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '', '', '', '', '', '', ''),
		(2, 1, 'Bathroom Ideas  The Ultimate Design Resource Guide', '', '&lt;p&gt;Bathrooms are one of the most popular and commonly remodeled rooms in the home. And since they are a high  traffic space (and one where updates are noticeable), doing so can have a significant effect on resale value.When starting a bathroom remodeling project think about utility as well as design. Bathrooms are often difficult jobs because multiple components must be arranged to fit  and function  in a small space. There&prime;s also multiple water elements so doing the project correctly, from plumbing to ventilation, is imperative.&lt;br&gt;&lt;br&gt;&lt;h4&gt;Walls&lt;br&gt;&lt;/h4&gt;Tile is frequently used in bathrooms for many reasons. It&prime;s aesthetically pleasing, it reflects light, it&prime;s durable, it&prime;s easy to clean and it&prime;s a simple way to freshen up the space. And options abound for bathroom tile ideas, from material to implementation. Tile halfway up the wall to create wainscoting, use classic white subway tile, tile the entire wall, create a 4  6 inch border or combine multiple style elements using whichever material you like. Using tile is more expensive than painting, however, so if you&prime;re on a budget either choose an iteration that doesn&prime;t use a lot of it or just use paint. Make sure the proper additive is mixed in with your paint color in order to keep it from getting mildewy and if you&prime;re using tile, look for stain  resistant grout (more expensive but worth the extra cost). White and off  white are the most popular bathroom color ideas and neutral colors also help make the space feel calm and fresh. Choosing a monochromatic color palette, where you base the whole color scheme off of one main color, is another popular option and will make the space feel bigger.&lt;br&gt;&lt;img src=&quot;http://oc.themeglobal.com/images/hodeco/new3a.jpg&quot;&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h4&gt;Lighting&lt;br&gt;&lt;br&gt;&lt;/h4&gt;&lt;img src=&quot;http://oc.themeglobal.com/images/hodeco/new3b.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;Selecting the proper lighting in your bathroom is important because a light, bright room will feel bigger. Good lighting can transform the space and make all other design elements pop. Unless you&prime;re particularly savvy with electrical work, leave electrical projects to professionals unless you&prime;re just swapping out a fixture. In terms of efficiency, install LED lights. They use at least 75% less energy and last 25 times longer than incandescent lighting (and won&prime;t heat up the room).&lt;/p&gt;&lt;h4&gt;Flooring&lt;br&gt;&lt;br&gt;&lt;/h4&gt;&lt;img src=&quot;http://oc.themeglobal.com/images/hodeco/new3c.jpg&quot;&gt;&lt;/p&gt;There are many options for bathroom flooring so first consider our tips for selecting a material for your floors, which will help you choose what works best for your space. In general, larger floor tiles and patterns are subtle and better for small bathrooms. If you put ceramic tile on the floor look for a grade of 1 or 2, a water absorption rating of less than 7% and a coefficient of friction above .60, which are slip resistant and stand up to water. You&prime;ll also want a more impervious tile for the floor because of exposure to water. Vinyl feels better on bare feet than ceramic tile and it&prime;s one of the more popular flooring choices due to it being inexpensive and practical (safe, easy to install and maintain). One feature that buyers are looking for in today&prime;s market is radiant heated flooring, which not only ensures warm feet in the colder months but also makes the floor dry faster, reducing the chance of slips or falls. It&prime;s also energy efficient.', '', '', '', '', '', '', '', ''),
		(1, 1, 'This Was the Summer of Dr. Scholl&prime;s', '', 'Fall may have crested the horizon, but those of us still immersed in sultry climates continue to have summer on the brain: specifically, well-ventilated footwear options for the slow slide into the new season. And while June through August typically brings with it all types of lighthearted footwear-from gladiator sandals to open-weave huaraches, moccasins and brogues, raffia-crested strappy sandals and rhinestone-emblazoned shower slides, flip-flops and block-heeled pumps and beyond-for those less inclined toward light and dainty than to heavy and happening, this summer also brought an old reliable back into the limelight: Dr. Scholl&prime;s Original sandals. What is essentially a wooden platform with anatomical footbed became the grounding force behind any number of layered ruffled looks, swinging crocheted skirts, and flared denim trousers. From a shoot with Caroline Trentini and her son, Bento (where every look bore a pair of Scholl&prime;s) to Vogue&prime;s own market department on out, it seemed that everywhere you looked this summer there was the deft clomp of a Scholl-every step, a workout for the foot (the very vision of health, as imagined back in 1904, by one Dr. William Mathias Scholl!) and every look stealthily reaping the benefit of a dose of literally elevating hippie-dippie 1970s-era crunch and charm (a clog-sandal! Imagine!) alongside a certain rudimentary simplicity. Birkenstock who? Get a pair and get ready to flex those toes until autumn really kicks in.&lt;br&gt;&lt;br&gt;&lt;img src=&quot;http://oc.themeglobal.com/images/superstar/news4a.jpg&quot;&gt;&lt;br&gt;&lt;br&gt;With her eyes almost continually covered by amorphous vintage sunglasses, it&prime;s hard to imagine anyone more qualified than stylist Catherine Baba to create a collection of shades inspired by, well, her own. I just can&prime;t take them off my face, darling! enthuses the Australian-born Parisian transplant, who studied her own flea market eyewear finds, amassed over decades (I got my first pair in Sydney as a child age ten . . . perhaps younger), for the project and is now, as you&prime;d hope, a die-hard fan. After all, if 28.6K Instagram followers covet her fashion-forward look on the street style circuit-that usually means vintage Yves Saint Laurent paired with turbans, or some elaborate piece of couture draped in a more aerodynamic way, so she can make her way around the city on a bike-it&prime;s likely there&prime;s a significant number of advocates who&prime;d throw a euro or dollar her way in order to grab a piece of the action themselves.&lt;br&gt;&lt;br&gt;', '', '', '', '', '', '', '', '')
		");		
		
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_news_gallery` (`news_image_id`, `news_id`, `image`, `text`, `sort_order`) VALUES
		(41, 4, 'catalog/superstar/blog/news1g.jpg', 'a:1:{i:1;s:0:\"\";}', 0),
		(42, 4, 'catalog/superstar/blog/news1f.jpg', 'a:1:{i:1;s:0:\"\";}', 0),
		(43, 4, 'catalog/superstar/blog/news1b.jpg', 'a:1:{i:1;s:0:\"\";}', 0),
		(44, 4, 'catalog/superstar/blog/news1c.jpg', 'a:1:{i:1;s:0:\"\";}', 0),
		(45, 4, 'catalog/superstar/blog/news1d.jpg', 'a:1:{i:1;s:0:\"\";}', 0),
		(46, 4, 'catalog/superstar/blog/news1e.jpg', 'a:1:{i:1;s:0:\"\";}', 0)
		");		
	
		
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_news_to_layout` (`news_id`, `store_id`, `layout_id`) VALUES
		(1, 0, 0),
		(2, 0, 0),
		(3, 0, 0),
		(4, 0, 0)
		");		
		
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_news_to_ncategory` (`news_id`, `ncategory_id`) VALUES
		(4, 59),
		(3, 60),
		(2, 61),
		(1, 62)
		");		
	
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_news_to_store` (`news_id`, `store_id`) VALUES
		(1, 0),
		(2, 0),
		(3, 0),
		(4, 0)
		");		
	
	$query = $this->db->query("
		INSERT INTO `".DB_PREFIX."sb_news_video` (`news_video_id`, `news_id`, `text`, `video`, `width`, `height`, `sort_order`) VALUES
		(18, 4, 'a:1:{i:1;s:37:\"Versace Fall Winter 2016 Fashion Show\";}', 'https://www.youtube.com/watch?v=jgLkgrGq2nc', 800, 450, 0),
		(19, 3, 'a:1:{i:1;s:0:\"\";}', 'https://www.youtube.com/watch?v=HpQXyELG_CI', 800, 450, 0)
		");		

?>