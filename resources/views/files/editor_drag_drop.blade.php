@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('head_vars')

	<?php
	/*---------------- PHP Custom Scripts ---------

	YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */

	$pagetitle = "Editor de documentos (Drag & Drop)";

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	$your_style = 'bootstrap-select.min.css,your_style.css';
	//$your_style = 'bootstrap-select.min.css';
	

	//include left panel (navigation)
	//follow the tree in inc/config.ui.php

	$page_nav = 1;
	$menu="dashboard";
	$submenu1="";
	//$submenu2='';
	?>

@endsection


@section('styles')
	<style type="text/css">
		/* Minimal styling to center the editor in this sample */
		.content {
			padding: 30px;
			display: flex;
			align-items: center;
			text-align: center;
		}

		#content_editor {
			margin: 0 auto;
		}

		.columns {
			background: #fff;
			padding: 20px;
			border: 1px solid #E7E7E7;
		}
		.columns:after {
			content: "";
			clear: both;
			display: block;
		}
		.columns > .editor {
			float: left;
			width: 65%;
			position: relative;
			z-index: 1;
		}
		.columns > .contacts {
			float: right;
			width: 35%;
			box-sizing: border-box;
			padding: 0 0 0 20px;
		}
		#contactList {
			list-style-type: none;
			margin: 0 !important;
			padding: 0;
		}
		#contactList li {
			background: #FAFAFA;
			margin-bottom: 1px;
			height: 56px;
			line-height: 56px;
			cursor: pointer;
		}
		#contactList li:nth-child(2n) {
			background: #F3F3F3;
		}
		#contactList li:hover {
			background: #FFFDE3;
			border-left: 5px solid #DCDAC1;
			margin-left: -5px;
		}
		.contact {
			padding: 0 10px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		.contact .u-photo {
			display: inline-block;
			vertical-align: middle;
			margin-right: 10px;
		}
		#editor1 .h-card {
			background: #FFFDE3;
			padding: 3px 6px;
			border-bottom: 1px dashed #ccc;
		}
		#editor1 {
			border: 1px solid #E7E7E7;
			padding: 0 20px;
			background: #fff;
			position: relative;
			color: black;
		}
		#editor1 .h-card .p-tel {
			font-style: italic;
		}
		#editor1 .h-card .p-tel::before,
		#editor1 .h-card .p-tel::after {
			font-style: normal;
		}
		#editor1 .h-card .p-tel::before {
			content: "(☎ ";
		}
		#editor1 .h-card .p-tel::after {
			content: ")";
		}
		#editor1 h1 {
			text-align: center;
		}
		#editor1 hr {
			border-style: dotted;
			border-color: #DCDCDC;
			border-width: 1px 0 0;
		}

	</style>

@endsection

@section('content')

	<!-- MAIN CONTENT -->
	<div id="content_editor" class="container">
		<div id="content_columns" class="text-left">

			<div class="columns">
				<div class="editor">
					<div cols="10" id="editor1" name="editor1" rows="10"  contenteditable="true">
						<h1>The Annual Meeting of Fictional Characters</h1>
						<h3>Technical Announcement</h3>
						<p>We hereby have the pleasure to announce that the theme of this year's meeting is "<strong>E–ink Technology and Classical Fairy Tales</strong>". As every year, the event will be hosted in <em>The Wonderland</em> by <span class="h-card"><a class="p-name u-email" href="mailto:alice@example.com">Alice</a> <span class="p-tel">+20 4345 234 235</span></span>and
							starts tomorrow at 8:00 GMT.</p>
						<h3>Speakers and Agenda</h3>
						<p>TBA.</p>
						<h3>Venue</h3>
						<p>For detailed information, please contact <span class="h-card"><a class="p-name u-email" href="mailto:h.finn@example.com">Huckleberry Finn</a> <span class="p-tel">+48 1345 234 235</span></span>.</p>
						<h3>Accommodation</h3>
						<p>Many thanks to <span class="h-card"><a class="p-name u-email" href="mailto:r.crusoe@example.com">Robinson Crusoe</a> <span class="p-tel">+45 2345 234 235</span></span>who kindly offered his island to the guests of the annual meeting.</p>
						<hr>
						<p style="text-align: right;"><span class="h-card"><a class="p-name u-email" href="mailto:lrrh@example.com">Little Red Riding Hood</a> <span class="p-tel">+45 2345 234 235</span></span>
						</p>
					</div>
				</div>
				<div class="contacts">
					<h3>List of Droppable Contacts</h3>
					<ul id="contactList">
						<li>
							<div class="contact h-card" data-contact="0" draggable="true" tabindex="0">
								<img src="http://sdk.ckeditor.com/samples/assets/draganddrop/img/hfin.png" alt="avatar" class="u-photo">Huckleberry Finn</div>
						</li>
						<li>
							<div class="contact h-card" data-contact="1" draggable="true" tabindex="0">
								<img src="http://sdk.ckeditor.com/samples/assets/draganddrop/img/dartagnan.png" alt="avatar" class="u-photo">D'Artagnan</div>
						</li>
						<li>
							<div class="contact h-card" data-contact="2" draggable="true" tabindex="0">
								<img src="http://sdk.ckeditor.com/samples/assets/draganddrop/img/pfog.png" alt="avatar" class="u-photo">Phileas Fogg</div>
						</li>
						<li>
							<div class="contact h-card" data-contact="3" draggable="true" tabindex="0">
								<img src="http://sdk.ckeditor.com/samples/assets/draganddrop/img/alice.png" alt="avatar" class="u-photo">Alice</div>
						</li>
						<li>
							<div class="contact h-card" data-contact="4" draggable="true" tabindex="0">
								<img src="http://sdk.ckeditor.com/samples/assets/draganddrop/img/lrrh.png" alt="avatar" class="u-photo">Little Red Riding Hood</div>
						</li>
						<li>
							<div class="contact h-card" data-contact="5" draggable="true" tabindex="0">
								<img src="http://sdk.ckeditor.com/samples/assets/draganddrop/img/winetou.png" alt="avatar" class="u-photo">Winnetou</div>
						</li>
						<li>
							<div class="contact h-card" data-contact="6" draggable="true" tabindex="0">
								<img src="http://sdk.ckeditor.com/samples/assets/draganddrop/img/edantes.png" alt="avatar" class="u-photo">Edmond Dantès</div>
						</li>
						<li>
							<div class="contact h-card" data-contact="7" draggable="true" tabindex="0">
								<img src="http://sdk.ckeditor.com/samples/assets/draganddrop/img/rcrusoe.png" alt="avatar" class="u-photo">Robinson Crusoe</div>
						</li>
					</ul>
				</div>
			 </div>
		</div>
	</div>
