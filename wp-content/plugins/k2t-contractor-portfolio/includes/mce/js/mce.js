/* ----------------------------------------------------- */
/* This file for register button insert portfolio shortcode to TinyMCE
/* ----------------------------------------------------- */
(function() {
	tinymce.create('tinymce.plugins.k2t_pre_portfolio_button', {
		init : function(ed, url) {
			title = 'k2t_pre_portfolio_button';
			tinymce.plugins.k2t_pre_portfolio_button.theurl = url;
			ed.addButton('k2t_pre_portfolio_button', {
				title	:	'Portfolio shortcode',
				icon	:	'wp_code',
				type	:	'menubutton',
				/* List Button */
				menu: [
					/* --- Portfolio --- */   
					{	
						text: 'Portfolio',
						value: 'Portfolio',
						onclick: function() {
							ed.windowManager.open( {
								title: 'Portfolio',
								body: [
								{type	:	'listbox', name	:	'filter', label					:	'Filter turn on', values: [{text: 'True', value: 'true'},{text: 'False', value: 'false'}], value: 'true'},
								{type	:	'listbox', name	:	'filter_align', label			:	'Filter align', values: [{text: 'Left', value: 'left'},{text: 'Center', value: 'center'},{text: 'Right', value: 'right'}], value: 'center'},
								{type	:	'textbox', name	:	'categories', label				:	'Categories of projects'},
								{type	:	'textbox', name	:	'number', label					:	'Number of projects'},
								{type	:	'listbox', name	:	'column', label					:	'Columns', values: [{text: '2 columns', value: '2'},{text: '3 columns', value: '3'},{text: '4 columns', value: '4'},{text: '5 columns', value: '5'},], value: '3'},
								{type	:	'listbox', name	:	'style', label					:	'Portfolio style', values: [{text: 'Text Grid', value: 'text-grid'},{text: 'Text Masonry', value: 'text-masonry'},{text: 'Gallery Grid', value: 'gallery-grid'},{text: 'Gallery Masonry', value: 'gallery-masonry'},]},
								{type	:	'listbox', name	:	'padding', label				:	'Padding', values: [{text: 'Yes', value: 'true'},{text: 'No', value: 'false'},]},
								],
								onsubmit: function( e ) {
									ed.insertContent( '[portfolio filter="'+ e.data.filter +'" filter_align="'+ e.data.filter_align +'" categories="'+ e.data.categories +'" number="'+ e.data.number + '" column="'+ e.data.column +'" style="'+ e.data.style +'" padding="'+ e.data.padding +'" /]');
								}
							});
							}
					},
					
					/* --- Portfolio Carousel --- */   
					{	
						text: 'Portfolio Carousel',
						value: 'Portfolio Carousel',
						onclick: function() {
							ed.windowManager.open( {
								title: 'Portfolio Carousel',
								body: [
								{type	:	'textbox', name	:	'categories', label				:	'Categories of projects'},
								{type	:	'textbox', name	:	'number', label					:	'Number of projects'},
								{type	:	'listbox', name	:	'column', label					:	'Columns', values: [{text: '2 columns', value: '2'},{text: '3 columns', value: '3'},{text: '4 columns', value: '4'},{text: '5 columns', value: '5'},]},
								{type	:	'listbox', name	:	'portfolio_type', label			:	'Portfolio type', values: [{text: 'Portfolio', value: 'portfolio'},{text: 'Gallery', value: 'gallery'},]},
								{type	:	'listbox', name	:	'link_detail', label			:	'Link detail', values: [{text: 'Link', value: 'link'},{text: 'Ajax', value: 'ajax'},]},
								{type	:	'listbox', name	:	'effect_3d', label				:	'3D effect?', values: [{text: 'Yes', value: 'true'},{text: 'No', value: 'false'},]},
								{type	:	'listbox', name	:	'padding', label				:	'Padding?', values: [{text: 'Yes', value: 'true'},{text: 'No', value: 'false'},]},
								{type	:	'listbox', name	:	'auto', label					:	'Auto slide', values: [{text: 'Yes', value: 'true'},{text: 'No', value: 'false'},]},
								{type	:	'textbox', name	:	'auto_time', label				:	'Auto time (milliseconds), eg 5000'},
								{type	:	'textbox', name	:	'speed', label					:	'Speed (milliseconds), eg 300'},
								{type	:	'listbox', name	:	'loop', label					:	'Loop?', values: [{text: 'Yes', value: 'true'},{text: 'No', value: 'false'},]},
								{type	:	'listbox', name	:	'touch', label					:	'Touch?', values: [{text: 'Yes', value: 'true'},{text: 'No', value: 'false'},]},
								{type	:	'listbox', name	:	'mousewheel', label				:	'Mousewheel?', values: [{text: 'Yes', value: 'true'},{text: 'No', value: 'false'},]},
								{type	:	'listbox', name	:	'keyboard', label				:	'Keyboard Navigation?', values: [{text: 'Yes', value: 'true'},{text: 'No', value: 'false'},]},
								{type	:	'listbox', name	:	'belowtitle', label				:	'Below title', values: [{text: 'Subtitle', value: 'subtitle'},{text: 'Client', value: 'client'},{text: 'Location', value: 'location'},{text: 'Date', value: 'date'}]},
								],
								onsubmit: function( e ) {
									ed.insertContent( '[portfolio_carousel categories="'+ e.data.categories + '" number="'+ e.data.number + '" column="'+e.data.column +'" portfolio_type="'+e.data.portfolio_type +'" link_detail="'+e.data.link_detail +'" effect_3d="'+e.data.effect_3d+'" padding="'+e.data.padding+'" auto="'+e.data.auto+'" auto_time="'+e.data.auto_time+'" speed="'+e.data.speed+'" loop="'+e.data.loop+'" touch="'+e.data.touch+'" mousewheel="'+e.data.mousewheel+'" keyboard="'+e.data.keyboard+'" /]');
								}
							});
							}
					},
					
				],
			});

		},
		createControl : function(n, cm) {
			return null;
		}
	});

	tinymce.PluginManager.add('k2t_pre_portfolio_button', tinymce.plugins.k2t_pre_portfolio_button);

})();