@extends('layouts.app')

@section('content')
	<div class = "container">
		<div class = "row justify-content-center">
			<div class = "col-md-7">
				<div class = "card">
					<div class = "card-header">Users</div>

					<div class = "card-body">
						<table class = "table table-bordered">
							<thead>
							<td>Name</td>
							<td>Username</td>
							<td>Action</td>
							</thead>
							<tbody>
							@foreach($users as $user)
								<tr>
									<td>{{ $user->name }}</td>
									<td>{{ $user->username }}</td>
									<td>
										<a href = "{{ route('private-chat', ['id' => $user->id]) }}"
										   class = "btn btn-success">
											Start Messaging
										</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class = "col-md-5">
				<div class = "card">
					<div class = "card-header">Activities</div>

					<div class = "card-body">
						<table class = "table table-bordered">
							<tbody id = "activities-tbody">

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

        let user_id = "{{ auth()->user()->id }}";
        let base_url = "{{ config('app.url') }}";
        let active_conversation = [];

        function show_toast (title, content = null, type = 'info')
        {
            toastr[type](content, title)
            toastr.options.onclick = function () {
                toastr.clear();
            }
        }

        function going_to_conversation (id)
        {
            active_conversation.push(id);
        }

        function openInNewTab (url)
        {
            window.open(url, '_blank').focus();
        }

        Echo.private('activities')
            .listen('ActivityEvent', (e) => {
                let msg = `<tr><td>${e.on}: ${e.action} - ${e.name} (username: ${e.username})</td></tr>`;
                console.log(msg);
                $("#activities-tbody").append(msg);
            });

        Echo.private('conversation-receiver-' + user_id)
            .listen('.message-received', function (e) {
                console.log('requested message received: ', e);
                if ( !e.sender_id || active_conversation.indexOf(e.sender_id) != -1 ) {
                    console.log('empty sender_id or conversation in new tab');
                    return;
                }

                let name = e.sender_name;
                let anchor = `<a href="${base_url}/messages/${e.sender_id}" target="_blank" onClick = going_to_conversation(${e.sender_id})>Click HERE to open in new tab</a>`;
                show_toast('New message request', anchor);
                /*if ( e.type == 'connecting' && active_conversation.indexOf(by) < 0 ) {
                    active_conversation.push(by);
                    console.log('opening new chat window for messaging with: ' + by);
                    openInNewTab(base_url + "/messages/" + by);
                }*/
            });
	</script>
@endsection
