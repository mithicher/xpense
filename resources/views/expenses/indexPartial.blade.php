<div>
	@if ($expenses->isEmpty())
	@component('components.card')
	<div class="py-10 text-center">
		<p class="mb-6">No expenses found. <br> Click the button below to add a new expense.</p>
		@component('components.button', [
		'type' => 'link',
		'href' => route('expenses.create')
		])
		Add Expense
		@endcomponent
	</div>
	@endcomponent
	@else
	<div class="shadow rounded-lg overflow-hidden mb-8">
		<table class="w-full whitespace-no-wrap bg-white overflow-hidden">
			<thead>
				<tr>
					<th class="text-left px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">
						Expense Date
					</th>
					<th class="text-left px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">
						Total Expenditure
					</th>
					<th class="w-10 text-left px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($expenses as $expense)
				<tr class="focus-within:bg-gray-200 overflow-hidden">
					<td class="border-t"><span
							class="text-gray-700 px-6 py-2 flex items-center">{{ \Carbon\Carbon::parse($expense->expense_date)->format('D j M, Y') }}</span>
					</td>
					<td class="border-t"><span
							class="text-gray-700 px-6 py-2 flex items-center">&#8377;{{ $expense->total_expense }}</span>
					</td>
					<td class="border-t">
						<a href="{{ route('expenses.show', $expense->expense_date->format('Y-m-d')) }}"
							class="px-2 text-blue-500 flex items-center justify-between cursor-pointer hover:text-blue-700">
							View <span class="hidden md:block ml-1">Details</span>
							<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M10.707 17.707L16.414 12 10.707 6.293 9.293 7.707 13.586 12 9.293 16.293z" />
							</svg>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif

	<div class="flex justify-between my-2">
		<div class="w-1/2">
			@if ($expenses->previousPageUrl())
			<a href="{{ $expenses->previousPageUrl() }}"
				class="inline-block font-bold shadow bg-white px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600">Previous</a>
			@endif
		</div>
		<div class="w-1/2 text-right">
			@if ($expenses->nextPageUrl())
			<a href="{{ $expenses->nextPageUrl() }}"
				class="inline-block font-bold shadow bg-white px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600">Next</a>
			@endif
		</div>
	</div>
</div>