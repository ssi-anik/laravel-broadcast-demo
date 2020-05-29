@extends('layouts.app')
@section('css')
	<link rel = "stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')
	<div class = "container">
		<div class = "row justify-content-center">
			<div class = "col-md-12">
				<div class = "card">
					<div class = "card-header">
						Messages with "{{ $conversation->by == auth()->user()->id ? $conversation->withUser->username : $conversation->byUser->username }}"
					</div>

					<div class = "card-body">
						{!! Form::open(['id' => 'message-form', 'method' => 'post', 'url' => route('conversation-message', ['conversation' => $conversation->id])]) !!}
						{!! Form::token() !!}
						<div class = "form-group row">
							<div class = "col-md-12">
								{!! Form::text('message', null, ['class' => 'form-control', 'id' => 'message', 'placeholder' => 'Type message. Press enter to send ', 'autofocus' => true]) !!}
							</div>
						</div>
						{!! Form::close() !!}
						<table class = "table table-bordered" style = "margin-top: 5px;">
							<tbody id = "messages-tbody">
							@forelse($messages as $message)
								<tr>
									<td class = "{{ $message->sender_id == auth()->user()->id ? "text-right" : "text-left" }}">
										{{ $message->created_at->diffForHumans() }} - {{ $message->message }}
									</td>
								</tr>
							@empty
								<tr>
									<td class = "text-center">No message shared yet</td>
								</tr>
							@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script type = "text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script type = "text/javascript">
        let message_count = "{{ $messages->count() }}";
        let conversation_id = "{{ $conversation->id }}";

        Echo.private('conversation-' + conversation_id)
            .listen('.message-received', (e) => {
                console.log('received message: ', e);
                prepend_message(e.message, e.on, 'text-left');
            });

        function show_toast (title, content = null, type = 'info')
        {
            // toastr.options.progressBar = true;
            toastr[type](content, title)
            toastr.options.onclick = function () {
                toastr.clear();
            }
        }

        function prepend_message (message, time, direction)
        {
            let msg = `<tr><td class = "${direction}"> ${time} - ${message} </td></tr>`;
            $("#messages-tbody").prepend(msg);
        }

        function submit_message ()
        {
            let message = $("#message").val().trim();
            if ( !message ) {
                return;
            }

            axios({
                method: 'post',
                url: "{{ route('conversation-message', ['conversation' => $conversation->id]) }}",
                data: {
                    message: message
                },
                headers: {
                    'Accept': 'text/json',
                }
            }).then(function (response) {
                prepend_message(response.data.message, response.data.time, 'text-right');
                $("#message").val('');
            }).catch(function (error) {
                show_toast("Error occurred", error.response.data.message, 'error');
            });
        }

        $("#message-form").on('submit', function (e) {
            e.preventDefault();
            submit_message();
            return false;
        });
	</script>
@endsection