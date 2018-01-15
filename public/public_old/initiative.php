<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Initiative";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["InterActions"]["sub"]["InterIniciative"]["active"] = true;
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
			  <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterActions <span>&gt; Enviar Iniciativa </span></h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
				<ul id="sparks" class="">
					<li class="sparks-info">
						<h5> Iniciativas <span class="txt-color-blue">152</span></h5>
						<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
							1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
						</div>
					</li>
					<li class="sparks-info">
						<h5> Nuevas <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
						<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
							110,150,300,130,400,240,220,310,220,300, 270, 210
						</div>
					</li>
					<li class="sparks-info">
						<h5> Pendientes <span class="txt-color-greenDark"><i class="fa fa-clock-o"></i>&nbsp;2447</span></h5>
						<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
							110,150,300,130,400,240,220,310,220,300, 270, 210
						</div>
					</li>
				</ul>
			</div>
		</div>
		
		<!-- widget grid -->
		<section id="widget-grid" class="">
		
			<!-- row -->
			<div class="row">
				<!-- linea con secuencia de pasos -->
				<div class="contenedor text-center">
					<div class="row bs-wizard text-center" style="border-bottom:0;">
		                
			                <div class="col-xs-1 bs-wizard-step completado disabled"  rel="tooltip" data-original-title="This is tooltip" data-placement="top">
			                  <div class="text-center bs-wizard-stepnum">Paso 1</div>
			                  <div class="progress"><div class="progress-bar"></div></div>
			                  <a href="#" class="bs-wizard-dot"></a>
			                  <div class="bs-wizard-info text-center"> Registrar mi iniciativa</div>
			                </div>
			                
			                <div class="col-xs-1 bs-wizard-step completado disabled"><!-- complete -->
			                  <div class="text-center bs-wizard-stepnum">Paso 2</div>
			                  <div class="progress"><div class="progress-bar"></div></div>
			                  <a href="#" class="bs-wizard-dot"></a>
			                  <div class="bs-wizard-info text-center"> Obtener el aval</div>
			                </div>
			                
			                <div class="col-xs-1 bs-wizard-step disabled"><!-- complete -->
			                  <div class="text-center bs-wizard-stepnum">Paso 3</div>
			                  <div class="progress"><div class="progress-bar"></div></div>
			                  <a href="#" class="bs-wizard-dot"></a>
			                  <div class="bs-wizard-info text-center"> Obtener viavilidad financiera</div>
			                </div>
			                
			                <div class="col-xs-1 bs-wizard-step disabled"><!-- active -->
			                  <div class="text-center bs-wizard-stepnum">Paso 4</div>
			                  <div class="progress"><div class="progress-bar"></div></div>
			                  <a href="#" class="bs-wizard-dot"></a>
			                  <div class="bs-wizard-info text-center"> Obtener Viabilidad Internacional</div>
			                </div>
		                
			                <div class="col-xs-1 bs-wizard-step disabled"><!-- active -->
			                  <div class="text-center bs-wizard-stepnum">Paso 5</div>
			                  <div class="progress"><div class="progress-bar"></div></div>
			                  <a href="#" class="bs-wizard-dot"></a>
			                  <div class="bs-wizard-info text-center"> Obtener Viabilidad Jurídica</div>
			                </div>
			                
			                <div class="col-xs-1 bs-wizard-step disabled"><!-- active -->
			                  <div class="text-center bs-wizard-stepnum">Paso 6</div>
			                  <div class="progress"><div class="progress-bar"></div></div>
			                  <a href="#" class="bs-wizard-dot"></a>
			                  <div class="bs-wizard-info text-center"> Descargar Respaldo Institucional</div>
			                </div>
			                
			                <div class="col-xs-1 bs-wizard-step disabled"><!-- active -->
			                  <div class="text-center bs-wizard-stepnum">Paso 7</div>
			                  <div class="progress"><div class="progress-bar"></div></div>
			                  <a href="#" class="bs-wizard-dot"></a>
			                  <div class="bs-wizard-info text-center"> Confirmar Postulación</div>
			                </div>
		            </div>
				</div>




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
					<!-- -------- ----------------  REGISTRO ------------ ------------ -->

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-darken widget_pre_registro" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false">
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
							<h2>Registrar una nueva iniciativa</h2>
		
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
								<div class="wizard wizard_oportunidad" id="orderWizard">
									<!-- encabezados -->
									<ul class="steps">
										<li data-target="#step1" class="active">
											<span class="badge badge-info">1</span>Unidad Académica<span class="chevron"></span>
										</li>
										<li data-target="#step2">
											<span class="badge">2</span>Actores Aliados<span class="chevron"></span>
										</li>
										<li data-target="#step3">
											<span class="badge">3</span>Iniciativa<span class="chevron"></span>
										</li>
										<li data-target="#step4">
											<span class="badge">4</span>Presupuesto<span class="chevron"></span>
										</li>
										<li data-target="#step5">
											<span class="badge">5</span>Instrumentos de Monitoreo<span class="chevron"></span>
										</li>
										<li data-target="#step6">
											<span class="badge">6</span>Documentos<span class="chevron"></span>
										</li>
										<li data-target="#step7">
											<span class="badge">7</span>Guardar y Enviar<span class="chevron"></span>
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
									<form  class="form-horizontal" id="wizard_oportunidad" method="post">
										<div class="step-pane active" id="step1">
											<h3><strong>Paso 1 </strong> - Unidad Administrativa</h3>
		
											<!--oportunidad-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="oportunidad">
																<option value="" selected="selected">Seleccione la oportunidad</option>
									                            
									                            <option value="2">2016-0001 - Becas de Doctorado y Estancias cortas postdoctorales</option>
									                            <option value="5">2016-0004 - Experiencia internacional para investigadores postdoctorales</option>
									                            <option value="10">2016-0009 - Many Languages, One World Student Essay Contest and Global Youth Forum</option>
									                            <option value="1">2015-0001 - Oprtunidad de Prueba</option>
									                            <option value="6">2016-0005 - Programa de Movilidad Estudiantil y Académica de la Alianza del Pacífico.</option>
									                            <option value="4">2016-0003 - Iniciativas de investigación - Hábitat y Desarrollo Urbano</option>
									                            <option value="14">2016-0013 - Red Epidemiológica Iberoamericana en salud visual y ocular</option>
									                            <option value="12">2016-0011 - remiación Concurso casos Exitosos 2012: FONTAGRO, BID, IICA</option>
									                            <option value="16">2016-0015 - Study abroad Grant</option>
									                            <option value="11">2016-0010 - X Premio de Estudios Iberoamericanos la Rábida para 2016</option>
									                            <option value="0">Otra</option>
									                        </select>
														</div>
													</div>
												</div>
											</div>
											<hr>
											<h4><strong>Datos Básicos </strong> - Especifique sus datos.</h4>
											<br>
											<!--rol y NOMBRE-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="rol">
																<option value="" selected="selected">Seleccione el rol</option>
									                            
									                            <option value="1">Solicitante/Coordinador</option>
									                            <option value="2">Asociado</option>
									                        </select>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Nombre" type="text" name="nombre" id="nombre">

														</div>
													</div>
												</div>
											</div>
											<!--unidad Académica/Administrativa y cargo-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="unidad">
																<option value="" selected="selected">Seleccione la unidad Académica/Administrativa</option>
																
																<option value="701">Facultad de Ciencias Administrativas y Contables</option>
													            <option value="702">Facultad de Ciencias Agropecuarias</option>
													            <option value="704">Facultad de Ciencias de la Educación</option>
													            <option value="705">Facultad de Ciencias de la Salud</option>
													            <option value="700">Facultad de Ciencias del Hábitat</option>
													            <option value="703">Facultad de Ciencias Económicas y Sociales</option>
													            <option value="706">Facultad de Filosofía y Humanidades</option>
													            <option value="707">Facultad de Ingeniería</option>
													            <option value="319">Departamento de Ciencias Básicas</option>
													            <option value="1093">CONTROL INTERNO</option>
													            <option value="1039">COORDINACION DE FILANTROPIA Y FINANCIAMIENTO EXTERNO</option>
													            <option value="109">DIVISION DE PLANEAMIENTO ESTRATEGICO</option>
													            <option value="401">OFICINA - VPDH</option>
													            <option value="104">OFICINA DE RELACIONES INTERNACIONALES E INTERINSTITUCIONALES</option>
													            <option value="107">SECRETARIA GENERAL</option>
													            <option value="201">VICERRECTORIA ACADÉMICA</option>
													            <option value="501">VICERRECTORIA ADMINISTRATIVA</option>
													            <option value="810">VICERRECTORIA DE INVESTIGACION Y TRANSFERENCIA</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Cargo" type="text" name="cargo" id="cargo">
														</div>
													</div>
												</div>
											</div>
											<!--email, telefono y celular-->
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="email@address.com" type="text" name="email" id="email">
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Teléfono y Extensión" type="text" name="telefono" id="telefono">
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" data-mask="+9 999-9999" data-mask-placeholder= "X" placeholder="Celular" type="text" name="celular" id="celular">
														</div>
													</div>
												</div>

											</div>
											<!-- conocimientos en el area -->
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
															<textarea class="form-control input-lg" placeholder="Sus conocimientos y experiencia en el area de la oportunidad" name="conocimiento" id="conocimiento"></textarea>

														</div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="step-pane" id="step2">
											<h3><strong>Paso 2 </strong> - Actores Aliados</h3>
		
											<!--organizacion y rol_aliado-->
											<div class="row">

												
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="organizacion">
																<option value="" selected="selected">Seleccione la organización</option>
																
																<option value="97">Acción Contra el Hambre</option>
									                            <option value="99">Acción Cultural Popular</option>
									                            <option value="120">Agencia Brasileña de Cooperación Internacional</option>
									                            <option value="20">Agencia Canadiense para la Cooperación al Desarrollo</option>
									                            <option value="144">Agencia Chilena de Cooperación Internacional para el Desarrollo</option>
									                            <option value="41">Agencia de los Estados Unidos para el Desarrollo</option>
									                            <option value="49">Agencia Española de Cooperación Internacional</option>
									                            <option value="17">Agencia Francesa de Desarrollo</option>
									                            <option value="35">Agencia Japonesa de Cooperación Internacional</option>
									                            <option value="76">Agencia Presidencial de Cooperación internacional de Colombia</option>
									                            <option value="96">Agencia Suiza para la Cooperación y el Desarrollo</option>
									                            <option value="183">Agency for Science, Technology &amp; Research</option>
									                            <option value="16">Alto Comisionado de NU para los Refugiados</option>
									                            <option value="101">América España Solidaridad y Cooperación</option>
									                            <option value="133">Archer Daniels Midland Cares</option>
									                            <option value="102">ASOCIACIÓN DE INVESTIGACIÓN Y ESPECIALIZACIÓN SOBRE TEMAS IBEROAMERICANOS</option>
									                            <option value="104">Asociación Interamericana para la Defensa del Ambiente</option>
									                            <option value="105">Asociación Internacional UNIMOS</option>
									                            <option value="106">Asociación Paz con Dignidad</option>
									                            <option value="100">ASOCIACIÓN SOCIO CULTURAL Y DE COOPERACIÓN AL DESAROLLO POR COLOMBIA E IBEROAMERICA</option>
									                            <option value="150">Australia Colombia Chamber</option>
									                            <option value="107">Ayuda en Acción</option>
									                            <option value="54">Banco Interamericano de Desarrollo</option>
									                            <option value="83">Banco Mundial</option>
									                            <option value="6">Benposta Colombia- Nación de Muchach@s</option>
									                            <option value="191">Bentley University</option>
									                            <option value="186">Bond University</option>
									                            <option value="180">British Council</option>
									                            <option value="13">CAF Banco de Desarrollo de América Latina</option>
									                            <option value="74">Campus France</option>
									                            <option value="85">Centro de las Naciones Unidas para el Desarrollo Regional</option>
									                            <option value="169">Centro Internacional de Ingeniería Genética y Biotecnología</option>
									                            <option value="90">Child family Health International</option>
									                            <option value="157">Ciencia y Tecnología para el Desarrollo</option>
									                            <option value="34">Ciudad de Grenoble</option>
									                            <option value="66">CIVICUS</option>
									                            <option value="81">Comisión Económica para America latina y el Caribe</option>
									                            <option value="127">Conferencia de las Naciones unidas Unidas para el Comercio y el Desarrollo</option>
									                            <option value="121">Conferencia Episcopal Italiana</option>
									                            <option value="32">Consejo Australiano para las relaciones con LA</option>
									                            <option value="123">Conservación Internacional</option>
									                            <option value="142">Cooperación Chilena de Cooperación Internacional para el Desarrollo</option>
									                            <option value="143">Cooperación Chilena de Cooperación Internacional para el Desarrollo</option>
									                            <option value="50">Delegación de la Unión Europea en Colombia</option>
									                            <option value="58">Departamento de Estado de los Estados Unidos</option>
									                            <option value="155">Diputación de Barcelona</option>
									                            <option value="156">Diputación de Barcelona</option>
									                            <option value="30">El Fondo de las Naciones Unidas para la Infancia</option>
									                            <option value="77">El Fondo de las naciones unidas para la Infancia</option>
									                            <option value="146">ELS English Language School</option>
									                            <option value="43">Embajada Británica</option>
									                            <option value="71">Embajada de Argelia en Colombia</option>
									                            <option value="21">Embajada de Australia en Chile</option>
									                            <option value="11">Embajada de Brasil en Bogotá</option>
									                            <option value="39">Embajada de Canadá</option>
									                            <option value="18">Embajada de Francia en Bogotá</option>
									                            <option value="12">Embajada de Israel en Colombia</option>
									                            <option value="2">Embajada de Italia en Bogotá</option>
									                            <option value="67">Embajada de la Federación de Rusia en la República de Colombia</option>
									                            <option value="63">Embajada de la India Colombia-Ecuador</option>
									                            <option value="60">Embajada de la República Argentina en la República de Colombia</option>
									                            <option value="47">Embajada de la República de Corea</option>
									                            <option value="48">Embajada de la República Federal de Alemania</option>
									                            <option value="9">Embajada de la República Popular China</option>
									                            <option value="5">Embajada de México en Colombia</option>
									                            <option value="24">Embajada de Nueva Zelanda en Chile</option>
									                            <option value="44">Embajada de Suecia</option>
									                            <option value="46">Embajada del Japón</option>
									                            <option value="42">EMBAJADA DEL REINO DE BELGICA</option>
									                            <option value="45">Embajada del Reino de los Países Bajos</option>
									                            <option value="38">Estados Unidos de América</option>
									                            <option value="135">Estudia en Finlandia</option>
									                            <option value="89">EUROPEAID</option>
									                            <option value="29">Fondo de Población de las Naciones Unidas</option>
									                            <option value="94">Fondo Monetario Internacional</option>
									                            <option value="139">Fondo Sueco-Noruego de Cooperación con la Sociedad Civil Colombiana</option>
									                            <option value="36">FREEDOM HOUSE</option>
									                            <option value="40">FRIEDRICH EBERT STIFTUNG EN COLOMBIA</option>
									                            <option value="62">Fulbright Colombia</option>
									                            <option value="116">FUNDACIÓN AGRICULTORES SOLIDARIOS</option>
									                            <option value="7">Fundación Air France</option>
									                            <option value="140">Fundación Carolina</option>
									                            <option value="126">Fundación Carrefour</option>
									                            <option value="108">Fundación CODESPA</option>
									                            <option value="73">Fundación Elizabeth Taylor para el Sida</option>
									                            <option value="10">Fundación Ford</option>
									                            <option value="8">Fundación Gordon and Betty Moore</option>
									                            <option value="112">Fundación Humanismo y Democracía</option>
									                            <option value="154">Fundación ICALA</option>
									                            <option value="122">Fundación Mapfre</option>
									                            <option value="61">Fundación Nipona</option>
									                            <option value="78">Fundación Refugee Education Trust.</option>
									                            <option value="65">Fundación Rockefeller</option>
									                            <option value="72">Fundación Toyota</option>
									                            <option value="75">Fundación Varkey Gems</option>
									                            <option value="111">Global Humanitaria</option>
									                            <option value="151">Gobierno de Canadá</option>
									                            <option value="181">Gobierno de Canadá</option>
									                            <option value="148">Gobierno de China</option>
									                            <option value="174">Gobierno de China</option>
									                            <option value="165">Gobierno de Indonesia</option>
									                            <option value="168">Gobierno de Italia</option>
									                            <option value="185">Gobierno de la India</option>
									                            <option value="177">Gobierno de Perú</option>
									                            <option value="178">Gobierno de Perú</option>
									                            <option value="179">Gobierno de Perú</option>
									                            <option value="166">Gobierno de Turquía</option>
									                            <option value="103">Grupo de Trabajo Intercultural</option>
									                            <option value="149">Grupo de Universidades Iberoamericanas La Rábida</option>
									                            <option value="69">IDEX Global Fellowship</option>
									                            <option value="147">Instituto Caro y Cuervo</option>
									                            <option value="70">Instituto de la Universidad Europea</option>
									                            <option value="68">Instituto de Paz de los Estados Unidos</option>
									                            <option value="153">Instituto Interamericano de Cooperación para la Agricultura</option>
									                            <option value="152">Instituto Interamericano de Cooperación para la Agricultura</option>
									                            <option value="15">Intermón OXFAM</option>
									                            <option value="113">International Action for Peace</option>
									                            <option value="136">International Development Research Centre</option>
									                            <option value="131">Jacobs Foundation</option>
									                            <option value="110">La Fundación Desarrollo Sostenido</option>
									                            <option value="109">La Sociedad Nacional de la Cruz Roja Colombiana</option>
									                            <option value="158">Lion Club International</option>
									                            <option value="159">Lion Club International</option>
									                            <option value="160">Lion Club International</option>
									                            <option value="161">Lion Club International</option>
									                            <option value="162">Lion Club International</option>
									                            <option value="163">Lion Club International</option>
									                            <option value="115">Médicos Sin Fronteras</option>
									                            <option value="134">Microsoft Corporate Citizenship</option>
									                            <option value="128">Ministerio de Educación Nacional - Colombia</option>
									                            <option value="114">Movimiento por la Paz, el Desarme y la Libertad</option>
									                            <option value="190">Nichibunken</option>
									                            <option value="182">Novus Biological</option>
									                            <option value="19">NUFFIC</option>
									                            <option value="137">OAK Foundation</option>
									                            <option value="64">Oficina de Naciones unidas sobre Drogas y Crimen</option>
									                            <option value="51">ONU para la Agricultura y la Alimentación</option>
									                            <option value="14">ONU para la Coordinación de Asuntos Humanitarios</option>
									                            <option value="53">ONU para la Educación, la ciencia y la cultura</option>
									                            <option value="28">ONU-MUJERES</option>
									                            <option value="3">Organización de Estados Americanos</option>
									                            <option value="37">Organización de Estados Iberoamericanos</option>
									                            <option value="84">Organización de la Naciones Unidas para el Desarrollo Industrial</option>
									                            <option value="86">Organización de las Naciones unidas para el desarrollo urbano</option>
									                            <option value="125">Organización de las Naciones Unidas para la Alimentacion y la Agricultura</option>
									                            <option value="26">Organización Internacional de las Migraciones</option>
									                            <option value="79">Organización Internacional del Trabajo</option>
									                            <option value="82">Organización Mundial de la Salud</option>
									                            <option value="98">Organización mundial del Comercio</option>
									                            <option value="95">Organización para la Cooperación y el Desarrollo Económico</option>
									                            <option value="145">Partners of the Americas</option>
									                            <option value="117">Peace Brigades international</option>
									                            <option value="31">Programa de las Naciones Unidas para el Desarrollo</option>
									                            <option value="52">Programa de las NU para los Asentamientos Humanos</option>
									                            <option value="87">Programa de Voluntarios de Naciones Unidas</option>
									                            <option value="80">Programa Mundial de Alimentos</option>
									                            <option value="22">Programa para la Cohesión Social en América Latina</option>
									                            <option value="132">Qatar Foundation</option>
									                            <option value="187">Queensland University</option>
									                            <option value="23">Real Embajada de Noruega</option>
									                            <option value="27">Rotary International</option>
									                            <option value="184">Saint Mary's University of Minnesota</option>
									                            <option value="93">Secretariado de Estado para Asuntos Económicos Cooperación Económica y Desarrollo</option>
									                            <option value="141">Servicio Alemán de Intercambio Académico</option>
									                            <option value="59">Servicio Alemán de Intercambio Académico</option>
									                            <option value="88">Servicio de Naciones Unidas para la Acción contra Minas Antipersonal</option>
									                            <option value="91">Sistema Andino de Integración</option>
									                            <option value="164">Sociedad Japonesa para la promoción de la Ciencia</option>
									                            <option value="118">Solidaridad internacional</option>
									                            <option value="33">Suiza</option>
									                            <option value="25">Teconología, Entretenimiento, Diseño</option>
									                            <option value="188">The Expert Editor</option>
									                            <option value="119">Tierra de los Hombres</option>
									                            <option value="92">Tree Fund Cultivating Innovation</option>
									                            <option value="57">Unión Europea</option>
									                            <option value="167">United Nations Educational, Scientific and Cultural Organization</option>
									                            <option value="176">Universidad de Alcalá</option>
									                            <option value="175">Universidad de Alcalá</option>
									                            <option value="170">Universidad de Edimburgo</option>
									                            <option value="173">Universidad de Edimburgo</option>
									                            <option value="171">Universidad de Edimburgo</option>
									                            <option value="172">Universidad de Edimburgo</option>
									                            <option value="189">Universidad de Lausana</option>
									                            <option value="124">Universidad de Lousanne</option>
									                            <option value="129">UNIVERSIDAD NACIONAL AUTONOMA DE MEXICO</option>
									                            <option value="130">World Habitat Awards</option>
									                            <option value="138">Yale World Fellows</option>
									                            <option value="-1">Otra</option>
																
															</select>
														</div>
													</div>
												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Organización (otra)" type="text" name="organizacion_otra" id="organizacion_otra">

														</div>
													</div>
												</div>
											</div>
											<!--correo personal y universitario-->
											<div class="row">

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
															<select class="form-control input-lg" name="rol_aliado">
																<option value="" selected="selected">Seleccione el rol del aliado</option>
									                            
									                            <option value="1">Solicitante/Coordinador</option>
									                            <option value="2">Asociado</option>
									                        </select>
														</div>
													</div>
												</div>
											</div>
											<!--correo personal y universitario-->
											<div class="row">
												
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Nombre del líder" type="text" name="nombre_lider" id="nombre_lider">

														</div>
													</div>
												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Cargo del líder" type="text" name="cargo_lider" id="cargo_lider">
														</div>
													</div>
												</div>
											</div>
											<!--email, telefono y celular-->
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Unidad del líder" type="text" name="unidad_lider" id="unidad_lider">
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="email@address.com" type="text" name="email_lider" id="email_lider">
														</div>
													</div>
												</div>
											</div>
		
										</div>
		
										<div class="step-pane" id="step3">
											<h3><strong>Paso 3 </strong> - Iniciativa</h3>
		
											<!--titulo-->
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Título de la Iniciativa" type="text" name="titulo" id="titulo">
														</div>
													</div>
												</div>
											</div>

											<!-- objetivo -->
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
															<textarea class="form-control input-lg" placeholder="Objetivo" name="objetivo" id="objetivo"></textarea>

														</div>
													</div>
												</div>
											</div>

											<!-- integracion -->
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
															<textarea class="form-control input-lg" placeholder="¿Como se integra a la agenda institucional?" name="integracion" id="integracion"></textarea>

														</div>
													</div>
												</div>
											</div>
											<!-- responsabilidades universidad local -->
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
															<textarea class="form-control input-lg" placeholder="Responsabilidades de la universidad local" name="responsabilidades" id="responsabilidades"></textarea>

														</div>
													</div>
												</div>
											</div>
											<!-- beneficios para la universidad local -->
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
															<textarea class="form-control input-lg" placeholder="Beneficios para la universidad local" name="beneficios" id="beneficios"></textarea>

														</div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="step-pane" id="step4">
											<h3><strong>Paso 4 </strong> - Presupuesto</h3>
		
											

											<!--periodo y modalidad-->
											
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon">
																<span class="checkbox">
																	<label>
																	  <input type="checkbox" class="checkbox style-0" value="" name="presupuesto_local" id="presupuesto_local">
																	  <span></span>
																	  &nbsp;&nbsp;&nbsp;&nbsp;¿La Universidad recibirá y/o aportará recursos financieros?
																	</label>
																</span>
															</span>																
														</div>
													</div>
												</div>
											</div>

											<hr>
											<h4><strong>Resumen del Presupuesto </strong> - Puede descargar el formato <a class="nounderline" href="#"><button class="btn">Aqui</button></a></h4>
											<br>
											
											<!--correo personal y universitario-->
											<div class="row">
												
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Costo total" type="text" name="costo_total" id="costo_total">

														</div>
													</div>
												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Aporte otros aliados" type="text" name="aporte_aliados" id="aporte_aliados">
														</div>
													</div>
												</div>
											</div>

											<hr>
											<h4><strong>Aportes </strong> - Universidad local.</h4>
											<br>
											<!--aporte_total_local y aporte_financiero_local-->
											<div class="row">
												
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Aporte total de la universidad local" type="text" name="aporte_total_local" id="aporte_total_local">

														</div>
													</div>
												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Aporte financiero " type="text" name="aporte_financiero_local" id="aporte_financiero_local">
														</div>
													</div>
												</div>
											</div>

											<!--aporte_personal_local y aporte_infraestructura_local-->
											<div class="row">
												
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Aporte para personal" type="text" name="aporte_personal_local" id="aporte_personal_local">

														</div>
													</div>
												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Aporte para infraestructura" type="text" name="aporte_infraestructura_local" id="aporte_infraestructura_local">
														</div>
													</div>
												</div>
											</div>
											<!--aporte_otros_local-->
											<div class="row">
												
												<div class="col-sm-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<input class="form-control input-lg" placeholder="Otros aportes" type="text" name="aporte_otros_local" id="aporte_otros_local">
														</div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="step-pane" id="step5">
											<h3><strong>Paso 5 </strong> - Instrumentos de monitoreo</h3>
		
											<!--Instrumentos de monitoreo-->
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
															<textarea class="form-control input-lg" placeholder="Instrumentos de monitoreo evaluación y mejoramiento continuo" name="instrumentos_monitoreo" id="instrumentos_monitoreo"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
		
										<div class="step-pane" id="step6">
											<h3><strong>Paso 6 </strong> - Documentos</h3>
											
											<p class="alert alert-info">
												Adjunte a continuación los documentos que soportan su Iniciativa.
											</p>
											
											<!--fuente de financiacion nacional y monto en pesos-->
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
		
										<div class="step-pane" id="step7">
											<h3><strong>Paso 7 </strong> - Guardar y Enviar!</h3>
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
		

