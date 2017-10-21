@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('head_vars')

	<?php
	/*---------------- PHP Custom Scripts ---------

	YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */

	$pagetitle = "Editar Documento - ".$documento['nombre'];

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	$your_style = 'bootstrap-select.min.css,your_style.css';
	//$your_style = 'bootstrap-select.min.css';
	

	//include left panel (navigation)
	//follow the tree in inc/config.ui.php

	$page_nav = 1;
	$menu=($menuApp ?? "dashboard");
	$submenu1=($submenu1App ?? "Editar Documento");
	//$submenu2='';
	?>

@endsection


@section('content')
	<div class="row">
		<div id="flash-msg">
	        @include('flash::message')
	        @include('adminlte-templates::common.errors')

	    </div>
	</div>
	<!-- MAIN CONTENT -->
	<div id="content_editor" class="container">
		<div id="content_columns" class="text-left">

			<div class="columns">
				
				<h2><label for="editor1">Editor de documentos</label></h2>	

				<p>
					<h3>A continuacion se muestra el contenido correspondiente a <strong>{{ $documento['nombre'] }}</strong></h3>
					<br>
					@if(isset($imprimir))
						<?php $complemento = 'e <strong>imprimir</strong> <span class="cke_button__print_icon" style="width: 16px;display: inline-block;" >&nbsp;</span> el'; ?>
					@else 
						<?php $complemento = 'del'; ?>
					@endif
					<h4>Puede usar las diferentes opciones de edicion para modificar el contenido {!! $complemento !!} documento.</h4>
					<br/>
					
					<?php $complemento = ''; ?>
					@if(isset($copiar))
						<?php $complemento = 'para almacenar una copia.'; ?>
					@endif
					@if(isset($editar))
						<h4>Cuando termine de realizar las modificaciones en el documento escoja la opción <strong>'Guardar'</strong> {!! $complemento !!}</h4>
						<br/>
						@include('print.fields')
					@endif
					<br/>
				</p>

				<div class="col-sm-12 editor_documento hide">
					<div class="document_editor editor">
						@if(isset($imprimir))
							<div class="editor_title_msg">
								<h4><i class="fa fa-hand-o-down"></i> Escoja esta opción para imprimir el documento</h4>
							</div>
						@endif
						<textarea id="editor1" col="10" row="6" class="hide">
							{!! ($documento_contenido ?? '') !!}
						</textarea>
					</div>
					<div class="contacts">
						<div>
							<h3>Puede arrastar al documento algún elemento de esta lista</h3>
							<ul id="contactList">
								@if(isset($keyWords))
									@php 
										$data_contact = 1; 
										$data_name = '';  
									@endphp
									@foreach($keyWords as $key => $value)
										@php 
											$name_explode = explode(" ", $value['name']);
										@endphp
										@if($data_name != $name_explode[0]) 
											@if($data_name != '') 
												</ul>
											</li>
											@endif
											<li>
												<!--
												<button data-toggle="collapse" data-target="#{{ $name_explode[0] }}">Datos {{ $name_explode[0] }}</button>
												<ul id="{{ $name_explode[0] }}" class="collapse">
												-->
												<div class="contact" draggable="false" data-toggle="collapse" data-target="#{{ $name_explode[0] }}">
													<span class="u-photo fa fa-plus"></span>Datos {{ $name_explode[0] }}</div>
												<ul id="{{ $name_explode[0] }}" class="collapse">
										@endif
													<li>
														<div class="contact show_{{ $showData }}" title="{{ $value['name'] }}" data-contact="{{ $data_contact }}" draggable="true" tabindex="0">
															<span class="u-photo fa fa-arrows-alt"></span>{{ $value['name'] }}</div>
													</li>
										@php 
											$data_contact++;
											$data_name = $name_explode[0];
										@endphp
									@endforeach
								@endif
							</ul>

						</div>
					</div>
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

			@if(isset($pre_forma_id))
			$('select[name="tipo_documento"]').on('change', function(){
				var thisVal = $(this).val();
				if (thisVal == {{ $pre_forma_id }}) {
					$('.archivo_input').addClass('hide');
					$('.editor_documento').removeClass('hide');
				}else{
					$('.editor_documento').addClass('hide');
					$('.archivo_input').removeClass('hide');
				}
			});
			@endif

			$('button#guardar_documento').on('click', function(){
				var form_target = $(this).attr('form_target');
				var data = CKEDITOR.instances.editor1.getData();

				$('form'+ form_target +' input[name="archivo_contenido"]').val(data);

				$('form'+ form_target).submit();
			});

			var CONTACTS = [
				{ name: '',			value: '', keyword: '' }

				@if(isset($keyWords))
					@php $data_contact = 8; @endphp
					@foreach($keyWords as $key => $value)
						@php 
							if (isset($value['value'])) {
								if (is_array($value['value'])) {
									$value_implode = implode(", ", $value['value']);
								}else{
									$value_implode = $value['value'];
								}
							}else{
								$value_implode = '';
							}
						@endphp
						,{ name: '{{ $value['name'] }}',			value: '{{ $value_implode }}', keyword: '{{ $value['keyword'] }}' }
					@endforeach
				@endif
			];

			CKEDITOR.disableAutoInline = true;

			// Implements a simple widget that represents contact details (see http://microformats.org/wiki/h-card).
			CKEDITOR.plugins.add( 'hcard', {
				requires: 'widget',

				init: function( editor ) {
					editor.widgets.add( 'hcard', {
						allowedContent: 'span(!show_{{ $showData }}); span(!{{ $showData }})',
						requiredContent: 'span(show_{{ $showData }})',
						pathName: 'hcard',

						upcast: function( el ) {
							return el.name == 'span' && el.hasClass( 'show_{{ $showData }}' );
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
						/*
						evt.data.dataValue = 
							'<span class="show_{{ $showData }}">' +
							@if( $showData == 'keyword')
								'<span class="{{ $showData }}">[' + contact.keyword + ']</span>' +
							@else
								'<span class="{{ $showData }}">' + contact.value + '</span>' +
							@endif
							'</span>';
						*/
						
						@if( $showData == 'keyword')
							evt.data.dataValue = '[' + contact.keyword + ']';
						@else
							evt.data.dataValue = contact.value;
						@endif
						
					} );
				}
			} );

			CKEDITOR.on( 'instanceReady', function() {
				// When an item in the contact list is dragged, copy its data into the drag and drop data transfer.
				// This data is later read by the editor#paste listener in the hcard plugin defined above.
				CKEDITOR.document.getById( 'contactList' ).on( 'dragstart', function( evt ) {
					// The target may be some element inside the draggable div (e.g. the image), so get the div.show_{{ $showData }}.
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
					
					//esto agrega el texto del elemento de la lista que se arrastra
					//dataTransfer.setData( 'text/html', target.getText() );
					dataTransfer.setData( 'text/html', target.getText() );

					// You can still access and use the native dataTransfer - e.g. to set the drag image.
					// Note: IEs do not support this method... :(.
					if ( dataTransfer.$.setDragImage ) {
						dataTransfer.$.setDragImage( target.findOne( 'img' ).$, 0, 0 );
					}
				} );
			} );

			// Initialize the editor with the hcard plugin.
			CKEDITOR.replace( 'editor1', {
				

				// Define the toolbar: http://docs.ckeditor.com/#!/guide/dev_toolbar
				// The full preset from CDN which we used as a base provides more features than we need.
				// Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.
				
				toolbar: [
					{ name: 'document', items: [ 'Print', 'Preview', 'Source', '-', 'NewPage', '-', 'Templates' ] },
					{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' ] },
					{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
					{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
					{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
					{ name: 'links', items: [ 'Link', 'Unlink' ] },
					{ name: 'insert', items: [ 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
					{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
					{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
					{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
				],

				// Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
				// One HTTP request less will result in a faster startup time.
				// For more information check http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-customConfig
				customConfig: '',

				// Sometimes applications that convert HTML to PDF prefer setting image width through attributes instead of CSS styles.
				// For more information check:
				//  - About Advanced Content Filter: http://docs.ckeditor.com/#!/guide/dev_advanced_content_filter
				//  - About Disallowed Content: http://docs.ckeditor.com/#!/guide/dev_disallowed_content
				//  - About Allowed Content: http://docs.ckeditor.com/#!/guide/dev_allowed_content_rules
				disallowedContent: 'img{width,height,float}',
				extraAllowedContent: 'img[width,height,align]',

				// Enabling extra plugins, available in the full-all preset: http://ckeditor.com/presets-all
				extraPlugins: 'tableresize,hcard,sourcedialog,justify',
				//extraPlugins: 'tableresize,uploadimage,uploadfile,hcard,sourcedialog,justify',

				/*********************** File management support ***********************/
				// In order to turn on support for file uploads, CKEditor has to be configured to use some server side
				// solution with file upload/management capabilities, like for example CKFinder.
				// For more information see http://docs.ckeditor.com/#!/guide/dev_ckfinder_integration

				// Uncomment and correct these lines after you setup your local CKFinder instance.
				// filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
				// filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				/*********************** File management support ***********************/

				// Make the editing area bigger than default.
				height: 800,

				// An array of stylesheets to style the WYSIWYG area.
				// Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
				contentsCss: [ '{{ asset('/css/ckeditor/contents.css') }}', '{{ asset('/css/ckeditor/mystyles.css') }}' ],

				// This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
				//bodyClass: 'document-editor',
				bodyClass: 'document_editor',

				// Reduce the list of block elements listed in the Format dropdown to the most commonly used.
				format_tags: 'p;h1;h2;h3;pre',

				// Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
				removeDialogTabs: 'image:advanced;link:advanced;link:target',

				// Define the list of styles which should be available in the Styles dropdown list.
				// If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
				// (and on your website so that it rendered in the same way).
				// Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
				// that file, which means one HTTP request less (and a faster startup).
				// For more information see http://docs.ckeditor.com/#!/guide/dev_styles
				stylesSet: [
					/* Inline Styles */
					{ name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
					{ name: 'Cited Work', element: 'cite' },
					{ name: 'Inline Quotation', element: 'q' },

					/* Object Styles */
					{
						name: 'Special Container',
						element: 'div',
						styles: {
							padding: '5px 10px',
							background: '#eee',
							border: '1px solid #ccc'
						}
					},
					{
						name: 'Compact table',
						element: 'table',
						attributes: {
							cellpadding: '5',
							cellspacing: '0',
							border: '1',
							bordercolor: '#ccc'
						},
						styles: {
							'border-collapse': 'collapse'
						}
					},
					{ name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
					{ name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
				]
			} );
			@if(!isset($pre_forma_id))
			$('.editor_documento').removeClass('hide');
			@endif
		})

	</script>

@endsection