@extends('layouts.one.master')
@section('content')
<div class="px-4 py-6">
	<div class="md:max-w-5xl mx-auto" x-data="expense()">
		@component('components.linkto', [
		'href' => route('expenses.show', $expense->expense_date->format('Y-m-d')),
		'classes' => 'mb-4'
		])
		Go Back
		@endcomponent
		<div class="flex flex-wrap -mx-4">
			<div class="w-full md:w-1/3 px-4">
				@component('components.heading', [
				'size' => 'heading',
				'classes' => "mb-2"
				])
				Edit your expense
				@endcomponent
				@component('components.heading', [
				'classes' => "mb-6"
				])
				Update your expense details incase something incorrect data is added.
				@endcomponent
			</div>
			<div class="w-full md:w-2/3 px-4">
				@component('components.card')
				<form method="POST" x-on:submit.prevent="saveExpense()">
					@csrf
					<div class="mb-4">
						<label for="category" class="form-label block mb-2 font-semibold text-gray-700">Expense
							Category</label>
						<div class="relative">
							<select name="category" id="category"
								x-on:change="category = document.getElementById('category').value"
								x-bind:class="{ 'border-red-500': errors['category'] }"
								class="form-select px-3 py-2 h-12 bg-gray-100 block w-full text-gray-800 font-sans rounded-lg text-left appearance-none relative pr-6 font-normal border focus:border-blue-600 focus:outline-none focus:bg-white">
								@foreach($categories as $category)
								<option value="{{ $category->id}}"
									{{$expense->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
								</option>
								@endforeach
							</select>
							<div x-show="errors['category']" x-cloak>
								<svg class="absolute text-red-600 fill-current" style="top: 12px; right: 30px"
									xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
									<path
										d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
								</svg>
								<span class="text-red-600 mt-1 text-sm block" x-text="errors['category']"></span>
							</div>
						</div>
						@component('components.heading', [
						'classes' => "mt-2"
						])
						To add a new category?
						@component('components.linkto', [
						'href' => route('categories.index')
						])
						Click here
						@endcomponent
						@endcomponent
					</div>
					<div class="mb-4">
						<label for="expense_name" class="form-label block mb-2 font-semibold text-gray-700">Expense
							Name</label>
						<div class="relative">
							<input type="text" name="expense_name" x-model="expenseName"
								placeholder="Movie with friends :)" x-on:keydown="delete errors['expense_name']"
								x-bind:class="{ 'border-red-500': errors['expense_name'] }"
								class="border bg-gray-100 px-3 py-2 h-12 rounded-lg w-full text-gray-800 focus:border-blue-600 focus:outline-none focus:bg-white">
							<div x-show="errors['expense_name']" x-cloak>
								<svg class="absolute text-red-600 fill-current" style="top: 12px; right: 12px"
									xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
									<path
										d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
								</svg>
								<span class="text-red-600 mt-1 text-sm block" x-text="errors['expense_name']"></span>
							</div>
						</div>
					</div>
					<div class="mb-4">
						<label for="expense_amount" class="form-label block mb-2 font-semibold text-gray-700">Expense
							Amount</label>
						<div class="relative w-32">
							<input type="text" name="expense_amount" x-model="expenseAmount"
								x-on:keydown="delete errors['expense_amount']"
								x-bind:class="{ 'border-red-500': errors['expense_amount'] }"
								class="border bg-gray-100 px-3 py-2 h-12 rounded-lg w-full text-gray-800 focus:border-blue-600 focus:outline-none focus:bg-white"
								onkeypress="return isNumber(event)">
							<svg x-show="errors['expense_amount']" x-cloak class="absolute text-red-600 fill-current"
								style="top: 12px; right: 12px" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24">
								<path
									d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
							</svg>
						</div>
						<div x-show="errors['expense_amount']" x-cloak>
							<span class="text-red-600 mt-1 text-sm block" x-text="errors['expense_amount']"></span>
						</div>
					</div>
					<div class="mb-4">
						<label for="datepicker" class="form-label block mb-2 font-semibold text-gray-700">Expense
							Date</label>
						<div class="relative w-64">
							<input ref="datepicker" type="text" id="datepicker"
								class="pl-10 pr-2 py-2 h-12 leading-normal block w-full text-gray-800 bg-white font-sans rounded-lg text-left appearance-none border bg-gray-100 focus:bg-white focus:border-blue-600 focus:outline-none"
								x-on:change="expenseDate = document.getElementById('datepicker').value"
								autocomplete="off" readonly>
							<svg class="absolute text-gray-400 fill-current" width="20" height="20"
								style="top: 14px; left: 12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
								<path
									d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z" />
							</svg>
						</div>
					</div>
					<div class="mb-4">
						<label for="expense_details" class="form-label block mb-2 font-semibold text-gray-700">Expense
							Details (optional)</label>
						<div class="relative">
							<textarea name="expense_details" id="expense_details" x-model="expenseDetails"
								x-on:keydown="delete errors['expense_details']"
								x-bind:class="{ 'border-red-500': errors['expense_details'] }"
								class="textarea border bg-gray-100 px-3 py-2 rounded-lg w-full text-gray-800 focus:border-blue-600 focus:outline-none focus:bg-white"></textarea>
							<div x-show="errors['expense_details']" x-cloak>
								<svg class="absolute text-red-600 fill-current" style="top: 12px; right: 12px"
									xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
									<path
										d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
								</svg>
								<span class="text-red-600 mt-1 text-sm block" x-text="errors['expense_details']"></span>
							</div>
						</div>
					</div>
					<div class="mt-6">
						<a href="#"
							class="mr-2 bg-white shadow text-gray-600 text-normal font-semibold px-6 py-3 hover:shadow-md rounded-lg inline-block">Cancel</a>
						<button type="submit" name="submitButton"
							x-bind:class="{ 'cursor-not-allowed opacity-25 base-spinner': loading == true }"
							x-bind:disabled="loading == true"
							class="shadow text-white  text-normal font-semibold px-6 py-3 bg-blue-500 hover:bg-blue-600 rounded-lg">Save
							Expense</button>
					</div>
				</form>
				@endcomponent
			</div>
		</div>
	</div>
</div>
</div>
@endsection

@section('js-bottom')
<script data-turbolinks-track="reload">
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	window.addEventListener('DOMContentLoaded', function() {
		var picker = new Pikaday({ 
			keyboardInput: false,
			field: document.getElementById('datepicker'),
			theme: "date-input",
			i18n: {
				previousMonth: "Prev",
				nextMonth: "Next",
				months: [
					"Jan",
					"Feb",
					"Mar",
					"Apr",
					"May",
					"Jun",
					"Jul",
					"Aug",
					"Sep",
					"Oct",
					"Nov",
					"Dec"
				],
				weekdays: [
					"Sunday",
					"Monday",
					"Tuesday",
					"Wednesday",
					"Thursday",
					"Friday",
					"Saturday"
				],
				weekdaysShort: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
			}
		});
		picker.setDate( new Date(@json($expense->expense_date)) );
	});
	function expense() {
		return { 
			loading: false,
			expenseName: @json($expense->expense_name), 
			expenseDate: new Date(@json($expense->expense_date)), 
			expenseDetails: @json($expense->expense_details), 
			expenseAmount: @json($expense->expense_amount), 
			category: @json($expense->category_id), 
			errors: [],
			saveExpense() {
				window.axios.post(`/expenses/${@json($expense->id)}`, {
                    expense_name: this.expenseName, 
					expense_date: this.expenseDate, 
					expense_details: this.expenseDetails, 
					expense_amount: this.expenseAmount,
					category: this.category
                })
                .then(response => { 
                    this.loading = false;
                    // console.log(response.data);
					// window.location.href('/home');
					window.location.reload();
					// document.querySelector('.flash-message').innerHTML = response.data;
                }).catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
			}
		};
	}
</script>
@endsection