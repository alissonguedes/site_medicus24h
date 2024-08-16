<div class="flex flex-wrap">
	@foreach ($months as $month => $dates)
		<div class="antialiased p-4 w-full lg:w-1/3 md:w-1/2">
			<div class="bg-white rounded-lg shadow overflow-hidden">
				<div class="text-center py-2 px-6">
					<span class="text-lg font-bold text-gray-800">
						{{ $month }}
					</span>
					<span class="ml-1 text-lg text-gray-600 font-normal">
						{{ date('Y') }}
					</span>
				</div>

				<div class="flex flex-wrap border-t -mx-1 -mb-1">
					@foreach ($dates as $date)
						<div class="inline-flex items-center justify-center p-1.5 border-r border-b" style="width: 14.28%">
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