@endsection

@section('scripts')

	<script src="{{ asset('/js/plugin/ckeditor/ckeditor.js') }}"></script>

	<script type="text/javascript">

		// DO NOT REMOVE : GLOBAL FUNCTIONS!

		$(document).ready(function() {

			'use strict';

			var CONTACTS = [
				{ name: 'Huckleberry Finn',			tel: '+48 1345 234 235', email: 'h.finn@example.com', avatar: 'hfin' },
				{ name: 'D\'Artagnan',				tel: '+45 2345 234 235', email: 'dartagnan@example.com', avatar: 'dartagnan' },
				{ name: 'Phileas Fogg',				tel: '+44 3345 234 235', email: 'p.fogg@example.com', avatar: 'pfog' },
				{ name: 'Alice',					tel: '+20 4345 234 235', email: 'alice@example.com', avatar: 'alice' },
				{ name: 'Little Red Riding Hood',	tel: '+45 2345 234 235', email: 'lrrh@example.com', avatar: 'lrrh' },
				{ name: 'Winnetou',					tel: '+44 3345 234 235', email: 'winnetou@example.com', avatar: 'winetou' },
				{ name: 'Edmond Dantès',			tel: '+20 4345 234 235', email: 'count@example.com', avatar: 'edantes' },
				{ name: 'Robinson Crusoe',			tel: '+45 2345 234 235', email: 'r.crusoe@example.com', avatar: 'rcrusoe' }
			];

			CKEDITOR.disableAutoInline = true;

			// Implements a simple widget that represents contact details (see http://microformats.org/wiki/h-card).
			CKEDITOR.plugins.add( 'hcard', {
				requires: 'widget',

				init: function( editor ) {
					editor.widgets.add( 'hcard', {
						allowedContent: 'span(!h-card); a[href](!u-email,!p-name); span(!p-tel)',
						requiredContent: 'span(h-card)',
						pathName: 'hcard',

						upcast: function( el ) {
							return el.name == 'span' && el.hasClass( 'h-card' );
						}
					} );

					// This feature does not have a button, so it needs to be registered manually.
					editor.addFeature( editor.widgets.registered.hcard );

					// Handle dropping a contact by transforming the contact object into HTML.
					// Note: All pasted and dropped content is handled in one event - editor#paste.
					editor.on( 'paste', function( evt ) {
						var contact = evt.data.dataTransfer.getData( 'contact' );
						if ( !contact ) {
							return;
						}

						evt.data.dataValue =
							'<span class="h-card">' +
								'<a href="mailto:' + contact.email + '" class="p-name u-email">' + contact.name + '</a>' +
								' ' +
								'<span class="p-tel">' + contact.tel + '</span>' +
							'</span>';
					} );
				}
			} );

			CKEDITOR.on( 'instanceReady', function() {
				// When an item in the contact list is dragged, copy its data into the drag and drop data transfer.
				// This data is later read by the editor#paste listener in the hcard plugin defined above.
				CKEDITOR.document.getById( 'contactList' ).on( 'dragstart', function( evt ) {
					// The target may be some element inside the draggable div (e.g. the image), so get the div.h-card.
					var target = evt.data.getTarget().getAscendant( 'div', true );

					// Initialization of the CKEditor data transfer facade is a necessary step to extend and unify native
					// browser capabilities. For instance, Internet Explorer does not support any other data type than 'text' and 'URL'.
					// Note: evt is an instance of CKEDITOR.dom.event, not a native event.
					CKEDITOR.plugins.clipboard.initDragDataTransfer( evt );

					var dataTransfer = evt.data.dataTransfer;

					// Pass an object with contact details. Based on it, the editor#paste listener in the hcard plugin
					// will create the HTML code to be inserted into the editor. You could set 'text/html' here as well, but:
					// * It is a more elegant and logical solution that this logic is kept in the hcard plugin.
					// * You do not know now where the content will be dropped and the HTML to be inserted
					// might vary depending on the drop target.
					dataTransfer.setData( 'contact', CONTACTS[ target.data( 'contact' ) ] );

					// You need to set some normal data types to backup values for two reasons:
					// * In some browsers this is necessary to enable drag and drop into text in the editor.
					// * The content may be dropped in another place than the editor.
					dataTransfer.setData( 'text/html', target.getText() );

					// You can still access and use the native dataTransfer - e.g. to set the drag image.
					// Note: IEs do not support this method... :(.
					if ( dataTransfer.$.setDragImage ) {
						dataTransfer.$.setDragImage( target.findOne( 'img' ).$, 0, 0 );
					}
				} );
			} );

			// Initialize the editor with the hcard plugin.
			CKEDITOR.inline( 'editor1', {
				extraPlugins: 'hcard,sourcedialog,justify'
			} );
		})

	</script>

@endsection