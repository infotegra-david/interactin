<li class="{{ Request::is('usuarios*') ? 'active' : '' }}">
    <a href="/"><i class="fa fa-edit"></i><span>usuarios</span></a>
</li>


<li class="{{ Request::is('tipoAlianzas*') ? 'active' : '' }}">
    <a href="{!! route('tipoAlianzas.index') !!}"><i class="fa fa-edit"></i><span>TipoAlianzas</span></a>
</li>

<li class="{{ Request::is('modalidades*') ? 'active' : '' }}">
    <a href="{!! route('modalidades.index') !!}"><i class="fa fa-edit"></i><span>Modalidades</span></a>
</li>

<li class="{{ Request::is('alianzas*') ? 'active' : '' }}">
    <a href="{!! route('alianzas.index') !!}"><i class="fa fa-edit"></i><span>Alianzas</span></a>
</li>

<li class="{{ Request::is('tipoTramites*') ? 'active' : '' }}">
    <a href="{!! route('tipoTramites.index') !!}"><i class="fa fa-edit"></i><span>TipoTramites</span></a>
</li>

<li class="{{ Request::is('pasosAlianzas*') ? 'active' : '' }}">
    <a href="{!! route('pasosAlianzas.index') !!}"><i class="fa fa-edit"></i><span>PasosAlianzas</span></a>
</li>

<li class="{{ Request::is('institucions*') ? 'active' : '' }}">
    <a href="{!! route('institucions.index') !!}"><i class="fa fa-edit"></i><span>Institucions</span></a>
</li>




<li class="{{ Request::is('inscripcion*') ? 'active' : '' }}">
    <a href="{!! route('inscripcion.index') !!}"><i class="fa fa-edit"></i><span>Inscripcion</span></a>
</li>

<li class="{{ Request::is('tipoAlianzas*') ? 'active' : '' }}">
    <a href="{!! route('tipoAlianzas.index') !!}"><i class="fa fa-edit"></i><span>TipoAlianzas</span></a>
</li>

<li class="{{ Request::is('tipoInstitucions*') ? 'active' : '' }}">
    <a href="{!! route('tipoInstitucions.index') !!}"><i class="fa fa-edit"></i><span>TipoInstitucions</span></a>
</li>

<li class="{{ Request::is('datosPersonales*') ? 'active' : '' }}">
    <a href="{!! route('datosPersonales.index') !!}"><i class="fa fa-edit"></i><span>DatosPersonales</span></a>
</li>



<li class="{{ Request::is('tipoFacultads*') ? 'active' : '' }}">
    <a href="{!! route('tipoFacultads.index') !!}"><i class="fa fa-edit"></i><span>TipoFacultads</span></a>
</li>

<li class="{{ Request::is('emails*') ? 'active' : '' }}">
    <a href="{!! route('emails.index') !!}"><i class="fa fa-edit"></i><span>Emails</span></a>
</li>

<li class="{{ Request::is('tipoPasos*') ? 'active' : '' }}">
    <a href="{!! route('tipoPasos.index') !!}"><i class="fa fa-edit"></i><span>TipoPasos</span></a>
</li>

<li class="{{ Request::is('estados*') ? 'active' : '' }}">
    <a href="{!! route('estados.index') !!}"><i class="fa fa-edit"></i><span>Estados</span></a>
</li>

<li class="{{ Request::is('archivos*') ? 'active' : '' }}">
    <a href="{!! route('archivos.index') !!}"><i class="fa fa-edit"></i><span>Archivos</span></a>
</li>

<li class="{{ Request::is('tipoArchivos*') ? 'active' : '' }}">
    <a href="{!! route('tipoArchivos.index') !!}"><i class="fa fa-edit"></i><span>TipoArchivos</span></a>
</li>


<li class="{{ Request::is('claseDocumentos*') ? 'active' : '' }}">
    <a href="{!! route('claseDocumentos.index') !!}"><i class="fa fa-edit"></i><span>ClaseDocumentos</span></a>
</li>

<li class="{{ Request::is('tipoDocumentos*') ? 'active' : '' }}">
    <a href="{!! route('tipoDocumentos.index') !!}"><i class="fa fa-edit"></i><span>TipoDocumentos</span></a>
</li>

<li class="{{ Request::is('validation/assign*') ? 'active' : '' }}">
    <a href="{!! route('intervalidation.assignments.index') !!}"><i class="fa fa-edit"></i><span>UserPasos</span></a>
</li>

<li class="{{ Request::is('userPasoEmails*') ? 'active' : '' }}">
    <a href="{!! route('userPasoEmails.index') !!}"><i class="fa fa-edit"></i><span>UserPasoEmails</span></a>
</li>

<li class="{{ Request::is('interChanges*') ? 'active' : '' }}">
    <a href="{!! route('interChanges.index') !!}"><i class="fa fa-edit"></i><span>InterChanges</span></a>
</li>

<li class="{{ Request::is('aplicaciones*') ? 'active' : '' }}">
    <a href="{!! route('aplicaciones.index') !!}"><i class="fa fa-edit"></i><span>Aplicaciones</span></a>
</li>

