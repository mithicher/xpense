<div x-data="{ 
	categoryEditModal:false, 
	categoryName: '',
	errors: [],
	showModal: false, 
	deleteRecord: '', 
	deleteCategory: '', 
	loading: false 
}" x-cloak>

	{{-- Delete Modal --}}
	<div style="background-color: rgba(0, 0, 0, 0.4)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full"
		x-show="showModal" x-on:click.away="showModal = false" x-transition:enter="ease-out transition-slow"
		x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
		x-transition:leave="ease-in transition-slow" x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0">
		<div class="p-4 max-w-xl mx-auto absolute left-0 right-0 overflow-hidden mt-24">
			<form method="POST" action="{{ route('categories.delete') }}" onsubmit="deleteCategoryButton.disabled = true;
			deleteCategoryButton.classList.add('base-spinner');">
				@component('components.card', [
				'withFooter' => true
				])

				<input type="hidden" name="category_id" x-model="deleteRecord['id']">
				@method('DELETE')
				@csrf
				@component('components.heading', [
				'size' => 'large'
				])
				Are you sure delete this record?
				@endcomponent

				<p>If you delete the record you can't recover it.</p>

				<div class="border rounded-lg mt-4">
					<div class="flex py-2 px-4">
						<div class="mr-2">Category Name:</div>
						<div class="flex-1 text-truncate">
							<p x-text="deleteRecord['name']" class="mb-0 text-gray-800"></p>
						</div>
					</div>
				</div>

				@slot('footer')
				<div class="text-right">
					<button type="button" x-on:click="showModal = false"
						class="px-4 py-2 rounded-lg text-gray-600 bg-white hover:text-blue-600 shadow mr-2">Cancel</button>
					<button type="submit" name="deleteCategoryButton"
						class="px-4 py-2 rounded-lg text-white bg-red-500 hover:bg-red-600 shadow">Confirm</button>
				</div>
				@endslot
				@endcomponent
			</form>
		</div>
	</div>

	{{-- Edit Modal --}}
	<div style="background-color: rgba(0, 0, 0, 0.4)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full"
		x-show="categoryEditModal" x-on:click.away="categoryEditModal = false"
		x-transition:enter="ease-out transition-slow" x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100" x-transition:leave="ease-in transition-slow"
		x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
		<div class="p-4 max-w-xl mx-auto absolute left-0 right-0 overflow-hidden mt-24">
			<form method="POST" x-on:submit.prevent="
				loading = true;
				window.axios.put('/categories/' + categoryName['id'], {
					'name': categoryName['name'],
					'_method': 'PUT'
				}).then((response) => {
					categoryEditModal = false
					loading = false
					Turbolinks.visit('/categories', { action: 'replace' })
				}).catch(error => {
					errors = error.response.data.errors
					loading = false
				})
			">
				@csrf

				@component('components.card', [
				'withFooter' => true
				])
				@component('components.heading', [
				'size' => 'heading'
				])
				Edit category
				@endcomponent

				<div class="mb-4 mt-2">
					<label for="name" class="form-label block mb-2 font-semibold text-gray-700">Category
						Name</label>
					<div class="relative">
						<input type="text" name="name" x-model="categoryName['name']"
							x-on:keydown="delete errors['name']" x-bind:class="{ 'border-red-500': errors['name'] }"
							class="border bg-gray-100 px-3 py-2 h-12 rounded-lg w-full text-gray-800 focus:border-blue-600 focus:outline-none focus:bg-white">

						<div x-show="errors['name']" x-cloak>
							<svg class="absolute text-red-600 fill-current" style="top: 12px; right: 12px"
								xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
								<path
									d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
							</svg>
							<span class="text-red-600 mt-2 text-sm block" x-text="errors['name']"></span>
						</div>
					</div>
				</div>

				@slot('footer')
				<div class="text-right">
					<button type="button" x-on:click="categoryEditModal = false"
						class="px-4 py-2 rounded-lg text-gray-600 bg-white hover:text-blue-600 shadow mr-2">Cancel</button>
					<button type="submit"
						x-bind:class="{ 'cursor-not-allowed opacity-25 base-spinner': loading == true }"
						x-bind:disabled="loading == true || categoryName == ''"
						class="px-4 py-2 rounded-lg text-white bg-red-500 hover:bg-red-600 shadow">Update
						Category</button>
				</div>
				@endslot
				@endcomponent
			</form>
		</div>
	</div>

	@if ($categories->isEmpty())
	@component('components.card')
	<div class="py-10 text-center">
		<p class="mb-6">No categories found. <br> Click the button below to add a new category.</p>
		@component('components.button', [
		'type' => 'link',
		'href' => route('categories.create')
		])
		Add category
		@endcomponent
	</div>
	@endcomponent
	@else
	<div class="shadow rounded-lg overflow-hidden mb-8">
		<table class="w-full whitespace-no-wrap bg-white overflow-hidden">
			<thead>
				<tr>
					<th class="text-left px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">
						Category Name
					</th>
					<th class="w-16 text-left px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($categories as $category)
				<tr class="focus-within:bg-gray-200 overflow-hidden">
					<td class="border-t"><span
							class="text-gray-700 px-6 py-2 flex items-center">{{ $category->name }}</span>
					</td>
					<td class="border-t">
						<a href="#"
							x-on:click.prevent="categoryEditModal = !categoryEditModal; categoryName = {{ $category }}"
							class="px-1 text-blue-500 hover:text-blue-700">
							Edit
						</a>
						<a href="#" x-on:click.prevent="showModal = !showModal; deleteRecord = {{ $category }}"
							class="ml-1 px-1 mr-4 text-red-500 hover:text-red-700">
							Delete
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
			@if ($categories->previousPageUrl())
			<a href="{{ $categories->previousPageUrl() }}"
				class="inline-block font-bold shadow bg-white px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600">Previous</a>
			@endif
		</div>
		<div class="w-1/2 text-right">
			@if ($categories->nextPageUrl())
			<a href="{{ $categories->nextPageUrl() }}"
				class="inline-block font-bold shadow bg-white px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600">Next</a>
			@endif
		</div>
	</div>
</div>