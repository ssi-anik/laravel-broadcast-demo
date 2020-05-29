@extends('layouts.app')

@section('content')
	<div class = "container">
		<div class = "row justify-content-center">
			<div class = "col-md-9">
				<div class = "card">
					<div class = "card-header">
						Group messages
					</div>

					<div class = "card-body">
						{!! Form::open(['id' => 'message-form', 'method' => 'post', 'url' => route('post.group-chat')]) !!}
						{!! Form::token() !!}
						<div class = "form-group row">
							<div class = "col-md-12">
								{!! Form::text('message', null, ['class' => 'form-control', 'id' => 'message', 'placeholder' => 'Type message. Press enter to send ', 'autofocus' => true]) !!}
								<span class = "help-block float-right typing" style = "font-size: 10px;">
                                    <span id = "who-is"></span> is typing...
                                </span>
							</div>
						</div>
						{!! Form::close() !!}
						<table class = "table table-bordered" style = "margin-top: 5px;">
							<tbody id = "messages-tbody">
							<tr>
								<td class = "text-center">No message shared yet</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class = "col-md-3">
				<div class = "card">
					<div class = "card-header">Active Members</div>

					<div class = "card-body">
						<table class = "table table-bordered">
							<tbody id = "group-users-tbody">

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script type = "text/javascript">
        let message_count = 0;
        let user = JSON.parse('{!! auth()->user()->toJson() !!}');
        let whisper_typing = false;

        function show_toast (title, content = null, type = 'info')
        {
            toastr[type](content, title)
            toastr.options.onclick = function () {
                toastr.clear();
            }
        }

        function add_user (user)
        {
            let row = `<tr data-id="${user.id}"><td> [${user.username}] ${user.name} </td></tr>`;
            $("#group-users-tbody").prepend(row);
        }

        function remove_user (user)
        {
            let id = user.id;
            $("#group-users-tbody > tr").each(function (index, tr) {
                if ( $(tr).attr('data-id') == id ) {
                    $(tr).remove();
                }
            });
        }

        function prepend_message (message, time, username, direction)
        {
            let msg = `<tr><td class = "${direction}"> ${time} - [${username}]: ${message} </td></tr>`;
            if ( message_count == 0 ) {
                $("#messages-tbody").empty();
            }
            ++message_count;
            $("#messages-tbody").prepend(msg);
        }

        function submit_message ()
        {
            let message = $("#message").val().trim();
            if ( !message ) {
                return;
            }

            axios({
                method: 'post', url: "{{ route('post.group-chat') }}", data: {
                    message: message
                }, headers: {
                    'Accept': 'text/json',
                }
            }).then(function (response) {
                prepend_message(response.data.message, response.data.time, response.data.sender, 'text-right');
                $("#message").val('');
            }).catch(function (error) {
                show_toast("Error occurred", error.response.data.message, 'error');
            });
        }

        function whisper ()
        {
            if ( whisper_typing ) {
                return;
            }

            whisper_typing = true;
            groupChannel.whisper('typing', {
                user: user, typing: true
            });

            setTimeout(() => {
                whisper_typing = false;
                groupChannel.whisper('typing', {
                    user: user, typing: false
                })
            }, 5000)
        }

        $("#message-form").on('submit', function (e) {
            e.preventDefault();
            submit_message();
            return false;
        });

        let groupChannel = Echo.join('group-conversation');

        groupChannel.here((users) => {
            console.log('here: ', users);
            $(users).each(function (index, item) {
                add_user(item);
            });
        }).joining((user) => {
            console.log('joining: ', user);
            add_user(user);
        }).listenForWhisper('typing', (e) => {
            console.log('Event typing', e);
            if ( e.typing ) {
                $('#who-is').text(e.user.name);
                $('.typing').show();
            } else {
                $('.typing').hide();
            }
        }).leaving((user) => {
            console.log('leaving: ', user);
            remove_user(user);
        }).listen('.group-message-received', (e) => {
            prepend_message(e.message, e.time, e.sender, 'text-left');
        });


        $('#message').on('keyup', function (e) {
            // don't whisper on enter, or
            if ( e.keyCode != 13 && $('#message').val().trim().length != 0 ) {
                whisper();
            }
        })
        $('.typing').hide();
	</script>
@endsection
