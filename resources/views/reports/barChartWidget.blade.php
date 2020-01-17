<div>
	<canvas id="{{ $id }}" width="{{ isset($width) ? $width : '400' }}"
		height="{{ isset($height) ? $height : '150' }}"></canvas>
</div>

@push('scripts')
<script data-turbolinks-track="reload">
	window.addEventListener("load", function(e) {
		Chart.defaults.global.defaultFontFamily = 'Manrope';
	
		let ctx = document.getElementById('{{ $id }}').getContext('2d');
		new Chart(ctx, {
			type: '{{ isset($chartType) ? $chartType : 'bar' }}',
			data: {
				labels: @json($keys),
				datasets: [{
					label: 'Expenses',
					data: @json($values),
					backgroundColor: 'rgba(54, 162, 235, 0.25)',
					borderColor: 'rgba(54, 162, 235, 1)',
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
						},
						gridLines: {
							lineWidth: 1,
							color: "#f1f1f1"
						} 
					}],
					xAxes : [ {
						gridLines: {
							drawOnChartArea: false
							// display: false
						}
					}]
				},
				@if(isset($tooltipData))
				tooltips: {
					callbacks: {
						label: function(tooltipItem, data) {
							return tooltipItem.{{ $tooltipData }}.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
						}
					}
				}
				@endif
			}
		});
	});
</script>
@endpush