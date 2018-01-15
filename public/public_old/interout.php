<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "InterOut";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css = array('your_style.css','bootstrap-select.min.css');
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["InterChange"]["sub"]["InterOut"]["active"] = true;
include("inc/nav.php");

?>
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
			  <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterChange <span>&gt; InterOut </span></h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
				<ul id="sparks" class="">
					<li class="sparks-info">
						<h5> Mi Presupuesto <span class="txt-color-blue">USD$2.500</span></h5>
						<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
							1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
						</div>
					</li>
				</ul>
			</div>
		</div>
		
		<!-- widget grid -->
		<section id="widget-grid" class="">
		
			<!-- row -->
			<div class="row">


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
									<form class="form-horizontal" id="fuelux-wizard">
										<div id="bootstrap-wizard-1" class="col-sm-12">
		
											<div class="step-pane active col-lg-11" > 
												Este formulario permite que los estudiantes registren sus datos para evaluar sus competencias y otorgar la autorización de movilidad
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

		
				<!-- NEW WIDGET START -->
				<article class="col-sm-12 col-md-12 col-lg-12 article_pre_registro">
		
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
							<h2>Pre registro del estudiante</h2>
		
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
									<form id="wizard_pre_registro" novalidate>
										<div id="bootstrap-wizard_pre_registro" class="col-sm-12">
											<div class="form-bootstrapWizard">
												<ul class="bootstrapWizard form-wizard">
													<li class="active" data-target="#step1">
														<a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title">Datos personales</span> </a>
													</li>
													<li data-target="#step2">
														<a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Información Académica</span> </a>
													</li>
													<li data-target="#step3">
														<a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Información de movilidad</span> </a>
													</li>
													<li data-target="#stepG1">
														<a href="#tabG1" data-toggle="tab"> <span class="step">G</span> <span class="title">Enviar el pre-registro</span> </a>
													</li>
												</ul>
												<div class="clearfix"></div>
											</div>
											<div class="tab-content">
												<div class="tab-pane active" id="tab1">
													<br>
													<h3><strong>Paso 1 </strong> - Datos personales</h3>
													<!--NOMBRES Y APELLIDOS-->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Nombres" type="text" name="nombres" id="nombres">
		
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Apellidos" type="text" name="apellidos" id="apellidos">
		
																</div>
															</div>
														</div>
													</div>
													<!--TIPO Y DOCUMENTO DE IDENTIDAD-->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="tdocumento">
																		<option value="" selected="selected">Seleccione el tipo de documento</option>
																		<option>Cédula de Ciudadanía</option>
																		<option>Cédula de Extranjería</option>
																		<option>Registro civil</option>
																		<option>Tarjeta de identidad</option>
																	</select>
																</div>
															</div>
														</div>

														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-id-card-o fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Número de documento" type="text" name="ndocumento" id="ndocumento">
																</div>
															</div>
														</div>
													</div>
													<!--CORREO_PERSONAL, CORREO_UNIVERSIDAD, CODIGO UNIVERSITARIO -->
													<div class="row">
		
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="email@correo_personal.com" type="text" name="emailp" id="emailp">
		
																</div>
															</div>
		
														</div>
		
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="email@correo_universidad.com" type="text" name="emailu" id="emailu">
		
																</div>
															</div>
		
														</div>
		
													</div>
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" data-mask="99999999" data-mask-placeholder= "X" placeholder="Código universitario" type="text" name="codigou" id="codigou">
																</div>
															</div>
														</div>
													</div>
		
												</div>
												<div class="tab-pane" id="tab2">
													<br>
													<h3><strong>Paso 2</strong> - Información Académica</h3>

													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="facultad">
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
																	<span class="input-group-addon"><i class="fa fa-graduation-cap fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="programa">
																		<option value="" selected="selected">Seleccione el programa</option>
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
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Promedio académico acumulado" type="text" name="promedio" id="promedio">
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-percent fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" data-mask="99" data-mask-placeholder= "99" placeholder="Porcentaje de creditos aprobados" type="text" name="creditos" id="creditos">
																</div>
															</div>
														</div>

													</div>
												</div>
												<div class="tab-pane" id="tab3">
													<br>
													<h3><strong>Paso 3</strong> - Información de movilidad</h3>
													<div class="alert alert-info fade in">
														<button class="close" data-dismiss="alert">
															×
														</button>
														<i class="fa-fw fa fa-info"></i>
														<strong>Importante!</strong> Escoja muy bien la informaciòn de movilidad.
													</div>
													<div class="row">

														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-calendar-check-o fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="periodo">
																		<option value="" selected="selected">Selecione el periodo</option>
																		<option>PRIMER SEMESTRE 2017</option>
																		<option>JUNIO A JULIO 2017</option>
																		<option>SEGUNDO SEMESTRE 2017</option>
																		<option>DICIEMBRE 2017 A ENERO 2018</option>
																		<option>PRIMER SEMESTRE 2018</option>
																		<option>JUNIO A JULIO 2018</option>
																		<option>SEGUNDO SEMESTRE 2018</option>
																		<option>DICIEMBRE 2018 A ENERO 2019</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-list fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="modalidad">
																		<option value="" selected="selected">Seleccione la modalidad</option>
																		<option>Doble Titulación</option>
													                    <option>Gira Académica a Perú</option>
													                    <option>Gira Académica Italia</option>
													                    <option>Korean Studies Summer Program Hannam University</option>
													                    <option>Leadership And Global Understanding - Summer Program</option>
													                    <option>Misión Técnica Ingeniería</option>
													                    <option>Prácticas</option>
													                    <option>Semestre Académico</option>
													                    <option>Summer Program Introduction to Materials Science and Enginnering</option>
													                    <option>Summer Programme Responsible Management Rennes</option>
													                    <option>Voluntariado Impacta Brasil</option>
													                    <option>Voluntariado impacta México</option>
													                    <option>Voluntariado impacta Perú</option>
																		<option>Workshop Internacional Solar Decatholn</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
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
																	<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="universidad">
																		<option value="" selected="selected">Seleccione la universidad de destino</option>
                        												<option value="193">AIESEC BRASIL</option>
													                    <option value="167">AIESEC MEXICO</option>
													                    <option value="192">AIESEC PERÚ</option>
													                    <option value="143">Animal Clinic of Village Square</option>
													                    <option value="142">Animal Medical Hospital</option>
													                    <option value="144">ASLAN y EZCURRA - Arquitectos</option>
													                    <option value="173">Asociación  Brasileña de Hereford y Braford</option>
													                    <option value="166">Aurora Organic Dairy</option>
													                    <option value="161">BAENA CASAMOR ARQUITECTES BCQ</option>
													                    <option value="198">CASA BITALICIA ROMA</option>
													                    <option value="67">Catholic University of Paris</option>
													                    <option value="103">Centro de Educación Militar del Ejercito</option>
													                    <option value="136">CONAHEC - Universidad de Quilmes</option>
													                    <option value="155">CONAHEC - UNIVERSIDAD JUÁREZ AUTÓNOMA DE TABASCO (UJAT)</option>
													                    <option value="104">Congregacion de Hermanos de las Escuelas Cristianas</option>
													                    <option value="105">Corporacion de Ciencias y Desarrollo – Uniciencia</option>
													                    <option value="106">Corporacion Magisterio Formación</option>
													                    <option value="108">Corporación Universitaria Minuto de Dios</option>
													                    <option value="33">EARTH - CR</option>
													                    <option value="63">Ecole Superieure de Commerce – International School of Management - IDRAC</option>
													                    <option value="64">ESC Rennes School of Business</option>
													                    <option value="77">Escuela Bancaria y Comercial -EBC-</option>
													                    <option value="109">Escuela Colombiana de Ingeniería - Julio Garavito</option>
													                    <option value="42">Escuela Superior de Archivística y Gestión de documentos de la Universidad Autónoma de Barcelona</option>
													                    <option value="164">Freie University de Berlin</option>
													                    <option value="110">Fundación Caminos de Identidad</option>
													                    <option value="111">Fundacion Creciendo Unidos</option>
													                    <option value="112">Fundación Idesa</option>
													                    <option value="177">Fundación LABITAT</option>
													                    <option value="132">Fundación Teimaken</option>
													                    <option value="113">Fundación Universidad Autónoma de Colombia</option>
													                    <option value="114">Fundación Universitaria Empresarial de la Cámara de Comercio de Bogotá- Uniempresarial</option>
													                    <option value="115">Fundacion Universitaria Sanitas</option>
													                    <option value="65">Groupe Ecole Superieure de Commerce Chambéry Savoie</option>
													                    <option value="102">Hacettepe University</option>
													                    <option value="190">Hacienda Los Angeles</option>
													                    <option value="30">Hannam University</option>
													                    <option value="137">HOSPITAL CENTRO DE CUIDADOS INTENSIVOS PARA EQUINOS LOS AZULEJOS</option>
													                    <option value="178">IALU</option>
													                    <option value="66">IGS Group – The American Business School, Paris</option>
													                    <option value="157">In Vitro</option>
													                    <option value="185">INSEEC BUSINESS SCHOOL</option>
													                    <option value="116">Institución Universitaria CESMAG</option>
													                    <option value="69">Institut des Sciences de la Vision</option>
													                    <option value="78">Instituto Mexicano de Doctrina Social Cristiana</option>
													                    <option value="93">Instituto Superior de Optometría y Ciencias Eurohispano</option>
													                    <option value="34">Instituto Superior Politécnico ¨Jose Antonio Echeverría¨</option>
													                    <option value="117">Instituto Tecnológico Metropolitano</option>
													                    <option value="31">Keimyung University</option>
													                    <option value="53">Kentucky State University</option>
													                    <option value="118">La santa iglesia Católica Anglicana del Caribe</option>
													                    <option value="151">Massey University</option>
													                    <option value="176">MAYNOOTH UNIVERSITY</option>
													                    <option value="18">Mount Royal University</option>
													                    <option value="73">National University of Ireland Maynooth</option>
													                    <option value="61">Nova  Southeastern University</option>
													                    <option value="158">Organisme de Selection en Race Normande</option>
													                    <option value="175">Ostwestfalen-Lippe University of Applied Sciences</option>
													                    <option value="172">Partners of The Americas</option>
													                    <option value="140">Performance Equine VS</option>
													                    <option value="145">Polo Day - Argentina</option>
													                    <option value="9">Pontifica Universidad Católica de Paraná</option>
													                    <option value="29">Pontificia Universidad Católica de Valparaiso</option>
													                    <option value="97">Pontificia Universidad Católica Madre y Maestra de Santo Domingo</option>
													                    <option value="125">Pontificia Universidad Javeriana</option>
													                    <option value="150">PUMMA - Universidad Militar Nueva Granada</option>
													                    <option value="56">Saint Mary´s University of Minnesota</option>
													                    <option value="19">Saint Paul University</option>
													                    <option value="181">Taller Internacional Ciudad de Quito</option>
													                    <option value="57">The New England -College of Optometry (Boston )</option>
													                    <option value="58">The University of Alabama at Birmingham</option>
													                    <option value="40">The University of Dundee</option>
													                    <option value="59">The University of Mississippi</option>
													                    <option value="141">Town &amp; Country Veterinary Clinic</option>
													                    <option value="54">Troy University</option>
													                    <option value="119">UDCA</option>
													                    <option value="23">Universidad Austral de Chile</option>
													                    <option value="79">Universidad Autónoma de Aguascalientes</option>
													                    <option value="168">UNIVERSIDAD AUTONOMA DE CHIHUAHUA</option>
													                    <option value="91">Universidad Autónoma de Chiriquí</option>
													                    <option value="120">Universidad Autónoma de Occidente</option>
													                    <option value="197">Universidad Autónoma Metropolitana de México</option>
													                    <option value="99">Universidad Católica Andrés Bello</option>
													                    <option value="24">Universidad Católica Cardenal Raúl Silva Henríquez</option>
													                    <option value="90">Universidad Católica Redemptoris Mater</option>
													                    <option value="92">Universidad Católica Santa María La Antigua</option>
													                    <option value="101">Universidad Central de Chile</option>
													                    <option value="162">UNIVERSIDAD CES</option>
													                    <option value="121">Universidad Colegio Mayor de Cundinamarca</option>
													                    <option value="2">Universidad de Buenos Aires - Facultad de Agronomía</option>
													                    <option value="174">Universidad de Buenos Aires - Facultad de Ciencias Económicas y Sociales</option>
													                    <option value="1">Universidad de Buenos Aires - Facultad de Ciencias Veterinarias</option>
													                    <option value="3">Universidad de Buenos Aires - Facultad de Ingeniería</option>
													                    <option value="35">Universidad de Camagüey</option>
													                    <option value="25">Universidad de Chile</option>
													                    <option value="45">Universidad de Córdoba</option>
													                    <option value="46">Universidad de Extremadura</option>
													                    <option value="10">Universidad de Fortaleza</option>
													                    <option value="47">Universidad de Granada</option>
													                    <option value="80">Universidad de Guadalajara</option>
													                    <option value="36">Universidad de Holguín ¨Oscar Lucero Moya¨</option>
													                    <option value="138">Universidad de Los Lagos</option>
													                    <option value="122">Universidad de Manizales y Cinde</option>
													                    <option value="20">Universidad de Ottawa</option>
													                    <option value="74">Universidad de Roma ¨La Sapienza¨</option>
													                    <option value="123">Universidad de San Buenaventura - Cali</option>
													                    <option value="124">Universidad de San Buenaventura - Cartagena</option>
													                    <option value="26">Universidad de Santiago de Chile</option>
													                    <option value="154">Universidad de Santiago de Compostela</option>
													                    <option value="11">Universidad de Sao Paulo - Facultad de Medicina Veterinaria</option>
													                    <option value="76">Universidad de Tokio</option>
													                    <option value="49">Universidad de Valladolid (Instituto Universitario de Oftalmobiología Aplicada (IOBA)</option>
													                    <option value="98">Universidad de Yacambú</option>
													                    <option value="134">Universidad del Bio Bio</option>
													                    <option value="196">UNIVERSIDAD ESAN</option>
													                    <option value="14">Universidad Estadual de Maringá</option>
													                    <option value="12">Universidad Estadual Paulista</option>
													                    <option value="194">UNIVERSIDAD ESTATAL DE SONORA (CONAHEC)</option>
													                    <option value="52">Universidad Europea de Madrid</option>
													                    <option value="195">Universidad Federal de Integración de América Latina en Foz de Iguacu</option>
													                    <option value="15">Universidad Federal de Pelotas</option>
													                    <option value="16">Universidad Federal de Rio Grande del Sur</option>
													                    <option value="17">Universidad Federal de Uberlandia</option>
													                    <option value="186">UNIVERSIDAD FRANCISCO DE PAULA SANTANDER</option>
													                    <option value="71">Universidad Francisco Marroquín</option>
													                    <option value="95">Universidad Interamericana de Puerto Rico</option>
													                    <option value="37">Universidad Interamericana del Ecuador</option>
													                    <option value="126">Universidad La gran Colombia Seccional Armenia</option>
													                    <option value="27">Universidad Mayor de Chile</option>
													                    <option value="165">Universidad Miguel Hernandez de Elche</option>
													                    <option value="127">Universidad Militar Nueva Granada</option>
													                    <option value="72">Universidad Nacional Autónoma de Honduras</option>
													                    <option value="87">Universidad Nacional Autónoma de México (UNAM)</option>
													                    <option value="191">Universidad Nacional de Chonnam</option>
													                    <option value="189">UNIVERSIDAD NACIONAL DE COLOMBIA</option>
													                    <option value="153">Universidad Nacional de Colombia</option>
													                    <option value="38">Universidad Nacional de Loja</option>
													                    <option value="152">Universidad Nacional de Villa María</option>
													                    <option value="4">Universidad Nacional del Litoral</option>
													                    <option value="100">Universidad Nacional Experimental de los Llanos Centrales Rómulo Gallegos</option>
													                    <option value="128">Universidad Pedagógica Nacional</option>
													                    <option value="129">Universidad Pedagógica y Tecnológica de Colombia- Tunja</option>
													                    <option value="130">Universidad Piloto de Colombia</option>
													                    <option value="6">Universidad Privada de Santa Cruz de La Sierra</option>
													                    <option value="28">Universidad San Sebastián</option>
													                    <option value="131">Universidad Santo Tomás</option>
													                    <option value="148">Universidad Sergio Arboleda</option>
													                    <option value="182">Universidad Tecnológica de Panamá</option>
													                    <option value="39">Universidad Tecnológica Equinoccial</option>
													                    <option value="94">Universidade do Porto</option>
													                    <option value="13">Universidade Estadual de Campinas</option>
													                    <option value="75">Universidades Publicas del Eje Cafetero para el Desarrollo Regional. Alma Mater</option>
													                    <option value="68">Université de Perpignan</option>
													                    <option value="21">Université Laval</option>
													                    <option value="60">University of Delaware</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon">
																		<span class="checkbox">
																			<label>
																			  <input type="checkbox" class="checkbox style-0" value="">
																			  <span></span>
																			  &nbsp;&nbsp;&nbsp;&nbsp;Prorroga de la movilidad
																			</label>
																		</span>
																	</span>																
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane" id="tabG1">
													<br>
													<h3><strong>Terminado</strong> - Enviar el pre-registro</h3>
													<br>
													<h1 class="text-center text-success"><strong><i class="fa fa-check fa-lg"></i> Perfecto</strong></h1>
													<h4 class="text-center">Escoja la opción <strong>Enviar</strong></h4>
													<br>
												
													<div class="col-sm-12 text-center">
														<div class="form-group">
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
																	<a href="javascript:void(0);" class="btn btn-lg btn-default"> Previous </a>
																</li>
																<!--<li class="next last">
																<a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
																</li>-->
																<li class="next">
																	<a href="javascript:void(0);" class="btn btn-lg txt-color-darken"> Next </a>
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
				<!-- END WIDGET  -->


				<!-- NEW WIDGET START -->
				<article class="col-sm-12 col-md-12 col-lg-12 article_registro hide">
					<!-- -------- ----------------  REGISTRO ------------ ------------ -->

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false">
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
							<h2>Registro del estudiante</h2>
		
						</header>
		
						<!-- widget div-->
						<div role="content">
		
							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->
		
							</div>
							<!-- end widget edit box -->
		
							<!-- widget content -->
							<div class="widget-body fuelux">
		
								<!--div class="wizard" id="orderWizard"-->
								<div class="wizard wizard_registro" id="orderWizard">
									<ul class="steps">
										<li data-target="#step1" class="active">
											<span class="badge badge-info">4</span>Datos Personales<span class="chevron"></span>
										</li>
										<li data-target="#step2">
											<span class="badge">5</span>Datos de Contacto<span class="chevron"></span>
										</li>
										<li data-target="#step3">
											<span class="badge">6</span>Información Académica<span class="chevron"></span>
										</li>
										<li data-target="#step4">
											<span class="badge">7</span>Información de la movilidad<span class="chevron"></span>
										</li>
										<li data-target="#step5">
											<span class="badge">8</span>Contacto en caso de emergencia<span class="chevron"></span>
										</li>
										<li data-target="#step6">
											<span class="badge">9</span>Financiación Nacional<span class="chevron"></span>
										</li>
										<li data-target="#step7">
											<span class="badge">10</span>Financiación Internacional<span class="chevron"></span>
										</li>
										<li data-target="#step8">
											<span class="badge">11</span>Presupuesto<span class="chevron"></span>
										</li>
										<li data-target="#step9">
											<span class="badge">12</span>Documentos de Soporte<span class="chevron"></span>
										</li>
										<li data-target="#step10">
											<span class="badge">13</span>Foto<span class="chevron"></span>
										</li>
										<li data-target="#stepG2">
											<span class="badge">G</span>Guardar y Enviar<span class="chevron"></span>
										</li>
									</ul>
									<div class="actions">
										<button type="button" class="btn btn-sm btn-primary btn-prev">
											<i class="fa fa-arrow-left"></i>Anterior
										</button>
										<button type="button" class="btn btn-sm btn-success btn-next" data-last="Enviar">
											Siguiente<i class="fa fa-arrow-right"></i>
										</button>
									</div>
								</div>
								<div class="step-content">
									<br>
									<br>
									<form  class="form-horizontal" id="wizard_registro" method="post">
										<div class="step-pane active" id="step1">
											<h3><strong>Paso 4 </strong> - Datos Personales</h3>
		
											<!--NOMBRES Y APELLIDOS-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Nombres" type="text" name="nombres" id="nombres">

														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Apellidos" type="text" name="apellidos" id="apellidos">

														</div>
													</div>
												</div>
											</div>
											<!--código universitario y genero-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" data-mask="99999999" data-mask-placeholder= "X" placeholder="Código universitario" type="text" name="codigou" id="codigou">
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="genero">
																<option value="" selected="selected">Seleccione el género</option>
																<option>Femenino</option>
																<option>Masculino</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<!--nacionalidad y No. pasaporte -->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="nacionalidad">
																<option value="" selected="selected">Seleccione la nacionalidad</option>
																<option>Colombiana</option>
																<option>Angoleña</option>
																<option>Argelina</option>
																<option>Camerunesa</option>
																<option>Etíope</option>
																<option>Ecuatoguineana</option>
																<option>Egipcia</option>
																<option>Liberiana</option>
																<option>Libia</option>
																<option>Marroquí</option>
																<option>Namibia</option>
																<option>Nigeriana</option>
																<option>Saharaui</option>
																<option>Senegalesa</option>
																<option>Sudafricana</option>
																<option>Togolesa</option>

																<option>Canadiense</option>
																<option>Estadounidense</option>
																<option>Mexicana</option>

																<option>Beliceña</option>
																<option>Costarricense</option>
																<option>Guatemalteca</option>
																<option>Hondureña</option>
																<option>Nicaragüense</option>
																<option>Panameña</option>
																<option>Salvadoreña</option>

																<option>Cubana</option>
																<option>Arubana</option>
																<option>Bahameña</option>
																<option>Barbadense</option>
																<option>Dominiquesa</option>
																<option>Dominicana</option>
																<option>Haitiana</option>
																<option>Jamaiquina</option>
																<option>Puertorriqueña</option>
																<option>Sancristobaleña</option>
																<option>Santaluciana</option>
																<option>Sanvicentina</option>

																<option>Argentina</option>
																<option>Boliviana</option>
																<option>Brasileña</option>
																<option>Chilena</option>
																<option>Ecuatoriana</option>
																<option>Guyanesa</option>
																<option>Paraguaya</option>
																<option>Peruana</option>
																<option>Surinamesa</option>
																<option>Uruguaya</option>
																<option>Venezolana</option>

																<option>Europea</option>
																<option>Albanesa</option>
																<option>Alemana</option>
																<option>Andorrana</option>
																<option>Armenia</option>
																<option>Austríaca</option>
																<option>Belga</option>
																<option>Bielorrusa</option>
																<option>Bosnia</option>
																<option>Búlgara</option>
																<option>Checa</option>
																<option>Chipriota</option>
																<option>Croata</option>
																<option>Danesa</option>
																<option>Escocesa</option>
																<option>Eslovaca</option>
																<option>Eslovena</option>
																<option>Española</option>
																<option>Estonia</option>
																<option>Finlandesa</option>
																<option>Francesa</option>
																<option>Griega</option>
																<option>Holandesa</option>
																<option>Húngara</option>
																<option>Británica</option>
																<option>Irlandesa</option>
																<option>Italiana</option>
																<option>Letona</option>
																<option>Lituana</option>
																<option>Luxemburguesa</option>
																<option>Maltesa</option>
																<option>Moldava</option>
																<option>Monegasca</option>
																<option>Montenegrina</option>
																<option>Noruega</option>
																<option>Polaca</option>
																<option>Portuguesa</option>
																<option>Rumana</option>
																<option>Rusa</option>
																<option>Serbia</option>
																<option>Sueca</option>
																<option>Suiza</option>
																<option>Turca</option>
																<option>Ucraniana</option>


																<option>Australiana</option>
																<option>Neozelandesa</option>
															</select>
														</div>
													</div>
												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Seleccione el No. de Pasaporte" type="text" name="pasaporte" id="pasaporte">

														</div>
													</div>

												</div>

											</div>
											<!-- fecha de expedición y de vencimiento del pasaporte -->
											<div class="row">

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Seleccione la fecha de expedición" type="date" name="fecha_exp_pasaporte" id="fecha_exp_pasaporte">

														</div>
													</div>

												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Seleccione la fecha de vencimiento" type="date" name="fecha_venc_pasaporte" id="fecha_venc_pasaporte">

														</div>
													</div>

												</div>

											</div>
		
										</div>
		
										<div class="step-pane" id="step2">
											<h3><strong>Paso 5 </strong> - Datos de Contacto</h3>
		
											<!--correo personal y universitario-->
											<div class="row">
												
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="email@correo_personal.com" type="text" name="emailp" id="emailp">

														</div>
													</div>
												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="email@correo_universidad.com" type="text" name="emailu" id="emailu">

														</div>
													</div>
												</div>
											</div>
											<!--ciudad y direccion residencia-->
											<div class="row">

												
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="ciudad">
																<option value="" selected="selected">Seleccione la ciudad</option>
																<option>Bogotá</option>
																<option value="461">AGUA DE DIOS</option>
																<option value="462">ALBAN</option>
																<option value="463">ANAPOIMA</option>
																<option value="464">ANOLAIMA</option>
																<option value="465">ARBELAEZ</option>
																<option value="466">BELTRAN</option>
																<option value="467">BITUIMA</option>
																<option value="468">BOJACA</option>
																<option value="469">CABRERA</option>
																<option value="470">CACHIPAY</option>
																<option value="471">CAJICA</option>
																<option value="472">CAPARRAPI</option>
																<option value="473">CAQUEZA</option>
																<option value="474">CARMEN DE CARUPA</option>
																<option value="475">CHAGUANI</option>
																<option value="476">CHIA</option>
																<option value="477">CHIPAQUE</option>
																<option value="478">CHOACHI</option>
																<option value="479">CHOCONTA</option>
																<option value="480">COGUA</option>
																<option value="481">COTA</option>
																<option value="482">CUCUNUBA</option>
																<option value="483">EL COLEGIO</option>
																<option value="484">EL PEÑON</option>
																<option value="485">EL ROSAL</option>
																<option value="486">FACATATIVA</option>
																<option value="487">FOMEQUE</option>
																<option value="488">FOSCA</option>
																<option value="489">FUNZA</option>
																<option value="490">FUQUENE</option>
																<option value="491">FUSAGASUGA</option>
																<option value="492">GACHALA</option>
																<option value="493">GACHANCIPA</option>
																<option value="494">GACHETA</option>
																<option value="495">GAMA</option>
																<option value="496">GIRARDOT</option>
																<option value="497">GRANADA</option>
																<option value="498">GUACHETA</option>
																<option value="499">GUADUAS</option>
																<option value="500">GUASCA</option>
																<option value="501">GUATAQUI</option>
																<option value="502">GUATAVITA</option>
																<option value="503">GUAYABAL DE SIQUIMA</option>
																<option value="504">GUAYABETAL</option>
																<option value="505">GUTIERREZ</option>
																<option value="506">JERUSALEN</option>
																<option value="507">JUNIN</option>
																<option value="508">LA CALERA</option>
																<option value="509">LA MESA</option>
																<option value="510">LA PALMA</option>
																<option value="511">LA PEÑA</option>
																<option value="512">LA VEGA</option>
																<option value="513">LENGUAZAQUE</option>
																<option value="514">MACHETA</option>
																<option value="515">MADRID</option>
																<option value="516">MANTA</option>
																<option value="517">MEDINA</option>
																<option value="518">MOSQUERA</option>
																<option value="519">NARIÑO</option>
																<option value="520">NEMOCON</option>
																<option value="521">NILO</option>
																<option value="522">NIMAIMA</option>
																<option value="523">NOCAIMA</option>
																<option value="524">VENECIA</option>
																<option value="525">PACHO</option>
																<option value="526">PAIME</option>
																<option value="527">PANDI</option>
																<option value="528">PARATEBUENO</option><option value="529">PASCA</option><option value="530">PUERTO SALGAR</option><option value="531">PULI</option><option value="532">QUEBRADANEGRA</option><option value="533">QUETAME</option><option value="534">QUIPILE</option><option value="535">APULO</option><option value="536">RICAURTE</option><option value="537">SAN ANTONIO DEL TEQUENDAMA</option><option value="538">SAN BERNARDO</option><option value="539">SAN CAYETANO</option><option value="540">SAN FRANCISCO</option><option value="541">SAN JUAN DE RIO SECO</option><option value="542">SASAIMA</option><option value="543">SESQUILE</option><option value="544">SIBATE</option><option value="545">SILVANIA</option><option value="546">SIMIJACA</option><option value="547">SOACHA</option><option value="548">SOPO</option><option value="549">SUBACHOQUE</option><option value="550">SUESCA</option><option value="551">SUPATA</option><option value="552">SUSA</option><option value="553">SUTATAUSA</option><option value="554">TABIO</option><option value="555">TAUSA</option><option value="556">TENA</option><option value="557">TENJO</option><option value="558">TIBACUY</option><option value="559">TIBIRITA</option><option value="560">TOCAIMA</option><option value="561">TOCANCIPA</option><option value="562">TOPAIPI</option><option value="563">UBALA</option><option value="564">UBAQUE</option><option value="565">VILLA DE SAN DIEGO DE UBATE</option><option value="566">UNE</option><option value="567">UTICA</option><option value="568">VERGARA</option><option value="569">VIANI</option><option value="570">VILLAGOMEZ</option><option value="571">VILLAPINZON</option><option value="572">VILLETA</option><option value="573">VIOTA</option><option value="574">YACOPI</option><option value="575">ZIPACON</option><option value="576">ZIPAQUIRA</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Dirección de residencia" type="text" name="direccion" id="direccion">

														</div>
													</div>
												</div>
											</div>
											<!--codigo postal, telefono fijo y celular -->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" data-mask="999999" data-mask-placeholder= "X" placeholder="Código postal" type="text" name="codigo_postal" id="codigo_postal">
														</div>
													</div>
												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" data-mask="(999) 999-9999" data-mask-placeholder= "X" placeholder="Teléfono fijo" type="text" name="telefono" id="telefono">
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" data-mask="+9 999-9999" data-mask-placeholder= "X" placeholder="Celular" type="text" name="celular" id="celular">
														</div>
													</div>
												</div>
											</div>
		
										</div>
		
										<div class="step-pane" id="step3">
											<h3><strong>Paso 6 </strong> - Información Académica</h3>
		
											<!--facultad y programa-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="facultad">
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
															<span class="input-group-addon"><i class="fa fa-graduation-cap fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="programa">
																<option value="" selected="selected">Seleccione el programa</option>
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
											<h4><strong>Idiomas </strong> - Especifique los idiomas que maneja.</h4>
											<br>		
											<fieldset>
												<section>

													<!--idioma y cuenta con certificado-->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="idioma">
																		<option value="" selected="selected">Seleccione el idioma</option>
																		<option>Achuar</option>
																		<option>Afrikáans</option>
																		<option>Aguaruna</option>
																		<option>Aimara</option>
																		<option>Albanés</option>
																		<option>Alemán</option>
																		<option>Amarakaeri</option>
																		<option>Amárico</option>
																		<option>Amuesha</option>
																		<option>Árabe</option>
																		<option>Araona</option>
																		<option>Armenio</option>
																		<option>Asháninca</option>
																		<option>Aymara</option>
																		<option>Azerí</option>
																		<option>Baure</option>
																		<option>Bengalí</option>
																		<option>Bésiro</option>
																		<option>Bielorruso</option>
																		<option>Birmano</option>
																		<option>Bislama</option>
																		<option>Bora</option>
																		<option>Bosnio</option>
																		<option>Búlgaro</option>
																		<option>Candoshi</option>
																		<option>Canichana</option>
																		<option>Capanahua</option>
																		<option>Caquinte</option>
																		<option>Cashibo-Cacataibo</option>
																		<option>Cashinahua</option>
																		<option>Castellano</option>
																		<option>Catalán</option>
																		<option>Cauqui</option>
																		<option>Cavineño</option>
																		<option>Cayubaba</option>
																		<option>Chácobo</option>
																		<option>Chayahuita</option>
																		<option>Checo</option>
																		<option>Chicheua</option>
																		<option>Chimán</option>
																		<option>Cingalés </option>
																		<option>Cocama</option>
																		<option>Comorense</option>
																		<option>Coreano</option>
																		<option>Criollo Haitiano</option>
																		<option>Criollo Seychellense</option>
																		<option>Croata </option>
																		<option>Croata</option>
																		<option>Culina</option>
																		<option>Danés</option>
																		<option>Dzongka</option>
																		<option>Ese Ejja</option>
																		<option>Eslovaco</option>
																		<option>Esloveno</option>
																		<option>Español</option>
																		<option>Estonio</option>
																		<option>Filipino</option>
																		<option>Finés¹</option>
																		<option>Fiyiano</option>
																		<option>Francés </option>
																		<option>Francés</option>
																		<option>Georgiano</option>
																		<option>Griego</option>
																		<option>Guaraní</option>
																		<option>Guarasu’We</option>
																		<option>Guarayu</option>
																		<option>Hebreo</option>
																		<option>Hindi</option>
																		<option>Hiri Motu</option>
																		<option>Huambisa</option>
																		<option>Huitoto</option>
																		<option>Húngaro</option>
																		<option>Indonesio</option>
																		<option>Indostano Fiyiano</option>
																		<option>Inglés</option>
																		<option>Irlandés</option>
																		<option>Islandés</option>
																		<option>Italiano</option>
																		<option>Itonama</option>
																		<option>Japonés</option>
																		<option>Jaqaru</option>
																		<option>Jébero</option>
																		<option>Jemer</option>
																		<option>Kazajo</option>
																		<option>Kirguís</option>
																		<option>Kiribatiano</option>
																		<option>Lao</option>
																		<option>Latín</option>
																		<option>Leco</option>
																		<option>Lengua De Signos Española </option>
																		<option>Lengua De Signos Neozelandesa</option>
																		<option>Letón</option>
																		<option>Lituano</option>
																		<option>Luxemburgués</option>
																		<option>Macedonio</option>
																		<option>Machajuyai-Kallawaya</option>
																		<option>Machiguenga</option>
																		<option>Machineri</option>
																		<option>Malayo</option>
																		<option>Maldivo</option>
																		<option>Malgache</option>
																		<option>Maltés</option>
																		<option>Mandarín</option>
																		<option>Maorí</option>
																		<option>Maropa</option>
																		<option>Marshalés</option>
																		<option>Matsés</option>
																		<option>Mojeño-Ignaciano</option>
																		<option>Mojeño-Trinitario</option>
																		<option>Moldavo</option>
																		<option>Mongol</option>
																		<option>Moré</option>
																		<option>Mosetén</option>
																		<option>Movima</option>
																		<option>Nauruano</option>
																		<option>Ndebele Meridional</option>
																		<option>Neerlandés</option>
																		<option>Nepalí</option>
																		<option>Noruego</option>
																		<option>Omagua</option>
																		<option>Pacawara</option>
																		<option>Palaosiano</option>
																		<option>Pastún</option>
																		<option>Persa</option>
																		<option>Polaco</option>
																		<option>Portugués</option>
																		<option>Puquina</option>
																		<option>Quechua</option>
																		<option>Romanche</option>
																		<option>Ruanda</option>
																		<option>Rumano</option>
																		<option>Rundi</option>
																		<option>Ruso</option>
																		<option>Samoano</option>
																		<option>Serbio</option>
																		<option>Shipibo-Conibo</option>
																		<option>Sirionó</option>
																		<option>Somalí</option>
																		<option>Soto Meridional</option>
																		<option>Soto Septentrional</option>
																		<option>Suahili</option>
																		<option>Suazi</option>
																		<option>Sueco²</option>
																		<option>Tacana</option>
																		<option>Tailandés</option>
																		<option>Tamil</option>
																		<option>Tapiete</option>
																		<option>Tayiko</option>
																		<option>Tetum</option>
																		<option>Ticuna</option>
																		<option>Tigriña</option>
																		<option>Tok Pisin</option>
																		<option>Tongano</option>
																		<option>Toromona</option>
																		<option>Tsonga</option>
																		<option>Tsuana</option>
																		<option>Turco</option>
																		<option>Turcomano</option>
																		<option>Tuvaluano</option>
																		<option>Ucraniano</option>
																		<option>Urarina</option>
																		<option>Urdu</option>
																		<option>Uru-Chipaya</option>
																		<option>Uzbeko</option>
																		<option>Venda</option>
																		<option>Vietnamita</option>
																		<option>Weenhayek</option>
																		<option>Xosa</option>
																		<option>Yagua</option>
																		<option>Yaminawa</option>
																		<option>Yine</option>
																		<option>Yuki</option>
																		<option>Yuracaré</option>
																		<option>Zamuco</option>
																		<option>Zulú</option>
																		
																	</select>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon">
																		<span class="checkbox">
																			<label>
																			  <input type="checkbox" class="checkbox style-0" value="" name="certificado" id="certificado">
																			  <span></span>
																			  &nbsp;&nbsp;&nbsp;&nbsp;¿Cuenta con certificado?
																			</label>
																		</span>
																	</span>																
																</div>
															</div>
														</div>
													</div>
													<!--nombre del examen y nivel alcanzado -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Nombre del examen" type="text" name="nombre_examen" id="nombre_examen">
																</div>
															</div>
														</div>

														<div class="col-sm-6">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
																	<select class="form-control input-lg" name="nivel_idioma">
																		<option value="" selected="selected">Seleccione el nivel alcanzado</option>
																		<option>Nativo</option>
																		<option>A1 Básico</option>
																		<option>A2 Elemental</option>
																		<option>B1 Pre-intermedio</option>
																		<option>B2 Intermedio superior</option>
																		<option>C1 Avanzado</option>
																		<option>C2 Superior</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-2">
															<div class="form-group">
																<div class="input-group">
																	<button  type="button"class="btn btn-lg btn-primary" name="agregar_idioma" id="agregar_idioma">
																		Agregar
																	</button>
																</div>
															</div>
														</div>
													</div>
												</section>
											</fieldset>
										</div>
		
										<div class="step-pane" id="step4">
											<h3><strong>Paso 7 </strong> - Información de movilidad</h3>
		
											<!--periodo y modalidad-->
											
											<div class="row">

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-calendar-check-o fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="periodo">
																<option value="" selected="selected">Selecione el periodo</option>
																<option>PRIMER SEMESTRE 2017</option>
																<option>JUNIO A JULIO 2017</option>
																<option>SEGUNDO SEMESTRE 2017</option>
																<option>DICIEMBRE 2017 A ENERO 2018</option>
																<option>PRIMER SEMESTRE 2018</option>
																<option>JUNIO A JULIO 2018</option>
																<option>SEGUNDO SEMESTRE 2018</option>
																<option>DICIEMBRE 2018 A ENERO 2019</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-list fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="modalidad">
																<option value="" selected="selected">Seleccione la modalidad</option>
																<option>Doble Titulación</option>
											                    <option>Gira Académica a Perú</option>
											                    <option>Gira Académica Italia</option>
											                    <option>Korean Studies Summer Program Hannam University</option>
											                    <option>Leadership And Global Understanding - Summer Program</option>
											                    <option>Misión Técnica Ingeniería</option>
											                    <option>Prácticas</option>
											                    <option>Semestre Académico</option>
											                    <option>Summer Program Introduction to Materials Science and Enginnering</option>
											                    <option>Summer Programme Responsible Management Rennes</option>
											                    <option>Voluntariado Impacta Brasil</option>
											                    <option>Voluntariado impacta México</option>
											                    <option>Voluntariado impacta Perú</option>
																<option>Workshop Internacional Solar Decatholn</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<!--universidad de destino y campus-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="universidad_destino">
																<option value="" selected="selected">Seleccione la universidad de destino</option>
                												<option value="193">AIESEC BRASIL</option>
											                    <option value="167">AIESEC MEXICO</option>
											                    <option value="192">AIESEC PERÚ</option>
											                    <option value="143">Animal Clinic of Village Square</option>
											                    <option value="142">Animal Medical Hospital</option>
											                    <option value="144">ASLAN y EZCURRA - Arquitectos</option>
											                    <option value="173">Asociación  Brasileña de Hereford y Braford</option>
											                    <option value="166">Aurora Organic Dairy</option>
											                    <option value="161">BAENA CASAMOR ARQUITECTES BCQ</option>
											                    <option value="198">CASA BITALICIA ROMA</option>
											                    <option value="67">Catholic University of Paris</option>
											                    <option value="103">Centro de Educación Militar del Ejercito</option>
											                    <option value="136">CONAHEC - Universidad de Quilmes</option>
											                    <option value="155">CONAHEC - UNIVERSIDAD JUÁREZ AUTÓNOMA DE TABASCO (UJAT)</option>
											                    <option value="104">Congregacion de Hermanos de las Escuelas Cristianas</option>
											                    <option value="105">Corporacion de Ciencias y Desarrollo – Uniciencia</option>
											                    <option value="106">Corporacion Magisterio Formación</option>
											                    <option value="108">Corporación Universitaria Minuto de Dios</option>
											                    <option value="33">EARTH - CR</option>
											                    <option value="63">Ecole Superieure de Commerce – International School of Management - IDRAC</option>
											                    <option value="64">ESC Rennes School of Business</option>
											                    <option value="77">Escuela Bancaria y Comercial -EBC-</option>
											                    <option value="109">Escuela Colombiana de Ingeniería - Julio Garavito</option>
											                    <option value="42">Escuela Superior de Archivística y Gestión de documentos de la Universidad Autónoma de Barcelona</option>
											                    <option value="164">Freie University de Berlin</option>
											                    <option value="110">Fundación Caminos de Identidad</option>
											                    <option value="111">Fundacion Creciendo Unidos</option>
											                    <option value="112">Fundación Idesa</option>
											                    <option value="177">Fundación LABITAT</option>
											                    <option value="132">Fundación Teimaken</option>
											                    <option value="113">Fundación Universidad Autónoma de Colombia</option>
											                    <option value="114">Fundación Universitaria Empresarial de la Cámara de Comercio de Bogotá- Uniempresarial</option>
											                    <option value="115">Fundacion Universitaria Sanitas</option>
											                    <option value="65">Groupe Ecole Superieure de Commerce Chambéry Savoie</option>
											                    <option value="102">Hacettepe University</option>
											                    <option value="190">Hacienda Los Angeles</option>
											                    <option value="30">Hannam University</option>
											                    <option value="137">HOSPITAL CENTRO DE CUIDADOS INTENSIVOS PARA EQUINOS LOS AZULEJOS</option>
											                    <option value="178">IALU</option>
											                    <option value="66">IGS Group – The American Business School, Paris</option>
											                    <option value="157">In Vitro</option>
											                    <option value="185">INSEEC BUSINESS SCHOOL</option>
											                    <option value="116">Institución Universitaria CESMAG</option>
											                    <option value="69">Institut des Sciences de la Vision</option>
											                    <option value="78">Instituto Mexicano de Doctrina Social Cristiana</option>
											                    <option value="93">Instituto Superior de Optometría y Ciencias Eurohispano</option>
											                    <option value="34">Instituto Superior Politécnico ¨Jose Antonio Echeverría¨</option>
											                    <option value="117">Instituto Tecnológico Metropolitano</option>
											                    <option value="31">Keimyung University</option>
											                    <option value="53">Kentucky State University</option>
											                    <option value="118">La santa iglesia Católica Anglicana del Caribe</option>
											                    <option value="151">Massey University</option>
											                    <option value="176">MAYNOOTH UNIVERSITY</option>
											                    <option value="18">Mount Royal University</option>
											                    <option value="73">National University of Ireland Maynooth</option>
											                    <option value="61">Nova  Southeastern University</option>
											                    <option value="158">Organisme de Selection en Race Normande</option>
											                    <option value="175">Ostwestfalen-Lippe University of Applied Sciences</option>
											                    <option value="172">Partners of The Americas</option>
											                    <option value="140">Performance Equine VS</option>
											                    <option value="145">Polo Day - Argentina</option>
											                    <option value="9">Pontifica Universidad Católica de Paraná</option>
											                    <option value="29">Pontificia Universidad Católica de Valparaiso</option>
											                    <option value="97">Pontificia Universidad Católica Madre y Maestra de Santo Domingo</option>
											                    <option value="125">Pontificia Universidad Javeriana</option>
											                    <option value="150">PUMMA - Universidad Militar Nueva Granada</option>
											                    <option value="56">Saint Mary´s University of Minnesota</option>
											                    <option value="19">Saint Paul University</option>
											                    <option value="181">Taller Internacional Ciudad de Quito</option>
											                    <option value="57">The New England -College of Optometry (Boston )</option>
											                    <option value="58">The University of Alabama at Birmingham</option>
											                    <option value="40">The University of Dundee</option>
											                    <option value="59">The University of Mississippi</option>
											                    <option value="141">Town &amp; Country Veterinary Clinic</option>
											                    <option value="54">Troy University</option>
											                    <option value="119">UDCA</option>
											                    <option value="23">Universidad Austral de Chile</option>
											                    <option value="79">Universidad Autónoma de Aguascalientes</option>
											                    <option value="168">UNIVERSIDAD AUTONOMA DE CHIHUAHUA</option>
											                    <option value="91">Universidad Autónoma de Chiriquí</option>
											                    <option value="120">Universidad Autónoma de Occidente</option>
											                    <option value="197">Universidad Autónoma Metropolitana de México</option>
											                    <option value="99">Universidad Católica Andrés Bello</option>
											                    <option value="24">Universidad Católica Cardenal Raúl Silva Henríquez</option>
											                    <option value="90">Universidad Católica Redemptoris Mater</option>
											                    <option value="92">Universidad Católica Santa María La Antigua</option>
											                    <option value="101">Universidad Central de Chile</option>
											                    <option value="162">UNIVERSIDAD CES</option>
											                    <option value="121">Universidad Colegio Mayor de Cundinamarca</option>
											                    <option value="2">Universidad de Buenos Aires - Facultad de Agronomía</option>
											                    <option value="174">Universidad de Buenos Aires - Facultad de Ciencias Económicas y Sociales</option>
											                    <option value="1">Universidad de Buenos Aires - Facultad de Ciencias Veterinarias</option>
											                    <option value="3">Universidad de Buenos Aires - Facultad de Ingeniería</option>
											                    <option value="35">Universidad de Camagüey</option>
											                    <option value="25">Universidad de Chile</option>
											                    <option value="45">Universidad de Córdoba</option>
											                    <option value="46">Universidad de Extremadura</option>
											                    <option value="10">Universidad de Fortaleza</option>
											                    <option value="47">Universidad de Granada</option>
											                    <option value="80">Universidad de Guadalajara</option>
											                    <option value="36">Universidad de Holguín ¨Oscar Lucero Moya¨</option>
											                    <option value="138">Universidad de Los Lagos</option>
											                    <option value="122">Universidad de Manizales y Cinde</option>
											                    <option value="20">Universidad de Ottawa</option>
											                    <option value="74">Universidad de Roma ¨La Sapienza¨</option>
											                    <option value="123">Universidad de San Buenaventura - Cali</option>
											                    <option value="124">Universidad de San Buenaventura - Cartagena</option>
											                    <option value="26">Universidad de Santiago de Chile</option>
											                    <option value="154">Universidad de Santiago de Compostela</option>
											                    <option value="11">Universidad de Sao Paulo - Facultad de Medicina Veterinaria</option>
											                    <option value="76">Universidad de Tokio</option>
											                    <option value="49">Universidad de Valladolid (Instituto Universitario de Oftalmobiología Aplicada (IOBA)</option>
											                    <option value="98">Universidad de Yacambú</option>
											                    <option value="134">Universidad del Bio Bio</option>
											                    <option value="196">UNIVERSIDAD ESAN</option>
											                    <option value="14">Universidad Estadual de Maringá</option>
											                    <option value="12">Universidad Estadual Paulista</option>
											                    <option value="194">UNIVERSIDAD ESTATAL DE SONORA (CONAHEC)</option>
											                    <option value="52">Universidad Europea de Madrid</option>
											                    <option value="195">Universidad Federal de Integración de América Latina en Foz de Iguacu</option>
											                    <option value="15">Universidad Federal de Pelotas</option>
											                    <option value="16">Universidad Federal de Rio Grande del Sur</option>
											                    <option value="17">Universidad Federal de Uberlandia</option>
											                    <option value="186">UNIVERSIDAD FRANCISCO DE PAULA SANTANDER</option>
											                    <option value="71">Universidad Francisco Marroquín</option>
											                    <option value="95">Universidad Interamericana de Puerto Rico</option>
											                    <option value="37">Universidad Interamericana del Ecuador</option>
											                    <option value="126">Universidad La gran Colombia Seccional Armenia</option>
											                    <option value="27">Universidad Mayor de Chile</option>
											                    <option value="165">Universidad Miguel Hernandez de Elche</option>
											                    <option value="127">Universidad Militar Nueva Granada</option>
											                    <option value="72">Universidad Nacional Autónoma de Honduras</option>
											                    <option value="87">Universidad Nacional Autónoma de México (UNAM)</option>
											                    <option value="191">Universidad Nacional de Chonnam</option>
											                    <option value="189">UNIVERSIDAD NACIONAL DE COLOMBIA</option>
											                    <option value="153">Universidad Nacional de Colombia</option>
											                    <option value="38">Universidad Nacional de Loja</option>
											                    <option value="152">Universidad Nacional de Villa María</option>
											                    <option value="4">Universidad Nacional del Litoral</option>
											                    <option value="100">Universidad Nacional Experimental de los Llanos Centrales Rómulo Gallegos</option>
											                    <option value="128">Universidad Pedagógica Nacional</option>
											                    <option value="129">Universidad Pedagógica y Tecnológica de Colombia- Tunja</option>
											                    <option value="130">Universidad Piloto de Colombia</option>
											                    <option value="6">Universidad Privada de Santa Cruz de La Sierra</option>
											                    <option value="28">Universidad San Sebastián</option>
											                    <option value="131">Universidad Santo Tomás</option>
											                    <option value="148">Universidad Sergio Arboleda</option>
											                    <option value="182">Universidad Tecnológica de Panamá</option>
											                    <option value="39">Universidad Tecnológica Equinoccial</option>
											                    <option value="94">Universidade do Porto</option>
											                    <option value="13">Universidade Estadual de Campinas</option>
											                    <option value="75">Universidades Publicas del Eje Cafetero para el Desarrollo Regional. Alma Mater</option>
											                    <option value="68">Université de Perpignan</option>
											                    <option value="21">Université Laval</option>
											                    <option value="60">University of Delaware</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Campus" type="text" name="campus" id="campus">

														</div>
													</div>
												</div>
											</div>

											<!--facultad y programa de destino -->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Facultad de destino" type="text" name="facultad_destino" id="facultad_destino">

														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Programa de destino" type="text" name="programa_destino" id="programa_destino">

														</div>
													</div>
												</div>
											</div>
											<h4><strong>Asignaturas </strong> - Especifique las asignaturas a cursar en la universidad de destino.</h4>
											<br>		
											<fieldset>
												<section>
													<!--asignatura, codigo y numero de creditos en destino -->
													<div class="row">
														<div class="col-sm-4">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Asignatura en destino" type="text" name="asignatura_destino" id="asignatura_destino">
																</div>
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Código en destino" type="text" name="codigo_destino" id="codigo_destino">
																</div>
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Numero de créditos en destino" type="text" name="n_creditos_destino" id="n_creditos_destino">
																</div>
															</div>
														</div>
													</div>
													<!--asignatura, codigo y numero de creditos en universidad -->
													<div class="row">
														<div class="col-sm-4">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Asignatura local" type="text" name="asignatura_local" id="asignatura_local">
																</div>
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Código local" type="text" name="codigo_local" id="codigo_local">
																</div>
															</div>
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
																	<input class="form-control input-lg" placeholder="Numero de créditos local" type="text" name="n_creditos_local" id="n_creditos_local">
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-2">
															<div class="form-group">
																<div class="input-group">
																	<button  type="button"class="btn btn-lg btn-primary" name="agregar_asignatura" id="agregar_asignatura">
																		Agregar
																	</button>
																</div>
															</div>
														</div>
													</div>
												</section>
											</fieldset>
										</div>
		
										<div class="step-pane" id="step5">
											<h3><strong>Paso 8 </strong> - Contacto en caso de emergencia</h3>
		
											
											<!--NOMBRES APELLIDOS y parentesco-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Nombres y Apellidos" type="text" name="nombres_emergencia" id="nombres_emergencia">

														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Parentesco" type="text" name="parentesco" id="parentesco">	
														</div>
													</div>
												</div>
											</div>
											
											<!--telefono fijo y celular -->
											<div class="row">

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" data-mask="(999) 999-9999" data-mask-placeholder= "X" placeholder="Teléfono fijo" type="text" name="telefono_contacto" id="telefono_contacto">
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" data-mask="+9 999-9999" data-mask-placeholder= "X" placeholder="Celular" type="text" name="celular_contacto" id="celular_contacto">
														</div>
													</div>
												</div>
											</div>
											<!--CORREO_contacto y direccion residencia contacto -->
											<div class="row">

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="email@correo_contacto.com" type="text" name="email_contacto" id="email_contacto">

														</div>
													</div>

												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Direccion de residencia" type="text" name="direccion_contacto" id="direccion_contacto">

														</div>
													</div>

												</div>

											</div>
										</div>
		
										<div class="step-pane" id="step6">
											<h3><strong>Paso 9 </strong> - Financiación Nacional</h3>
		
											
											<!--fuente de financiacion nacional y monto en pesos-->
											<div class="row">
												
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-list fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="fuente_finan_nacional">
																<option value="" selected="selected">Seleccione la fuente de financiación nacional</option>
																<option>Recursos Personales</option>
																<option>Universidades e instituciones locales</option>
																<option>ICETEX</option>
																<option>“Ser Pilo Paga”</option>
																<option>Colfuturo</option>
																<option>Apice</option>
																<option>Fundación Michelsen</option>
																<option>Bancoldex</option>
																<option>Fonade</option>
																<option>FEN - Financiera Energetica Nacional</option>
																<option>Finagro</option>
																<option>FNG - Fondo Nacional de Garantias</option>
																<option>Fogafin</option>
																<option>FNA</option>
																<option>INFIS</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Monto en pesos" type="text" name="monto_finan_nacional" id="monto_finan_nacional">	
														</div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="step-pane" id="step7">
											<h3><strong>Paso 10 </strong> - Financiación Internacional</h3>
		
											
											<!--requiere financiacion internacional-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon">
																<span class="checkbox">
																	<label>
																	  <input type="checkbox" class="checkbox style-0" value="" name="certificado" id="certificado">
																	  <span></span>
																	  &nbsp;&nbsp;&nbsp;&nbsp;¿La movilidad incluye fuentes de financiación internacional?
																	</label>
																</span>
															</span>																
														</div>
													</div>
												</div>
											</div>
											<!--fuente de financiacion internacional y monto en pesos-->
											<div class="row">
												
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Fuente de financiación internacional" type="text" name="fuente_finan_internacional" id="fuente_finan_internacional">	
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Monto en pesos" type="text" name="monto_finan_internacional" id="monto_finan_internacional">	
														</div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="step-pane" id="step8">
											<h3><strong>Paso 11 </strong> - Presupuesto</h3>
											<div>
												<p>
													Elaborar un presupuesto se constituye en una acción muy importante para considerar su movilidad. Por ello, puede consultar los siguiente enlaces en los cuales podrá calcular el costo de vida del país y/o región deonde realizará su estancia académica:
												</p>
												<div class="list-group">
													<a href="https://www.numbeo.com/cost-of-living/"class="list-group-item"><strong>Numbeo</strong> https://www.numbeo.com/cost-of-living/</a>
													<a href="http://www.eardex.com/"class="list-group-item"><strong>Eardex</strong> http://www.eardex.com/</a>
													<a href="http://www.costedelavida.com/"class="list-group-item"><strong>Coste de la vida</strong> http://www.costedelavida.com/</a>
												</div>
											</div>
					
											<!--Hospedaje y Alimentación-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Hospedaje" type="text" name="hospedaje" id="hospedaje">	
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Alimentación" type="text" name="alimentacion" id="alimentacion">	
														</div>
													</div>
												</div>
											</div>
				
											<!--fuente de financiacion internacional y monto en pesos-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Transporte" type="text" name="transporte" id="transporte">	
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Otros" type="text" name="otros_presupuesto" id="otros_presupuesto">	
														</div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="step-pane" id="step9">
											<h3><strong>Paso 12 </strong> - Documentos de Soporte</h3>
											<div>
												<p>
													Por favor cargar todos los documentos aqui mencionados:
												</p>
												<div class="list-group">
													<div class="list-group-item">- Certificado de notas</div>
							                        <div class="list-group-item">- Pasaporte</div>
							                        <div class="list-group-item">- Carta de intención del estudiante</div>
							                        <div class="list-group-item">- Carta de recomendación de un profesor</div>
							                        <div class="list-group-item">- Hoja de vida</div>
							                        <div class="list-group-item">- Carta de compromiso padres - acudientes</div>
							                        <div class="list-group-item">- Formulario de inscripcion destino</div>
							                        <div class="list-group-item">- Certificado conocimiento del idioma destino</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-check fa-lg fa-fw"></i></span>
															<select class="selectpicker form-control input-lg" name="tipos_documentos" title="Seleccione los tipos documentos a cargar" multiple>												                        
										                        <option value="1">Certificado de notas</option>
										                        <option value="2">Pasaporte</option>
										                        <option value="3">Carta de intención del estudiante</option>
										                        <option value="4">Carta de recomendación de un profesor</option>
										                        <option value="5">Hoja de vida</option>
										                        <option value="6">Carta de compromiso padres - acudientes</option>
										                        <option value="7">Formulario de inscripcion destino</option>
										                        <option value="8">Certificado conocimiento del idioma destino</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Archivo con el/los Documento(s)" type="file" name="archivo_documentos" id="archivo_documentos">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-2">
													<div class="form-group">
														<div class="input-group">
															<button  type="button"class="btn btn-lg btn-primary" name="agregar_documento" id="agregar_documento">
																Agregar
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="step-pane" id="step10">
											<h3><strong>Paso 13 </strong> - Foto</h3>
											
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
															<label class="form-control input-lg btn btn-default btn-file">
															    <p>Foto reciente tipo documento: <strong>Seleccionar archivo</strong> </p><input type="file" name="archivo_foto" id="archivo_foto" style="display: none;">
															</label>
														</div>
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group">
														<div class="input-group">
															<button  type="button"class="btn btn-lg btn-primary" name="agregar_foto" id="agregar_foto">
																Cargar
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="step-pane" id="stepG2">
											<h3><strong>Terminado </strong> - Guardar y Enviar!</h3>
											<br>
											<br>
											<h1 class="text-center text-success"><i class="fa fa-check"></i> Perfecto!
											<br>
											<small>Escoja la opción <strong>Guardar</strong> o <strong>Enviar</strong> </small></h1>
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
		
				<!-- NEW WIDGET START -->


		
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
<script src="<?php echo ASSETS_URL; ?>/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fuelux/wizard/wizard_externo.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/bootstrap/bootstrap-select.min.js"></script>

		

<script type="text/javascript">
	
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	
	$(document).ready(function() {

		//$('.article_registro').find('input, textarea, button, select').attr('disabled','disabled');
		//$('.article_registro .jarviswidget-toggle-btn').click();
		  
		  var $validator = $("#wizard_pre_registro").validate({
		    
		    rules: {
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
		  
		  $('#bootstrap-wizard_pre_registro').bootstrapWizard({
		    'tabClass': 'form-wizard',
		    'onNext': function (tab, navigation, index) {
		      var $valid = $("#wizard_pre_registro").valid();
		      if (!$valid) {
		        $validator.focusInvalid();
		        return false;
		      } else {
		        $('#bootstrap-wizard_pre_registro').find('.form-wizard').children('li').eq(index - 1).addClass(
		          'complete');
		        $('#bootstrap-wizard_pre_registro').find('.form-wizard').children('li').eq(index - 1).find('.step')
		        .html('<i class="fa fa-check"></i>');
		      }
		    }
		  });
		  
	
		// fuelux wizard

		  var wizard_pre_registro = $('.wizard_pre_registro').wizard();
		  
		  $('#enviar_pre_registro').on('click', function (e, data) {
		    //$("#wizard_registro").submit();
		    //console.log("submitted!");
		    $.smallBox({
		      title: "Excelente! Su pre-registro fue enviado correctamente",
		      content: "Hace <i class='fa fa-clock-o'></i> <i>1 segundos...</i> <br> Cuando el validador de una respuesta se enviará un mensaje a su correo electrónico.",
		      color: "#5F895F",
		      iconSmall: "fa fa-check bounce animated"
		    });
 			
 			//$('.article_registro').find('input, textarea, button, select').removeAttr('disabled');
		    
			$('.article_registro').removeClass('hide');
		    
		  });

		  $('#enviar_registro, #guardar_registro').on('click', function (e, data) {
		    var botonId = $(this).attr('id');
		    var accion = 'enviados';
		    var color = '#5f895f';
		    var mensaje = 'Su coordinador recibira un correo de confirmación para proceder a la autorización';
		    
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

		  var wizard_registro = $('.wizard_registro').wizard();
		  
		  wizard_registro.on('finished', function (e, data) {
		    //$("#wizard_registro").submit();
		    //console.log("submitted!");
		    $.smallBox({
		      title: "Perfecto! Sus datos fueron enviados correctamente",
		      content: "Hace <i class='fa fa-clock-o'></i> <i>1 segundos...</i> <br> Su coordinador recibira un correo de confirmación para proceder a la autorización",
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