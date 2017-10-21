<?php
	// introduccion
	//¿ que es Laravel?
	- laravel es un framework de php que trabaja con MVC (Modelo Vista Controlador)
	- tiene una gran influencia de framework como Ruby on Rails y ASP.NET
	
	//¿Porque Laravel?
	- incompora Eloquent-ORM(nada de SQL) Object Relational Mapping, sustituye el lenguaje SQL por objetos
	- Incorporra un Motor de plantillas(Blade), esto permite generar layouts de elementos comunes y asi generar menos lineas de html
	- Excelente documentacion
	- Deploy, se puede ejecutar en un servidor compartido, no necesita servidor dedicado como por ejemplo el caso de Ruby on Rails
	
	//instalacion en windows
	// composer
		- composer es una herramienta de administracion de dependencias para PHP
		- esta altamente inspirado por npm de node.js o bundler de Ruby
			
		//descargar e instalar composer
			https://getcomposer.org/download/
			- elegir el Composer-Setup.exe para el caso de windows
			- instalar con los parametros por defecto, siguiente, siguiente ....
	
	// xampp
		- paquete de instalacion que contiene un servidor apache, gestor de base de datos mysql y lenguajes de programacion php y perl
		
		//descargar e instalar xampp
			https://www.apachefriends.org/es/download.html
			- instalar con los parametros por defecto, siguiente, siguiente ....
			
	//instalar laravel	
		https://laravel.com/docs/5.2/
		//requisitos
			PHP >= 5.5.9
			OpenSSL PHP Extension
			PDO PHP Extension
			Mbstring PHP Extension
			Tokenizer PHP Extension
			
		//instalar via composer
		- en una consola cmd elegir un directorio para el proyecto y ejecutar la siguiente instruccion:
			//el directorio, si se va a trabajar con xampp, tiene que estar dentro de C:/xampp/htdocs/
			composer create-project --prefer-dist laravel/laravel [nombre_proyecto]
			//alternativa incluyendo la version
			composer create-project laravel/laravel Cinema "5.1.*"
	
	//comprobar instalaciones
		- dentro de la carpeta C:/xampp/ ejecutar el archivo xampp-control.exe
		- iniciar el servicio de apache 
			// mas adelante de va a trabajar con bases de datos, entonces se debe iniciar el servicio de mysql tambien
			
		//suponiendo que la instalacion de laravel halla quedado en C:\xampp\htdocs\laravel entonces:
		- en el navegador ir a la url http://localhost/laravel/public
		- si se muestra algo como 'Laravel 5' quedo instalado todo correctamente y esta funcionando laravel
		
	//Curso basico de laravel 5
	https://www.youtube.com/playlist?list=PLIddmSRJEJ0u-5Nv2k6W8Vhe0wUP_7H5W
	
	- se creara un proyecto en el cual se hara una aplicacion web referente a un cinema: cartelera, enviar correo de contacto, inicio de sesion, etc
	
	//documentacion de laravel version 5.2
	https://laravel.com/docs/5.2/
	
	//CONFIGURACION
	https://laravel.com/docs/5.2/configuration
	//infornacion acerca de laravel, por ejemplo la version
	- En un cmd, ir a la carpeta donde esta instalado laravel 
	
	//cd C:\xampp\htdocs\laravel> sera el directorio del proyecto
	//ejecutar el comando: php artisan	
	//artisan es el nombre de una interfaz de linea de comandos
		C:\xampp\htdocs\laravel>php artisan
	
	- en la carpeta config de la instalacion de laravel se encuentra la configuracion del proyecto
	
	//el siguiente comando cambia o asigna un nombre al proyecto o a la app: php artisan app:name Cinema
	C:\xampp\htdocs\laravel>php artisan app:name Cinema
	
	//iniciar la aplicacion
	php artisan serve
	
	//habilitar la muestra de errores en la aplicacion, hace que al salir un error se vea 
	//mas especifico el detalle del error, se debe cambiar el parametro false a true
	- se realiza el cambio en el archivo .env que esta en el directorio raiz de la aplicacion
	APP_DEBUG=true
	
	//este otro parametro se ve en el archivo /config/app.php:	
	'debug' => env('APP_DEBUG', false),
	//es algo adicional
	
	//en el archivo /config/app.php se puede configurar el timezone o zona horaria
	'timezone' => 'America/Bogota',
	
	//cambiar el idioma ( archivo /config/app.php )
	'locale' => 'es',
	- adicional a esto es necesario crear un directorio llamado 'es' en:
		/resources/lang/
		
	- buscar los archivos del idioma en los repositorios de laravel, GitHub
	//se puede descargar el proyecto con todos los lenguajes y copiar solo los requeridos
	- seguir los pasos que mencionan en el readme del repositorio de github de los lenguajes
		https://github.com/caouecs/Laravel-lang/blob/master/README.md
	- abrir los archivos del idioma en los repositorios de laravel en GitHub
		- crear los archivos dentro de la carpeta 'es' y copy/paste el contenido
		
	//Seleccion del SGDB que se va a utilizar en el proyecto
	- en el archivo /config/database.php se puede configurar el sistema gestor
		'default' => env('DB_CONNECTION', 'mysql'),
		//se puede escojer entre mysql, sqlite, pgsql (postgreSql) y es posible tambien sqlsrvr
	- en el archivo /config/app.php estan los parametros de conexion
		DB_CONNECTION=mysql
		DB_HOST=127.0.0.1
		DB_PORT=3306
		DB_DATABASE=homestead
		DB_USERNAME=homestead
		DB_PASSWORD=secret
		
	//crear base de datos y usuario en mysql [proyecto]
	CREATE DATABASE cinema;
	USE cinema;

	CREATE USER 'homestead'@'localhost' IDENTIFIED BY 'secret';
	GRANT ALL ON cinema.* TO homestead@'localhost' IDENTIFIED BY 'secret';
	GRANT SELECT ON mysql.proc TO homestead@'localhost' IDENTIFIED BY 'secret';
	
	//configuracion de autenticacion
	archivo /config/auth.php
	- se configuran nombres de usuario y password de la aplicacion
	- se puede definir si se utiliza el driver eloquent o database
	- en el caso del driver database se debe especificar la tabla de usuarios
	
	//funconamiento MVC en Laravel
			  Ruta
		   (1)↑  \		   
			 /	  \
			/	   ↓(2)
	Usuario 	 Controlador
		  ↑(8)		/  ↑(6)
		   \	   /	\
		    \	  / 	 \
		     \	 ↓(7)  	  ↓(3)  
			 Vista	  	Modelo (5) ← - - - → (4) Base de datos
			 
//RUTAS
	https://laravel.com/docs/5.2/routing
	- archivo /app/Http/routes.php
	- se pueden crear rutas para datos recibidos por metodos post, get, put, delete ...
	/* Estos son los metodos o verbos http admitidos
	Route::get($uri, $callback);
	Route::post($uri, $callback);
	Route::put($uri, $callback);
	Route::patch($uri, $callback);
	Route::delete($uri, $callback);
	Route::options($uri, $callback); 
	*/
	- con la clase Route se crea la siguiente instruccion
	
		Route::get('prueba', function () {
			return 'Un saludos desde routes.php';
		});
	- ir a la url por defecto de la aplicacion: http://localhost:8000/
		escribir delante la palabra prueba y se mostrara el mensaje configurado
	
	//capturar parametros o datos de las rutas	
		Route::get('nombre/{nombre}', function($nombre){
			return 'Su nombre es: '.$nombre;
		});
	-escribir en la url:
		http://localhost:8000/nombre/David
	-resultado:
		Su nombre es: David
	
	//parametros opcionales en las rutas
	- es posible que envien o no el dato del nombre, en este caso, por defecto seria 'pepito'
		Route::get('nombre/{nombre?}', function($nombre = 'pepito'){
			return 'Su nombre es: '.$nombre;
		});
		
//CONTROLADOR
	https://laravel.com/docs/5.2/controllers
	- el controlador es el intermediario entre el modelo y la vista
	- ruta /app/Http/Controllers/
	
	//crear un controlador de prueba	
	- crear el archivo PruebaController.php		
		<?php 
			namespace Cinema\Http\Controllers;
			
			use Cinema\Http\Controllers\Controller;
			
			class PruebaController extends Controller {
				/**
				 * Show the application welcome screen to the user.
				 *
				 * @return Response
				 */
				public function index()
				{
					return 'Hola desde PruebaController';
				}
				//controlador con parametros
				public function nombre($nombre){
					return 'Hola mi nombre es: '.$nombre;
				}
			}
		?>
	- en routes.php agregar la instruccion para direccionar al controlador
		// direcciona al metodo 'index' del controlador PruebaController
		Route::get('controlador','PruebaController@index');
	- mostrara el retorno configurado al ingregar a la url http://localhost:8000/controlador
	- enviar al controlador con parametros, archivo routes.php
		// direcciona al metodo 'nombre' del controlador PruebaController
		Route::get('name/{nombre}','PruebaController@nombre');
	
	//controlador RESTful 
	- agregar la instruccion en el archivo routes.php
		//esta instruccion genera multiples rutas:
			//index, create, store, show, edit, update, destroy
		Route::resource('movie','MovieController');
		
	- se crea el controlador por linea de comandos [proyecto]
		php artisan make:controller MovieController --resource
		//resultado: Controller created successfully.
		- esto crea un controlador llamado MovieController.php con todos los metodos 
			index, create, store, show, edit, update, destroy
			
	- ir a la ruta http://localhost:8000/movie 
		se muestra el mensaje o retorno configurado en el metodo index del controlador MovieController
	- http://localhost:8000/movie/create
		muestra el resultado del metodo create, el cual es usado con un formulario para crear

//MODELO
	https://laravel.com/docs/5.2/eloquent#defining-models
	-un modelo es la representacion de la informacion con la cual el sistema va a operar
	-gestiona todos los accesos a la informacion, que va desde hacer consultas hasta actualizaciones
	-basicamente el modelo es la representacion de una tabla de la base de datos
		
	//generar un modelo (consola de comandos)
	//modelo Genre [proyecto]
	php artisan make:model Genre -m
	//modelo Movie [proyecto]
	php artisan make:model Movie -m
	//el parametro -m al final hace que se cree el archivo de migracion a la bd automaticamente
		//se deben crear los modelos segun su dependencia, primero los que no tienen dependencias (llaves foraneas)
		
	-se puede verificar la creacion de los modelos dentro de la carpeta App
		-para el caso especifico deberan estar los archivos Movie.php y Genre.php
	
	//code first
	- code first es un enfoque que plantea que el programador cree las clases, cree sus relaciones y se olvide de como crear la base de datos
	- lo importante es entender que con code first lo primero es el codigo y luego generar la base de datos
	- aunque tambien se puede trabajar con bases de datos existentes
		- [modelo] ---→ [base de datos]
		- [base de datos] ---→ [modelo]
	
	//modelo Movie.php [proyecto]
		<?php

			namespace Cinema;

			use Illuminate\Database\Eloquent\Model;

			class Movie extends Model
			{
				/**
				 * The table associated with the model.
				 *
				 * @var string
				 */
				protected $table = 'movies';
			}
	-eloquent asume que cada tabla va a tener una llave primaria llamada id
		-se puede asignar un nombre a la llave primaria de las tablas
			protected $primaryKey = 'NombrePK'
	-eloquent asume que la llave primaria va a ser de tipo entero e incremental
		-se puede modificar el incremento 
			public $incrementing = false;
	
	//Timestamps
	- Eloquent mantiene las comunas: 
			'created_at' (la fecha de la creacion del recurso) y 'updated_at' (la fecha de la ultima utilizacion del recurso)
		si no quiere que se manejen automaticamente estas columnas entonces modifique la propiedad timestamps
			public $timestamps = false;
		
	//fillable
	- fillable se refiere a los atributos de la table que pueden ser llenados
		si la tabla tiene 10 columnas pero solo que quieren permitir que un usuario inserte 5 se pueden definir
		protected $fillable = ['first_name', 'last_name', 'email'];
		
	//modelo Genre.php [proyecto]
		<?php

			namespace Cinema;

			use Illuminate\Database\Eloquent\Model;

			class Genre extends Model
			{
				$protected $table = 'genres';
			}
			
