@foreach ($months as $month => $dates)
	<table border="1" width="100%">
		<thead>
			<tr>
				<th>{{ $month . ' - ' . date('Y') }}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<table border="1" width="100%">
					<thead>
						<tr>
							<td>Domingo</td>
							<td>Segunda</td>
							<td>Terça</td>
							<td>Quarta</td>
							<td>Quinta</td>
							<td>Sexta</td>
							<td>Sábado</td>
						</tr>
					</thead>
					<tbody>
						@for ($i = 0; $i <= 6; $i++)
							<tr>
								@foreach ($dates as $date)
									<td>{{ $date->day }}</td>
								@endforeach
							</tr>
						@endfor
					</tbody>
				</table>
			</tr>
			{{--
				@dump($date) {{-- @if ($date->isSameMonth($month))
				@endif - --}}
		</tbody>
	</table>
@endforeach

<div class="">
	@foreach ($months as $month => $dates)
		<div class="">
			<div class="">
				<div class="">
					<span class="text-lg font-bold text-gray-800">{{ $month }}</span>
					<span class="ml-1 text-lg text-gray-600 font-normal">
						{{ date('Y') }}
					</span>
				</div>

				<div class="">
					@foreach ($dates as $date)
						<div class="" style="">
							@if ($date->isSameMonth($month))
								<span class="text-cool-gray-500">{{ $date->day }}</span>
							@else
								<span class="text-gray-200">{{ $date->day }}</span>
							@endif
						</div>
					@endforeach
				</div>
			</div>
		</div>
	@endforeach
</div>
