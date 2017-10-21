<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $mail->id !!}</p>
</div>

<!-- From Field -->
<div class="form-group">
    {!! Form::label('from', 'From:') !!}
    <p>{!! $mail->from !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $mail->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $mail->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $mail->deleted_at !!}</p>
</div>

<!-- Cc Field -->
<div class="form-group">
    {!! Form::label('cc', 'Cc:') !!}
    <p>{!! $mail->cc !!}</p>
</div>

<!-- Bcc Field -->
<div class="form-group">
    {!! Form::label('bcc', 'Bcc:') !!}
    <p>{!! $mail->bcc !!}</p>
</div>

<!-- Replyto Field -->
<div class="form-group">
    {!! Form::label('replyto', 'Replyto:') !!}
    <p>{!! $mail->replyto !!}</p>
</div>

<!-- Subject Field -->
<div class="form-group">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{!! $mail->subject !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $mail->content !!}</p>
</div>

