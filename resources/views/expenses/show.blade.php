@extends('layouts.one.master')

@section('content')
<div class="px-4 py-6">
	<div class="md:max-w-5xl md:mx-auto">
		@component('components.linkto', [
		'href' => route('expenses.index'),
		'classes' => 'mb-4'
		])
		Back to Expenses
		@endcomponent

		@component('components.heading', [
		'size' => 'heading'
		])
		Your Expense Details
		@endcomponent

		@if ($expenses->isEmpty())
		<p>No expenses found.</p>
		@else
		@component('components.heading', [
		'size' => 'normal',
		'classes' => "mb-4"
		])
		on {{ \Carbon\Carbon::parse($expenses[0]->expense_date)->format('D j M, Y') }}
		@endcomponent

		<div class="flex flex-wrap -mx-4 mb-6">
			<div class="w-full md:w-1/3 px-4 flex-grow mb-5 md:mb-0">
				@component('components.card')
				<div class="flex flex-wrap items-center md:block md:mt-5">
					<div
						class="overflow-hidden relative w-32 h-32 md:w-40 md:h-40 rounded-full bg-blue-100 mx-auto md:mb-6">
						<div class="mb-8 md:mb-12 absolute left-0 right-0 mx-auto bottom-0" style="z-index: 1">
							<div class="bg-blue-600 mx-auto rounded-lg relative w-20 py-2 border-2 border-blue-100">
								<div class="h-8 bg-orange-500 w-8 rounded absolute left-0 top-0 -mt-3 ml-4"
									style="transform: rotate(-45deg); z-index: -1;"></div>
								<div class="h-8 bg-orange-600 w-8 rounded absolute left-0 top-0 -mt-3 ml-8"
									style="transform: rotate(-12deg); z-index: -2;"></div>

								<div
									class="flex items-center justify-center h-6 bg-blue-600 w-6 rounded-l-lg ml-auto border-4 border-blue-100 -mr-1">
									<div class="h-2 w-2 rounded-full bg-blue-600 border-2 border-blue-100"></div>
								</div>

								<div class="w-8 h-8 bg-orange-500 border-4 border-blue-100 rounded-full -ml-3 -mb-5">
								</div>
							</div>
						</div>
					</div>
					<div class="flex-1">
						@component('components.heading', [
						'size' => 'display2',
						'classes' => "mb-3 md:hidden text-center"
						])
						&#8377;{{ number_format($expenses->sum('expense_amount'), 2)}}
						@endcomponent

						@component('components.heading', [
						'size' => 'heading2',
						'classes' => "mb-3 hidden md:block text-center tracking-tight"
						])
						&#8377;{{ number_format($expenses->sum('expense_amount'), 2)}}
						@endcomponent

						@component('components.heading', [
						'size' => 'small-caps',
						'classes' => "text-center"
						])
						Total Expenditures
						@endcomponent
					</div>
				</div>
				@endcomponent
			</div>
			<div class="w-full md:w-2/3 px-4 flex-grow">
				@component('components.card')
				@include('reports.barChartWidget', [
				'keys' => $expensesDataForGraph->keys(),
				'values' => $expensesDataForGraph->values(),
				'id' => 'expenseBarChart',
				'height' => 180
				])
				@endcomponent
			</div>
		</div>
		@include('expenses.expenseTablePartial')
		@endif
	</div>
	@endsection

	@section('js-bottom')
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" defer data-turbolinks-track="reload">
	</script>
	{{-- 
	<script data-turbolinks-track="reload">
		function initChart() {
		var ctx = document.getElementById('expenseBarChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: @json($expensesDataForGraph->keys()),
				datasets: [{
					label: 'Expenses',
					data: @json($expensesDataForGraph->values()),
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			
			options: {
				legend: {
					display: false
				},
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});
	}

	window.addEventListener("DOMContentLoaded", function(e) {
		Chart.defaults.global.defaultFontFamily = 'ProximaNova';
		initChart();
	});
	</script> --}}
	@endsection