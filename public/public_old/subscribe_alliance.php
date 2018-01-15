<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Subscribir Alianza";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
//$page_css[] = "your_style.css";
$page_css[] = "bootstrap-select.min.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["InterAlliance"]["sub"]["SubscribeAlliance"]["active"] = true;
include("inc/nav.php");

?>

<style type="text/css">

	#bootstrap-wizard-1 > div.form-bootstrapWizard > ul > li{
		height: 80px;
	}

</style>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Forms"] = "";
		include("inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			  <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterAlliance <span>&gt; Subscribir Alianza </span></h1>
			</div>

			<!-- right side of the page with the sparkline graphs -->
			<!-- col -->
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<!-- sparks -->
				<ul id="sparks">
					<li class="sparks-info">
						<h5> Mis alianzas <span class="txt-color-blue">171</span></h5>
						<div class="sparkline txt-color-blue hidden-mobile">
							1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
						</div>
					</li>
				</ul>
				<!-- end sparks -->
			</div>
			<!-- end col -->
		</div>
		
		<!-- widget grid -->
		<section id="widget-grid" class="">
		
			<!-- row -->
			<div class="row">
				


				<!-- AYUDA -->
				<!-- NEW WIDGET START -->
				<article class="col-sm-12 col-md-12 col-lg-12">

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget" id="wid-id-2" data-widget-collapsed="true" data-widget-editbutton="false" data-widget-deletebutton="false">
						<!-- widget options:
						usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
		
						data-widget-colorbutton="false"
						data-widget-editbutton="false"
						data-widget-togglebutton="false"
						data-widget-deletebutton="false"
						data-widget-fullscreenbutton="false"
						data-widget-custombutton="false"
						data-widget-collapsed="true"
						data-widget-sortable="false"
		
						-->
						<header>
							<h2>Ayuda </h2>
		
						</header>
		
						<!-- widget div-->
						<div>
		
							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->
		
							</div>
							<!-- end widget edit box -->
		
							<!-- widget content -->
							<div class="widget-body fuelux">
								<div class="step-content">
									<div class="form-horizontal" id="fuelux-wizard">
		
										<div class="step-pane active col-lg-11" > 
											Este formulario permite subscribir una nueva alianza con otra institución<!-- wizard form starts here -->
									  </div>			
						
								  </div>
							  </div>
		
						  </div>
							<!-- end widget content -->
		
						</div>
						<!-- end widget div -->
		
					</div>
					<!-- end widget -->


				</article>
				<!-- WIDGET END -->


				<!-- pre-Registro de una nueva alianza -->
				<!-- NEW WIDGET START -->
				<article class="col-sm-12 col-md-12 col-lg-12">
		
					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
						<!-- widget options:
						usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
		
						data-widget-colorbutton="false"
						data-widget-editbutton="false"
						data-widget-togglebutton="false"
						data-widget-deletebutton="false"
						data-widget-fullscreenbutton="false"
						data-widget-custombutton="false"
						data-widget-collapsed="true"
						data-widget-sortable="false"
		
						-->
						<header>
							<span class="widget-icon"> <i class="fa fa-check"></i> </span>
							<h2>Formulario de Pre-Registro de una Nueva Alianza</h2>
		
						</header>
		
						<!-- widget div-->
						<div>
		
							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->
		
							</div>
							<!-- end widget edit box -->
		
							<!-- widget content -->
							<div class="widget-body">
		
								<div class="row">
									<form id="wizard-1" novalidate>
										<div id="bootstrap-wizard-1" class="col-sm-12">
											<div class="form-bootstrapWizard">
												<ul class="bootstrapWizard form-wizard">
													<li class="active" data-target="#step1">
														<a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title">Características de la Alianza</span> </a>
													</li>
													<li data-target="#step2">
														<a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Datos Generales de la Institución Contraparte</span> </a>
													</li>
													<li data-target="#step01">
														<a href="#tabG1" data-toggle="tab"> <span class="step">G</span> <span class="title">Guardar Formulario</span> </a>
													</li>

												</ul>
												<div class="clearfix"></div>
											</div>
											<div class="tab-content">
												<div class="tab-pane active" id="tab1">
													<br>
													<h3><strong>Paso 1 </strong> - Características de la Alianza</h3>
													<!--Solicitado por y otro-->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="solicitado_por">
																		<option value="" selected="selected">Seleccione quien solicita</option>
																		<option>Administración</option>
																		<option>Artes y Humanidades</option>
																		<option>Arquitectura y Diseño</option>
																		<option>Ciencias Económicas y Administrativas</option>
																		<option>Ciencias Naturales</option>
																		<option>Ciencias Sociales</option>
																		<option>Derecho</option>
																		<option>Educación</option>
																		<option>Ingeniería</option>
																		<option>Medicina</option>
																		<option>Otro</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Otro" type="text" name="otro" id="otro">
		
																</div>
															</div>
														</div>
													</div>
													<hr>
													<!--TIPO de alianza Y modalidad-->
													<div class="row">

														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="tipo_alianza">
																		<option value="" selected="selected">Seleccione el tipo de alianza</option>
																		<option>Marco</option>
																		<option>Especifico</option>
																	</select>
																</div>
															</div>
														</div>

														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
																	<select class="selectpicker form-control input-lg" name="modalidad" title="Seleccione la modalidad" multiple>
																		<option>Cooperación Interinstitucional</option>
																		<option>Actividades Científicas y de Cooperación Académica Investigativa</option>
																		<option>Prácticas y Pasantías</option>
																		<option>Movilidad Académica Estudiantil</option>
																		<option>Doble Titulación</option>
																		<option>Docencia-Servicio</option>
																		<option>Inmersión Universitaria</option>
																		<option>Movilidad Académica de Profesores, Investigadores o Administrativos</option>
																	</select>
																</div>
															</div>
														</div>
													</div>

													<!--Responsable de la ARL y pais-->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="arl_responsable">
																		<option value="" selected="selected">Institución Responsable de la ARL</option>
																		<option>La Universidad</option>
																		<option>Institución Contraparte</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-flag fa-lg fa-fw"></i></span>
																	<select name="pais" class="selectpicker form-control input-lg" title="Seleccione el país" multiple>
																		<option value="United States">United States</option>
																		<option value="United Kingdom">United Kingdom</option>
																		<option value="Afghanistan">Afghanistan</option>
																		<option value="Albania">Albania</option>
																		<option value="Algeria">Algeria</option>
																		<option value="American Samoa">American Samoa</option>
																		<option value="Andorra">Andorra</option>
																		<option value="Angola">Angola</option>
																		<option value="Anguilla">Anguilla</option>
																		<option value="Antarctica">Antarctica</option>
																		<option value="Antigua and Barbuda">Antigua and Barbuda</option>
																		<option value="Argentina">Argentina</option>
																		<option value="Armenia">Armenia</option>
																		<option value="Aruba">Aruba</option>
																		<option value="Australia">Australia</option>
																		<option value="Austria">Austria</option>
																		<option value="Azerbaijan">Azerbaijan</option>
																		<option value="Bahamas">Bahamas</option>
																		<option value="Bahrain">Bahrain</option>
																		<option value="Bangladesh">Bangladesh</option>
																		<option value="Barbados">Barbados</option>
																		<option value="Belarus">Belarus</option>
																		<option value="Belgium">Belgium</option>
																		<option value="Belize">Belize</option>
																		<option value="Benin">Benin</option>
																		<option value="Bermuda">Bermuda</option>
																		<option value="Bhutan">Bhutan</option>
																		<option value="Bolivia">Bolivia</option>
																		<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
																		<option value="Botswana">Botswana</option>
																		<option value="Bouvet Island">Bouvet Island</option>
																		<option value="Brazil">Brazil</option>
																		<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
																		<option value="Brunei Darussalam">Brunei Darussalam</option>
																		<option value="Bulgaria">Bulgaria</option>
																		<option value="Burkina Faso">Burkina Faso</option>
																		<option value="Burundi">Burundi</option>
																		<option value="Cambodia">Cambodia</option>
																		<option value="Cameroon">Cameroon</option>
																		<option value="Canada">Canada</option>
																		<option value="Cape Verde">Cape Verde</option>
																		<option value="Cayman Islands">Cayman Islands</option>
																		<option value="Central African Republic">Central African Republic</option>
																		<option value="Chad">Chad</option>
																		<option value="Chile">Chile</option>
																		<option value="China">China</option>
																		<option value="Christmas Island">Christmas Island</option>
																		<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
																		<option value="Colombia">Colombia</option>
																		<option value="Comoros">Comoros</option>
																		<option value="Congo">Congo</option>
																		<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
																		<option value="Cook Islands">Cook Islands</option>
																		<option value="Costa Rica">Costa Rica</option>
																		<option value="Cote D'ivoire">Cote D'ivoire</option>
																		<option value="Croatia">Croatia</option>
																		<option value="Cuba">Cuba</option>
																		<option value="Cyprus">Cyprus</option>
																		<option value="Czech Republic">Czech Republic</option>
																		<option value="Denmark">Denmark</option>
																		<option value="Djibouti">Djibouti</option>
																		<option value="Dominica">Dominica</option>
																		<option value="Dominican Republic">Dominican Republic</option>
																		<option value="Ecuador">Ecuador</option>
																		<option value="Egypt">Egypt</option>
																		<option value="El Salvador">El Salvador</option>
																		<option value="Equatorial Guinea">Equatorial Guinea</option>
																		<option value="Eritrea">Eritrea</option>
																		<option value="Estonia">Estonia</option>
																		<option value="Ethiopia">Ethiopia</option>
																		<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
																		<option value="Faroe Islands">Faroe Islands</option>
																		<option value="Fiji">Fiji</option>
																		<option value="Finland">Finland</option>
																		<option value="France">France</option>
																		<option value="French Guiana">French Guiana</option>
																		<option value="French Polynesia">French Polynesia</option>
																		<option value="French Southern Territories">French Southern Territories</option>
																		<option value="Gabon">Gabon</option>
																		<option value="Gambia">Gambia</option>
																		<option value="Georgia">Georgia</option>
																		<option value="Germany">Germany</option>
																		<option value="Ghana">Ghana</option>
																		<option value="Gibraltar">Gibraltar</option>
																		<option value="Greece">Greece</option>
																		<option value="Greenland">Greenland</option>
																		<option value="Grenada">Grenada</option>
																		<option value="Guadeloupe">Guadeloupe</option>
																		<option value="Guam">Guam</option>
																		<option value="Guatemala">Guatemala</option>
																		<option value="Guinea">Guinea</option>
																		<option value="Guinea-bissau">Guinea-bissau</option>
																		<option value="Guyana">Guyana</option>
																		<option value="Haiti">Haiti</option>
																		<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
																		<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
																		<option value="Honduras">Honduras</option>
																		<option value="Hong Kong">Hong Kong</option>
																		<option value="Hungary">Hungary</option>
																		<option value="Iceland">Iceland</option>
																		<option value="India">India</option>
																		<option value="Indonesia">Indonesia</option>
																		<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
																		<option value="Iraq">Iraq</option>
																		<option value="Ireland">Ireland</option>
																		<option value="Israel">Israel</option>
																		<option value="Italy">Italy</option>
																		<option value="Jamaica">Jamaica</option>
																		<option value="Japan">Japan</option>
																		<option value="Jordan">Jordan</option>
																		<option value="Kazakhstan">Kazakhstan</option>
																		<option value="Kenya">Kenya</option>
																		<option value="Kiribati">Kiribati</option>
																		<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
																		<option value="Korea, Republic of">Korea, Republic of</option>
																		<option value="Kuwait">Kuwait</option>
																		<option value="Kyrgyzstan">Kyrgyzstan</option>
																		<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
																		<option value="Latvia">Latvia</option>
																		<option value="Lebanon">Lebanon</option>
																		<option value="Lesotho">Lesotho</option>
																		<option value="Liberia">Liberia</option>
																		<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
																		<option value="Liechtenstein">Liechtenstein</option>
																		<option value="Lithuania">Lithuania</option>
																		<option value="Luxembourg">Luxembourg</option>
																		<option value="Macao">Macao</option>
																		<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
																		<option value="Madagascar">Madagascar</option>
																		<option value="Malawi">Malawi</option>
																		<option value="Malaysia">Malaysia</option>
																		<option value="Maldives">Maldives</option>
																		<option value="Mali">Mali</option>
																		<option value="Malta">Malta</option>
																		<option value="Marshall Islands">Marshall Islands</option>
																		<option value="Martinique">Martinique</option>
																		<option value="Mauritania">Mauritania</option>
																		<option value="Mauritius">Mauritius</option>
																		<option value="Mayotte">Mayotte</option>
																		<option value="Mexico">Mexico</option>
																		<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
																		<option value="Moldova, Republic of">Moldova, Republic of</option>
																		<option value="Monaco">Monaco</option>
																		<option value="Mongolia">Mongolia</option>
																		<option value="Montserrat">Montserrat</option>
																		<option value="Morocco">Morocco</option>
																		<option value="Mozambique">Mozambique</option>
																		<option value="Myanmar">Myanmar</option>
																		<option value="Namibia">Namibia</option>
																		<option value="Nauru">Nauru</option>
																		<option value="Nepal">Nepal</option>
																		<option value="Netherlands">Netherlands</option>
																		<option value="Netherlands Antilles">Netherlands Antilles</option>
																		<option value="New Caledonia">New Caledonia</option>
																		<option value="New Zealand">New Zealand</option>
																		<option value="Nicaragua">Nicaragua</option>
																		<option value="Niger">Niger</option>
																		<option value="Nigeria">Nigeria</option>
																		<option value="Niue">Niue</option>
																		<option value="Norfolk Island">Norfolk Island</option>
																		<option value="Northern Mariana Islands">Northern Mariana Islands</option>
																		<option value="Norway">Norway</option>
																		<option value="Oman">Oman</option>
																		<option value="Pakistan">Pakistan</option>
																		<option value="Palau">Palau</option>
																		<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
																		<option value="Panama">Panama</option>
																		<option value="Papua New Guinea">Papua New Guinea</option>
																		<option value="Paraguay">Paraguay</option>
																		<option value="Peru">Peru</option>
																		<option value="Philippines">Philippines</option>
																		<option value="Pitcairn">Pitcairn</option>
																		<option value="Poland">Poland</option>
																		<option value="Portugal">Portugal</option>
																		<option value="Puerto Rico">Puerto Rico</option>
																		<option value="Qatar">Qatar</option>
																		<option value="Reunion">Reunion</option>
																		<option value="Romania">Romania</option>
																		<option value="Russian Federation">Russian Federation</option>
																		<option value="Rwanda">Rwanda</option>
																		<option value="Saint Helena">Saint Helena</option>
																		<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
																		<option value="Saint Lucia">Saint Lucia</option>
																		<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
																		<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
																		<option value="Samoa">Samoa</option>
																		<option value="San Marino">San Marino</option>
																		<option value="Sao Tome and Principe">Sao Tome and Principe</option>
																		<option value="Saudi Arabia">Saudi Arabia</option>
																		<option value="Senegal">Senegal</option>
																		<option value="Serbia and Montenegro">Serbia and Montenegro</option>
																		<option value="Seychelles">Seychelles</option>
																		<option value="Sierra Leone">Sierra Leone</option>
																		<option value="Singapore">Singapore</option>
																		<option value="Slovakia">Slovakia</option>
																		<option value="Slovenia">Slovenia</option>
																		<option value="Solomon Islands">Solomon Islands</option>
																		<option value="Somalia">Somalia</option>
																		<option value="South Africa">South Africa</option>
																		<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
																		<option value="Spain">Spain</option>
																		<option value="Sri Lanka">Sri Lanka</option>
																		<option value="Sudan">Sudan</option>
																		<option value="Suriname">Suriname</option>
																		<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
																		<option value="Swaziland">Swaziland</option>
																		<option value="Sweden">Sweden</option>
																		<option value="Switzerland">Switzerland</option>
																		<option value="Syrian Arab Republic">Syrian Arab Republic</option>
																		<option value="Taiwan, Province of China">Taiwan, Province of China</option>
																		<option value="Tajikistan">Tajikistan</option>
																		<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
																		<option value="Thailand">Thailand</option>
																		<option value="Timor-leste">Timor-leste</option>
																		<option value="Togo">Togo</option>
																		<option value="Tokelau">Tokelau</option>
																		<option value="Tonga">Tonga</option>
																		<option value="Trinidad and Tobago">Trinidad and Tobago</option>
																		<option value="Tunisia">Tunisia</option>
																		<option value="Turkey">Turkey</option>
																		<option value="Turkmenistan">Turkmenistan</option>
																		<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
																		<option value="Tuvalu">Tuvalu</option>
																		<option value="Uganda">Uganda</option>
																		<option value="Ukraine">Ukraine</option>
																		<option value="United Arab Emirates">United Arab Emirates</option>
																		<option value="United Kingdom">United Kingdom</option>
																		<option value="United States">United States</option>
																		<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
																		<option value="Uruguay">Uruguay</option>
																		<option value="Uzbekistan">Uzbekistan</option>
																		<option value="Vanuatu">Vanuatu</option>
																		<option value="Venezuela">Venezuela</option>
																		<option value="Viet Nam">Viet Nam</option>
																		<option value="Virgin Islands, British">Virgin Islands, British</option>
																		<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
																		<option value="Wallis and Futuna">Wallis and Futuna</option>
																		<option value="Western Sahara">Western Sahara</option>
																		<option value="Yemen">Yemen</option>
																		<option value="Zambia">Zambia</option>
																		<option value="Zimbabwe">Zimbabwe</option>
																	</select>
																</div>
															</div>
														</div>
														
													</div>
													<!--duración y tipo de trámite-->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="duracion" id="duracion">
												                        <option selected="selected" disabled="disabled" value="">Seleccione la duración...</option>
												                        <option value="1">1</option>
												                        <option value="2">2</option>
												                        <option value="3">3</option>
												                        <option value="4">4</option>
												                        <option value="5">5</option>
												                        <option value="6">6</option>
												                        <option value="7">7</option>
												                        <option value="8">8</option>
												                        <option value="9">9</option>
												                        <option value="10">10</option>
												                        <option value="11">11</option>
												                    </select>
												                    <select class="form-control input-lg" name="duracion_unid" id="duracion_unid">
												                        <option selected="selected" disabled="disabled" value="">Seleccione la duración...</option>
												                        <option value="1">Meses</option>
												                        <option value="2">Años</option>
												                    </select>
																</div>
															</div>
														</div>

														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-id-card-o fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="tipo_tramite" id="tipo_tramite">
												                        <option selected="selected" disabled="disabled" value="">Seleccione el tipo de trámite</option>
												                        
												                        <option value="1">Nueva Alianza</option>
												                        <option value="2">Prórroga</option>
												                        <option value="3">Modificación</option>
												                        <option value="4">Renovación</option>
												                        <option value="5">Adición</option>
												                        <option value="6">Otro sí</option>
												                        <option value="7">Acta de Iniciación</option>
												                        <option value="8">Acta de Terminación</option>
												                        <option value="9">Carta de Intención</option>
												                    </select>
																</div>
															</div>
														</div>
													</div>
													<!--facultades y programas -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
																	<select class="selectpicker form-control input-lg" name="facultad" title="Seleccione las facultades" multiple>
																		<option>Administración</option>
																		<option>Artes y Humanidades</option>
																		<option>Arquitectura y Diseño</option>
																		<option>Ciencias Económicas y Administrativas</option>
																		<option>Ciencias Naturales</option>
																		<option>Ciencias Sociales</option>
																		<option>Derecho</option>
																		<option>Educación</option>
																		<option>Ingeniería</option>
																		<option>Medicina</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-graduation-cap fa-lg fa-fw"></i></span>
																	<select class="selectpicker form-control input-lg" name="programa" title="Seleccione los programas" multiple>
																		<option>Administración</option>
																		<option>Contaduría Internacional</option>
																		<option>Especialización en Administración Financiera</option>
																		<option>Especialización en Negociación</option>
																		<option>Especialización en Gerencia de Abastecimiento Estratégico</option>
																		<option>Especialización en Inteligencia de Mercados</option>
																		<option>Maestría en Investigación en Administración</option>
																		<option>Maestría en Administración (Tiempo Completo)</option>
																		<option>Maestría en Administración (Tiempo Parcial)</option>
																		<option>Maestría en Administración (Ejecutivo - EMBA)</option>
																		<option>Maestría en Finanzas</option>
																		<option>Maestría en Mercadeo</option>
																		<option>Maestría en Gerencia Ambiental</option>
																		<option>Maestría en Gerencia y Práctica del Desarrollo</option>
																		<option>Arquitectura</option>
																		<option>Diseño</option>
																		<option>Maestría en Arquitectura</option>
																		<option>Maestría en Diseño</option>
																		<option>Arte</option>
																		<option>Historia del Arte</option>
																		<option>Literatura</option>
																		<option>Música</option>
																		<option>Especialización en Creación Multimedia</option>
																		<option>Maestría en Literatura</option>
																		<option>Maestría en Periodismo</option>
																		<option>Doctorado en Literatura</option>
																		<option>Biología</option>
																		<option>Microbiología</option>
																		<option>Física</option>
																		<option>Geociencias</option>
																		<option>Matemáticas</option>
																		<option>Química</option>
																		<option>Maestría en Ciencias Biológicas</option>
																		<option>Maestría en Ciencias - Física</option>
																		<option>Maestría en Matemáticas</option>
																		<option>Maestría en Química</option>
																		<option>Doctorado en Ciencias - Biología</option>
																		<option>Doctorado en Ciencias - Física</option>
																		<option>Doctorado en Matemáticas</option>
																		<option>Doctorado en Ciencias Química</option>
																	</select>
																</div>
															</div>
														</div>		
													</div>		
												</div>
												<div class="tab-pane" id="tab2">
													<br>
													<h3><strong>Paso 2</strong> - Datos Generales de la Institución Contraparte</h3>

													<!--institucion y tipo de institucion -->
													<div class="row">

														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Nombre de la Institución" type="text" name="institucion" id="institucion">
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="tipo_institucion">
																		<option value="" selected="selected">Seleccione el tipo de institucion</option>
												                        
												                        <option value="1">Corporaciones Privadas</option>
												                        <option value="2">Instituciones Públicas</option>
												                        <option value="3">Organizaciones Mixtas</option>
												                        <option value="4">Organismos Multilaterales</option>
												                        <option value="5">Organizaciones No Gubernamentales</option>
												                        <option value="6">Agencias Oficiales</option>
												                        <option value="7">Instituciones de Educación Superior</option>
												                        <option value="8">Representaciones Diplomáticas</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
													<!--direccion y codigo postal -->
													<div class="row">

														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Dirección" type="text" name="direccion" id="direccion">

																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" data-mask="999999" data-mask-placeholder= "X" placeholder="Código postal" type="text" name="codigo_postal" id="codigo_postal">
																</div>
															</div>
														</div>
													</div>
													<!--pais y ciudad -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-flag fa-lg fa-fw"></i></span>
																	<select name="pais" class="form-control input-lg">
																		<option value="" selected="selected">Seleccione el país</option>
																		<option value="United States">United States</option>
																		<option value="United Kingdom">United Kingdom</option>
																		<option value="Afghanistan">Afghanistan</option>
																		<option value="Albania">Albania</option>
																		<option value="Algeria">Algeria</option>
																		<option value="American Samoa">American Samoa</option>
																		<option value="Andorra">Andorra</option>
																		<option value="Angola">Angola</option>
																		<option value="Anguilla">Anguilla</option>
																		<option value="Antarctica">Antarctica</option>
																		<option value="Antigua and Barbuda">Antigua and Barbuda</option>
																		<option value="Argentina">Argentina</option>
																		<option value="Armenia">Armenia</option>
																		<option value="Aruba">Aruba</option>
																		<option value="Australia">Australia</option>
																		<option value="Austria">Austria</option>
																		<option value="Azerbaijan">Azerbaijan</option>
																		<option value="Bahamas">Bahamas</option>
																		<option value="Bahrain">Bahrain</option>
																		<option value="Bangladesh">Bangladesh</option>
																		<option value="Barbados">Barbados</option>
																		<option value="Belarus">Belarus</option>
																		<option value="Belgium">Belgium</option>
																		<option value="Belize">Belize</option>
																		<option value="Benin">Benin</option>
																		<option value="Bermuda">Bermuda</option>
																		<option value="Bhutan">Bhutan</option>
																		<option value="Bolivia">Bolivia</option>
																		<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
																		<option value="Botswana">Botswana</option>
																		<option value="Bouvet Island">Bouvet Island</option>
																		<option value="Brazil">Brazil</option>
																		<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
																		<option value="Brunei Darussalam">Brunei Darussalam</option>
																		<option value="Bulgaria">Bulgaria</option>
																		<option value="Burkina Faso">Burkina Faso</option>
																		<option value="Burundi">Burundi</option>
																		<option value="Cambodia">Cambodia</option>
																		<option value="Cameroon">Cameroon</option>
																		<option value="Canada">Canada</option>
																		<option value="Cape Verde">Cape Verde</option>
																		<option value="Cayman Islands">Cayman Islands</option>
																		<option value="Central African Republic">Central African Republic</option>
																		<option value="Chad">Chad</option>
																		<option value="Chile">Chile</option>
																		<option value="China">China</option>
																		<option value="Christmas Island">Christmas Island</option>
																		<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
																		<option value="Colombia">Colombia</option>
																		<option value="Comoros">Comoros</option>
																		<option value="Congo">Congo</option>
																		<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
																		<option value="Cook Islands">Cook Islands</option>
																		<option value="Costa Rica">Costa Rica</option>
																		<option value="Cote D'ivoire">Cote D'ivoire</option>
																		<option value="Croatia">Croatia</option>
																		<option value="Cuba">Cuba</option>
																		<option value="Cyprus">Cyprus</option>
																		<option value="Czech Republic">Czech Republic</option>
																		<option value="Denmark">Denmark</option>
																		<option value="Djibouti">Djibouti</option>
																		<option value="Dominica">Dominica</option>
																		<option value="Dominican Republic">Dominican Republic</option>
																		<option value="Ecuador">Ecuador</option>
																		<option value="Egypt">Egypt</option>
																		<option value="El Salvador">El Salvador</option>
																		<option value="Equatorial Guinea">Equatorial Guinea</option>
																		<option value="Eritrea">Eritrea</option>
																		<option value="Estonia">Estonia</option>
																		<option value="Ethiopia">Ethiopia</option>
																		<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
																		<option value="Faroe Islands">Faroe Islands</option>
																		<option value="Fiji">Fiji</option>
																		<option value="Finland">Finland</option>
																		<option value="France">France</option>
																		<option value="French Guiana">French Guiana</option>
																		<option value="French Polynesia">French Polynesia</option>
																		<option value="French Southern Territories">French Southern Territories</option>
																		<option value="Gabon">Gabon</option>
																		<option value="Gambia">Gambia</option>
																		<option value="Georgia">Georgia</option>
																		<option value="Germany">Germany</option>
																		<option value="Ghana">Ghana</option>
																		<option value="Gibraltar">Gibraltar</option>
																		<option value="Greece">Greece</option>
																		<option value="Greenland">Greenland</option>
																		<option value="Grenada">Grenada</option>
																		<option value="Guadeloupe">Guadeloupe</option>
																		<option value="Guam">Guam</option>
																		<option value="Guatemala">Guatemala</option>
																		<option value="Guinea">Guinea</option>
																		<option value="Guinea-bissau">Guinea-bissau</option>
																		<option value="Guyana">Guyana</option>
																		<option value="Haiti">Haiti</option>
																		<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
																		<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
																		<option value="Honduras">Honduras</option>
																		<option value="Hong Kong">Hong Kong</option>
																		<option value="Hungary">Hungary</option>
																		<option value="Iceland">Iceland</option>
																		<option value="India">India</option>
																		<option value="Indonesia">Indonesia</option>
																		<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
																		<option value="Iraq">Iraq</option>
																		<option value="Ireland">Ireland</option>
																		<option value="Israel">Israel</option>
																		<option value="Italy">Italy</option>
																		<option value="Jamaica">Jamaica</option>
																		<option value="Japan">Japan</option>
																		<option value="Jordan">Jordan</option>
																		<option value="Kazakhstan">Kazakhstan</option>
																		<option value="Kenya">Kenya</option>
																		<option value="Kiribati">Kiribati</option>
																		<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
																		<option value="Korea, Republic of">Korea, Republic of</option>
																		<option value="Kuwait">Kuwait</option>
																		<option value="Kyrgyzstan">Kyrgyzstan</option>
																		<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
																		<option value="Latvia">Latvia</option>
																		<option value="Lebanon">Lebanon</option>
																		<option value="Lesotho">Lesotho</option>
																		<option value="Liberia">Liberia</option>
																		<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
																		<option value="Liechtenstein">Liechtenstein</option>
																		<option value="Lithuania">Lithuania</option>
																		<option value="Luxembourg">Luxembourg</option>
																		<option value="Macao">Macao</option>
																		<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
																		<option value="Madagascar">Madagascar</option>
																		<option value="Malawi">Malawi</option>
																		<option value="Malaysia">Malaysia</option>
																		<option value="Maldives">Maldives</option>
																		<option value="Mali">Mali</option>
																		<option value="Malta">Malta</option>
																		<option value="Marshall Islands">Marshall Islands</option>
																		<option value="Martinique">Martinique</option>
																		<option value="Mauritania">Mauritania</option>
																		<option value="Mauritius">Mauritius</option>
																		<option value="Mayotte">Mayotte</option>
																		<option value="Mexico">Mexico</option>
																		<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
																		<option value="Moldova, Republic of">Moldova, Republic of</option>
																		<option value="Monaco">Monaco</option>
																		<option value="Mongolia">Mongolia</option>
																		<option value="Montserrat">Montserrat</option>
																		<option value="Morocco">Morocco</option>
																		<option value="Mozambique">Mozambique</option>
																		<option value="Myanmar">Myanmar</option>
																		<option value="Namibia">Namibia</option>
																		<option value="Nauru">Nauru</option>
																		<option value="Nepal">Nepal</option>
																		<option value="Netherlands">Netherlands</option>
																		<option value="Netherlands Antilles">Netherlands Antilles</option>
																		<option value="New Caledonia">New Caledonia</option>
																		<option value="New Zealand">New Zealand</option>
																		<option value="Nicaragua">Nicaragua</option>
																		<option value="Niger">Niger</option>
																		<option value="Nigeria">Nigeria</option>
																		<option value="Niue">Niue</option>
																		<option value="Norfolk Island">Norfolk Island</option>
																		<option value="Northern Mariana Islands">Northern Mariana Islands</option>
																		<option value="Norway">Norway</option>
																		<option value="Oman">Oman</option>
																		<option value="Pakistan">Pakistan</option>
																		<option value="Palau">Palau</option>
																		<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
																		<option value="Panama">Panama</option>
																		<option value="Papua New Guinea">Papua New Guinea</option>
																		<option value="Paraguay">Paraguay</option>
																		<option value="Peru">Peru</option>
																		<option value="Philippines">Philippines</option>
																		<option value="Pitcairn">Pitcairn</option>
																		<option value="Poland">Poland</option>
																		<option value="Portugal">Portugal</option>
																		<option value="Puerto Rico">Puerto Rico</option>
																		<option value="Qatar">Qatar</option>
																		<option value="Reunion">Reunion</option>
																		<option value="Romania">Romania</option>
																		<option value="Russian Federation">Russian Federation</option>
																		<option value="Rwanda">Rwanda</option>
																		<option value="Saint Helena">Saint Helena</option>
																		<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
																		<option value="Saint Lucia">Saint Lucia</option>
																		<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
																		<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
																		<option value="Samoa">Samoa</option>
																		<option value="San Marino">San Marino</option>
																		<option value="Sao Tome and Principe">Sao Tome and Principe</option>
																		<option value="Saudi Arabia">Saudi Arabia</option>
																		<option value="Senegal">Senegal</option>
																		<option value="Serbia and Montenegro">Serbia and Montenegro</option>
																		<option value="Seychelles">Seychelles</option>
																		<option value="Sierra Leone">Sierra Leone</option>
																		<option value="Singapore">Singapore</option>
																		<option value="Slovakia">Slovakia</option>
																		<option value="Slovenia">Slovenia</option>
																		<option value="Solomon Islands">Solomon Islands</option>
																		<option value="Somalia">Somalia</option>
																		<option value="South Africa">South Africa</option>
																		<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
																		<option value="Spain">Spain</option>
																		<option value="Sri Lanka">Sri Lanka</option>
																		<option value="Sudan">Sudan</option>
																		<option value="Suriname">Suriname</option>
																		<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
																		<option value="Swaziland">Swaziland</option>
																		<option value="Sweden">Sweden</option>
																		<option value="Switzerland">Switzerland</option>
																		<option value="Syrian Arab Republic">Syrian Arab Republic</option>
																		<option value="Taiwan, Province of China">Taiwan, Province of China</option>
																		<option value="Tajikistan">Tajikistan</option>
																		<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
																		<option value="Thailand">Thailand</option>
																		<option value="Timor-leste">Timor-leste</option>
																		<option value="Togo">Togo</option>
																		<option value="Tokelau">Tokelau</option>
																		<option value="Tonga">Tonga</option>
																		<option value="Trinidad and Tobago">Trinidad and Tobago</option>
																		<option value="Tunisia">Tunisia</option>
																		<option value="Turkey">Turkey</option>
																		<option value="Turkmenistan">Turkmenistan</option>
																		<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
																		<option value="Tuvalu">Tuvalu</option>
																		<option value="Uganda">Uganda</option>
																		<option value="Ukraine">Ukraine</option>
																		<option value="United Arab Emirates">United Arab Emirates</option>
																		<option value="United Kingdom">United Kingdom</option>
																		<option value="United States">United States</option>
																		<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
																		<option value="Uruguay">Uruguay</option>
																		<option value="Uzbekistan">Uzbekistan</option>
																		<option value="Vanuatu">Vanuatu</option>
																		<option value="Venezuela">Venezuela</option>
																		<option value="Viet Nam">Viet Nam</option>
																		<option value="Virgin Islands, British">Virgin Islands, British</option>
																		<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
																		<option value="Wallis and Futuna">Wallis and Futuna</option>
																		<option value="Western Sahara">Western Sahara</option>
																		<option value="Yemen">Yemen</option>
																		<option value="Zambia">Zambia</option>
																		<option value="Zimbabwe">Zimbabwe</option>
																	</select>
																</div>
															</div>
														</div>

														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-map-marker fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="ciudad">
																		<option value="" selected="selected">Seleccione la ciudad</option>
																		<option>Amsterdam</option>
																		<option>Atlanta</option>
																		<option>Baltimore</option>
																		<option>Boston</option>
																		<option>Buenos Aires</option>
																		<option>Calgary</option>
																		<option>Chicago</option>
																		<option>Denver</option>
																		<option>Dubai</option>
																		<option>Frankfurt</option>
																		<option>Hong Kong</option>
																		<option>Honolulu</option>
																		<option>Houston</option>
																		<option>Kuala Lumpur</option>
																		<option>London</option>
																		<option>Los Angeles</option>
																		<option>Melbourne</option>
																		<option>Mexico City</option>
																		<option>Miami</option>
																		<option>Minneapolis</option>
																	</select>
																</div>
															</div>
														</div>
													</div>

													<!--Nombre del Representante Legal y Lugar de Nacimiento del Representante Legal  -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Nombre del Representante Legal" type="text" name="repre_legal_nombre" id="repre_legal_nombre">
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-percent fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Lugar de Nacimiento del Representante Legal" type="text" name="repre_legal_nacimiento" id="repre_legal_nacimiento">
																</div>
															</div>
														</div>
													</div>

													<!--tipo de Documento y Número de Documento  -->
													<div class="row">
														<div class="col-sm-4">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="tipo_documento">
																		<option value="" selected="selected">Seleccione el tipo de documento</option>
												                        
												                        <option value="1">Cédula de Ciudadanía</option>
												                        <option value="2">Cédula de Extrangería</option>
												                        <option value="3">Pasaporte</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-percent fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Número de Documento" type="text" name="numero_documento" id="numero_documento">
																</div>
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-percent fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Lugar de Expedición del Documento" type="text" name="lugar_exped_documento" id="lugar_exped_documento">
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane" id="tabG1">
													<br>
													<h3><strong>Terminar</strong> - Guardar la Alianza</h3>
													<br>
													<h1 class="text-center text-success"><strong><i class="fa fa-check fa-lg"></i> Completado</strong></h1>
													<h4 class="text-center">Elija la opción <strong>Guardar</strong> para finalizar.</h4>
													<br>

													<div class="col-sm-12 text-center">
														<div class="form-group">
															<button  type="button"class="btn btn-lg btn-info" name="guardar_pre_registro" id="guardar_pre_registro">
																Guardar
															</button>
															&nbsp;&nbsp;&nbsp;
															<button  type="button"class="btn btn-lg btn-success" name="enviar_pre_registro" id="enviar_pre_registro">
																Enviar
															</button>
														</div>
													</div>
													<br>
													<br>
												</div>
		
												<div class="form-actions">
													<div class="row">
														<div class="col-sm-12">
															<ul class="pager wizard no-margin">
																<!--<li class="Previous first disabled">
																<a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
																</li>-->
																<li class="Previous disabled">
																	<a href="javascript:void(0);" class="btn btn-lg btn-default"> Anterior </a>
																</li>
																<!--<li class="next last">
																<a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
																</li>-->
																<li class="next">
																	<a href="javascript:void(0);" class="btn btn-lg txt-color-darken"> Siguiente </a>
																</li>
															</ul>
														</div>
													</div>
												</div>
		
											</div>
										</div>
									</form>
								</div>
		
							</div>
							<!-- end widget content -->
		
						</div>
						<!-- end widget div -->
		
					</div>
					<!-- end widget -->
		
				</article>
				<!-- WIDGET END -->

				<!-- -------------------------------- ----------------------------- -->

				<!-- Registro de una nueva alianza -->

				<!-- NEW WIDGET START -->
				<article class="col-sm-12 col-md-12 col-lg-12 article_registro hide">
		
					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
						<!-- widget options:
						usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
		
						data-widget-colorbutton="false"
						data-widget-editbutton="false"
						data-widget-togglebutton="false"
						data-widget-deletebutton="false"
						data-widget-fullscreenbutton="false"
						data-widget-custombutton="false"
						data-widget-collapsed="true"
						data-widget-sortable="false"
		
						-->
						<header>
							<span class="widget-icon"> <i class="fa fa-check"></i> </span>
							<h2>Formulario de Registro de una Nueva Alianza</h2>
		
						</header>
		
						<!-- widget div-->
						<div>
		
							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->
		
							</div>
							<!-- end widget edit box -->
		
							<!-- widget content -->
							<div class="widget-body">
		
								<div class="row">
									<form id="wizard-1" novalidate>
										<div id="bootstrap-wizard-1" class="col-sm-12">
											<div class="form-bootstrapWizard">
												<ul class="bootstrapWizard form-wizard">
													<li data-target="#step3">
														<a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Datos de Contacto en la Institución Contraparte</span> </a>
													</li>
													<li data-target="#step4">
														<a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Documentos</span> </a>
													</li>
													<li data-target="#step5">
														<a href="#tab5" data-toggle="tab"> <span class="step">5</span> <span class="title">Datos Coordinador de la Alianza en la Universidad Local</span> </a>
													</li>
													<li data-target="#step6">
														<a href="#tab6" data-toggle="tab"> <span class="step">6</span> <span class="title">Datos Coordinador Externo</span> </a>
													</li>
													<li data-target="#stepG2">
														<a href="#tabG2" data-toggle="tab"> <span class="step">G</span> <span class="title">Guardar Formulario</span> </a>
													</li>

												</ul>
												<div class="clearfix"></div>
											</div>
											<div class="tab-content">
												<div class="tab-pane active" id="tab3">
													<br>
													<h3><strong>Paso 3</strong> - Datos de Contacto en la Institución Contraparte</h3>
													<!--Contacto para la alianza y cargo -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Contacto para la Alianza" type="text" name="contacto_alianza" id="contacto_alianza">
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Cargo" type="text" name="cargo" id="cargo">
																</div>
															</div>
														</div>
														
													</div>
													<!--telefono y fax -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Teléfono y Extensión" type="text" name="telefono" id="telefono">
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Fax" type="text" name="fax" id="fax">
																</div>
															</div>
														</div>
														
													</div>
													<!--email -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="email@address.com" type="text" name="email" id="email">
																</div>
															</div>
														</div>

													</div>
												</div>
												<div class="tab-pane" id="tab4">
													
													<br>
													<h3><strong>Paso 4</strong> - Documentos</h3>
													<!--Documentos a revisar por la ORII y otros documentos -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
																	<select class="selectpicker form-control input-lg" name="tipo_institucion" title="Seleccione los documentos a revisar" multiple>												                        
												                        <option value="1">Representación Legal</option>
												                        <option value="2">Acta de Nombramiento</option>
												                        <option value="3">Acta de Posesión</option>
												                        <option value="4">Cédula (C)(E)</option>
												                        <option value="5">Cámara de Comercio</option>
												                        <option value="6">Resolución/Decreto</option>
												                        <option value="7">Personería Jurídica</option>
												                        <option value="8">Carta del Decano(a)</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Otros documentos" type="text" name="otros_documentos" id="otros_documentos">
																</div>
															</div>
														</div>
														
													</div>
													<!--Contacto para el Alianza y cargo -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Archivo con los Documentos" type="file" name="archivo_documentos" id="archivo_documentos">
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane" id="tab5">
													<br>
													<h3><strong>Paso 5</strong> - Datos Coordinador de la Alianza en la Universidad Local</h3>
													
													<!--telefono y fax -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Nombre Coordinador Local" type="text" name="nombre_coordinador" id="nombre_coordinador">
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Cargo Coordinador Local" type="text" name="cargo_coordinador" id="cargo_coordinador">
																</div>
															</div>
														</div>
														
													</div>
													<!--facultad coordinador y emailcoordinador -->
													<div class="row">
														
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="facultad_coordinador" title="Seleccione la facultad">
																		<option value="" selected="selected">Seleccione la facultad</option>
												                        
																		<option>Administración</option>
																		<option>Artes y Humanidades</option>
																		<option>Arquitectura y Diseño</option>
																		<option>Ciencias Económicas y Administrativas</option>
																		<option>Ciencias Naturales</option>
																		<option>Ciencias Sociales</option>
																		<option>Derecho</option>
																		<option>Educación</option>
																		<option>Ingeniería</option>
																		<option>Medicina</option>
																	</select>
																</div>
															</div>
														</div>
														
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="email@address.com" type="text" name="email_coordinador" id="email_coordinador">
																</div>
															</div>
														</div>
														
													</div>
													<!--telefonos -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Teléfonos Coordinador Local" type="text" name="telefonos_coordinador" id="telefonos_coordinador">
																</div>
															</div>
														</div>
														
													</div>
												</div>
												<div class="tab-pane" id="tab6">
													<br>
													<h3><strong>Paso 6</strong> - Datos Coordinador Externo</h3>
													
													<!--telefono y fax -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Nombre Coordinador Externo" type="text" name="nombre_coordi_externo" id="nombre_coordi_externo">
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Cargo Coordinador Externo" type="text" name="cargo_coordi_externo" id="cargo_coordi_externo">
																</div>
															</div>
														</div>
														
													</div>
													<!--email y telefonos coordinador externo -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="email@address.com" type="text" name="email_coordi_externo" id="email_coordi_externo">
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Teléfonos Coordinador Externo" type="text" name="telefonos_coordi_externo" id="telefonos_coordi_externo">
																</div>
															</div>
														</div>
														
													</div>
												</div>
												<div class="tab-pane" id="tabG2">
													<br>
													<h3><strong>Terminar</strong> - Guardar la Alianza</h3>
													<br>
													<h1 class="text-center text-success"><strong><i class="fa fa-check fa-lg"></i> Completado</strong></h1>
													<h4 class="text-center">Elija la opción <strong>Guardar</strong> para finalizar.</h4>
													<br>

													<div class="col-sm-12 text-center">
														<div class="form-group">
															<button  type="button"class="btn btn-lg btn-info" name="guardar_registro" id="guardar_registro">
																Guardar
															</button>
															&nbsp;&nbsp;&nbsp;
															<button  type="button"class="btn btn-lg btn-success" name="enviar_registro" id="enviar_registro">
																Enviar
															</button>
														</div>
													</div>
													<br>
													<br>
												</div>
		
												<div class="form-actions">
													<div class="row">
														<div class="col-sm-12">
															<ul class="pager wizard no-margin">
																<!--<li class="Previous first disabled">
																<a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
																</li>-->
																<li class="Previous disabled">
																	<a href="javascript:void(0);" class="btn btn-lg btn-default"> Anterior </a>
																</li>
																<!--<li class="next last">
																<a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
																</li>-->
																<li class="next">
																	<a href="javascript:void(0);" class="btn btn-lg txt-color-darken"> Siguiente </a>
																</li>
															</ul>
														</div>
													</div>
												</div>
		
											</div>
										</div>
									</form>
								</div>
		
							</div>
							<!-- end widget content -->
		
						</div>
						<!-- end widget div -->
		
					</div>
					<!-- end widget -->
		
				</article>
				<!-- WIDGET END -->

			

				<div class="modal fade" id="thankModal" tabindex="-1" role="dialog">
				    <div class="modal-dialog modal-sm">
				        <div class="modal-content">
				            <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				                <h4 class="modal-title" id="myModalLabel">Thank you</h4>
				            </div>
				            <div class="modal-body">
				                <p class="text-center">Thank you for your order</p>
				            </div>
				        </div>
				    </div>
				</div>

		
			</div>
		
			<!-- end row -->
		
		</section>
		<!-- end widget grid -->

	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
	// include page footer
	include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/smartwidgets/jarvis.widget.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fuelux/wizard/wizard_externo.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/bootstrap/bootstrap-select.min.js"></script>
		

<script type="text/javascript">
	
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	
	$(document).ready(function() {

		  $('.article_registro').find('input, textarea, button, select').attr('disabled','disabled');
		
		  var $validator = $("#wizard-1").validate({
		    
		    rules: {
		      solicitado_por: {
		        required: true
		      },

		      nombres: {
		        required: true
		      },
		      apellidos: {
		        required: true
		      },
		      tdocumento: {
		        required: true
		      },
		      ndocumento: {
		        required: true
		      },
		      emailp: {
		        required: true,
		        email: "Your email address must be in the format of name@domain.com"
		      },
		      emailu: {
		        required: true,
		        email: "Your email address must be in the format of name@domain_university.com"
		      },
		      codigou: {
		        required: true
		      },
		      facultad: {
		        required: true
		      },
		      programa: {
		        required: true
		      },
		      promedio: {
		        required: true
		      },
		      creditos: {
		        required: true
		      },
		      periodo: {
		        required: true
		      },
		      modalidad: {
		        required: true
		      },
		      pais: {
		        required: true
		      },
		      universidad: {
		        required: true
		      }
		    },
		    
		    messages: {
		      solicitado_por: "Por favor, ingrese la facultad que propone la alianza",

		      nombres: "Por favor, ingrese sus nombres",
		      apellidos: "Por favor, ingrese sus apellidos",
		      tdocumento: "Por favor, ingrese su tipo de documento",
		      ndocumento: "Por favor, ingrese su número de documento",
		      emailp: {
		        required: "Necesitamos su correo electrónico personal para contactarlo",
		        email: "Su correo debe tener el formato usuario@dominio.com"
		      },
		      emailu: {
		        required: "Necesitamos su correo electrónico universitario para contactarlo",
		        email: "Su correo debe tener el formato usuario@dominio.com"
		      },
		      codigou: "Por favor, ingrese su código universitario",
		      facultad: "Por favor, ingrese su facultad",
		      programa: "Por favor, ingrese su programa",
		      promedio: "Por favor, ingrese su promedio académico acumulado",
		      creditos: "Por favor, ingrese su porcentaje de creditos aprobados",
		      periodo: "Por favor, ingrese el periodo",
		      modalidad: "Por favor, ingrese la modalidad",
		      pais: "Por favor, ingrese el país",
		      universidad: "Por favor, ingrese la universidad de destino",
		    },
		    
		    highlight: function (element) {
		      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		    },
		    unhighlight: function (element) {
		      $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		    },
		    errorElement: 'span',
		    errorClass: 'help-block',
		    errorPlacement: function (error, element) {
		      if (element.parent('.input-group').length) {
		        error.insertAfter(element.parent());
		      } else {
		        error.insertAfter(element);
		      }
		    }
		  });
		  
		  $('#bootstrap-wizard-1').bootstrapWizard({
		    'tabClass': 'form-wizard',
		    'onNext': function (tab, navigation, index) {
		      var $valid = $("#wizard-1").valid();
		      if (!$valid) {
		        $validator.focusInvalid();
		        return false;
		      } else {
		        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
		          'complete');
		        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
		        .html('<i class="fa fa-check"></i>');
		      }
		    }
		  });



		  $('#enviar_pre_registro, #guardar_pre_registro').on('click', function (e, data) {
		    var botonId = $(this).attr('id');
		    var accion = 'enviados';
		    var color = '#5f895f';
		    var mensaje = 'Cuando la institución contraparte de una respuesta se enviará un mensaje a su correo electrónico.';
		    
		    if ( botonId == 'guardar_pre_registro') {
		    	accion = 'guardados';
		    	color = '#57889C';
		    	mensaje = 'Sus datos han quedado guardados para que los pueda ver o editar en otra ocasión.';
		    };
		    //$("#wizard_registro").submit();
		    //console.log("submitted!");
		    $.smallBox({
		      title: "Perfecto! Sus datos fueron " + accion + " correctamente",
		      content: "Hace <i class='fa fa-clock-o'></i> <i>1 segundos...</i> <br> " + mensaje,
		      color: color,
		      iconSmall: "fa fa-check bounce animated"
		    });
 			

		    if ( botonId == 'enviar_pre_registro') {
		    	$('.article_registro').find('input, textarea, button, select').removeAttr('disabled');
		    
				$('.article_registro').removeClass('hide');  
		    };
			 
		  });

		  $('#enviar_registro, #guardar_registro').on('click', function (e, data) {
		    var botonId = $(this).attr('id');
		    var accion = 'enviados';
		    var color = '#5f895f';
		    var mensaje = 'Cuando sea verificado se enviará un mensaje a su correo electrónico.';
		    
		    if ( botonId == 'guardar_registro') {
		    	accion = 'guardados';
		    	color = '#57889C';
		    	mensaje = 'Sus datos han quedado guardados para que los pueda ver o editar en otra ocasión.';
		    };
		    //$("#wizard_registro").submit();
		    //console.log("submitted!");
		    $.smallBox({
		      title: "Perfecto! Sus datos fueron " + accion + " correctamente",
		      content: "Hace <i class='fa fa-clock-o'></i> <i>1 segundos...</i> <br> " + mensaje,
		      color: color,
		      iconSmall: "fa fa-check bounce animated"
		    });
 			
			 
		  });

		  
	
		// fuelux wizard
		  var wizard = $('.wizard').wizard();
		  
		  wizard.on('finished', function (e, data) {
		    //$("#fuelux-wizard").submit();
		    //console.log("submitted!");
		    $.smallBox({
		      title: "Congratulations! Your form was submitted",
		      content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
		      color: "#5F895F",
		      iconSmall: "fa fa-check bounce animated"
		    });
		    
		  });

	
	})

</script>

<?php 
	//include footer
	include("inc/google-analytics.php"); 
?>