@extends('layouts.one.master')

@section('title', 'Categories')

@section('content')
<div class="px-4 py-6">
	<div class="md:max-w-5xl md:mx-auto">
		<div x-data="{ categoryCreateModal: false, categoryName: '', errors: [], loading: false }" x-cloak>

			<div class="flex items-center justify-between mb-6">
				<div>
					@component('components.heading', [
					'size' => 'heading'
					])
					Categories
					@endcomponent
				</div>
				<div>
					<a href="#" x-on:click.prevent="categoryCreateModal = true"
						class="inline-block px-6 py-3 rounded-lg text-white bg-blue-500 hover:bg-blue-600">New
						Category</a>
				</div>
			</div>

			{{-- Category Create Modal --}}
			<div style="background-color: rgba(0, 0, 0, 0.4)"
				class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show="categoryCreateModal"
				x-on:click.away="categoryCreateModal = false" x-transition:enter="ease-out transition-slow"
				x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
				x-transition:leave="ease-in transition-slow" x-transition:leave-start="opacity-100"
				x-transition:leave-end="opacity-0">
				<div class="p-4 max-w-xl mx-auto absolute left-0 right-0 overflow-hidden mt-24">
					<form method="POST" x-on:submit.prevent="
						loading = true;
						window.axios.post('/categories', {
							'name': categoryName
						}).then((response) => {
							document.querySelector('.categoryContent').innerHTML = response.data;
							categoryCreateModal = false
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
						Create a new category
						@endcomponent

						<div class="mb-4 mt-2">
							<label for="name" class="form-label block mb-2 font-semibold text-gray-700">Category
								Name</label>
							<div class="relative">
								<input type="text" name="name" x-model="categoryName"
									x-on:keydown="delete errors['name']"
									x-bind:class="{ 'border-red-500': errors['name'] }"
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
							<button type="button" x-on:click="categoryCreateModal = false; categoryName = ''"
								class="px-4 py-2 rounded-lg text-gray-600 bg-white hover:text-blue-600 shadow mr-2">Cancel</button>
							<button type="submit" name="createCategoryButton"
								x-bind:class="{ 'cursor-not-allowed opacity-25 base-spinner': loading == true }"
								x-bind:disabled="loading == true || categoryName == ''"
								class="px-4 py-2 rounded-lg text-white bg-red-500 hover:bg-red-600 shadow">Save
								Category</button>
						</div>
						@endslot
						@endcomponent
					</form>
				</div>
			</div>

			<div class="categoryContent">
				@include('categories.indexPartial')
			</div>
		</div>
	</div>
</div>
@endsection