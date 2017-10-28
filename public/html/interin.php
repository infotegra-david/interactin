<?php //initilize the page
require_once ("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once ("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

 YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
 E.G. $page_title = "Custom Title" */

$page_title = "InterIn";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include ("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["InterChange"]["sub"]["InterIn"]["active"] = true;
include ("inc/nav.php");
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">

	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Tables"] = "";
		include("inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					<i class="fa fa-table fa-fw "></i> 
						InterChange 
					<span>> 
						InterIn
					</span>
				</h1>
			</div>


			<!-- right side of the page with the sparkline graphs -->
			<!-- col -->
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<!-- sparks -->
				<ul id="sparks">
					<li class="sparks-info">
						<h5> Mis Resgistrados <span class="txt-color-blue">171</span></h5>
						<div class="sparkline txt-color-blue hidden-mobile">
							1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
						</div>
					</li>
					<li class="sparks-info">
						<h5> Activos <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" title="Increased"></i>&nbsp;45%</span></h5>
						<div class="sparkline txt-color-purple hidden-mobile">
							110,150,300,130,400,240,220,310,220,300, 270, 210
						</div>
					</li>
					<li class="sparks-info">
						<h5> Pendientes <span class="txt-color-greenDark"><i class="fa fa-clock-o"></i>&nbsp;47</span></h5>
						<div class="sparkline txt-color-greenDark hidden-mobile">
							110,150,300,130,400,240,220,310,220,300, 270, 210
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
													<li data-target="#step4">
														<a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Enviar el pre-registro</span> </a>
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
												<div class="tab-pane" id="tab4">
													<br>
													<h3><strong>Paso 4</strong> - Enviar el pre-registro</h3>
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
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		
					
		
					
		
					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false">
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
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2> <strong>Estudiantes</strong> - Registros realizados</h2>
		
						</header>
		
						<!-- widget div-->
						<div>
		
							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->
		
							</div>
							<!-- end widget edit box -->
		
							<!-- widget content -->
							<div class="widget-body no-padding">
		
								<table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<th data-class="expand">Fecha de Pre-Registro</th>
											<th data-hide="phone">Periodo</th>
											<th>Modalidad</th>
											<th data-hide="phone">Nombres</th>
											<th data-hide="phone,tablet">Estado</th>
											<th data-hide="phone,tablet">Acciones</th>
										</tr>
									</thead>
									
									<tbody>
										<tr><td>03/04/2014</td><td>JUNIO A JULIO 2017</td><td>Misión Técnica Ingeniería</td><td>Jennifer</td><td class="text-danger">Rechazado (ORII)</td><td><a href="#" id="smart-mod-eg1" class="btn btn-success"> Callback ()</a></td></tr>
										<tr><td>12/08/2013</td><td>JUNIO A JULIO 2018</td><td>Voluntariado impacta México</td><td>Clark</td><td class="text-info">En Trámite (Esperando Aval ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/02/2013</td><td>SEGUNDO SEMESTRE 2018</td><td>Korean Studies Summer Program Hannam University</td><td>Brendan</td><td class="text-info">En Trámite (Esperando Aval Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/01/2013</td><td>SEGUNDO SEMESTRE 2017</td><td>Summer Program Introduction to Materials Science and Enginnering</td><td>Warren</td><td class="text-danger">Rechazado (ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>09/02/2013</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Voluntariado impacta Perú</td><td>Rajah</td><td class="text-info">En Trámite (Esperando Aval ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>10/07/2013</td><td>PRIMER SEMESTRE 2017</td><td>  Gira Académica a Perú</td><td>Demetrius</td><td class="text-info">En Trámite (Esperando Aval ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>07/08/2013</td><td>JUNIO A JULIO 2018</td><td>Misión Técnica Ingeniería</td><td>Keefe</td><td class="text-danger">Rechazado (Institución de Destino)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>12/09/2012</td><td>JUNIO A JULIO 2018</td><td>  Gira Académica a Perú</td><td>Leila</td><td class="text-danger">Rechazado (ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2014</td><td>JUNIO A JULIO 2017</td><td>Gira Académica Italia</td><td>Fritz</td><td class="text-danger">Rechazado (ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>10/07/2013</td><td>SEGUNDO SEMESTRE 2018</td><td>Prácticas</td><td>Cassady</td><td class="text-danger">Rechazado (Institución de Destino)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/11/2014</td><td>JUNIO A JULIO 2017</td><td>Doble Titulación</td><td>Rogan</td><td class="text-info">En Trámite (Esperando Aval de Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>11/05/2013</td><td>PRIMER SEMESTRE 2017</td><td>  Gira Académica a Perú</td><td>Candice</td><td class="text-info">En Trámite (Esperando Aval Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2014</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Prácticas</td><td>Brittany</td><td class="text-danger">Rechazado (ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>11/05/2013</td><td>SEGUNDO SEMESTRE 2018</td><td>Prácticas</td><td>Baxter</td><td class="text-danger">Rechazado (ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>05/09/2014</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Doble Titulación</td><td>Vaughan</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/04/2014</td><td>SEGUNDO SEMESTRE 2017</td><td>Semestre Académico</td><td>Ivan</td><td class="text-info">En Trámite (Esperando Aval Institución de Destino)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/11/2014</td><td>JUNIO A JULIO 2017</td><td>Voluntariado Impacta Brasil</td><td>Marah</td><td class="text-info">En Trámite (Esperando Aval de Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/12/2013</td><td>PRIMER SEMESTRE 2017</td><td>Gira Académica Italia</td><td>Kiara</td><td class="text-info">En Trámite (Esperando Aval ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/11/2014</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Summer Program Introduction to Materials Science and Enginnering</td><td>Brielle</td><td class="text-danger">Rechazado (ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2013</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Prácticas</td><td>Kennedy</td><td class="text-danger">Rechazado (Coordinador Programa)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/05/2014</td><td>PRIMER SEMESTRE 2018</td><td>Voluntariado impacta México</td><td>Peter</td><td class="text-danger">Rechazado (ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>12/08/2013</td><td>JUNIO A JULIO 2017</td><td>Gira Académica Italia</td><td>Kibo</td><td class="text-danger">Cancelado</td><td></td></tr>
										<tr><td>05/03/2014</td><td>SEGUNDO SEMESTRE 2017</td><td>Semestre Académico</td><td>Tanek</td><td class="text-info">En Trámite (Esperando Aval de Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/04/2013</td><td>JUNIO A JULIO 2017</td><td>Doble Titulación</td><td>Guinevere</td><td class="text-danger">Rechazado (ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/02/2013</td><td>PRIMER SEMESTRE 2018</td><td>Semestre Académico</td><td>Ronan</td><td class="text-danger">Rechazado (ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/03/2014</td><td>SEGUNDO SEMESTRE 2017</td><td>  Gira Académica a Perú</td><td>Kasper</td><td class="text-info">En Trámite (Esperando Aval Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/09/2014</td><td>PRIMER SEMESTRE 2018</td><td>  Gira Académica a Perú</td><td>Otto</td><td class="text-danger">Rechazado (Institución de Destino)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/05/2013</td><td>PRIMER SEMESTRE 2017</td><td>Korean Studies Summer Program Hannam University</td><td>Brenda</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>11/02/2013</td><td>SEGUNDO SEMESTRE 2017</td><td>Prácticas</td><td>Laith</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/05/2014</td><td>SEGUNDO SEMESTRE 2018</td><td>Prácticas</td><td>Ella</td><td class="text-info">En Trámite (Esperando Aval de Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/05/2014</td><td>JUNIO A JULIO 2017</td><td>Summer Program Introduction to Materials Science and Enginnering</td><td>Hanae</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>11/02/2013</td><td>SEGUNDO SEMESTRE 2017</td><td>Voluntariado impacta Perú</td><td>Donna</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2013</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Misión Técnica Ingeniería</td><td>Bevis</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/11/2014</td><td>PRIMER SEMESTRE 2017</td><td>Voluntariado Impacta Brasil</td><td>Celeste</td><td class="text-danger">Rechazado (Coordinador Programa)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/11/2014</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Semestre Académico</td><td>Ila</td><td class="text-success">Aprobado</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/04/2013</td><td>SEGUNDO SEMESTRE 2017</td><td>Misión Técnica Ingeniería</td><td>Alana</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2014</td><td>SEGUNDO SEMESTRE 2018</td><td>Semestre Académico</td><td>Rowan</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/06/2013</td><td>SEGUNDO SEMESTRE 2017</td><td>Leadership And Global Understanding - Summer Program</td><td>Eric</td><td class="text-info">En Trámite (Esperando Aval Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/05/2013</td><td>PRIMER SEMESTRE 2017</td><td>Misión Técnica Ingeniería</td><td>Dana</td><td class="text-info">En Trámite (Esperando Aval de Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/09/2014</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Gira Académica Italia</td><td>Karleigh</td><td class="text-danger">Cancelado</td><td></td></tr>
										<tr><td>05/09/2014</td><td>SEGUNDO SEMESTRE 2017</td><td>Leadership And Global Understanding - Summer Program</td><td>Malik</td><td class="text-info">En Trámite (Esperando Aval ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>12/09/2012</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Doble Titulación</td><td>May</td><td class="text-danger">Rechazado (ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/09/2014</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Leadership And Global Understanding - Summer Program</td><td>Alan</td><td class="text-danger">Cancelado</td><td></td></tr>
										<tr><td>08/01/2013</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Voluntariado impacta México</td><td>Anastasia</td><td class="text-danger">Rechazado (ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/09/2014</td><td>JUNIO A JULIO 2017</td><td>Leadership And Global Understanding - Summer Program</td><td>Yardley</td><td class="text-danger">Rechazado (ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>12/12/2013</td><td>JUNIO A JULIO 2018</td><td>Voluntariado impacta Perú</td><td>Oscar</td><td class="text-info">En Trámite (Esperando Aval Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2014</td><td>SEGUNDO SEMESTRE 2017</td><td>  Gira Académica a Perú</td><td>Hasad</td><td class="text-danger">Rechazado (Coordinador Programa)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>12/08/2013</td><td>SEGUNDO SEMESTRE 2018</td><td>Voluntariado impacta Perú</td><td>Mohammad</td><td class="text-info">En Trámite (Esperando Aval Institución de Destino)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>07/08/2013</td><td>JUNIO A JULIO 2018</td><td>Voluntariado impacta México</td><td>Nissim</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>11/02/2012</td><td>SEGUNDO SEMESTRE 2017</td><td>Leadership And Global Understanding - Summer Program</td><td>Porter</td><td class="text-info">En Trámite (Esperando Aval Coordinador Programa)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/04/2014</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Misión Técnica Ingeniería</td><td>Sophia</td><td class="text-info">En Trámite (Esperando Aval Institución de Destino)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/03/2014</td><td>SEGUNDO SEMESTRE 2017</td><td>Semestre Académico</td><td>Acton</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2013</td><td>PRIMER SEMESTRE 2018</td><td>Doble Titulación</td><td>Briar</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/05/2014</td><td>SEGUNDO SEMESTRE 2018</td><td>Summer Program Introduction to Materials Science and Enginnering</td><td>Benjamin</td><td class="text-danger">Rechazado (ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/11/2014</td><td>PRIMER SEMESTRE 2018</td><td>Voluntariado Impacta Brasil</td><td>Gregory</td><td class="text-info">En Trámite (Esperando Aval de Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/05/2014</td><td>JUNIO A JULIO 2017</td><td>Voluntariado impacta Perú</td><td>Marny</td><td class="text-info">En Trámite (Esperando Aval Coordinador Programa)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>09/02/2013</td><td>PRIMER SEMESTRE 2017</td><td>Semestre Académico</td><td>Indira</td><td class="text-info">En Trámite (Esperando Aval ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>12/09/2012</td><td>SEGUNDO SEMESTRE 2018</td><td>Leadership And Global Understanding - Summer Program</td><td>Fleur</td><td class="text-info">En Trámite (Esperando Aval de Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>05/03/2014</td><td>PRIMER SEMESTRE 2018</td><td>Summer Program Introduction to Materials Science and Enginnering</td><td>Fulton</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>05/09/2014</td><td>PRIMER SEMESTRE 2018</td><td>Semestre Académico</td><td>Arsenio</td><td class="text-info">En Trámite (Esperando Aval Coordinador Programa)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/01/2013</td><td>JUNIO A JULIO 2017</td><td>Summer Program Introduction to Materials Science and Enginnering</td><td>Jaden</td><td class="text-info">En Trámite (Esperando Aval Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>07/08/2013</td><td>JUNIO A JULIO 2018</td><td>Summer Program Introduction to Materials Science and Enginnering</td><td>Kylie</td><td class="text-danger">Rechazado (ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/03/2014</td><td>PRIMER SEMESTRE 2017</td><td>Korean Studies Summer Program Hannam University</td><td>Melyssa</td><td class="text-danger">Rechazado (ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>11/02/2013</td><td>JUNIO A JULIO 2017</td><td>Voluntariado Impacta Brasil</td><td>Jerry</td><td class="text-danger">Rechazado (Institución de Destino)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/06/2013</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Gira Académica Italia</td><td>Rhiannon</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>10/07/2013</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Korean Studies Summer Program Hannam University</td><td>Price</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>11/02/2012</td><td>PRIMER SEMESTRE 2017</td><td>Voluntariado impacta México</td><td>Ginger</td><td class="text-info">En Trámite (Esperando Aval ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>09/01/2013</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Leadership And Global Understanding - Summer Program</td><td>Britanney</td><td class="text-info">En Trámite (Esperando Aval Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>08/01/2013</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Gira Académica Italia</td><td>Wylie</td><td class="text-danger">Rechazado (Coordinador Programa)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/04/2014</td><td>PRIMER SEMESTRE 2018</td><td>Doble Titulación</td><td>Holly</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/04/2014</td><td>PRIMER SEMESTRE 2017</td><td>Voluntariado impacta Perú</td><td>Althea</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/06/2013</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Voluntariado impacta Perú</td><td>Quintessa</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2014</td><td>JUNIO A JULIO 2018</td><td>Leadership And Global Understanding - Summer Program</td><td>Fitzgerald</td><td class="text-info">En Trámite (Esperando Aval de Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>09/01/2013</td><td>PRIMER SEMESTRE 2017</td><td>Leadership And Global Understanding - Summer Program</td><td>Keefe</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>12/12/2013</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Misión Técnica Ingeniería</td><td>Rudyard</td><td class="text-danger">Rechazado (ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>09/01/2013</td><td>SEGUNDO SEMESTRE 2017</td><td>Summer Program Introduction to Materials Science and Enginnering</td><td>Kareem</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/05/2014</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Voluntariado impacta Perú</td><td>Genevieve</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>04/05/2014</td><td>JUNIO A JULIO 2018</td><td>Prácticas</td><td>Wang</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/05/2013</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Voluntariado impacta México</td><td>Odessa</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>05/03/2014</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Semestre Académico</td><td>Adrienne</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>08/01/2013</td><td>SEGUNDO SEMESTRE 2018</td><td>  Gira Académica a Perú</td><td>Charity</td><td class="text-success">Aprobado</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/09/2014</td><td>PRIMER SEMESTRE 2018</td><td>Korean Studies Summer Program Hannam University</td><td>Kieran</td><td class="text-success">Aprobado</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2014</td><td>JUNIO A JULIO 2018</td><td>Summer Programme Responsible Management Rennes</td><td>Alika</td><td class="text-info">En Trámite (Esperando Aval de Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/12/2013</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Voluntariado impacta Perú</td><td>Shay</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>11/02/2012</td><td>PRIMER SEMESTRE 2017</td><td>Doble Titulación</td><td>Cailin</td><td class="text-danger">Rechazado (ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2014</td><td>JUNIO A JULIO 2018</td><td>Summer Programme Responsible Management Rennes</td><td>Xena</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/11/2014</td><td>PRIMER SEMESTRE 2017</td><td>Voluntariado Impacta Brasil</td><td>Walker</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/11/2014</td><td>SEGUNDO SEMESTRE 2018</td><td>Summer Program Introduction to Materials Science and Enginnering</td><td>Adena</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>11/05/2013</td><td>JUNIO A JULIO 2018</td><td>Gira Académica Italia</td><td>Bradley</td><td class="text-info">En Trámite (Esperando Aval Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/02/2013</td><td>JUNIO A JULIO 2017</td><td>Doble Titulación</td><td>Yvette</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/04/2013</td><td>DICIEMBRE 2018 A ENERO 2019</td><td>Summer Programme Responsible Management Rennes</td><td>Neil</td><td class="text-info">En Trámite (Esperando Aval Institución de Destino)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/01/2013</td><td>PRIMER SEMESTRE 2017</td><td>Prácticas</td><td>Hunter</td><td class="text-success">Aprobado</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/05/2014</td><td>PRIMER SEMESTRE 2018</td><td>Prácticas</td><td>Marcia</td><td class="text-danger">Rechazado (Vicerrectoría)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>01/12/2013</td><td>PRIMER SEMESTRE 2017</td><td>Summer Program Introduction to Materials Science and Enginnering</td><td>Lavinia</td><td class="text-danger">Rechazado (Institución de Destino)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>02/06/2014</td><td>PRIMER SEMESTRE 2018</td><td>Summer Programme Responsible Management Rennes</td><td>Cynthia</td><td class="text-success">Aprobado</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>03/04/2014</td><td>SEGUNDO SEMESTRE 2017</td><td>Voluntariado Impacta Brasil</td><td>Lee</td><td class="text-danger">Rechazado (ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>12/12/2013</td><td>DICIEMBRE 2017 A ENERO 2018</td><td>Voluntariado Impacta Brasil</td><td>Linda</td><td class="text-info">En Trámite (Esperando Aval ORII)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>06/11/2014</td><td>SEGUNDO SEMESTRE 2017</td><td>Doble Titulación</td><td>Wayne</td><td class="text-danger">Cancelado</td><td></td></tr>
										<tr><td>06/09/2014</td><td>JUNIO A JULIO 2018</td><td>Korean Studies Summer Program Hannam University</td><td>Liberty</td><td class="text-success">Aprobado</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>
										<tr><td>09/02/2013</td><td>SEGUNDO SEMESTRE 2017</td><td>  Gira Académica a Perú</td><td>Cathleen</td><td class="text-info">En Trámite (Esperando Aval ORII 2ª Carga)</td><td><a class="btn btn-danger" href="javascript:void(0);" title="Cancelar movilidad del estudiante"><i class="fa fa-remove"></i> Cancelar</a></td></tr>

									</tbody>
								</table>
		
							</div>
							<!-- end widget content -->
		
						</div>
						<!-- end widget div -->
		
					</div>
					<!-- end widget -->
		
				</article>
				<!-- WIDGET END -->
		
			</div>
		
			<!-- end row -->
		
			<!-- end row -->
		
		</section>
		<!-- end widget grid -->


	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php // include page footer
include ("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php //include required scripts
include ("inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script type="text/javascript">

// DO NOT REMOVE : GLOBAL FUNCTIONS!

$(document).ready(function() {
	
	/* // DOM Position key index //
		
	l - Length changing (dropdown)
	f - Filtering input (search)
	t - The Table! (datatable)
	i - Information (records)
	p - Pagination (paging)
	r - pRocessing 
	< and > - div elements
	<"#id" and > - div with an id
	<"class" and > - div with a class
	<"#id.class" and > - div with an id and class
	
	Also see: http://legacy.datatables.net/usage/features
	*/	

	/* BASIC ;*/
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});

	/* END BASIC */
	
	/* COLUMN FILTER  */
    var otable = $('#datatable_fixed_column').DataTable({
    	//"bFilter": false,
    	//"bInfo": false,
    	//"bLengthChange": false
    	//"bAutoWidth": false,
    	//"bPaginate": false,
    	//"bStateSave": true // saves sort state using localStorage
		"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
		"autoWidth" : true,
		"preDrawCallback" : function() {
			// Initialize the responsive datatables helper once.
			if (!responsiveHelper_datatable_fixed_column) {
				responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
			}
		},
		"rowCallback" : function(nRow) {
			responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
		},
		"drawCallback" : function(oSettings) {
			responsiveHelper_datatable_fixed_column.respond();
		}		
	
    });
    
    // custom toolbar
    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
    	   
    // Apply the filter
    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
    	
        otable
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
            
    } );
    /* END COLUMN FILTER */   

	/* COLUMN SHOW - HIDE */
	$('#datatable_col_reorder').dataTable({
		"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
		"autoWidth" : true,
		"preDrawCallback" : function() {
			// Initialize the responsive datatables helper once.
			if (!responsiveHelper_datatable_col_reorder) {
				responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
			}
		},
		"rowCallback" : function(nRow) {
			responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
		},
		"drawCallback" : function(oSettings) {
			responsiveHelper_datatable_col_reorder.respond();
		}			
	});
	
	/* END COLUMN SHOW - HIDE */

	/* TABLETOOLS */
	$('#datatable_tabletools').dataTable({
		
		// Tabletools options: 
		//   https://datatables.net/extensions/tabletools/button_options
		"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "oTableTools": {
        	 "aButtons": [
             "copy",
             "csv",
             "xls",
                {
                    "sExtends": "pdf",
                    "sTitle": "SmartAdmin_PDF",
                    "sPdfMessage": "SmartAdmin PDF Export",
                    "sPdfSize": "letter"
                },
             	{
                	"sExtends": "print",
                	"sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
            	}
             ],
            "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
        },
		"autoWidth" : true,
		"preDrawCallback" : function() {
			// Initialize the responsive datatables helper once.
			if (!responsiveHelper_datatable_tabletools) {
				responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
			}
		},
		"rowCallback" : function(nRow) {
			responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
		},
		"drawCallback" : function(oSettings) {
			responsiveHelper_datatable_tabletools.respond();
		}
	});
	
	/* END TABLETOOLS */



	$("#smart-mod-eg1").click(function(e) {
        $.SmartMessageBox({
            title : "Smart Alert!",
            content : "This is a confirmation box. Can be programmed for button callback",
            buttons : '[No][Yes]'
        }, function(ButtonPressed) {
            if (ButtonPressed === "Yes") {

                $.smallBox({
                    title : "Callback function",
                    content : " You pressed Yes...",
                    color : "#659265",
                    iconSmall : "fa fa-check fa-2x fadeInRight animated",
                    timeout : 4000
                });
            }
            if (ButtonPressed === "No") {
                $.smallBox({
                    title : "Callback function",
                    content : " You pressed No...",
                    color : "#C46A69",
                    iconSmall : "fa fa-times fa-2x fadeInRight animated",
                    timeout : 4000
                });
            }

        });
        e.preventDefault();
    })

})

</script>

<?php
//include footer
include ("inc/google-analytics.php");
?>