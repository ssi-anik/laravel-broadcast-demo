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
        function openInNewTab (url)
        {
            window.open(url, '_blank').focus();
        }

        let user_id = "{{ auth()->user()->id }}";
        let base_url = "{{ config('app.url') }}";
        let active_conversation = [];

        Echo.private('activities')
            .listen('ActivityEvent', (e) => {
                let msg = `<tr><td>${e.on}: ${e.action} - ${e.name} (username: ${e.username})</td></tr>`;
                console.log(msg);
                $("#activities-tbody").append(msg);
            });

        /*Echo.private('conversation-phases-' + user_id)
            .listen('.started', function (e) {
                let by = e.initiator;
                if ( e.type == 'connecting' && active_conversation.indexOf(by) < 0 ) {
                    active_conversation.push(by);
                    console.log('opening new chat window for messaging with: ' + by);
                    openInNewTab(base_url + "/messages/" + by);
                }
            });*/
	</script>
@endsection