//Migraciones
	https://laravel.com/docs/5.2/migrations
	- la migracios es un tipo de control de versiones de una base de datos
	- esto le permite a un equipo modificar un esquema de base de datos y estar al dia en estas modificaciones
	- en el directorio /database/migrations/ estan los archivos de las migraciones
	- se deben crear las migraciones en orden de dependencia, primero las tablas que no tienen dependencias (llaves foraneas)
	//creacion de tablas
		https://laravel.com/docs/5.2/migrations#creating-tables
		- en los archivos de migracion se encuentran dos funciones, up() y down(), las cuales se usan para crear y eliminar la tabla respectivamente
	//la sintaxis para todos los tipos de campos necesarios se pueden encontrar en la documentacion de laravel		
	- creacion de campos, el codigo para cada campo se coloca dentro de la funcion up()
	//campos
		$table->integer('votes');
		$table->string('name', 100);
		$table->dateTime('created_at');
	- creacion de llaves foraneas, se agrega el codigo en la creacion de la tabla, funcion up()
		$table->integer('user_id')->unsigned();
		$table->foreign('user_id')->references('id')->on('users');
		
		$table->foreign('user_id')
			  ->references('id')->on('users')
			  ->onDelete('cascade');
		//eliminar fk
		$table->dropForeign('posts_user_id_foreign');
	-modificar campos
		$table->string('name', 50)->change();
		$table->string('name', 50)->nullable()->change();
		$table->renameColumn('from', 'to');
		$table->dropColumn('votes');
		$table->dropColumn(['votes', 'avatar', 'location']);
	-creacion de indices
		$table->string('email')->unique();
		$table->primary(['first', 'last']);
		$table->unique('state', 'my_index_name');
		$table->index('state');
		//eliminacion de indices
		$table->dropPrimary('users_id_primary');
		$table->dropUnique('users_email_unique');
		$table->dropIndex('geo_state_index');
	//archivo de migracion del modelo Movie [proyecto]
		// /database/migrations/2016_05_23_223059_create_movies_table.php
		<?php

			use Illuminate\Database\Schema\Blueprint;
			use Illuminate\Database\Migrations\Migration;

			class CreateMoviesTable extends Migration
			{
				/**
				 * Run the migrations.
				 *
				 * @return void
				 */
				public function up()
				{
					Schema::create('movies', function (Blueprint $table) {
						$table->increments('id');
						$table->string('name');
						$table->string('path');
						$table->string('cast');
						$table->string('direction');
						$table->string('duration');
						$table->timestamps();
						$table->integer('genre_id')->unsigned();
						$table->foreign('genre_id')->references('id')->on('genres');
					});
				}

				/**
				 * Reverse the migrations.
				 *
				 * @return void
				 */
				public function down()
				{
					Schema::drop('movies');
				}
			}
		
	//archivo de migracion del modelo Genre [proyecto]
		// /database/migrations/2016_05_23_223047_create_genres_table.php
		<?php
		...
		
			public function up()
			{
				Schema::create('genres', function (Blueprint $table) {
					$table->increments('id');
					$table->string('genre');
					$table->timestamps();
				});
			}
		...
	//ejecutar las migraciones
	- se deben crear las migraciones en orden de dependencia, primero las tablas que no tienen dependencias (llaves foraneas)
	- por linea de comandos ordenar la ejecucion de las migraciones
		//todas las migraciones
		php artisan migrate
		//migracion especifica
		php artisan make:migration create_users_table
		//migracion especifica mencionando la tabla de destino
		php artisan make:migration create_users_table --create=users
		//forzar las migraciones en produccion
		php artisan migrate --force
		//rollback de la ultima ejecucion de la migracion ( uso de la funcion down() )
		php artisan migrate:rollback
		//rollback de todas las migraciones
		php artisan migrate:reset
		//rollback de todas las migraciones y ejecuta el comando migrate
		php artisan migrate:refresh
	
//vistas
	https://laravel.com/docs/5.2/views
	- las vistas contienen el codigo html el cual es servido por la aplicacion
	- sirve como metodo para separar el controlador y la logica de dominio de la logica de presentacion
	- las vistas estan almacenadas en /resources/views/
	- para crear una vista se debe crear primero una ruta: peticion de usuario
		//crear el controlador FrontController [proyecto]
		php artisan make:controller FrontController --resource
		
		//crear las rutas a los metodos del controlador FrontController [proyecto]
		Route::get('/','FrontController@index');
		Route::get('contacto','FrontController@contacto');
		Route::get('reviews','FrontController@reviews');
	
	//retorno de una vista
		//retorna la vista 'index'
		return view('index');
		
		//contenido del archivo: /resoruces/views/index.php
		<html>
			<body>
				<h1>Hello, <?php echo $name; ?></h1>
			</body>
		</html>
		//ruta que retorna la vista greeting enviandole el parametro name con el valor James
		Route::get('/', function () {
			return view('greeting', ['name' => 'James']);
		});
		
		//subdirectorios: la vista profile esta almacenada en /resources/views/admin/profile.php
		//el subdirectorio es admin y le envia un array de valores: $data
		return view('admin.profile', $data);
		
		//determinar si existe una vista
		if (view()->exists('emails.customer')) {
			//
		}
		
		//asigna un valor a la variable name
		return view('greeting')->with('name', 'Victoria');
		
		//asigna el contenido de la vista a una variable y usa un 'Magic Methods' para asignar el valor 'steve' a la variable de la vista 'name'
		$view = View::make('greeting')->withName('steve');
		
		//comparte con todas las vistas el dato name con el valor Steve
		View::share('name', 'Steve');
		
		//archivo /app/Http/Controllers/FrontController.php [proyecto]
		<?php
		...
		
		class FrontController extends Controller
		{
			public function index()
			{
				return view('index');
			}

			public function contacto()
			{
				return view('contacto'):
			}

			public function reviews()
			{
				return view('reviews');
			}
		}
	//creacion de vistas 
		//index.php [proyecto]
		- copiar el contenido de este archivo:
			https://github.com/RpL02/CursoLaravel5.1/blob/Vistas/Front/index.html
		//contacto.php [proyecto]
		- copiar el contenido de este archivo:
			https://github.com/RpL02/CursoLaravel5.1/blob/Vistas/Front/contact.html
		//reviews.php [proyecto]
		- copiar el contenido de este archivo:
			https://github.com/RpL02/CursoLaravel5.1/blob/Vistas/Front/reviews.html
	//CSS, Fuentes, Imagenes, Javascript
		en la carpeta /public/ se encuentran o se colocan unas carpetas dispuestas para cada tipo de archivo o contenido
		/public/css/
		/public/fonts/
		/public/images/
		/public/js/
		
		//copiar css, js e images [proyecto]
			https://github.com/RpL02/CursoLaravel5.1/tree/Vistas/Front
			
//templates
	https://laravel.com/docs/5.2/blade
	- laravel usa un motor de plantillas que va a ayudar a reducir las lineas que se deban generar
	- Blade es un motor de plantillas simple pero potente, es impulsado por la herencia de plantillas y secciones
	- todas las plantillas tienen que tener la extension .blade.php y estar dentro del directorio /resources/views/
	
	- definir un layout, ejemplos:
		- plantilla dentro de ./layout/ con el nombre 'master'
		- la directiva @section define una seccion de contenido
		- la directiva @yield es usada para mostrar contenidos de una seccion determinada
		//archivo
		<!-- Stored in resources/views/layouts/master.blade.php -->
		<html>
			<head>
				<title>App Name - @yield('title')</title>
			</head>
			<body>
				@section('sidebar') 
					This is the master sidebar.
				@show

				<div class="container">
					@yield('content')
				</div>
			</body>
		</html>
		//
		- extension de un layout ("herencia")
			- se usa la directiva @extends para especificar de cual layout quiere heredar el diseño
			- las vistas con la directiva @extends pueden injectar contenido dentro de secciones usando la directiva @section
			- el contenido de dicha seccion se mostrara en el layout usando la directiva @yield
		//archivo
		<!-- Stored in resources/views/child.blade.php -->

		@extends('layouts.master')

		@section('title', 'Page Title')

		@section('sidebar')
			@parent

			<p>This is appended to the master sidebar.</p>
		@endsection

		@section('content')
			<p>This is my body content.</p>
		@endsection
		//
		- la directiva @parent reemplazara el contenido del layout que hace referencia cuando la vista se represente
		
	- mostrar templates
		//crear ruta hacia la vista creada, routes.php
		Route::get('blade', function () {
			return view('child');
		});
		// mostrar vista enviando parametros para las variables
		Route::get('greeting', function () {
			return view('welcome', ['name' => 'Samantha']);
		});
			//mostrar el contenido de la variable name:
			Hello, {{ $name }}.
			//la declaracion {{ }} es enviada automaticamente a traves de htmlentities para prevenir ataques XSS
			
	// crear carpeta /layouts/ [proyecto]
	- crear archivo /layouts/principal.blade.php [proyecto]
		- identificar y copiar el contenido comun entre index.php, contacto.php y reviews.php [proyecto]
		- en la seccion donde el contenido cambia agregar la declaracion @yield('content')
	- renombrar el archivo index.php a index.blade.php [proyecto]
		- identificar y copiar el contenido particular o unico del index 
		- en el inicio del archivo agregar las declaraciones:
			@extends('layouts.principal')
				@section('content')
		- al final del archivo agregar la declaracion:
				@endsection	
	- renombrar el archivo contacto.php a contacto.blade.php [proyecto]
		- identificar y copiar el contenido particular o unico del contacto 
		- en el inicio del archivo agregar las declaraciones:
			@extends('layouts.principal')
				@section('content')
		- al final del archivo agregar la declaracion:
				@endsection	
	- renombrar el archivo reviews.php a reviews.blade.php [proyecto]
		- identificar y copiar el contenido particular o unico del reviews 
		- en el inicio del archivo agregar las declaraciones:
			@extends('layouts.principal')
				@section('content')
		- al final del archivo agregar la declaracion:
				@endsection	
	- crear vista /layouts/admin.blade.php [proyecto]
		- copiar el contenido desde:
			https://github.com/RpL02/CursoLaravel5.1/blob/Templates/laravel/resources/views/layouts/admin.blade.php
	- agregar ruta, routes.php
		Route::get('admin','FrontController@admin');
	- agregar funcion en el controlador FrontController.php
		public function admin()
		{
			return view('admin.index');
		}
	- agregar los archivos css y js que falten
		https://github.com/RpL02/CursoLaravel5.1/tree/Templates/laravel/public
		
