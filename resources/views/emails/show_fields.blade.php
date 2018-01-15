<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $email->id !!}</p>
</div>

<!-- From Field -->
<div class="form-group">
    {!! Form::label('from', 'From:') !!}
    <p>{!! $email->from !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $email->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $email->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $email->deleted_at !!}</p>
</div>

<!-- Cc Field -->
<div class="form-group">
    {!! Form::label('cc', 'Cc:') !!}
    <p>{!! $email->cc !!}</p>
</div>

<!-- Bcc Field -->
<div class="form-group">
    {!! Form::label('bcc', 'Bcc:') !!}
    <p>{!! $email->bcc !!}</p>
</div>

<!-- Replyto Field -->
<div class="form-group">
    {!! Form::label('replyto', 'Replyto:') !!}
    <p>{!! $email->replyto !!}</p>
</div>

<!-- Subject Field -->
<div class="form-group">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{!! $email->subject !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $email->content !!}</p>
</div>

