@extends('layouts.app')

@section('content')
	<div class = "container">
		<div class = "row justify-content-center">
			<div class = "col-md-12">
				<div class = "card">
					<div class = "card-header">
						Messages with "{{ $conversation->by == auth()->user()->id ? $conversation->withUser->username : $conversation->byUser->username }}"
					</div>

					<div class = "card-body">
						<table class = "table table-bordered">
							<tbody id = "activities-tbody">
							@forelse($messages as $message)
								<tr>
									<td class = "{{ $message->sender_id == auth()->user()->id ? "text-right" : "text-left" }}">
										{{ $message->created_at->diffForHumans() }} - {{ $message->message }}
									</td>
								</tr>
							@empty
								<tr>
									<td class="text-center">No message shared yet</td>
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