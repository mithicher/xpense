<div x-data="{ showModal: false, deleteRecord: '', deleteCategory: '' }" x-cloak>
	<div style="background-color: rgba(0, 0, 0, 0.4)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full"
		x-show="showModal" x-on:click.away="showModal = false" x-transition:enter="ease-out transition-slow"
		x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
		x-transition:leave="ease-in transition-slow" x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0">
		<div class="p-4 max-w-xl mx-auto absolute left-0 right-0 overflow-hidden mt-24">
			<form method="POST" action="{{ route('expenses.delete') }}" onsubmit="deleteExpenseButton.disabled = true;
			deleteExpenseButton.classList.add('base-spinner');">
				@component('components.card', [
				'withFooter' => true
				])

				<input type="hidden" name="expense_id" x-model="deleteRecord['id']">
				@method('DELETE')
				@csrf
				@component('components.heading', [
				'size' => 'large'
				])
				Are you sure delete this record?
				@endcomponent

				<p>If you delete the record you can't recover it.</p>

				<div class="border rounded-lg mt-4">
					<div class="flex border-b py-2 px-4">
						<div class="w-20">Expense:</div>
						<div class="flex-1 text-truncate">
							<p x-text="deleteRecord['expense_name']" class="mb-0 text-gray-800"></p>
						</div>
					</div>
					<div class="flex py-2 px-4">
						<div class="w-20">Amount:</div>
						<div class="flex-1 text-truncate">
							<p x-text="'&#8377;' + deleteRecord['expense_amount']" class="mb-0 text-gray-800"></p>
						</div>
					</div>
				</div>


				@slot('footer')
				<div class="text-right">
					<button type="button" x-on:click="showModal = false"
						class="px-4 py-2 rounded-lg text-gray-600 bg-white hover:text-blue-600 shadow mr-2">Cancel</button>
					<button type="submit" name="deleteExpenseButton"
						class="px-4 py-2 rounded-lg text-white bg-red-500 hover:bg-red-600 shadow">Confirm</button>
				</div>
				@endslot
				@endcomponent
			</form>
		</div>
	</div>

	<div class="shadow rounded-lg overflow-hidden mb-8">
		<table class="w-full whitespace-no-wrap bg-white overflow-hidden">
			<thead>
				<tr>
					<th class="text-left px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">
						Expense Name
					</th>

					<th
						class="hidden md:block text-left px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">
						Category
					</th>

					<th class="text-left px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">
						Amount
					</th>

					<th class="w-16 text-left px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($expenses as $expense)
				<tr class="focus-within:bg-gray-200 overflow-hidden relative">
					<td class="border-t"><span class="text-gray-700 px-6 py-2 truncate block">
							{{ $expense->expense_name }}
							<span class="text-gray-500 text-sm block md:hidden">{{ $expense->category->name }}</span>
						</span>

					</td>
					<td class="border-t hidden md:block"><span
							class="text-gray-700 px-6 py-2 flex items-center">{{ $expense->category->name }}</span>
					</td>
					<td class="border-t"><span
							class="w-24 justify-end text-gray-700 px-6 py-2 flex items-center">&#8377;{{ $expense->expense_amount }}</span>
					</td>
					<td class="border-t">
						<a href="{{ route('expenses.edit', $expense->id) }}"
							class="px-1 text-blue-500 hover:text-blue-700">
							Edit
						</a>
						<a href="#" x-on:click.prevent="showModal = !showModal; deleteRecord = {{ $expense }}"
							class="ml-1 px-1 mr-4 text-red-500 hover:text-red-700">
							Delete
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>