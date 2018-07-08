<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="view/javascript/tableedit.js"></script>
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="view/javascript/bootstrap/less/bootstrap.less" rel="stylesheet/less" />
<script src="view/javascript/bootstrap/less-1.7.4.min.js"></script>
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<script src="view/javascript/jquery/datetimepicker/moment.js" type="text/javascript"></script>
<script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" type="text/css" href="view/stylesheet/tableedit.css" />
<?php foreach ($styles as $style) { ?>
<link type="text/css" href="<?php echo $style['href']; ?>" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
</head>
<body>


<script type="text/javascript">

// jQuery multiSelect 1.2.2 beta

jQuery(document).ready(function() {

	// render the html for a single option

	function renderOption(id, option)

	{

		var html = '<label><input type="checkbox" name="' + id + '[]" value="' + option.value + '"';

		if( option.selected ){

			html += ' checked="checked"';

		}

		html += ' />' + option.text + '</label>';

		

		return html;

	}

	

	// render the html for the options/optgroups

	function renderOptions(id, options, o)

	{

		var html = "";

		

		for(var i = 0; i < options.length; i++) {

			if(options[i].optgroup) {

				html += '<label class="optGroup">';

				

				if(o.optGroupSelectable) {

					html += '<input type="checkbox" class="optGroup" />' + options[i].optgroup;

				}

				else {

					html += options[i].optgroup;

				}

				

				html += '</label><div class="optGroupContainer">';

				

				html += renderOptions(id, options[i].options, o);

				

				html += '</div>';

			}

			else {

				html += renderOption(id, options[i]);

			}

		}

		

		return html;

	}

	

	// Building the actual options

	function buildOptions(options)

	{

		var multiSelect = jQuery(this);

		var multiSelectOptions = multiSelect.next('.multiSelectOptions');

		var o = multiSelect.data("config");

		var callback = multiSelect.data("callback");



		// clear the existing options

		multiSelectOptions.html("");

		var html = "";



		// if we should have a select all option then add it

		if( o.selectAll ) {

			html += '<label class="selectAll"><input type="checkbox" class="selectAll" />' + o.selectAllText + '</label>';

		}



		// generate the html for the new options

		html += renderOptions(multiSelect.attr('id'), options, o);

		

		multiSelectOptions.html(html);

		

		// variables needed to account for width changes due to a scrollbar

		var initialWidth = multiSelectOptions.width();

		var hasScrollbar = false;

		

		// set the height of the dropdown options

		if(multiSelectOptions.height() > o.listHeight) {

			multiSelectOptions.css("height", o.listHeight + 'px');

			hasScrollbar = true;

		} else {

			multiSelectOptions.css("height", '');

		}

		

		// if the there is a scrollbar and the browser did not already handle adjusting the width (i.e. Firefox) then we will need to manaually add the scrollbar width

		var scrollbarWidth = hasScrollbar && (initialWidth == multiSelectOptions.width()) ? 17 : 0;



		// set the width of the dropdown options

		if((multiSelectOptions.width() + scrollbarWidth) < multiSelect.outerWidth()) {

			multiSelectOptions.css("width", multiSelect.outerWidth() - 2/*border*/ + 'px');

		} else {

			multiSelectOptions.css("width", (multiSelectOptions.width() + scrollbarWidth) + 'px');

		}

		

		// Apply bgiframe if available on IE6

		if( jQuery.fn.bgiframe ) multiSelect.next('.multiSelectOptions').bgiframe( { width: multiSelectOptions.width(), height: multiSelectOptions.height() });



		// Handle selectAll oncheck

		if(o.selectAll) {

			multiSelectOptions.find('INPUT.selectAll').click( function() {

				// update all the child checkboxes

				multiSelectOptions.find('INPUT:checkbox').attr('checked', jQuery(this).attr('checked')).parent("LABEL").toggleClass('checked', jQuery(this).attr('checked'));

			});

		}

		

		// Handle OptGroup oncheck

		if(o.optGroupSelectable) {

			multiSelectOptions.addClass('optGroupHasCheckboxes');

		

			multiSelectOptions.find('INPUT.optGroup').click( function() {

				// update all the child checkboxes

				jQuery(this).parent().next().find('INPUT:checkbox').attr('checked', jQuery(this).attr('checked')).parent("LABEL").toggleClass('checked', jQuery(this).attr('checked'));

			});

		}

		

		// Handle all checkboxes

		multiSelectOptions.find('INPUT:checkbox').click( function() {

			// set the label checked class

			jQuery(this).parent("LABEL").removeClass('checked', jQuery(this).attr('checked'));

			

			updateSelected.call(multiSelect);

			multiSelect.focus();

			if(jQuery(this).parent().parent().hasClass('optGroupContainer')) {

				updateOptGroup.call(multiSelect, jQuery(this).parent().parent().prev());

			}

			if( callback ) {

				callback(jQuery(this));

			}

		});

		

		// Initial display

		multiSelectOptions.each( function() {

			jQuery(this).find('INPUT:checked').parent().toggleClass('checked');

		});

		

		// Initialize selected and select all 

		updateSelected.call(multiSelect);

		

		// Initialize optgroups

		if(o.optGroupSelectable) {

			multiSelectOptions.find('LABEL.optGroup').each( function() {

				updateOptGroup.call(multiSelect, jQuery(this));

			});

		}

		

		// Handle hovers

		multiSelectOptions.find('LABEL:has(INPUT)').hover( function() {

			jQuery(this).parent().find('LABEL').removeClass('hover');

			jQuery(this).addClass('hover');

		}, function() {

			jQuery(this).parent().find('LABEL').removeClass('hover');

		});

		

		// Keyboard

		multiSelect.keydown( function(e) {

		

			var multiSelectOptions = jQuery(this).next('.multiSelectOptions');



			// Is dropdown visible?

			if( multiSelectOptions.css('visibility') != 'hidden' ) {

				// Dropdown is visible

				// Tab

				if( e.keyCode == 9 ) {

					jQuery(this).addClass('focus').trigger('click'); // esc, left, right - hide

					jQuery(this).focus().next(':input').focus();

					return true;

				}

				

				// ESC, Left, Right

				if( e.keyCode == 27 || e.keyCode == 37 || e.keyCode == 39 ) {

					// Hide dropdown

					jQuery(this).addClass('focus').trigger('click');

				}

				// Down || Up

				if( e.keyCode == 40 || e.keyCode == 38) {

					var allOptions = multiSelectOptions.find('LABEL');

					var oldHoverIndex = allOptions.index(allOptions.filter('.hover'));

					var newHoverIndex = -1;

					

					// if there is no current highlighted item then highlight the first item

					if(oldHoverIndex < 0) {

						// Default to first item

						multiSelectOptions.find('LABEL:first').addClass('hover');

					}

					// else if we are moving down and there is a next item then move

					else if(e.keyCode == 40 && oldHoverIndex < allOptions.length - 1)

					{

						newHoverIndex = oldHoverIndex + 1;

					}

					// else if we are moving up and there is a prev item then move

					else if(e.keyCode == 38 && oldHoverIndex > 0)

					{

						newHoverIndex = oldHoverIndex - 1;

					}



					if(newHoverIndex >= 0) {

						jQuery(allOptions.get(oldHoverIndex)).removeClass('hover'); // remove the current highlight

						jQuery(allOptions.get(newHoverIndex)).addClass('hover'); // add the new highlight

						

						// Adjust the viewport if necessary

						adjustViewPort(multiSelectOptions);

					}

					

					return false;

				}



				// Enter, Space

				if( e.keyCode == 13 || e.keyCode == 32 ) {

					var selectedCheckbox = multiSelectOptions.find('LABEL.hover INPUT:checkbox');

					

					// Set the checkbox (and label class)

					selectedCheckbox.attr('checked', !selectedCheckbox.attr('checked')).parent("LABEL").toggleClass('checked', selectedCheckbox.attr('checked'));

					

					// if the checkbox was the select all then set all the checkboxes

					if(selectedCheckbox.hasClass("selectAll")) {

						multiSelectOptions.find('INPUT:checkbox').attr('checked', selectedCheckbox.attr('checked')).parent("LABEL").addClass('checked').toggleClass('checked', selectedCheckbox.attr('checked')); 

					}



					updateSelected.call(multiSelect);

					

					if( callback ) callback(jQuery(this));

					return false;

				}



				// Any other standard keyboard character (try and match the first character of an option)

				if( e.keyCode >= 33 && e.keyCode <= 126 ) {

					// find the next matching item after the current hovered item

					var match = multiSelectOptions.find('LABEL:startsWith(' + String.fromCharCode(e.keyCode) + ')');

					

					var currentHoverIndex = match.index(match.filter('LABEL.hover'));

					

					// filter the set to any items after the current hovered item

					var afterHoverMatch = match.filter(function (index) {

						return index > currentHoverIndex;

					});



					// if there were no item after the current hovered item then try using the full search results (filtered to the first one)

					match = (afterHoverMatch.length >= 1 ? afterHoverMatch : match).filter("LABEL:first");



					if(match.length == 1) {

						// if we found a match then move the hover

						multiSelectOptions.find('LABEL.hover').removeClass('hover');								

						match.addClass('hover');

						

						adjustViewPort(multiSelectOptions);

					}

				}

			} else {

				// Dropdown is not visible

				if( e.keyCode == 38 || e.keyCode == 40 || e.keyCode == 13 || e.keyCode == 32 ) { //up, down, enter, space - show

					// Show dropdown

					jQuery(this).removeClass('focus').trigger('click');

					multiSelectOptions.find('LABEL:first').addClass('hover');

					return false;

				}

				//  Tab key

				if( e.keyCode == 9 ) {

					// Shift focus to next INPUT element on page

					multiSelectOptions.next(':input').focus();

					return true;

				}

			}

			// Prevent enter key from submitting form

			if( e.keyCode == 13 ) return false;

		});

	}

	

	// Adjust the viewport if necessary

	function adjustViewPort(multiSelectOptions)

	{

		// check for and move down

		var selectionBottom = multiSelectOptions.find('LABEL.hover').position().top + multiSelectOptions.find('LABEL.hover').outerHeight();

		

		if(selectionBottom > multiSelectOptions.innerHeight()){		

			multiSelectOptions.scrollTop(multiSelectOptions.scrollTop() + selectionBottom - multiSelectOptions.innerHeight());

		}

		

		// check for and move up						

		if(multiSelectOptions.find('LABEL.hover').position().top < 0){		

			multiSelectOptions.scrollTop(multiSelectOptions.scrollTop() + multiSelectOptions.find('LABEL.hover').position().top);

		}

	}

	

	// Update the optgroup checked status

	function updateOptGroup(optGroup)

	{

		var multiSelect = jQuery(this);

		var o = multiSelect.data("config");

		

		// Determine if the optgroup should be checked

		if(o.optGroupSelectable) {

			var optGroupSelected = true;

			jQuery(optGroup).next().find('INPUT:checkbox').each( function() {

				if( !jQuery(this).attr('checked') ) {

					optGroupSelected = false;

					return false;

				}

			});

			

			jQuery(optGroup).find('INPUT.optGroup').attr('checked', optGroupSelected).parent("LABEL").toggleClass('checked', optGroupSelected);

		}

	}

	

	// Update the textbox with the total number of selected items, and determine select all

	function updateSelected() {

		var multiSelect = jQuery(this);

		var multiSelectOptions = multiSelect.next('.multiSelectOptions');

		var o = multiSelect.data("config");

		

		var i = 0;

		var selectAll = true;

		var display = '';

		multiSelectOptions.find('INPUT:checkbox').not('.selectAll, .optGroup').each( function() {

			if( jQuery(this).attr('checked') ) {

				i++;

				display = display + jQuery(this).parent().text() + ', ';

			}

			else selectAll = false;

		});

		

		// trim any end comma and surounding whitespace

		display = display.replace(/\s*\,\s*$/,'');

		

		if( i == 0 ) {

			multiSelect.find("span").html( o.noneSelected );

		} else {

			if( o.oneOrMoreSelected == '*' ) {

				multiSelect.find("span").html( display );

				multiSelect.attr( "title", display );

			} else {

				multiSelect.find("span").html( o.oneOrMoreSelected.replace('%', i) );

			}

		}



		// Determine if Select All should be checked

		if(o.selectAll) {

			multiSelectOptions.find('INPUT.selectAll').attr('checked', selectAll).parent("LABEL").toggleClass('checked', selectAll);

		}

	}

	

	jQuery.extend(jQuery.fn, {

		multiSelect: function(o, callback) {

			// Default options

			if( !o ) o = {};

			if( o.selectAll == undefined ) o.selectAll = false;

			if( o.selectAllText == undefined ) o.selectAllText = "Select All";

			if( o.noneSelected == undefined ) o.noneSelected = 'Select Options';

			if( o.oneOrMoreSelected == undefined ) o.oneOrMoreSelected = '% Selected';

			if( o.optGroupSelectable == undefined ) o.optGroupSelectable = false;

			if( o.listHeight == undefined ) o.listHeight = 150;



			// Initialize each multiSelect

			jQuery(this).each( function() {

				var select = jQuery(this);

				var html = '<a href="javascript:;" class="multiSelect"><span></span></a>';

				html += '<div class="multiSelectOptions" style="position: absolute; z-index: 99; visibility: hidden;"></div>';

				jQuery(select).after(html);

				

				var multiSelect = jQuery(select).next('.multiSelect');

				var multiSelectOptions = multiSelect.next('.multiSelectOptions');

				

				// if the select object had a width defined then match the new multilsect to it

				multiSelect.find("span").css("width", jQuery(select).width() + 'px');

				

				// Attach the config options to the multiselect

				multiSelect.data("config", o);

				

				// Attach the callback to the multiselect

				multiSelect.data("callback", callback);

				

				// Serialize the select options into json options

				var options = [];

				jQuery(select).children().each( function() {

					if(this.tagName.toUpperCase() == 'OPTGROUP')

					{

						var suboptions = [];

						options.push({ optgroup: jQuery(this).attr('label'), options: suboptions });

						

						jQuery(this).children('OPTION').each( function() {

							if( jQuery(this).val() != '' ) {

								suboptions.push({ text: jQuery(this).html(), value: jQuery(this).val(), selected: jQuery(this).attr('selected') });

							}

						});

					}

					else if(this.tagName.toUpperCase() == 'OPTION')

					{

						if( jQuery(this).val() != '' ) {

							options.push({ text: jQuery(this).html(), value: jQuery(this).val(), selected: jQuery(this).attr('selected') });

						}

					}

				});

				

				// Eliminate the original form element

				jQuery(select).remove();

				

				// Add the id that was on the original select element to the new input

				multiSelect.attr("id", jQuery(select).attr("id"));

				

				// Build the dropdown options

				buildOptions.call(multiSelect, options);



				// Events

				multiSelect.hover( function() {

					jQuery(this).addClass('hover');

				}, function() {

					jQuery(this).removeClass('hover');

				}).click( function() {

					// Show/hide on click

					if( jQuery(this).hasClass('active') ) {

						jQuery(this).multiSelectOptionsHide();

					} else {

						jQuery(this).multiSelectOptionsShow();

					}

					return false;

				}).focus( function() {

					// So it can be styled with CSS

					jQuery(this).addClass('focus');

				}).blur( function() {

					// So it can be styled with CSS

					jQuery(this).removeClass('focus');

				});

				

				// Add an event listener to the window to close the multiselect if the user clicks off

				jQuery(document).click( function(event) {

					// If somewhere outside of the multiselect was clicked then hide the multiselect

					if(!(jQuery(event.target).parents().andSelf().is('.multiSelectOptions'))){

						multiSelect.multiSelectOptionsHide();

					}

				});

			});

		},

		

		// Update the dropdown options

		multiSelectOptionsUpdate: function(options) {

			buildOptions.call(jQuery(this), options);

		},

		

		// Hide the dropdown

		multiSelectOptionsHide: function() {

			jQuery(this).removeClass('active').removeClass('hover').next('.multiSelectOptions').css('visibility', 'hidden');

		},

		

		// Show the dropdown

		multiSelectOptionsShow: function() {

			var multiSelect = jQuery(this);

			var multiSelectOptions = multiSelect.next('.multiSelectOptions');

			var o = multiSelect.data("config");

		

			// Hide any open option boxes

			jQuery('.multiSelect').multiSelectOptionsHide();

			multiSelectOptions.find('LABEL').removeClass('hover');

			multiSelect.addClass('active').next('.multiSelectOptions').css('visibility', 'visible');

			multiSelect.focus();

			

			// reset the scroll to the top

			multiSelect.next('.multiSelectOptions').scrollTop(0);



			// Position it

			var offset = multiSelect.position();

			multiSelect.next('.multiSelectOptions').css({ top:  offset.top + jQuery(this).outerHeight() + 'px' });

			multiSelect.next('.multiSelectOptions').css({ left: offset.left + 'px' });

		},

		

		// get a coma-delimited list of selected values

		selectedValuesString: function() {

			var selectedValues = "";

			jQuery(this).next('.multiSelectOptions').find('INPUT:checkbox:checked').not('.optGroup, .selectAll').each(function() {

				selectedValues += jQuery(this).attr('value') + ",";

			});

			// trim any end comma and surounding whitespace

			return selectedValues.replace(/\s*\,\s*$/,'');

		}		

	});

	

	// add a new ":startsWith" search filter

	jQuery.expr[":"].startsWith = function(el, i, m) {

		var search = m[3];        

		if (!search) return false;

		return eval("/^[/s]*" + search + "/i").test(jQuery(el).text());

	};	

});

</script>

<script type="text/javascript">

// jQuery paging plugin v1.1.0

(function(k,p,n){k.fn.paging=function(v,w){var t=this,s={setOptions:function(b){this.a=k.extend(this.a||{lapping:0,perpage:10,page:1,refresh:{interval:10,url:null},format:"",onFormat:function(){},onSelect:function(){return!0},onRefresh:function(){}},b||{});this.a.lapping|=0;this.a.perpage|=0;this.a.page|=0;1>this.a.perpage&&(this.a.perpage=10);this.k&&p.clearInterval(this.k);this.a.refresh.url&&(this.k=p.setInterval(function(b){k.ajax({url:b.a.refresh.url,success:function(g){if("string"===typeof g)try{g=

k.parseJSON(g)}catch(f){return}b.a.onRefresh(g)}})},1E3*this.a.refresh.interval,this));this.l=function(b){for(var g=0,f=0,h=1,d={e:[],h:0,g:0,b:5,d:3,j:0,m:0},a,l=/[*<>pq\[\]().-]|[nc]+!?/g,k={"[":"first","]":"last","<":"prev",">":"next",q:"left",p:"right","-":"fill",".":"leap"},e={};a=l.exec(b);){a=""+a;if(n===k[a])if("("===a)f=++g;else if(")"===a)f=0;else{if(h){if("*"===a){d.h=1;d.g=0}else{d.h=0;d.g="!"===a.charAt(a.length-1);d.b=a.length-d.g;if(!(d.d=1+a.indexOf("c")))d.d=1+d.b>>1}d.e[d.e.length]=

{f:"block",i:0,c:0};h=0}}else{d.e[d.e.length]={f:k[a],i:f,c:n===e[a]?e[a]=1:++e[a]};"q"===a?++d.m:"p"===a&&++d.j}}return d}(this.a.format);return this},setNumber:function(b){this.o=n===b||0>b?-1:b;return this},setPage:function(b){function q(b,a,c){c=""+b.onFormat.call(a,c);l=a.value?l+c.replace("<a",'<a data-page="'+a.value+'"'):l+c}if(n===b){if(b=this.a.page,null===b)return this}else if(this.a.page==b)return this;this.a.page=b|=0;var g=this.o,f=this.a,h,d,a,l,r=1,e=this.l,c,i,j,m,u=e.e.length,o=

u;f.perpage<=f.lapping&&(f.lapping=f.perpage-1);m=g<=f.lapping?0:f.lapping|0;0>g?(a=g=-1,h=Math.max(1,b-e.d+1-m),d=h+e.b):(a=1+Math.ceil((g-f.perpage)/(f.perpage-m)),b=Math.max(1,Math.min(0>b?1+a+b:b,a)),e.h?(h=1,d=1+a,e.d=b,e.b=a):(h=Math.max(1,Math.min(b-e.d,a-e.b)+1),d=e.g?h+e.b:Math.min(h+e.b,1+a)));for(;o--;){i=0;j=e.e[o];switch(j.f){case "left":i=j.c<h;break;case "right":i=d<=a-e.j+j.c;break;case "first":i=e.d<b;break;case "last":i=e.b<e.d+a-b;break;case "prev":i=1<b;break;case "next":i=b<a}r|=

i<<j.i}c={number:g,lapping:m,pages:a,perpage:f.perpage,page:b,slice:[(i=b*(f.perpage-m)+m)-f.perpage,Math.min(i,g)]};for(l="";++o<u;){j=e.e[o];i=r>>j.i&1;switch(j.f){case "block":for(;h<d;++h)c.value=h,c.pos=1+e.b-d+h,c.active=h<=a||0>g,c.first=1===h,c.last=h==a&&0<g,q(f,c,j.f);continue;case "left":c.value=j.c;c.active=j.c<h;break;case "right":c.value=a-e.j+j.c;c.active=d<=c.value;break;case "first":c.value=1;c.active=i&&1<b;break;case "prev":c.value=Math.max(1,b-1);c.active=i&&1<b;break;case "last":(c.active=

0>g)?c.value=1+b:(c.value=a,c.active=i&&b<a);break;case "next":(c.active=0>g)?c.value=1+b:(c.value=Math.min(1+b,a),c.active=i&&b<a);break;case "leap":case "fill":c.pos=j.c;c.active=i;q(f,c,j.f);continue}c.pos=j.c;c.last=c.first=n;q(f,c,j.f)}t.length&&(k("a",t.html(l)).click(function(a){a.preventDefault();a=this;do if("a"===a.nodeName.toLowerCase())break;while(a=a.parentNode);s.setPage(k(a).data("page"));if(s.n)p.location=a.href}),this.n=f.onSelect.call({number:g,lapping:m,pages:a,slice:c.slice},b));

return this}};return s.setNumber(v).setOptions(w).setPage()}})(jQuery,this);

</script>

<script type="text/javascript">

// jQuery Vertigo Tip

this.vtip = function() {    

    this.xOffset = -10; // x distance from mouse

    this.yOffset = 10; // y distance from mouse       

    	

    jQuery(".vtip").unbind().hover(    

        function(e) {

            this.t = this.title;

            this.title = ''; 

            this.top = (e.pageY + yOffset); this.left = (e.pageX + xOffset);

            

            jQuery('body').append( '<p id="vtip">' + this.t + '</p>' );

            

			jQuery('p#vtip').css("display", "none");

			jQuery('p#vtip').css("position", "absolute");

			jQuery('p#vtip').css("padding", "10px");

			jQuery('p#vtip').css("left", "5px");	

			jQuery('p#vtip').css("font-size", "11px");

			jQuery('p#vtip').css("background-color", "white");

			jQuery('p#vtip').css("border", "1px solid #DDDDDD");

			jQuery('p#vtip').css("background-color", "white");

			jQuery('p#vtip').css("-moz-border-radius", "5px");

			jQuery('p#vtip').css("-webkit-border-radius", "5px");

			jQuery('p#vtip').css("z-index", "9999");

			

            jQuery('p#vtip').css("top", this.top+"px").css("left", this.left+"px").fadeIn("fast");

			

        },

        function() {

            this.title = this.t;

            jQuery("p#vtip").fadeOut("fast").remove();

        }

    ).mousemove(

        function(e) {

            this.top = (e.pageY + yOffset);

            this.left = (e.pageX + xOffset);

                         

            jQuery("p#vtip").css("top", this.top+"px").css("left", this.left+"px");

        }

    );            

};

jQuery(document).ready(function($){vtip();}) 

</script>

			
<div id="container">
<header id="header" class="navbar navbar-static-top">
  <div class="navbar-header">
    <?php if ($logged) { ?>
    <a type="button" id="button-menu" class="pull-left"><i class="fa fa-indent fa-lg"></i></a>
    <?php } ?>
    <a href="<?php echo $home; ?>" class="navbar-brand"><img src="view/image/logo.png" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" /></a></div>
  <?php if ($logged) { ?>
  <ul class="nav pull-right">
    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><span class="label label-danger pull-left"><?php echo $alerts; ?></span> <i class="fa fa-bell fa-lg"></i></a>
      <ul class="dropdown-menu dropdown-menu-right alerts-dropdown">
        <li class="dropdown-header"><?php echo $text_order; ?></li>
        <li><a href="<?php echo $order_status; ?>" style="display: block; overflow: auto;"><span class="label label-warning pull-right"><?php echo $order_status_total; ?></span><?php echo $text_order_status; ?></a></li>
        <li><a href="<?php echo $complete_status; ?>"><span class="label label-success pull-right"><?php echo $complete_status_total; ?></span><?php echo $text_complete_status; ?></a></li>
        <li><a href="<?php echo $return; ?>"><span class="label label-danger pull-right"><?php echo $return_total; ?></span><?php echo $text_return; ?></a></li>
        <li class="divider"></li>
        <li class="dropdown-header"><?php echo $text_customer; ?></li>
        <li><a href="<?php echo $online; ?>"><span class="label label-success pull-right"><?php echo $online_total; ?></span><?php echo $text_online; ?></a></li>
        <li><a href="<?php echo $customer_approval; ?>"><span class="label label-danger pull-right"><?php echo $customer_total; ?></span><?php echo $text_approval; ?></a></li>
        <li class="divider"></li>
        <li class="dropdown-header"><?php echo $text_product; ?></li>
        <li><a href="<?php echo $product; ?>"><span class="label label-danger pull-right"><?php echo $product_total; ?></span><?php echo $text_stock; ?></a></li>
        <li><a href="<?php echo $review; ?>"><span class="label label-danger pull-right"><?php echo $review_total; ?></span><?php echo $text_review; ?></a></li>
        <li class="divider"></li>
        <li class="dropdown-header"><?php echo $text_affiliate; ?></li>
        <li><a href="<?php echo $affiliate_approval; ?>"><span class="label label-danger pull-right"><?php echo $affiliate_total; ?></span><?php echo $text_approval; ?></a></li>
      </ul>
    </li>
    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-life-ring fa-lg"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
        <li class="dropdown-header"><?php echo $text_store; ?> <i class="fa fa-shopping-cart"></i></li>
        <?php foreach ($stores as $store) { ?>
        <li><a href="<?php echo $store['href']; ?>" target="_blank"><?php echo $store['name']; ?></a></li>
        <?php } ?>
        <li class="divider"></li>
        <li class="dropdown-header"><?php echo $text_help; ?> <i class="fa fa-life-ring"></i></li>
        <li><a href="http://www.opencart.cn" target="_blank"><?php echo $text_homepage; ?></a></li>
        <li><a href="http://docs.opencart.com" target="_blank"><?php echo $text_documentation; ?></a></li>
        <li><a href="http://opencart.cn/app" target="_blank"><?php echo $text_support; ?></a></li>
        <li><a href="http://opencart.cn" target="_blank"><?php echo $text_opencart_cn; ?></a></li>
      </ul>
    </li>
    <li><a href="<?php echo $logout; ?>"><span class="hidden-xs hidden-sm hidden-md"><?php echo $text_logout; ?></span> <i class="fa fa-sign-out fa-lg"></i></a></li>
  </ul>
  <?php } ?>
</header>