<script type="text/javascript">
	
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	
	$(document).ready(function() {

		// para que se vea animado el progreso de los pasos
		$('.bs-wizard-step.completado').each(function(){
			$(this).toggleClass('disabled complete');
		});

		
		//validacion para los campos del formulario
  
		  var $validator = $("#wizard_1").validate({
		    
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
		  
		  $('#bootstrap-wizard_1').bootstrapWizard({
		    'tabClass': 'form-wizard',
		    'onNext': function (tab, navigation, index) {
		      var $valid = $("#wizard_1").valid();
		      if (!$valid) {
		        $validator.focusInvalid();
		        return false;
		      } else {
		        $('#bootstrap-wizard_1').find('.form-wizard').children('li').eq(index - 1).addClass(
		          'complete');
		        $('#bootstrap-wizard_1').find('.form-wizard').children('li').eq(index - 1).find('.step')
		        .html('<i class="fa fa-check"></i>');
		      }
		    }
		  });
		  
	
		// fuelux wizard
		// aplicar los estilos y las acciones al wizard continuo

		  var wizard_oportunidad = $('.wizard_oportunidad').wizard();
		  
		  wizard_oportunidad.on('finished', function (e, data) {
		    //$("#wizard_oportunidad").submit();
		    //console.log("submitted!");
		    $.smallBox({
		      title: "Perfecto! Sus datos fueron enviados correctamente",
		      content: "Hace <i class='fa fa-clock-o'></i> <i>1 segundos...</i> <br> Su Iniciativa sera evaluada y recibira un email para pasar a la siguiente etapa",
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