<table class="table table-responsive" id="mails-table">
    <thead>
        <th>From</th>
        <th>Cc</th>
        <th>Bcc</th>
        <th>Replyto</th>
        <th>Subject</th>
        <th>Content</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($mails as $mail)
        <tr>
            <td>{!! $mail->from !!}</td>
            <td>{!! $mail->cc !!}</td>
            <td>{!! $mail->bcc !!}</td>
            <td>{!! $mail->replyto !!}</td>
            <td>{!! $mail->subject !!}</td>
            <td>{!! $mail->content !!}</td>
            <td>
                {!! Form::open(['route' => ['mails.destroy', $mail->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('mails.show', [$mail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('mails.edit', [$mail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>