<li class="{{ Request::is('modalidades*') ? 'active' : '' }}">
    <a href="{!! route('modalidades.index') !!}"><i class="fa fa-edit"></i><span>Modalidades</span></a>
</li>

<li class="{{ Request::is('periodos*') ? 'active' : '' }}">
    <a href="{!! route('periodos.index') !!}"><i class="fa fa-edit"></i><span>Periodos</span></a>
</li>

<li class="{{ Request::is('matriculas*') ? 'active' : '' }}">
    <a href="{!! route('matriculas.index') !!}"><i class="fa fa-edit"></i><span>Matriculas</span></a>
</li>

<li class="{{ Request::is('institutions*') ? 'active' : '' }}">
    <a href="{!! route('admin.institutions.index') !!}"><i class="fa fa-edit"></i><span>Institutions</span></a>
</li>

<li class="{{ Request::is('institucions*') ? 'active' : '' }}">
    <a href="{!! route('admin.institucions.index') !!}"><i class="fa fa-edit"></i><span>Institucions</span></a>
</li>

<li class="{{ Request::is('campuses*') ? 'active' : '' }}">
    <a href="{!! route('admin.campuses.index') !!}"><i class="fa fa-edit"></i><span>Campuses</span></a>
</li>


<li class="{{ Request::is('facultads*') ? 'active' : '' }}">
    <a href="{!! route('admin.facultads.index') !!}"><i class="fa fa-edit"></i><span>Facultads</span></a>
</li>

<li class="{{ Request::is('programas*') ? 'active' : '' }}">
    <a href="{!! route('admin.programas.index') !!}"><i class="fa fa-edit"></i><span>Programas</span></a>
</li>

<li class="{{ Request::is('asignaturas*') ? 'active' : '' }}">
    <a href="{!! route('admin.asignaturas.index') !!}"><i class="fa fa-edit"></i><span>Asignaturas</span></a>
</li>

<li class="{{ Request::is('documentosInstitucions*') ? 'active' : '' }}">
    <a href="{!! route('admin.documentosInstitucions.index') !!}"><i class="fa fa-edit"></i><span>DocumentosInstitucions</span></a>
</li>


<li class="{{ Request::is('pasosIniciativas*') ? 'active' : '' }}">
    <a href="{!! route('validation.pasosIniciativas.index') !!}"><i class="fa fa-edit"></i><span>PasosIniciativas</span></a>
</li>

<li class="{{ Request::is('documentosAlianzas*') ? 'active' : '' }}">
    <a href="{!! route('documentosAlianzas.index') !!}"><i class="fa fa-edit"></i><span>DocumentosAlianzas</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('iniciativas*') ? 'active' : '' }}">
    <a href="{!! route('iniciativas.index') !!}"><i class="fa fa-edit"></i><span>Iniciativas</span></a>
</li>

<li class="{{ Request::is('documentosInscripcion*') ? 'active' : '' }}">
    <a href="{!! route('documentosInscripcion.index') !!}"><i class="fa fa-edit"></i><span>DocumentosInscripcion</span></a>
</li>

<li class="{{ Request::is('plantillas*') ? 'active' : '' }}">
    <a href="{!! route('plantillas.index') !!}"><i class="fa fa-edit"></i><span>Plantillas</span></a>
</li>

<li class="{{ Request::is('plantillas*') ? 'active' : '' }}">
    <a href="{!! route('plantillas.index') !!}"><i class="fa fa-edit"></i><span>Plantillas</span></a>
</li>


<li class="{{ Request::is('tipoIdiomas*') ? 'active' : '' }}">
    <a href="{!! route('admin.tipoIdiomas.index') !!}"><i class="fa fa-edit"></i><span>TipoIdiomas</span></a>
</li>

<li class="{{ Request::is('nivels*') ? 'active' : '' }}">
    <a href="{!! route('admin.nivels.index') !!}"><i class="fa fa-edit"></i><span>Nivels</span></a>
</li>


<li class="{{ Request::is('UserIdiomas*') ? 'active' : '' }}">
    <a href="{!! route('admin.UserIdiomas.index') !!}"><i class="fa fa-edit"></i><span>UserIdiomas</span></a>
</li>

<li class="{{ Request::is('financiacions*') ? 'active' : '' }}">
    <a href="{!! route('financiacions.index') !!}"><i class="fa fa-edit"></i><span>Financiacions</span></a>
</li>

<li class="{{ Request::is('fuenteFinanciacions*') ? 'active' : '' }}">
    <a href="{!! route('fuenteFinanciacions.index') !!}"><i class="fa fa-edit"></i><span>FuenteFinanciacions</span></a>
</li>

<li class="{{ Request::is('financiacions*') ? 'active' : '' }}">
    <a href="{!! route('financiacions.index') !!}"><i class="fa fa-edit"></i><span>Financiacions</span></a>
</li>

<li class="{{ Request::is('financiacions*') ? 'active' : '' }}">
    <a href="{!! route('financiacions.index') !!}"><i class="fa fa-edit"></i><span>Financiacions</span></a>
</li>

<li class="{{ Request::is('tipoPasos*') ? 'active' : '' }}">
    <a href="{!! route('tipoPasos.index') !!}"><i class="fa fa-edit"></i><span>TipoPasos</span></a>
</li>

