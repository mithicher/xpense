@extends('layouts.one.master')

@section('title', 'Expenses')

@section('content')
<div class="px-4 py-10">
	<div class="md:max-w-5xl md:mx-auto">
		<div class="flex items-center justify-between mb-6">
			<div>
				@component('components.heading', [
				'size' => 'heading'
				])
				Your Expenses
				@endcomponent
			</div>
			<div>
				@component('components.button', [
				'href' => route('expenses.create'),
				'type' => 'link'
				])
				New Expense
				@endcomponent
			</div>
		</div>


		<div class="mb-5 expenses-content">
			@include('expenses.indexPartial')
		</div>
	</div>
</div>
@endsection

@section('js-bottom')
<script>
	// function debounced(delay, fn) {
	// 	let timerId;
	// 	return function(...args) {
	// 		if (timerId) {
	// 			clearTimeout(timerId);
	// 		}
	// 		timerId = setTimeout(() => {
	// 			fn(...args);
	// 			timerId = null;
	// 		}, delay);
	// 	}
	// }
	// window.addEventListener("DOMContentLoaded", function(e) {
	// 	document.addEventListener("turbolinks:load", () => {
	// 		document.querySelector('.expense-search').addEventListener('input', debounced(300, function(e) {
	// 			window.axios.get('/expenses/expenses-partial?search=' + e.target.value)
	// 				.then(response => {
	// 					document.querySelector('.expenses-content').innerHTML = response.data;

	// 					history.pushState(null, null, '?page=1');
	// 				});
	// 		}));
	// 	});

	// });
</script>
@endsection