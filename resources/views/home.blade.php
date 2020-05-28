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
        Echo.private('activities')
            .listen('ActivityEvent', (e) => {
                let msg = `<tr><td>${e.on}: ${e.action} - ${e.name} (username: ${e.username})</td></tr>`;
                console.log(msg);
                $("#activities-tbody").append(msg);
            });
	</script>
@endsection
