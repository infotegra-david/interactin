<!-- From Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from', 'From:') !!}
    {!! Form::text('from', null, ['class' => 'form-control']) !!}
</div>

<!-- Cc Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('cc', 'Cc:') !!}
    {!! Form::textarea('cc', null, ['class' => 'form-control']) !!}
</div>

<!-- Bcc Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('bcc', 'Bcc:') !!}
    {!! Form::textarea('bcc', null, ['class' => 'form-control']) !!}
</div>

<!-- Replyto Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('replyto', 'Replyto:') !!}
    {!! Form::textarea('replyto', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', 'Subject:') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route($route_split.'.index') !!}" class="btn btn-default">Cancel</a>
</div>