//CRUD de los usuarios (Create, Read, Update, Delete)
// Create
	- generar un controlador
		php artisan make:controller UsuarioController --resource
	- agregar ruta RESTful en routes.php
		// direcciona a todos los metodos por defecto del controlador UsuarioController
		Route::resource('usuario','UsuarioController');
	- en el controlador UsuarioController, en el metodo 'create' agregar la instruccion para que muestre la vista usuario.create
		public function create()
		{
			return view('usuario.create');
		}
	- crear la vista create.blade.php
	// archivo /resources/views/usuario/create.blade.php
	// la vista tiene sintaxis html de laravel: 
	// https://laravel.com/docs/4.2/html
	// https://laravelcollective.com/docs/5.2/html
		
		@extends('layouts.admin')
			@section('content')
				{!!Form::open(['route'=>'usuario.store', 'method'=>'POST'])!!}
				<div class="form-group">
					{!!Form::label('nombre','Nombre:')!!}
					//{!!Form::text([nombre],[valor por defecto], [atributos])!!}
					{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('email','Correo:')!!}
					{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('password','Contraseña:')!!}
					{!!Form::password('password',['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
				</div>
				{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
				{!!Form::close()!!}
			@endsection
			
	//es posible que no funcionen estas instrucciones, entonces los pasos a seguir son los que dicta la pagina laravelcollective:
	// https://laravelcollective.com/docs/5.2/html
	- en el archivo composer.json agregar la instruccion dentro de 'require':
		"require": {
			"laravelcollective/html": "5.2.*"
		}
	- en un terminal ejecutar la siguiente instruccion:
		composer update
	- luego en el archivo /config/app.php agregar un nuevo proveedor en el array providers:
		'providers' => [
			// ...
			Collective\Html\HtmlServiceProvider::class,
			// ...
		  ],
	- Finalmente, agregue dos clases de alias al array aliases del archivo /config/app.php:

	  'aliases' => [
		// ...
		  'Form' => Collective\Html\FormFacade::class,
		  'Html' => Collective\Html\HtmlFacade::class,
		// ...
	  ],	
	  
	- ahora se notara que se muestra el formulario pero sin formato, sin css ni js, entonces hay que reemplazar las etiquetas link y script por otro formato:
		//en la plantilla /layouts/admin.blade.php las etiquetas link:
			<link href="css/bootstrap.min.css" rel="stylesheet">
			//se cambian por este formato:
			{!!Html::style('css/bootstrap.min.css')!!}
		
		//en la plantilla /layouts/admin.blade.php las etiquetas script:
			<script src="js/jquery.min.js"></script>
			//se cambian por este formato:
			{!!Html::script('js/jquery.min.js')!!}
			
	- si llegaron a observar, con laravelcollective se puede colocar la ruta en el envio del formulario	
		{!!Form::open(['route'=>'usuario.store', 'method'=>'POST'])!!}
		- lo cual quiere decir que los datos van a ir al metodo store del controlador UsuarioController y seran enviados por metodo POST
	- ahora se puede comprobar la recepcion creando un mensaje de retorno:
		public function store(Request $request)
		{
			return 'Aqui estoy';
		}
		
	- se utilizara el Request (la informacion que es enviada) para los datos recibidos de los formularios
		//se modifica el metodo store del controlador UsuarioController
		public function store(Request $request)
		{
			\Cinema\user::create([
			'name' => $request['name'],
			'email' => $request['email'],
			'password' => bcrypt($request['password']),
			]);
			
			return 'Usuario registrado';
		}
		// se usa el namespace \Cinema con el nombre del modelo \user y la accion de ::create 
		// se colocan los datos como tipo json extraidos del $request[] 
		// se encripta el password con bcrypt();
		// se retorna un mensaje al usuario: return 'Usuario registrado';
		
//----------------------------------------------------------//
//----------------------------------------------------------//
// ALTERNATIVA (COMPROBADO)
// crear CRUD con laravel-api-generator InfyOm Labs
	http://labs.infyom.com/laravelgenerator/
	http://labs.infyom.com/laravelgenerator/docs/getting-started/installation
	http://labs.infyom.com/laravelgenerator/docs/generator-gui-interface
	
	- se debe tener configuradas las credenciales de la bd en el archivo .env para que el api funcione correctamente
	- Coloca la siguiente línea en tu composer.json:
		- los tres primeros packages son para el generador
		- los siguientes dos son para swagger annotations para la documentation de la api 
		- la siguiente es para usar la opcion de Generate from Table
		- la ultima es para usar el Generator GUI Interface
		
		"require": {
			...
			"infyomlabs/laravel-generator": "dev-master",
			"laravelcollective/html": "5.1.*",
			"infyomlabs/core-templates": "dev-master",
			"infyomlabs/swagger-generator": "dev-master",
			"jlapp/swaggervel": "dev-master",
			"doctrine/dbal": "~2.3",
			"infyomlabs/generator-builder": "dev-master"
		}
		
	- luego en la consola:
		//composer update
		composer install
		
		//(Opcional) asegurarse de que esta instalado el flash package
		// se puede instalar por el terminal
		composer require laracasts/flash 
		
	- Siguiente paso, agrega en el archivo config/app.php los siguientes providers:
		//verificar que no esten ya
		...
		Collective\Html\HtmlServiceProvider::class,
		Laracasts\Flash\FlashServiceProvider::class,
		Prettus\Repository\Providers\RepositoryServiceProvider::class,
		\InfyOm\Generator\InfyOmGeneratorServiceProvider::class,
		\InfyOm\CoreTemplates\CoreTemplatesServiceProvider::class,
		\InfyOm\GeneratorBuilder\GeneratorBuilderServiceProvider::class,
		...
		
	- y los siguientes aliases:
		'Form'      => Collective\Html\FormFacade::class,
		'Html'      => Collective\Html\HtmlFacade::class,
		'Flash'     => Laracasts\Flash\Flash::class
		
	- De nuevo en la consola, para publicar el material de configuarción:
		
		php artisan vendor:publish
		
	- En la consola, para publicar el material de reutilizable:	
		
		php artisan infyom:publish
			yes
		
	- En consola, para publicar el material del generator-builder y las rutas del mismo:	
		
		php artisan infyom.publish:generator-builder
	
	- se debe crear una vista en resources\views\layouts\app.blade.php con el siguiente contenido:
		//archivo
			<html>
				<head>
					@section('head')
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
					@show
				</head>
				<body>
				<div class="container">
					@yield('content')
				</div>

				@section('footer_scripts')
				  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
				  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
				@show
				</body>
			</html>
		//	
	
	- ahora se podra utilizar el generador
		http://labs.infyom.com/laravelgenerator/docs/advanced/fields-input-guide
		http://labs.infyom.com/laravelgenerator/docs/introduction
		
		- al usar el api generator este le preguntara una serie de datos basicos acerca del modelo que esta generando
		- se tiene que tener clara la sintaxis de:
			- los tipos de datos de bd de laravel
			- los tipos de elementos html (text, number, ...)
			- las validaciones de laravel
	
	- Publish Layout, genera los layout principales, como los del login, registro y home
		http://labs.infyom.com/laravelgenerator/docs/master/publish-layout
		
		php artisan infyom.publish:layout

	- API Generator
		php artisan infyom:api $MODEL_NAME$
		// donde $MODEL_NAME$ es el nombre del modelo que se quiere
		//ejemplo: php artisan infyom:api Project
		
	- Scaffold Generator
	
		php artisan infyom:scaffold $MODEL_NAME$
		//ejemplo: php artisan infyom:scaffold miprueba
		- este comando genera todo lo necesario para el modelo, tabla en bd, controlador, vistas, rutas 
	
	- API & Scaffold Generator
	
		php artisan infyom:api_scaffold $MODEL_NAME$
		
	- Generator GUI Interface
	
		- ahora en la url de la aplicacion escribir /generator_builder para comenzar a usar la interfaz del generador
		
	- Generate from Table
		- crear crud a partir de una tabla existente
			http://labs.infyom.com/laravelgenerator/docs/master/generator-options
			
			php artisan infyom:scaffold $MODEL_NAME$ --fromTable --tableName=$TABLE_NAME$
			//ejemplo php artisan infyom:scaffold ciudad --fromTable --tableName=ciudad
			
		- si la tabla no tiene los campos created_at, updated_at y deleted_at se debe crear una nueva migracion para agregarle estos campos
			
			//el nombre de la migracion es simbolico
			php artisan make:migration add_timestamps_deleted_to_ciudad_table --table=ciudad
			
			//Created Migration: 2016_06_08_221035_add_timestamps_deleted_to_ciudad_table
			
		- se modifica el archivo creado de la migracion /database/migrations/2016_06_08_221035_add_timestamps_deleted_to_ciudad_table.php
			- en la funcion up() se agregan las instrucciones para los campos faltantes
				//Ejemplo
				...
				/**
				 * Run the migrations.
				 *
				 * @return void
				 */
				public function up()
				{
					Schema::table('ciudad', function (Blueprint $table) {
						$table->timestamps();
						$table->softDeletes();
					});
				}
				...
				//
				
		- luego se ejecuta el comando para ejecutar la migracion
			
			php artisan migrate
			
		- en el caso de que la tabla tenga datos, no va a permitir crear las columnas debido a que los campos del timestamp son not null: created_at y updated_at
			
			- entonces sera necesario crear las columnas con valores nulos, si se quiere, se puede colocar una fecha inicial y luego colocarle el atributo de not null a created_at y updated_at
			//
			...
			$table->dateTime('created_at')->nullable();
			$table->dateTime('updated_at')->nullable();
			$table->softDeletes();
			...
			//
		- ya estaria funcionando el crud 
		
		- el generador, al parecer, no contempla los campos not null de la tabla existente en las validaciones, entonces es necesario agregar las reglas en el modelo
		
	- AdminLTE Templates Installation, esto agrega un template para las rutas creadas, un estilo visual de AdminLTE
	
		http://labs.infyom.com/laravelgenerator/docs/templates/adminlte
	
	- con el siguiente comando se puede ver la lista de rutas que estan configuradas
		php artisan route:list
	
	- los archivos creados apuntan a App\.. en namespace y use, entonces al parecer no permite cambiar el nombre del proyecto ( app:name )
	
	//----------------------------------------------------------//
	//----------------------------------------------------------//
	
	
//CRUD de los usuarios (Create, Read, Update, Delete)
// Read
	- en el controlador UsuarioController, en la funcion index, retornar una vista que esta en /resoruces/views/usuario/ y se llama index
		return view('usuario.index');
		
	- crear el archivo /resoruces/views/usuario/index.blade.php
	//archivo
		@extends('layouts.admin')
			@section('content')
				<table class="table">
					<thead>
						<th>Nombre</th>
						<th>Correo</th>
						<th>Operaciones</th>
					</thead>
					<!-- recorre los datos de la variable recibida y muestra el name y email -->
					@foreach($users as $user)
					<tbody>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td></td>
					</tbody>
					@endforeach
				</table>
			@endsection
	//
	- se agrega una nueva instruccion en el metodo index del controlador UsuarioController
	//archivo
		public function index()
		{
			// trae todos los elementos que tenga la tabla users y los almacena en la variable $users
			$users = \Cinema\User::All();
			// retorna la vista /usuario/index.blade.php agregandole los datos de la variable users
			return view('usuario.index', compact('users'));
		}
	//
	- en el metodo store del controlador UsuarioController cambiar el mensaje de retorno:
		//return 'Usuario registrado';
		
		// redirecciona a la vista de usuario, le envia en la variable message el valor store, lo cual sera indicador para mostrar un mensaje de que se almaceno
		return redirect('/usuario')->with('message','store');
		
	- modificar la vista /usuario/index.blade.php para que valide la recepcion de la variable message y muestre un mensaje
	http://getbootstrap.com/components/#alerts
	//archivo
		@extends('layouts.admin')
			<!--  se recibe la variable enviada del metodo store del controlador UsuarioController -->
			<?php $message=Session::get('message'); ?>
			
			<!-- si message == 'store' muestra el mensaje de la creacion exitosa -->
			@if($message == 'store')
				<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  Usuario creado exitosamente.
				</div>
			@endif
			
			@section('content')
			...
	//
	
// UPGRADE VERSION DE LARAVEL
	- en el caso de que salga una nueva version de laravel se deben seguir las instrucciones en la documentacion de laravel
		por ejemplo: https://laravel.com/docs/5.2/upgrade
	- en la url se muestra la ultima version de laravel y esta en la documentacion de upgrade
	- luego de ejecutar los cambios requeridos, tanto para el funcionamiento de laravel como para el del proyecto, debido a que puede haber cambios en funciones o sintaxis, se actualiza el composer via terminal
		composer update

//CRUD de los usuarios (Create, Read, Update, Delete)
// Update
	https://laravelcollective.com/docs/5.2/html#generating-urls
	- ir a la vista \resources\views\usuario\index.blade.php
	- la columna de operaciones se edita con el siguiente codigo
	// 'usuario.edit' vista /usuario/edit.blade.php; le envia como parametros el array de $user; en los atributos se le asigno una clase, de bootstrap para que se vea como un boton primario
		<td>
			{!!link_to_route('usuario.edit', $title = 'Editar', $parameters = $user, $attributes = ['class'=>'btn btn-primary'] )!!}
		</td>
	- crear la vista /usuario/edit.blade.php 
		//la instruccion Form::model se usa para llenar el formulario basandose en un modelo, donde los atributos del modelo se van a ajustas a cada valor del campo
		@extends('layouts.admin')
			@section('content')
				{!!Form::model($user,['route'=> ['usuario.update',$user],'method'=>'PUT'])!!}
					...
				{!!Form::close()!!}
			@endsection
	- aditar el controlador UsuarioController
		- si no se quiere hacer uso del namespace de la aplicacion en cada instruccion, ejemplo: $users = \Cinema\User::All(); , entonces se coloca la instruccion al inicio del controlador, despues del namespace: 
			use Cinema\User;
			- luego se pueden modificar las instrucciones que hacian el llamado a \Cinema\
		- se edita la funcion edit
		//archivo
			public function edit($id)
			{
				//a la variable $user se le asigna el resultado de la busqueda del usuario a partir del id recibido
				$user = User::find($id);
				//se retorna una vista a la cual se envia el parametro user con el valor de la variable asignada $user
				return view('usuario.edit', ['user'=>$user]);
			}
		//
	- crear un nuevo layout /usuario/forms/user.blade.php en donde se coloca el contenido que compartiran los formularios de creacion y actualizacion se usuarios
		- este layout hace que se reduzca el codigo en las vistas
		//archivo
			<div class="form-group">
				{!!Form::label('nombre','Nombre:')!!}
				{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
			</div>
			<div class="form-group">
				{!!Form::label('email','Correo:')!!}
				{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
			</div>
			<div class="form-group">
				{!!Form::label('password','Contraseña:')!!}
				{!!Form::password('password',['class'=>'form-control','placeholder'=>'Ingresa la contraseña del usuario'])!!}
			</div>
		//
	- editar la vista /usuario/create.blade.php reemplazando el contenido compartido por el llamado al nuevo layout user: @include('usuario.forms.user');
	//archivo
		@extends('layouts.admin')
			@section('content')
				{!!Form::open(['route'=>'usuario.store', 'method'=>'POST'])!!}
					@include('usuario.forms.user');
					{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
				{!!Form::close()!!}
			@endsection
	//
	- editar la vista /usuario/edit.blade.php
		- el metodo PUT es el que se usa para los updates
	//archivo
		@extends('layouts.admin')
			@section('content')
				{!!Form::model($user,['route'=> ['usuario.update',$user],'method'=>'PUT'])!!}
					@include('usuario.forms.user');
					{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
				{!!Form::close()!!}
			@endsection
	//
	- editar el modelo de usuario /app/User.php agregar una funcion para encriptar la contraseña si es cambiada
		//para setear la contraseña cada vez que sea cambiada, es decir ser encriptada
		public function setPasswordAttribute($valor){
			if( !empty($valor) ){
				$this->attributes['password'] = \Hash::make($valor);
			}
		}
	- en el controlador UsuarioController se quita la instruccion bcrypt para el password en la funcion store ya que ahora no es necesaria
		'password' => bcrypt($request['password']),
		
	- editar el controlador UsuarioController en la funcion update 
		//
		public function update(Request $request, $id)
		{
			//a la variable $user se le asigna el resultado de la busqueda del usuario a partir del id recibido
			$user = User::find($id);
			//almacenar la actualizacion que realiza el usuario, deacuerdo a los campos fillable
			$user->fill($request->all());
			//guardar el usuario
			$user->save();
			//configurar el mensaje que se almacenara en la variable Session
			Session::flash('message','Usuario Actualizado Correctamente');
			//redirecciona al index del usuario
			return redirect::to('/usuario');
		}
		//
	- editar el controlador UsuarioController en la funcion store 
		// se cambia el return por el que se manejara para todos los retornos 
		Session::flash('message','Usuario Creado Correctamente');
        return Redirect::to('/usuario');
		//
	- editar el controlador UsuarioController agregando los recursos para Session y Request, esto se agrega despues de la declaracion namespace
		//
		use Session;
		use Redirect;
		//
	- editar la vista /usuario/index.blade.php 
		- cambiar el mensaje configurado, para la creacion exitosa del usuario, por uno que muestre el mensaje que le sea enviado por Session
		//
		<!-- si existe la variable message muestra el mensaje en un recuadro de alerta -->
		@if( Session::has('message') )
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  {{Session::get('message')}}
			</div>
		@endif
		//
		
//CRUD de los usuarios (Create, Read, Update, Delete)
// Delete
	https://laravel.com/docs/5.2/eloquent#deleting-models
	- laravel provee de dos metodos para eliminar un recurso: ->delete() o ::destroy()
	- se va a usar ::destroy(1) ya que nosotros sabemos la llave primaria o el id
	- en un terminal, en la carpeta del proyecto, con el comando: php artisan route list  , van a salir las rutas configuradas y se puede ver que para eliminar un recurso es necesario enviar por el metodo DELETE el id del recurso y se requiere un formulario que reciba la instruccion
	
	- modificar la vista /usuario/edit.blade.php 
		// agregar las instrucciones para mostrar el boton de Eliminar debajo del de Actualizar, el metodo DELETE es el encargado de eliminar un recurso
		{!!Form::open(['route'=> ['usuario.destroy',$user],'method'=>'DELETE'])!!}
			{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
		{!!Form::close()!!}
		//
	- editar el controlador UsuarioController en la funcion destroy
		//
		public function destroy($id)
		{
			//se pasa el id que se esta recibiendo para hacer el destroy
			User::destroy($id);
			//configurar el mensaje que se almacenara en la variable Session
			Session::flash('message','Usuario Eliminado Correctamente');
			//redirecciona al index del usuario
			return Redirect::to('/usuario');
		}
		//
	
	- editar el layout /layouts/admin.blade.php para que las opciones del usuario comiencen a funcionar correctamente
		- se ajusta la instruccion url del href de los link: href="{!!URL::to('/usuario/create')!!}" , mediante la cual se evitan erroes como los de las llamadas a los .js y .css
		//se editan los enlaces de los submenus de Usuario
		...
		<a href="#"><i class="fa fa-users fa-fw"></i> Usuario<span class="fa arrow"></span></a>
		<ul class="nav nav-second-level">
			<li>
				<a href="{!!URL::to('/usuario/create')!!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
			</li>
			<li>
				<a href="{!!URL::to('/usuario')!!}"><i class='fa fa-list-ol fa-fw'></i> Usuarios</a>
			</li>
		</ul>
		...
		//
		
//Validaciones
	https://laravel.com/docs/5.2/validation#form-request-validation
	- crear los request para crear y actualizar por medio del comando en el terminal
		//el nombre puede ser algo simbolico
		php artisan make:request UserCreateRequest
		php artisan make:request UserUpdateRequest
		
	- los request creados se encuentran en: 
		/app/Http/Requests/UserCreateRequest.php
		/app/Http/Requests/UserUpdateRequest.php
		
	- editar los request /app/Http/Requests/UserCreateRequest.php y /app/Http/Requests/UserUpdateRequest.php
		- modificar la funcion rules, ingresar las reglas con las que se quiere que sean validados cada campo
			https://laravel.com/docs/5.2/validation#available-validation-rules
			//request UserCreateRequest.php
			public function rules()
			{
				return [
					'name' => 'required',
					'email' => 'required|unique:users',
					'password' => 'required',
				];
			}
			//
			//request UserUpdateRequest.php
			//en este caso el password puede o no ser enviado
			public function rules()
			{
				return [
					'name' => 'required',
					'email' => 'required|unique:users',
				];
			}
			//
		- modificar la funcion authorize, cambiar el valor de return a true para autorizar el uso de ese request
			//
			public function authorize()
			{
				return true;
			}
			//
	- modificar el controlador UsuarioController
		- agregar las instrucciones para usar los recursos creados
			//
			use Cinema\Http\Requests\UserCreateRequest;
			use Cinema\Http\Requests\UserUpdateRequest;
			//
		- en la funcion store, cambiar el parametro (Request $request) para que use el request realizado para la creacion de usuarios UserCreateRequest
			//
			...
			public function store(UserCreateRequest $request)
			...
			//
		- en la funcion update, cambiar el parametro (Request $request, $id) para que use el request realizado para la actualizacion de usuarios UserUpdateRequest
			//
			...
			public function update(UserUpdateRequest $request, $id)
			...
			//
	- crear el directorio /resoruces/views/alerts/
	- crear la sub-vista /alerts/request.blade.php
		- modificar la vista /alerts/request.blade.php
			- agregar las instrucciones para mostrar los errores
			//
			<!-- si existen errores muestra todos en un recuadro de alerta -->
			@if(count($errors) > 0)
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<ul>
						@foreach($errors->all() as $error)
							<li>{!!$error!!}</li>
						@endforeach
					</ul>
				</div>
			@endif
			//
	- modificar las vistas /usuario/create.blade.php y /usuario/edit.blade.php para incluir la sub-vista que muestra los errores
		//
		...
		@section('content')
			@include('alerts.request')
		...
		//
		
	- en el archivo /resources/lang/es/validation.php estan las validaciones para cada caso
		https://laravel.com/docs/5.1/validation#working-with-error-messages
		
		- se pueden modificar o agregar mensajes personalizados
			//
			...
			'required'             => 'El campo :attribute es obligatorio.',
			...
			//
		- se pueden agregar 'traducciones' para los nombres de los campos
			//
			...
			'attributes'           => [
				'name'                  => 'nombre',
			...
			//
	
//Paginacion
	https://laravel.com/docs/5.2/pagination
	- la paginacion se va a encargar de mostrar un cierto numero de recursos por cada pagina
	
	- modificar el controlador UsuarioController 
		//en la funcion index se cambia el parametro User::All() por User::paginate(10); en donde el numero 10 es la cantidad de elementos que seran mostrados por pagina
		...
		public function index()
		{
			// trae una cantidad limitada de elementos que tenga la tabla users y los almacena en la variable $users
			$users = User::paginate(10);
		...
		//
	- modificar la vista /usuario/index.blade.php 
		//al final, antes del fin de la seccion, agregar la instruccion para mostrar los botones de paginacion
			{!! $users->render() !!}
		@endsection
		//
		
//Soft Deleting
	https://laravel.com/docs/5.2/eloquent#soft-deleting
	- en una bd nunca es recomendable eliminar los recursos
	- el soft deleting oculta los registros pero no los elimina
	
	- modificar el modelo User.php
		- agregar la instruccion para usar el recurso de soft deleting
			//
			use Illuminate\Database\Eloquent\SoftDeletes;
			//
		- dentro de la clase User llamar el uso del SoftDeletes y crear la variable protected $dates = ['deleted_at'];
			//
			use SoftDeletes;
			 /**
			 * The attributes that should be mutated to dates.
			 *
			 * @var array
			 */
			protected $dates = ['deleted_at'];
			//
	- agregar la columna deleted_at a la tabla users
		- para esto se va a crear una migracion por linea de comandos
			php artisan make:migration add_deleted_to_users_table --table=users
		- y agregar la instruccion para el nuevo campo
			//simplemente se coloca la instruccion $table->softDeletes(); en la funcion up()
			public function up()
			{
				Schema::table('users', function (Blueprint $table) {
					$table->softDeletes();
				});
			}
			//
		- correr la migracion por linea de comandos
			php artisan migrate
			//se tubo que haber creado un campo llamado deleted_at en la tabla users
		- luego de esto, cada vez que se llame al metodo delete, la columna deleted_at va a ser seteada con la fecha de eliminacion del recurso
		- modificar el controlador UsuarioController para colocar el metodo delete()
			//en la funcion destroy cambiar el uso del metodo destroy($id) por el de delete() para asi no destruir el recurso sino eliminarlo de la perspectiva de los usuarios
			...
			public function destroy($id)
			{
				//a la variable $user se le asigna el resultado de la busqueda del usuario a partir del id recibido
				$user = User::find($id);
				//este metodo usa el campo deleted_at para colocar la fecha de eliminacion y asi oculta el recurso al usuario
				$user->delete();
				...
			//
		- si, por ejemplo, se quiere ver todos los elementos que han sido eliminados, se debe colocar la instruccion ::onlyTrashed(), ejemplo:
			//se puede modificar la funcion index del controlador UsuarioController para que muestre solo los recursos que han sido eliminados
			public function index()
			{
				// trae una cantidad limitada de elementos que tenga la tabla users y los almacena en la variable $users
				$users = User::onlyTrashed()->paginate(15);
			//
			
//Optimizando el proyecto
	
	- modificar el controlados UsuarioController
		- en la funcion store se pueden cambiar los parametros del metodo create por la instruccion: request->All()
			//
			...
			User::create( request->All() );
			...
			//
	//INICIO, Eliminado en la version 5.2 de laravel, reemplazado por el middleware
		- hay codigo que se esta repitiendo en varias funciones, por ejemplo: $user = User::find($id);    , entonces se va a crear un constructor para solucionar esto
			//
			...
			//metodo constructor
			public function __construct(){
				//filtro que se ejecutara antes de cualquier accion del controlador, se especifica el metodo que se desea ejecutar
				$this->beforeFilter('@find',['only' => ['edit','update','destroy'] ]);
			}
			//metodo find ejecutado por el metodo beforeFilter dentro del constructor
			public function find(Route $route){
				//va a buscar los parametros que estan el esta ruta y que son enviados por el recurso, que en este caso es 'usuario' el configurado en las rutas
				$this->user = User::find( $route->getParameter('usuario') );
				//return $this->user;
			}
			...
			//
	----------------------------------------
		php artisan make:middleware find
		archivo kernel.php, variable $routeMiddleware 
			'find' => \Cinema\Http\Middleware\find::class,
		archivo middleware find.php, metodo handle
			$this->user = User::find( $route->getParameter('usuario') );
			return $this->user;
			
		//no ha funcionado
		
	//FIN, Eliminado en la version 5.2 de laravel, reemplazado por el middleware
	
	- crear la sub-vista /alerts/success.blade.php
		//archivo
		<!--  se recibe la variable enviada del metodo store del controlador UsuarioController -->
		<?php $message=Session::get('message'); ?>

		<!-- si existe la variable message muestra el mensaje en un recuadro de alerta -->
		@if( Session::has('message') )
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  {{Session::get('message')}}
			</div>
		@endif
		//
	- modificar la vista /usuario/index.blade.php eliminando las lineas que estan en la sub-vista /alerts/success.blade.php e incluir a dicha sub-vista con la instruccion @include()
		//
		@extends('layouts.admin')
			@include('alerts.success');
		...
		//
		
//Autenticacion 
	https://laravel.com/docs/5.2/authentication
	- laravel nos provee de un modulo de autenticacion
	- en este caso lo vamos a hacer de forma manual
	- en el archivo /config/auth.php se encuentran varias configuraciones importantes
		- se puede elegir entre el driver "database" y "eloquent"
		- en el caso de eloquent se debe especificar el modelo con el cual se va a trabajar
			- para la version 5.2 de laravel esta por defecto el driver eloquent y su configuracion basicamente
		- en el caso de database se debe especificar la tabla con la cual se va a llevar a cabo la autenticacion
			- por defecto esta la tabla users
			
	- crear un controlador por linea de comantos
		php artisan make:controller LogController --resource
		// \app\Http\Controllers\LogController.php
	- crear un request por linea de comantos
		php artisan make:request LoginRequest
		// \app\Http\Requests\LoginRequest.php
		
	- crear la ruta hacia el controlador
		- archivo /app/Http/routes.php
		// direcciona a todos los metodos por defecto del controlador LogController para la autenticacion
		Route::resource('log','LogController');
		//
	
	- modificar la vista index.blade.php agregando o modificando el div.header-info con la ruta hacia el metodo store del controlador log
		//archivo
		...
		<div class="header-info">
			<h1>BIG HERO 6</h1>
			{!!Form::open(['route'=>'log.store', 'method'=>'POST'])!!}
				<div class="form-group">
					{!!Form::label('correo','Correo:')!!}	
					{!!Form::email('email',null,['class'=>'form-control', 'placeholder'=>'Ingresa tu correo'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('contrasena','Contraseña:')!!}	
					{!!Form::password('password',['class'=>'form-control', 'placeholder'=>'Ingresa tu contraseña'])!!}
				</div>
				{!!Form::submit('Iniciar',['class'=>'btn btn-primary'])!!}
			{!!Form::close()!!}
		</div>
		...
		//
	- habilitar el request LoginRequest, \app\Http\Requests\LoginRequest.php
		//
		...
		public function authorize()
		{
			return true;
		...
		//
	- modificar el controlador LogController
		- importar el request LoginRequest, los facade y librerias necesarias
			//
			...		
			use Auth;
			use Session;
			use Redirect;
			use Cinema\Http\Requests\LoginRequest;
			...
			//
		- modificar el metodo store
			//
			...
			public function store(LoginRequest $request)
			{
				//se utiliza el facade Auth y la propiedad attempt que recibe un array, 
				//donde se pregunta si el email es igual a los que se esta recibiendo, al igual que para el password
				//si es cierto entonces que redireccione a el panel de administracion
				// y sino, se envia un mensaje al usuario indicando que los datos son incorrectos y lo retorna a la raiz de la aplicacion
				if(Auth::attempt( ['email' => $request['email'] ], ['password' => $request['password'] ] ) ){
					return Redirect::to('admin');
				}else{
					Session::flash('message-error','Los Datos son incorrectos');
					return Redirect::to('/');
				}
			}
			...
			//
	- crear la sub-vista de alertas para los errores, /alerts/errors.blade.php
		//archivo
		<!-- si existe la variable message-error muestra el mensaje en un recuadro de alerta -->
		@if( Session::has('message-error') )
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  {{Session::get('message-error')}}
			</div>
		@endif
		//
	- hacer el include en la vista index.blade.php
		//
		...
		@section('content')
			@include('alerts.errors')
		...
		//
	- el facade Auth brinda una caracteristica que es la de user, con la cual se tiene acceso a la informacion del usuario
		- en el layout /layouts/admin.blade.php mostrar la informacion de usuario 
			//
			...
			<ul class="nav navbar-top-links navbar-right">
				 <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					{!!Auth::user()->name!!} <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
			...
			//
	
	- configurar el logout del usuario
		- crear una ruta al metodo logout del controlador LogController, /app/Http/routes.php
			//
			...
			Route::get('logout','LogController@logout');
			...
			//
		- crear el metodo logout en el controlador LogController, \app\Http\Controllers\LogController.php
			//
			...
			/**
			 * efectua el logout del usuario.
			 *
			 * @return redirecciona a la raiz
			 */
			public function logout()
			{
				//el metodo logout lo brinda el facade Auth
				Auth::logout();
				return Redirect::to('/');
			}
			...
			//
			
		- modificar el layout /layouts/admin.blade.php colocando la direccion hacia el logout en el submenu del nombre del usuario
			//
			...
			<li><a href="{!!URL::to('/logout')!!}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
			...
			//
	- crear las reglas del request LoginRequest, \app\Http\Requests\LoginRequest
		//
		...
		/**
		 * Get the validation rules that apply to the request.
		 * required|email se usa para especificar que se deba ingresar un email correcto
		 * @return array
		 */
		public function rules()
		{
			return [
				'email' => 'required|email',
				'password' => 'required',
			];
		}
		...
		//
	- importar el alert para los request en el index.blade.php
		//
		...
		@section('content')
			@include('alerts.errors')
			@include('alerts.request')
		...
		//
		
//middleware
	https://laravel.com/docs/5.2/middleware
	- un middleware nos provee de un mecanismo conveniente para filtrar las solicitudes http que entran a la aplicacion
	- por ejemplo laravel provee de un middleware que verifica que un usuario en la aplicacion este autenticado, sino lo esta, el middleware redirecciona a la pagina de login
	
	- modificar el controlador FrontController
		- crear un constructor para usar el middleware
			//
			...
			public function __construct()
			{
				//especificamos que vamos a usar el middleware auth, pero solo que aplique para el metodo admin
				$this->middleware('auth', ['only' => 'admin']);
			}
			...
			//
	
	- cambiar la ruta por defecto del middleware
		- modificar el archivo de middleware /app/Http/Middleware/Authenticate.php
			//se especifica la raiz como la ruta de login
			...
			return redirect()->guest('/');
			...
			//
	- modificar el controlador UsuarioController
		- crear un constructor para usar el middleware
			//
			...
			public function __construct()
			{
				//especificamos que vamos a usar el middleware auth en todo el controlador
				$this->middleware('auth');
				...
			}
			...
			//
			
	- crear un middleware propio, por linea de comandos
		php artisan make:middleware Admin
		// \app\Http\Middleware\Admin.php
		
	- registrar el middleware creado el el archivo \app\Http\Kernel.php
		//
		...
		protected $routeMiddleware = [
		'admin' => \Cinema\Http\Middleware\Admin::class,
		...
		//
	- se va a establecer que el usuario con el id=1 va a ser el que tenga todos los permisos 
	- modificar el middleware Admin /app/Http/Middleware/Admin.php
		- se utilizara una interfaz llamada Guard, hacer el llamado junto con la libreria Session		
			//
			...
			use Illuminate\Contracts\Auth\Guard;
			use Session;
			...
			//
		- crear una variable y un constructor para igualar las variables 
			//
			...
			protected $auth;
			//este constructor simplemente va a igualar las variables
			public function __construct(Guard $auth){
				$this->auth = $auth;
			}
			...
			//
		- modificar la funcion handle, agregar la validacion para el usuario con id 1
			//
			...
			public function handle($request, Closure $next)
			{
				if( $this->auth->user()->id != 1 ){
					Session::flash('message-error','Sin privilegios');
					return redirect()->to('admin');
				}
			...
			//
			
	- agregar el llamado al middleware admin en el controlador UsuarioController dentro del constructor y justo debajo del llamado al middleware auth
		//entonces si pasa el middleware de autenticacion tiene que pasar por el de admin
		...
		//especificamos que vamos a usar el middleware admin en todo el constructor
		$this->middleware('admin');
		...
		//
	
	- incluir el alert de los errores en la vista index del admin, /admin/index.blade.php
		//archivo
		@extends('layouts.admin')
			@section('content')
				@include('alerts.errors')
			@endsection
		//
		
	- modificar el layout /layouts/admin.blade.php 
		- agregar la condicional en el menu de usuario para que solo lo muestre si el usuario tiene el id == 1
			//
			...
			@if( Auth::user()->id == 1 )
				<li>
					<a href="#"><i class="fa fa-users fa-fw"></i> Usuario<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="{!!URL::to('/usuario/create')!!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
						</li>
						<li>
							<a href="{!!URL::to('/usuario')!!}"><i class='fa fa-list-ol fa-fw'></i> Usuarios</a>
						</li>
					</ul>
				</li>
			@endif
			...
			//
			
//Crear con AJAX
	- realizar peticiones para poder crear recursos mediante ajax 
	- estas peticiones requieren que el servidor de laravel este funcionando, es decir que no sea simplemente el xampp o IIS sino por medio del comando: php artisan serve
	- es necesario validar la accion del enter, debido a que segun las pruebas, solo funcionan las peticiones con el click al boton de envio
	- crear un controlador
		php artisan make:controller GeneroController --resource
	
	- crear la ruta hacia el controlador, routes.php
		Route::resource('genero','GeneroController');
		
	- modificar controlador	GeneroController, agregar direccion de la vista en el metodo create
		//
		...
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			return view('genero.create');
		}
		...
		//
		
	- modificar la vista /genero/create.blade.php
		//archivo
		@extends('layouts.admin')
			@section('content')
				@include('alerts.request')
				{!!Form::open()!!}
					<div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
						<strong> Genero Agregado Correctamente.</strong>
					</div>
					<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
						<strong id="msj"></strong>
					</div>
					<!--laravel genera y requiere un token para verificar que las peticiones ajax no son malintencionadas-->
					<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
					@include('genero.form.genero')
					{!!link_to('#', $title='Registrar', $attributes = ['id'=>'registro', 'class'=>'btn btn-primary'], $secure = null)!!}
				{!!Form::close()!!}
			@endsection
			
			<!--de esta manera se agregan los script de cada formulario cuando sea necesario y no desde el inicio, este js se cargara en la section del layout admin.blade.php que tiene el mismo nombre-->
			@section('script')
				{!!Html::script('js/script.js')!!}
			@endsection
		//
		
	- crear la carpeta y la vista /genero/form/genero.blade.php
		//archivo
		<div class="form-group">
			{!!Form::label('genre','Nombre:')!!}
			{!!Form::text('name',null,['id'=>'genre', 'class'=>'form-control','placeholder'=>'Ingresa el Nombre del Genero'])!!}
		</div>
		//
		
	- crear el archivo /public/js/script.js
		//archivo
		$("#registro").click(function(){
			var dato = $("#genre").val();
			var route = "/genero";
			//se almacena el token para enviarlo en el parametro headers dentro de ajax
			var token = $("#token").val();
			
			$.ajax({
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data:{genre: dato},

				success:function(){
					$("#msj-success").fadeIn();
				},
				error:function(msj){
					$("#msj").html(msj.responseJSON.genre);
					$("#msj-error").fadeIn();
				}
			});
		});
		//
		
	- modificar el controlador GeneroController
		- llamamos al modelo Genre
			//
			...
			//incorporamos el modelo
			use Cinema\Genre;
			...
			//
		- en el metodo store
			//
			public function store(Request $request)
			{
				//si el request es de tipo ajax entonces usa el modelo Genre para guardar todo lo que el request recibe y retorna un mensaje de tipo json
				if($request->ajax()){
					//crear el genero con el modelo Genre
					Genre::create($request->all());
					return response()->json([
						"mensaje" => "Creado"
					]);
				}
			}
			//
		
	- modificar el modelo Genre.php
		//
		...
		//selecciona los campos de la tabla que pueden ser llenados
		protected $fillable = ['genre'];
		...
		//
	- modificar el layout /layouts/admin.blade.php, agregar una section para el llamado a los script, en este caso: /js/script.js
		//
		...
		@section('scripts')
		
		@show
		...
		//
	- modificar el archivo /js/script.js , agregar la validacion del enter o submit en el formulario para evitar errores
		//
		...
		//de esta manera se asegura la accion al presionar el enter, debido a que no estaba funcionando bien y salian errores
		$("#registro").parent('form').keypress(function (e) {
		 var key = e.which;
		 if(key == 13)  // the enter key code
		  {
			$('#registro').click();
			return false;  
		  }
		}).submit(function (event) {
			$('#registro').click();
			event.preventDefault();
			return false;  
		});
		...
		//
		
//leer con AJAX
	- modificar el controlador GeneroController
		- funcion index() agregar el retorno de la vista /genero/index.blade.php
			//
			...
			return view('genero.index');
			...
			//
	- crear la vista /genero/index.blade.php
		//
		@extends('layouts.admin')
			@section('content')
				<table class="table">
					<thead>
						<th>Nombre</th>
						<th>Operaciones</th>
					</thead>
					<tbody id="datos">
						
					</tbody>
				</table>
				
			@endsection

			<!--de esta manera se agregan los script de cada formulario cuando sea necesario y no desde el inicio, este js se cargara en la section del layout admin.blade.php que tiene el mismo nombre-->
			@section('scripts')
				{!!Html::script('js/script2.js')!!}
			@endsection
		//
	- modificar el layout /layouts/admin.blade.php, agregar la section('scripts') para mostrar los script de cada formulario
		//
		@section('scripts')
		
		@show
		//
	- modificar el archivo /js/script.js
		//
		$(document).ready(function(){
			Carga();
		});

		function Carga(){
			var tablaDatos = $("#datos");
			var route = "/genero";

			$("#datos").empty();
			$.get(route, function(res){
				$(res).each(function(key,value){
					tablaDatos.append("<tr><td>"+value.genre+"</td><td><button class='btn btn-primary' >Editar</button><button class='btn btn-danger' >Eliminar</button></td></tr>");
				});
			});
		}
		...
		//
			
	- modificar el controlador GeneroController, modificar el metodo index
		//
		...
		//va a recibir una peticion tipo get mediante AJAX 
		public function index(Request $request)
		{
			//se va a encargar de listar todos los generos mediante json
			if ($request->ajax()) {
				$genres = Genre::all();
				return response()->json($genres);
			}
			return view('genero.index');
		}
		...
		//

//Actualizar y Eliminar con AJAX
	- se puede crear un costructor y un metodo llamado find() para reducir lineas de codigo, pero esto solo es posible hasta la version 5.1.* de laravel
		- modificar el controlador GeneroController
		// 
		...
		//beforeFilter admitido solo hasta version 5.1.* de laravel
		//el constructor y el metodo find reducen la busqueda de los datos del genero para cada accion ['edit','update','destroy']
		public function __construct(){
			$this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
		}
		public function find(Route $route){
			$this->genre = Genre::find($route->getParameter('genero'));
		}
		...
		//
	- modificar la vista /genero/index.blade.php
		- incluir sub-vista /genero/modal.blade.php y agregar el mensaje para la actualizacion exitosa
			//
			...
			@extends('layouts.admin')
				@section('content')
					@include('genero.modal')
					<div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
						<strong> Genero Actualizado Correctamente.</strong>
					</div>
			...
			//
	- crear el archivo o vista  /genero/modal.blade.php
		//esto nos lo suministra bootstrap para crear una ventana modal, en este caso tiene unos cambios
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Actualizar Genero</h4>
			  </div>
			  <div class="modal-body">
				<!--el imput que guarda el token que genera laravel para las peticiones ajax-->
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				<!--el imput que guarda el id correspondiente al genero-->
				<input type="hidden" id="id">
				<!--se incorpora un sub-vista para crear el genero-->
				@include('genero.form.genero')
			  </div>
			  <div class="modal-footer">
			  <!--link para actualizar el genero-->
			  {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'], $secure = null)!!}
			  </div>
			</div>
		  </div>
		</div>
		//
		
	- modificar el archivo /public/js/script2.js, agregar el id al boton Editar y Eliminar en la funcion Carga(), crear la funcion Mostrar(), Eliminar() y configurar el evento click() para el boton de Editar
		//
		...
		function Carga(){
			var tablaDatos = $("#datos");
			var route = "/genero";

			$("#datos").empty();
			//mediante get se obtiene la respuesta con todos los generos
			$.get(route, function(res){
				$(res).each(function(key,value){
					//inserta los datos recibidos con formato, en la opcion Editar y Eliminar se agregan los id para poder ejecutar dichas acciones
					tablaDatos.append("<tr><td>"+value.genre+"</td><td><button value="+value.id+" OnClick='Mostrar(this);' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>Editar</button><button class='btn btn-danger' value="+value.id+" OnClick='Eliminar(this);'>Eliminar</button></td></tr>");
				});
			});
		}

		//permite ver el genero que se quiere editar
		function Mostrar(btn){
			var route = "/genero/"+btn.value+"/edit";
			//asigna a los imput ocultos #genre y #id los valores recibidos, estos imput estan en la sub-vista modal.blade.php
			$.get(route, function(res){
				$("#genre").val(res.genre);
				$("#id").val(res.id);
			});
		}
		
		//se obtiene el id del genero del imput oculto de la ventana modal
		function Eliminar(btn){
			var route = "/genero/"+btn.value+"";
			var token = $("#token").val();
			
			//se envia la peticion mediante el metodo DELETE con el id del genero
			$.ajax({
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'DELETE',
				dataType: 'json',
				success: function(){
					Carga();
					$("#msj-success").fadeIn();
				}
			});
		}
		//se obtiene el id y el genre del genero de los imput ocultos de la ventana modal
		$("#actualizar").click(function(){
			var value = $("#id").val();
			var dato = $("#genre").val();
			var route = "/genero/"+value+"";
			var token = $("#token").val();
			
			//se envian los datos a la url /genero/[id] por el metodo PUT
			$.ajax({
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'PUT',
				dataType: 'json',
				data: {genre: dato},
				success: function(){
					Carga();
					$("#myModal").modal('toggle');
					$("#msj-success").fadeIn();
				}
			});
		});
		...
		//
		
	- modificar el controlador GeneroController
		- editar el metodo edit()
			//
			...
			public function edit($id)
			{
				$genre = Genre::find($id);
				return response()->json($genre);
				//solo hasta version 5.1.* de laravel, solo se requiere un linea gracias al constructor
				//return response()->json($this->genre);
			}
			...
			//
		- editar el metodo update()
			//
			...
			public function update(Request $request, $id)
			{
				//busca el genero por el id recibido
				$genre = Genre::find($id);
				//actualiza los datos del genero
				$genre->fill($request->all());
				//guarda los cambios
				$genre->save();
				
				//solo hasta version 5.1.* de laravel, se reduce a tres lineas gracias al constructor
				//$this->genre->fill($request->all());
				//$this->genre->save();
				return response()->json(["mensaje" => "listo"]);
			}
			...
			//
		- editar el metodo destroy()
			//
			...
			public function destroy($id)
			{
				//busca el genero por el id recibido
				$genre = Genre::find($id);
				//elimina los datos del genero
				$genre->delete();
				//solo hasta version 5.1.* de laravel, se reduce a dos lineas gracias al constructor
				//$this->genre->delete();
				return response()->json(["mensaje"=>"borrado"]);
			}
			...
			//
			
//Validaciones con AJAX
	- se puede crear una sub-vista con el formato para mostrar los errores del request de ajax para no tener los alert en la misma vista, por ejemplo: /resources/views/alerts/request_ajax.blade.php
	- crear un request GenreRequest por linea de comandos
		php artisan make:request GenreRequest
		
	- modificar el request GenreRequest
		- autorizar el uso del request
			//
			...
			public function authorize()
			{
				return true;
			}
			...
			//
		- colocar las reglas para los generos
			//
			...
			public function rules()
			{
				//especifica que minimo se ingresen tres caracteres
				return [
					'genre' => 'required|min:3'
				];
			}
			...
			//
	- modificar el controlador GeneroController
		- incorporar el request GenreRequest
			//
			...
			//incorporamos el request GenreRequest
			use Cinema\Http\Requests\GenreRequest;
			...
			//
		- incorporar el request GenreRequest en el metodo store
			//
			...
			public function store(GenreRequest $request)
			...
			//
		- incorporar el request GenreRequest en el metodo update
			//
			...
			public function update(GenreRequest $request, $id)
			...
			//
			
//Paginacion con AJAX
	- se debe obtener el id de la url que proporciona el link de la paginacion
	- crear el script3.js , /public/js/script3.js
		//
		$(document).on('click','.pagination a',function(e){
			//prevenir que ese evento desencadene algo
			e.preventDefault();
			//capturar el atributo href y la divide, mostrando lo que esta despues de la cadena 'page='
			var page = $(this).attr('href').split('page=')[1];
			var route = "/usuario";
			$.ajax({
				url: route,
				data: {page: page},
				type: 'GET',
				dataType: 'json',
				success: function(data){
					$(".users").html(data);
				}
			});
		});
		//
	
	- modificar la vista /usuario/index.blade.php
		- crear un nuevo div.users y meter la tabla.table
			//
			...
			<div class="users">
				<table class="table">
					<thead>
						<th>Nombre</th>
						<th>Correo</th>
						<th>Operaciones</th>
					</thead>
					<!-- recorre los datos de la variable recibida y muestra el name y email de la tabla users-->
					@foreach($users as $user)
					<tbody>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>
							{!!link_to_route('usuario.edit', $title = 'Editar', $parameters = $user, $attributes = ['class'=>'btn btn-primary'] )!!}
						</td>
					</tbody>
					@endforeach
				</table>

				{!! $users->links() !!}
			</div>
			...
			//
		- agregar la section('scripts') para incluir el script3.js
			//
			...
			@section('scripts')
				{!!Html::script('js/script3.js')!!}
			@endsection
			...
			//
	- crear una sub-vista /usuario/users.blade.php, colocar la tabla que esta en el index.blade.php para despues llamarla con los datos de la repuesta de paginacion por ajax
		//
		<table class="table">
			<thead>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Operaciones</th>
			</thead>
			<!-- recorre los datos de la variable recibida y muestra el name y email de la tabla users-->
			@foreach($users as $user)
			<tbody>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>
					{!!link_to_route('usuario.edit', $title = 'Editar', $parameters = $user, $attributes = ['class'=>'btn btn-primary'] )!!}
				</td>
			</tbody>
			@endforeach
		</table>

		{!! $users->links() !!}
		//
	- modificar el controlador UsuarioController, editar el metodo index() para que valide y responda a una peticion ajax()
		//
		...
		public function index(Request $request)
		{
			// trae una cantidad limitada de elementos que tenga la tabla users y los almacena en la variable $users
			$users = User::paginate(15);
			//valida si existe una peticion de tipo ajax() y devuelve una respuesta de tipo json con la vista usuario.users
			if($request->ajax()){
				return response()->json(view('usuario.users',compact('users'))->render());
			}
			// retorna la vista /usuario/index.blade.php agregandole los datos de la variable users
			return view('usuario.index', compact('users'));
		}
		...
		//

//Subir Archivos
	- se usara un mutador para modificar los elementos antes de guardarlos, se llama carbon
		http://carbon.nesbot.com/
		- agregar la instruccion, en la opcion "require", al archivo composer.json para obtener los repositorios de Carbon
			//
			"require": {
				...
				"nesbot/carbon": "~1.18"
				...
			//
		- por linea de comandos ejecutar la instruccion para actualizar o instalar los repositorios de composer
			composer update
	- crear la vista /pelicula/create.blade.php
		//
		@extends('layouts.admin')
			@section('content')
				@include('alerts.request')
					<!--la propiedad 'files' => true es la que permite enviar archivos -->
					{!!Form::open(['route'=>'pelicula.store', 'method'=>'POST','files' => true])!!}
						@include('pelicula.forms.pelicula')
						{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
					{!!Form::close()!!}
			@endsection
		//
	- crear la sub-vista /pelicula/forms/pelicula.blade.php
		//en esta sub-vista se usa la variable $genres la cual contiene la lista de generos
		//
		<div class="form-group"> 
			{!!Form::label('nombre','Nombre:')!!}
			{!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre de la pelicula'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Elenco','Elenco:')!!}
			{!!Form::text('cast',null,['class'=>'form-control', 'placeholder'=>'Ingresa el elenco'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Direccion','Dirección:')!!}
			{!!Form::text('direction',null,['class'=>'form-control', 'placeholder'=>'Ingresa al director'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Duracion','Duración:')!!}
			{!!Form::text('duration',null,['class'=>'form-control', 'placeholder'=>'Ingresa la duración'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Poster','Poster:')!!}
			{!!Form::file('path')!!}
		</div>
		<div class="form-group">
			{!!Form::label('Genero','Genero:')!!}
			{!! Form::select('genre_id', $genres, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una clase' ])!!}
		</div>
		//
	- modificar el controlador MovieController
		- incluir los modelos Genre y Movie
			//
			...
			//incluir los modelos Genre y Movie
			use Cinema\Genre;
			use Cinema\Movie;
			...
			//
		- modificar el metodo create
			//
			...
			public function create()
			{
				//se lista el genero y el id correspondiente a todos los generos
				$genres = Genre::lists('genre', 'id');
				return view('pelicula.create',compact('genres'));
			}
			...
			//
		- modificar el metodo store
			//
			...
			public function store(Request $request)
			{
				Movie::create($request->all());
				return "Listo";
			}
			...
			//
	- en el archivo /config/filesystems.php esta la configuracion del almacenamiento de los archivos
		// por defecto laravel va a almacenar todos los archivos de manera local
		...
		'default' => 'local',
		...
		//
		- la configuracion predeterminada de 'local' esta para que almacene los archivos en la carpeta /storage/app/
			//
			...
			'local' => [
				'driver' => 'local',
				'root' => storage_path('app'),
			],
			...
			//
		- en este caso la configuracion de 'local' se modificara para que almacene los archivos en la carpeta /public/movies/
			//
			...
			'local' => [
				'driver' => 'local',
				'root' => public_path('movies'),
			],
			...
			//
	- modificar el modelo Movie.php
		- agregar los campos que se pueden llenar
			// esto es algo que se deberia hacer siempre que se cree un modelo nuevo
			...
			protected $fillable = ['name','path','cast','direction','duration','genre_id'];
			...
			//
		- crear el mutador usando carbon
			//
			...
			// se crea un mutador, el cual sirve para modificar los elementos antes de ser guardados con set[]Attribute
			// se especifica la fecha actual ::now()->second, el segundo con el que es subido concatenado al nombre del archivo
			// subir el archivo \Storage... con el metodo put
			public function setPathAttribute($path){
				$name = Carbon::now()->second.$path->getClientOriginalName();
				$this->attributes['path'] = $name;
				\Storage::disk('local')->put($name, \File::get($path));
			}
			...
			//
	
//Leer Archivos
	- modificar el modelo Movie.php
		- agregar la libreria del query builder
			//
			...
			//usar la libreria del query builder
			use DB;
			...
			//
		- agregar el metodo Movies
			//
			...
			// metodo para colsultar con el query builder
			// se crea un join entre la tabla genres y movies por el campo genre_id
			// se selecciona todo * de la tabla movies y solo el genre de la tabla genres
			// para finalizar se obtiene la consulta
			public static function Movies(){
				return DB::table('movies')
					->join('genres','genres.id','=','movies.genre_id')
					->select('movies.*', 'genres.genre')
					->get();
			}
			...
			//
	- modificar el controlador MovieController
		- modificar el metodo index()
			//
			...
			/**
			 * Display a listing of the resource.
			 *
			 * @return \Illuminate\Http\Response
			 * almacena la consulta al metodo Movies del modelo Movie y retorna la vista pelicula.index con los resultados
			 */
			public function index()
			{
				$movies = Movie::Movies();
				return view('pelicula.index',compact('movies'));
			}
			...
			//
	- crear la vista /pelicula/index.blade.php
		//
		@extends('layouts.admin')
			@include('alerts.success')
			@section('content')
				<table class="table">
					<thead>
						<th>Nombre</th>
						<th>Genero</th>
						<th>Direccion</th>
						<th>Caratula</th>
						<th>Operaciones</th>
					</thead>
					@foreach($movies as $movie)
						<tbody>
							<td>{{$movie->name}}</td>
							<td>{{$movie->genre}}</td>
							<td>{{$movie->direction}}</td>
							<td>
								<img src="movies/{{$movie->path}}" alt="" style="width:100px;"/>
							</td>
							<td>Editar</td>
						</tbody>
					@endforeach
				</table>
			@endsection
		//
	- editar la seccion de los Reviews
		- modificar el controlador FrontController
			- agregar el modelo Movie;
				//
				...
				//incorporar el modelo Movie
				use Cinema\Movie;
				...
				//
			- modificar el metodo reviews;
				//
				...
				public function reviews(){
					//almacena los datos del metodo Movies del modelo Movie y retorna la vista enviando la variable movies
					$movies = Movie::Movies();
					return view('reviews',compact('movies'));
				}
				...
				//
		- modificar la vista reviews.blade.php, el contenido del div.review se modifica y se coloca dentro de un foreach para que recorra todos los datos de la variable $movies 
			//
			...
			@foreach($movies as $movie)
				<div class="review">
					<div class="movie-pic">
						<img src="movies/{{$movie->path}}" alt="" /></a>
					</div>
					<div class="review-info">
						<a class="span" href="single.html">
							<i>{{$movie->name}}</i>
						</a>
						<p class="info">CAST:&nbsp;&nbsp;{{$movie->cast}}</p>
						<p class="info">DIRECTION:&nbsp;&nbsp;{{$movie->direction}}</p>
						<p class="info">GENRE:&nbsp;&nbsp;{{$movie->genre}}</p>
						<p class="info">DURATION:&nbsp;&nbsp;{{$movie->duration}}</p>
					</div>
					<div class="clearfix"></div>
				</div>
			@endforeach
			...
			//

//Actualizar Archivos
	- modificar la vista /pelicula/index.blade.php, agregar el boton de editar donde estaba la palabra 'Editar' el cual mostrara la vista edit.blade.php
		//
		...
		<td>
			{!!link_to_route('pelicula.edit', $title = 'Editar', $parameters = $movie->id, $attributes = ['class'=>'btn btn-primary'])!!}
		</td>
		...
		//
	- crear la vista /pelicula/edit.blade.php, 
		// en esta vista estan las opciones de editar con el atributo 'files' => true y tambien la opcion de eliminar la pelicula
		//
		...
		@extends('layouts.admin')
			@section('content')
				@include('alerts.request')
				
				{!!Form::model($movie,['route'=> ['pelicula.update',$movie->id],'method'=>'PUT','files' => true])!!}
					@include('pelicula.forms.pelicula')
					{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
				{!!Form::close()!!}

				{!!Form::open(['route'=> ['pelicula.destroy',$movie->id],'method'=>'DELETE'])!!}
					{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
				{!!Form::close()!!}
			@endsection
		...
		//
	- modificar el controlador MovieController
		- agregar las librerias necesarias
			//
			...
			//agregar las librerias requeridas para manejar la session, el redirect y los datos en la ruta
			use Session;
			use Redirect;
			use Illuminate\Routing\Route;
			...
			//
		- crear los metodos __construct y find (en el caso de tener la version 5.1.* de laravel) 
			//
			...
			public function __construct(){
				$this->middleware('auth');
				$this->middleware('admin');
				//adminitido hasta la version 5.1.* de laravel
				//$this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
			}
			public function find(Route $route){
				//adminitido hasta la version 5.1.* de laravel
				//$this->movie = Movie::find($route->getParameter('pelicula'));
			}
			...
			//
		- modificar el metodo store
			//
			...
			public function store(Request $request)
			{
				Movie::create($request->all());
				Session::flash('message','Pelicula Creada Correctamente');
				return Redirect::to('/pelicula');
				//return "Listo";
			}
			...
			//
		- modificar el metodo edit
			//
			...
			public function edit($id)
			{
				$movie = Movie::find($id);
				$genres = Genre::lists('genre', 'id');
				return view('pelicula.edit',['movie'=>$movie,'genres'=>$genres]);
				//admitido hasta la version 5.1.* de laravel
				//return view('pelicula.edit',['movie'=>$this->movie,'genres'=>$genres]);
			}
			...
			//
		- modificar el metodo update
			//
			...
			public function update(Request $request, $id)
			{
				$movie = Movie::find($id);
				$movie->fill($request->all());
				$movie->save();
				Session::flash('message','Pelicula Editada Correctamente');
				return Redirect::to('/pelicula');
			}
			...
			//
		- modificar el metodo destroy
			//
			...
			public function destroy($id)
			{
				$movie = Movie::find($id);
				$movie->delete();
				//elimina el archivo fisico 
				\Storage::delete($movie->path);
				Session::flash('message','Pelicula Eliminada Correctamente');
				return Redirect::to('/pelicula');
			}
			...
			//
	- modificar el modelo Movie.php, colocar todo el contenido del metodo setPathAttribute dentro de la validacion del path que no este vacio
		//
		...
		// todo esto dentro de la validacion del path, verificando que no este vacio
		public function setPathAttribute($path){
			if(! empty($path)){
				$name = Carbon::now()->second.$path->getClientOriginalName();
				$this->attributes['path'] = $name;
				\Storage::disk('local')->put($name, \File::get($path));
			}
		}
		...
		// 

//Enviar Correo
	https://laravel.com/docs/5.2/mail
	- laravel provee de algunos drivers, como son Mailgun, Mandrill, SparkPost o SES pero requieren de una cuenta en cada uno de ellos
	- se va a usar la cuenta de gmail para enviar los correos
	- configurar el email:
		- archivo /config/mail.php
			//
			...
			//se deja con smtp
			'driver' => env('MAIL_DRIVER', 'smtp'),
			...
			//
			// se asigna para trabajar con gmail.com
			...
			'host' => env('MAIL_HOST', 'smtp.gmail.com'),
			...
			//
			//el puerto debe ser el 465
			...
			'port' => env('MAIL_PORT', 465),
			...
			//
			//se especifica la direccion de correo y el nombre
			...
			'from' => ['address' => 'pepito_perez@gmail.com', 'name' => 'Pepito Perez'],
			...
			//
			//se especifica como se va a encriptar, sera con ssl
			...
			'encryption' => env('MAIL_ENCRYPTION', 'ssl'),
			...
			//

		- archivo enviroment, .env
			//
			...
			//se colocan las credenciales correctas
			MAIL_DRIVER=smtp
			MAIL_HOST=smtp.gmail.com
			MAIL_PORT=465
			MAIL_USERNAME=pepito_perez@gmail.com
			MAIL_PASSWORD='password123'
			MAIL_ENCRYPTION=ssl
			...
			//
			
	- crear un controlador para el mail
		php artisan make:controller MailController --resource
		
	- enrutar el controlador creado, routes.php
		//
		...
		// direcciona a todos los metodos por defecto del controlador MailController
		Route::resource('mail','MailController');
		...
		//
			
	- modificar la vista: vista /contacto.blade.php 
		- incluir los mensajes de alerta
			//
			...
			@include('alerts.success')
			...
			//
		- modificar el formulario de contacto
			//
			...
			<div class="contact-form">
				{!!Form::open(['route'=>'mail.store','method'=>'POST'])!!}
					<div class="col-md-6 contact-left">
						{!!Form::text('name',null,['placeholder' => 'Nombre'])!!}
						{!!Form::text('email',null,['placeholder' => 'Email'])!!}
					</div>
					<div class="col-md-6 contact-right">
						{!!Form::textarea('mensaje',null,['placeholder' => 'Mensaje'])!!}
					</div>
					{!!Form::submit('SEND')!!}
				 {!!Form::close()!!}
			 </div>
			...
			//	
		
	- modificar el controlador MailController
		- agregar librerias
			//
			...
			//se incluyen para manejar el proceso de envio de correo
			use Mail;
			use Session;
			use Redirect;
			...
			//
		- metodo store
			//
			...
			public function store(Request $request)
			{
				//se especifica un vista, emails.contact, y la informacion que se va a enviar
				Mail::send('emails.contact',$request->all(), function($msj){
					//se coloca el asunto
					$msj->subject('Correo de Contacto');
					//el correo de destino
					$msj->to('pepito_perez@gmail.com');
				});
				Session::flash('message','Mensahe enviado correctamente');
				return Redirect::to('contacto');
			}
			...
			//
	- crear la vista /emails/contact.blade.php   , se reciben los datos enviados por el formuario de contacto a traves del controlador MailController
		//archivo
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Document</title>
			</head>
			<body>
				<p><stron>Nombre: </stron>{!!$name!!}</p>
				<p><stron>Correo: </stron>{!!$email!!}</p>
				<p><stron>Mensaje: </stron>{!!$mensaje!!}</p>
			</body>
		</html>
		//
		
	- al probar el funcionamiento saldran errores debido a que:
		- hay que reiniciar la aplicacion
		- la cuenta de correo de gmail no esta configurada para que permita el envio de correos de esta manera
			- llegara un correo notificando que hay un inicio de sesion en otra aplicacion y se ha evitado dicho inicio
			- en el correo hay un link de 'mas informacion' este lo llevara a una pagina que informa sobre permitir que aplicaciones menos seguras accedan a tu cuenta
				https://support.google.com/accounts/answer/6010255
			- en la pagina de informacion ir al enlace: Ve a la sección "Aplicaciones menos seguras" en Mi cuenta.
				https://www.google.com/settings/security/lesssecureapps
			- activar Acceso de aplicaciones menos seguras 
			- si todo se ha hecho correctamente el formulario ya debe de funcionar
		
//Restablecer password
	- se puede llevar a cabo esta tarea gracias al modulo de autenticacion que provee laravel
	- se requiere que la aplicacion ya tenga configurada la opcion de enviar correos
	- se debe generar una migracion predeterminada de laravel(en el caso de que ya no este hecha) 
		- en la migracion se crea la tabla password_resets la cual tiene los campos email y token que se usaran para el restablecimiento de la contraseña
		- normalmente esta migracion se lleva a cabo automaticamente al ingresar el comando:
			php artisan migrate
		- en el caso de que no suceda el archivo se llama '[fecha]_create_password_resets_table.php' el cual esta en /database/migrations/
	
	- crear las rutas hacia los controladores para restablecer los password
		//archivo routes.php
		...
		//esto sirve para que se muestre una vista para poder especificar que cuenta de correo se va a asignar para restablecer el password
		Route::get('password/email','Auth\PasswordController@getEmail');
		Route::post('password/email','Auth\PasswordController@postEmail');
		...
		//
		
	- modificar la vista index.blade.php
		// se coloca un enlace a la ruta configurada para restablecer la contraseña, justo debajo del formulario de inicio de sesion
		...
		{!!link_to('password/email', $title = 'Olvidaste tu contraseña?', $attributes = null, $secure = null)!!}
		...
		//
		
	- crear la vista /auth/password.blade.php , esta vista se crea para asignar el correo de restablecimiento
		// se puede copiar y modificar el contenido de la vista contaco
		@extends('layouts.principal')
			@section('content')
			@include('alerts.success')
				<div class="contact-content">
					<div class="top-header span_top">
						<div class="logo">
							<a href="/"><img src="images/logo.png" alt="" /></a>
							<p>Movie Theater</p>
						</div>
					<div class="clearfix"></div>
					</div>

					<div class="main-contact">
						 <h3 class="head">CONTACT</h3>
						 <p>WE'RE ALWAYS HERE TO HELP YOU'</p>
						 <div class="contact-form">
							 {!!Form::open(['url' => '/password/email'])!!}
								<div class="col-md-6 contact-left">
									
									{!!Form::text('email')!!}
								</div>
								
								{!!Form::submit('Enviar link')!!}
							 {!!Form::close()!!}
						</div>
					</div>
				</div>
			@endsection
		//

	- en el caso de tener la version 5.2 de laravel remitirse a la documentacion 
		https://laravel.com/docs/5.2/authentication#resetting-passwords
		- en la documentacion mencionan de la migracion y usar el comando:
			php artisan make:auth
		- el comando crea las vistas requeridas y funcionando correctamente
		- sin embargo el metodo actual funciona correctamente, recuerden cerrar la sesion o hacer logout antes de probar los resultados
	- en el caso de que el formulario se muestre sin estilos es necesario modificar el layout /layouts/principal.blade.php colocando un / al inicio de la url de cada llamado de js o css 
	
	- probar el formulario creado ingresar a la plagina y dar click en el enlace de 'Olvidaste tu contraseña?'
		- escribir un email y enviarlo, segun sea el mensaje de error se determina que vista hace falta por crear
		- puede ser /auth/emails/password.blade.php o /emails/password.blade.php
	- crear la vista 
		 /auth/emails/password.blade.php
		//
		Sigue el link para resetear tu password {{ url('password/reset/'.$token)}}
		//
	
	- hay que tener en cuenta para las pruebas que solo los correos de los usuarios registrados en la aplicacion seran validos
	
	- agregar las rutas para recibir la confirmacion desde el email
		//
		...
		//de esta manera se recibe la confirmacion del reset del password desde el correo enviado al email del usuario
		//laravel redirecciona a la vista /auth/reset.blade.php
		Route::get('password/reset/{token}','Auth\PasswordController@getReset');
		Route::post('password/reset','Auth\PasswordController@postReset');
		...
		//
		
	- crear la vista /auth/reset.blade.php
		//es una copia de la vista contacto, modificando el formulario y los campos, los cuales son tipicos para este tipo de acciones
		@extends('layouts.principal')
			@section('content')
			@include('alerts.success')
				<div class="contact-content">
					<div class="top-header span_top">
						<div class="logo">
							<a href="index.html"><img src="/images/logo.png" alt="" /></a>
							<p>Movie Theater</p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="main-contact">
					 <h3 class="head">CONTACT</h3>
					 <p>WE`RE ALWAYS HERE TO HELP YOU</p>
					 <div class="contact-form">
						 {!!Form::open(['url' => '/password/reset'])!!}
							<div class="col-md-6 contact-left">
								{!!Form::hidden('token',$token,null)!!}

								{!!Form::text('email',null,['value' => "{{old('email')}}",'placeholder' => 'Email'] )!!}
								
								{!! Form::password('password', array('placeholder'=>'Contraseña') ) !!}
								{!! Form::password('password_confirmation',['placeholder' => 'Confirmar Contraseña']) !!}
							</div>
							
							{!!Form::submit('Restablecer contraseña')!!}
						 {!!Form::close()!!}
					</div>
				</div>
			@endsection
		//
		
	- modificar el controlador /auth/PasswordController.php
		- agregar los trait requeridos (version 5.2 de laravel)
			//
			...
			//es requerido para el metodo resetPassword, en el caso de usar la version 5.2 de laravel
			use Illuminate\Support\Str;
			use Illuminate\Support\Facades\Auth;
			...
			//
		- colocar el redireccionamiento de la aplicacion y copiar el metodo resetPassword del trait ResetsPasswords
			//
			...
			//por defecto la configuracion de laravel y el reset password hace que se redireccione a la url /home pero como no lo tenemos asi entonces se debe especificar a cual
			//el otro problema es que el la aplicacion se configuro para que encriptara el password y los procesos de laravel para el reset password lo encriptan tambien, entonces hay que crear el metodo por si mismo para que no lo encripte dos veces
			// lo mencionado anteriormente se puede comprobar en los archivos de configuracion de auth y especificamente en el que usa el controlador PasswordController, el trait ResetsPasswords
			// el archivo esta en: \vendor\laravel\framework\src\Illuminate\Foundation\Auth\ResetsPasswords.php
			// entonces se copia la funcion resetPassword al controlador y se quita la instruccion de la encripcion
			protected $redirectTo = '/admin';
			
			/*en la version 5.1 de laravel la funcion esta de esta manera
			protected function resetPassword($user, $password){
				$user->password = $password;
				$user->save();
				Auth::login($user);
			}
			*/
			//asi esta la funcion en la version 5.2
			protected function resetPassword($user, $password)
			{
				$user->forceFill([
					'password' => $password,
					'remember_token' => Str::random(60),
				])->save();

				Auth::guard($this->getGuard())->login($user);
			}
			...
			//
	
	- segun la configuracion del trait ResetsPasswords los password deben ser de minimo 6 caracteres de longitud
	
//Deployment
	- preparar la aplicacion para el despliegue
	- verificar las urls de los archivos, dejarlas sin el prefijo http://localhost:8000
	- se crearan seeders (sembradores), que su funcionalidad basicamente es la de insertar registros que la aplicacion va a necesitar de manera predeterminada o llenar la aplicacion de datos de prueba
		https://laravel.com/docs/5.1/seeding
		- los seeder estan almacenados en /database/seeds/ 
			- se pueden ejecutar por linea de comando, segun lo requerido:
				php artisan db:seed
				php artisan db:seed --class=UserTableSeeder
				php artisan migrate:refresh --seed
				
			- el comando php artisan db:seed ejecuta todos los seeder creados a los que se hizo el llamado en el metodo up() del seed DatabaseSeed.php
				//
				public function run()
{
					Model::unguard();

					$this->call(UsersTableSeeder::class);
					$this->call(PostsTableSeeder::class);
					$this->call(CommentsTableSeeder::class);

					Model::reguard();
				}
				//
				
	- crear un seeder llamado UserTableSeeder
		php artisan make:seeder UserTableSeeder
		
	- modificar el seeder creado, UserTableSeeder
		- archivo /database/seeds/UserTableSeeder.php
			//
			...
			/**
			 * Run the database seeds.
			 *
			 * @return void
			 */
			public function run()
			{
				// php artisan db:seed --class=UserTableSeeder
				
				DB::table('users')->insert([
					'name' => 'Raul Palacios',
					'email' => 'palacios.rauls02@gmail.com',
					'password' => bcrypt('qwerty'),
				]);
			}
			...
			//
		
	- modificar el seeder DatabaseSeed
		- archivo /database/seeds/DatabaseSeed.php
			//
			...
			/**
			 * Run the database seeds.
			 *
			 * @return void
			 */
			public function run()
			{
				// php artisan db:seed
				
				//en el caso de la version 5.2 de laravel las lineas Model::unguard(); y Model::reguard(); no son requeridas
				Model::unguard();

				$this->call(UsersTableSeeder::class);

				Model::reguard();
			}
			...
			//
			
	- para hacer el despliegue se puede usar una maquina virtual de MicrosoftAzure
		
	- datos de configuracion mostrados en el curso de video tutorial
		user/pass: Admin2015
		url: CinemaXXII.cloudapp.net
		
		- conexion por ssh
			ssh Admin2015@104.44.140.85
				password Admin2015
			
		- actualizar el servidor
			sudo apt-get update
			
		- instalar el servidor apache
			sudo apt-get install apache2
				yes
				
		- instalar mysql con librerias adicionales
			sudo apt-get install mysql-server libapache2-mod-auth-mysql php5-mysql
			
		- instalar php5 y la libreria mcrypt
			sudo apt-get install php5 libapache2-mod-php5 php5-mcrypt
				yes
			
		- instalar la extension curl
			sudo apt-get install php5-curl
			
		- mediante curl instalar composer
			curl -sS http://getcomposer.org/installer | php
			
		- hacer el composer global, moverlo
			sudo mv composer.phar /usr/local/bin/composer
			
		- prueba de la instalacion de apache, crear el archivo info.php
			cd /var/www/html/
			sudo nano info.php
				<?php
					phpinfo.php
				?>
			//guardar los cambios
		
		- ir a la url del archivo creado (http://cinemaxxii.cloudapp.net/phpinfo.php) 
			- se debera ver la informacion de php
		
		- activar el modo de sobreescritura del apache, para no tener problemas con en enrutado
			cd /home/Admin2015/
			sudo a2enmod rewrite
			sudo service apache2 restart
				password: Admin2015
				
		- instalar unzip para desempaquetar el proyecto que sera subido en formato .zip
			sudo apt-get install unzip
		
		- enviar el proyecto comprimido en zip desde el equipo local hacia el servidor por medio de scp
			- scp es un sistema seguro de transferencia de archivos que usa el protocolo ssh
				scp laravel.zip Admin2015@104.44.140.85:/home/Admin2015
					password: Admin2015
					
		- mover el archivo subido a la carpeta del apache
			sudo mv laravel.zip /var/www/html/
			
		- descormprimir el archivo
			cd /var/www/html/
			sudo unzip laravel.php
			
		- dar permisos a la aplicacion
			sudo chmod -R 755 laravel
			sudo chmod -R 755 laravel/storage
			sudo chmod -R 755 laravel/public/movies/
			
		- configurar el apache
			sudo nano /etc/apache2/sites-enabled/000-default.conf
			
			- en el archivo buscar la linea: DocumentRoot /var/www/html
			- reeplazarla por lo siguiente:
				//
				DocumentRoot /var/www/html/laravel/public
				<Directory /var/www/html/laravel/public >
					AllowOverrite All
					RewriteEngine on
					RewriteBase /var/www/html/laravel/public
				</Directory>
				//
				//guardar los cambios
				
		- reiniciar el servidor apache
			sudo service apache2 restart
			
		- al ingresar a la url de la aplicacion deberia estar funcionando correctamente
		
		- generar una clave para la aplicacion, en la raiz de la aplicacion ejecutar el comando
			php artisan key:generate
		- si muestra un error de permisos entonces situarse en el directorio /var/www/html y darle todos los premisos
			sudo chmod -R 777 laravel
				
			- generar una clave para la aplicacion, en la raiz de la aplicacion ejecutar el comando
				php artisan key:generate
				
		- realizar las migraciones
			php artisan migrate
			
		- realizar la insercion de los datos
			php artisan db:seed
			
		- ingresar a la aplicacion y realizar el login para comprobar que todo esta correcto
		
		- optimizar el proyecto, esto ayuda bastante para las aplicaciones que van lento
			php artisan optimize
			
//seguridad
	- laravel provee de componentes que hacen a una aplicacion segura
	- laravel incorpora elementos en el core para hacer a una aplicacion segura
	- componentes
		form request: ayuda a validar la informacion que es enviada por el usuario, colocar reglas y restricciones
		uso de middleware: permite filtrar a un usuario dependiendo de sus permisos
	- componentes en el core:
		- gracias a que laravel incorpora un ORM ya no se necesita preocuparse por la inyecciones sql (SQL Injection), gracias a que el ORM esta basado en una capa de objetos y no puede interpretar el lenguaje sql
		- laravel incorpora un sistema de tokens los cuales mitigan el problema de los sitios cruzados 
			- por ejemplo si vamos a un formulario de la aplicacion e inspeccionamos los elementos html veremos que el formulario tiene un campo oculto llamado _token el cual tiene una clave que viene siendo una credencial del formulario ante la aplicacion, esto evita que exista algun tipo de falsificacion
		- proteccion frente al Cross-site scripting, evita la insercion de javascript
			//esta instruccion esta 'escapando' el valor del dato es decir que no es interpretada
			<td>{{$user->name}}</td>
			//
			//en cambio esta instruccion esta permitiendo la interpretacion del valor del dato es decir que si el valor tiene instrucciones html o javascript seran interpretadas por la aplicacion
			<td>{!!$user->name!!}</td>
			//
		- para usuarios maliciosos 
			- por ejemplo que aprovechan cosas como que en la url se vea el id del recurso que se esta editando http://localhost:8000/usuario/1/edit y que decidan estar cambiando ese numero 'a ver que pasa', hay una forma de manejarlo
			- el los metodos de los controladores despues de buscar el elemento se agrega una validacion de que si no existe se ejecute un abort(404)
				//
				...
				$movie = Movie::find($id);
				if(! $movie ){
					abort(404);
				}
				...
				//
				- en el caso de la version 5.1 de laravel, en el metodo find() se coloca dicha instruccion
				//
				...
				public function find(Route $route){
					//adminitido hasta la version 5.1.* de laravel
					$this->movie = Movie::find($route->getParameter('pelicula'));
					if(! $this->movie ){
						abort(404);
					}
				}
				...
				//
			- se crear una vista 404.blade.php en /errors/ en donde ya existe una vista 503.blade.php la cual se puede copiar y modificar
				//
				<!DOCTYPE html>
					<html>
						<head>
							<title>Objeto no localizado.</title>

							<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

							<style>
								html, body {
									height: 100%;
								}

								body {
									margin: 0;
									padding: 0;
									width: 100%;
									color: #B0BEC5;
									display: table;
									font-weight: 100;
									font-family: 'Lato';
								}

								.container {
									text-align: center;
									display: table-cell;
									vertical-align: middle;
								}

								.content {
									text-align: center;
									display: inline-block;
								}

								.title {
									font-size: 72px;
									margin-bottom: 40px;
								}
							</style>
						</head>
						<body>
							<div class="container">
								<div class="content">
									<div class="title">Objeto no localizado.</div>
								</div>
							</div>
						</body>
					</html>
				//
			- para no estar colocando las mismas lineas de codigo para el 404 en todos los controladores se puede crear un metodo en el controlador padre Controller.php
				//
				...
				//este metodo se usara para mostrar una pagina 404 en el caso de no encontrar el recurso
				//el parametro $value es la variable que almacena el resultado de la consulta
				public function notFound($value){
					if(! $value ){
						abort(404);
					}
				}
				...
				//
				
				- luego las instrucciones que se colocaran en las busquedas seran mas simples
					//
					...
					$this->notFound($movie);
					...
					//
				- en el caso de la version 5.1 de laravel seria:
					//
					...
					$this->notFound($this->movie);
					...
					//
					
//Selects Dinamicos
	- se crearan nuevos modelos los cuales se usaran para el ejercicio, es un tipico caso de pais - departamento - ciudad o estado - municipio
	
	- crear los modelos State y Town
		php artisan make:model State -m 
		php artisan make:model Town -m 
		
	- modificar el archivo de migracion del modelo State, [fecha]_create_states_table.php
		//agregar el campo name
		...
		$table->string('name');
		...
		//
		
	- modificar el archivo de migracion del modelo Town, [fecha]_create_towns_table.php
		//agregar el campo name y la llave foranea hacia la tabla states
		...
		$table->string('name');
		$table->integer('state_id')->unsigned();
		$table->foreign('state_id')->references('id')->on('states');
		...
		//
		
	- correr las migraciones
		php artisan migrate

	- modificar el modelo State, agregar la variable de la tabla y los campos fillables
		//
		...
		protected $table = 'states';
	
		protected $fillable = ['name'];
		...
		//

	- modificar el modelo Town, agregar la variable de la tabla y los campos fillables
		//
		...
		protected $table = 'towns';
	
		protected $fillable = ['name','state_id'];
		...
		//
		
	- crear el layout /layouts/master.blade.php 
		//
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<title>Document</title>
			</head>
			<body>
				@yield('content')
				
				{!!Html::script('/js/jquery.min.js')!!}
				{!!Html::script('/js/dropdown.js')!!}
			</body>
		</html>
		//
	
	- hacer uso de laravelcollective, instalarlo
		https://laravelcollective.com/docs/5.2/html
		
	- crear una vista /state/index.blade.php
		//
		@extends('layouts.master')
			@section('content')
				{!!Form::select('state',$states, null,['id' => 'state']) !!}
				{!!Form::select('town',['placeholder' => 'Seleccione un municipio'], null, ['id' => 'town'])!!}
			@endsection	
		//
		
	- crear el controlador StateController
		php artisan make:controller StateController --resource
		
	- crear la ruta hacia el controlador StateController
		//
		...
		// direcciona a todos los metodos por defecto del controlador StateController para los selects dinamicos 
		Route::resource('states','StateController');
		...
		//
		
	- modificar el controlador StateController, 
		- hacer el llamado a los modelos State y Town
			//
			...
			use Cinema\State;
			use Cinema\Town;
			...
			//
		- modificar el metodo index
			//
			...
			public function index()
			{
				$states = State::lists('name','id');
				return view('state.index',compact('states') );
			}
			...
			//
		- crear el metodo getTowns
			//
			...
			//metodo para obtener el id segun la opcion elejida en el select de estados, se valida mediante ajax
			public function getTowns(Request $request, $id){
				if($request->ajax()){
					//se obtiene el resultado de la busqueda de todos los municipios a partir de id del estado elegido y se regresan los registros resultantes
					$towns = Town::towns($id);
					return response()->json($towns);
				}
			}
			...
			//
			
	- insertar datos de prueba en las tablas states y towns
	
	- modificar el modelo Town, agregar un metodo para lanzar los datos de los municipios
		//
		...
		//retorna todos los estados correspondientes a partir del state_id recibido 
		public static function towns($id){
			return Town::where('state_id','=',$id)->get();
		}
		...
		//
		
	- crear la ruta hacia el metodo getTowns del controlador StateController
		//
		...
		// direcciona al metodo getTowns del controlador StateController para los selects dinamicos 
		Route::get('towns/{id}','StateController@getTowns');
		...
		//
		
	- crear el script /js/dropdown.js con las instrucciones para hacer funcionar el select dinamico
		- de esta manera seria con jquery normal y ecmascript 5
			//
			$("#state").change(function(event){
				//se obtiene el componente en el cual se esta generando el evento
				//se obtiene el id (event.target.value) y se envia concatenado a la url towns/[id]
				//esta peticion tendra una respuesta y un estado
				$.get("towns/"+event.target.value+"", function(response, state){
					//se puede ver que es lo que esta recibiendo
						//console.log(response);
					//se limpia el elemento antes de insertar la informacion
					$("#town").empty();
					//se insertan los elementos recibidos con formato de option dentro del select#town
					for(i=0; i<response.length; i++){
						$("#town").append('<option value="'+ response[i].id +'">'+ response[i].name +'</option>');
					}
				});
			});
			//
		- de esta otra es usando jquery-2.1.0.min.js con ecmascript 6
			https://www.uno-de-piera.com/ecmascript-6-el-cambio-de-javascript/
			//
			$("#state").change(event => {
				$.get(`towns/${event.target.value}`, function(res, sta){
					$("#town").empty();
					res.forEach(element => {
						$("#town").append(`<option value=${element.id}> ${element.name} </option>`);
					});
				});
			});
			//
//FIN DEL CURSO
https://github.com/RpL02

https://www.openshift.com
https://openshift.redhat.com

PostgreSQL 9.2 database added.  Please make note of these credentials:

   Root User: adminufdibkj
   Root Password: G6-sCR86eJwk
   Database Name: camaleon50

Connection URL: postgresql://$OPENSHIFT_POSTGRESQL_DB_HOST:$OPENSHIFT_POSTGRESQL_DB_PORT

-----------------------------------------------

Associated with job 'camaleon2-build' in Jenkins server.
Jenkins created successfully.  Please make note of these credentials:

   User: admin
   Password: JyNcB7t2TbQP

Note:  You can change your password at: https://jenkins-davidcalderon.rhcloud.com/me/configure

Your application is now building with Jenkins.

-----------------------------------------------
http://camaleonv1-davidcalderon.rhcloud.com/
Database: camaleonv1 User: admin5EBXnLp Password: 5yq-PEDLTcdN

MySQL 5.5 database added.  Please make note of these credentials:

       Root User: admin5EBXnLp
   Root Password: 5yq-PEDLTcdN
   Database Name: camaleonv1

Connection URL: mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/

You can manage your new MySQL database by also embedding phpmyadmin.
The phpmyadmin username and password will be the same as the MySQL credentials above.


Please make note of these MySQL credentials again:
  Root User: admin5EBXnLp
  Root Password: 5yq-PEDLTcdN
URL: https://camaleonv1-davidcalderon.rhcloud.com/phpmyadmin/


PostgreSQL 9.2 database added.  Please make note of these credentials:

   Root User: admin94i4g7i
   Root Password: wRPuu5abyePk
   Database Name: camaleonv1

Connection URL: postgresql://$OPENSHIFT_POSTGRESQL_DB_HOST:$OPENSHIFT_POSTGRESQL_DB_PORT


?>
