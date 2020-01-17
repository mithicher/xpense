@if (Session::has('success'))
<div x-data="{ open: true }" x-show="open" class="flex pl-4 pr-8 py-4 rounded-lg relative bg-green-100 text-green-800 border-2 border-green-200" role="alert">
	<svg
		class="flex-shrink-0 fill-current text-green-600 mr-3"
		width="32"
		height="32"
		xmlns="http://www.w3.org/2000/svg"
		viewBox="0 0 24 24"
	>
		<path d="M0 0h24v24H0z" fill="none" />
		<path
			d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"
		/>
	</svg>

	<div class="pt-1">
	    <span class="block sm:inline leading-normal">
	    	{{ Session::get('success') }}
	    </span>
		 
		<span class="cursor-pointer w-8 h-8 inline-flex p-1 rounded-full absolute top-0 right-0 mr-3 mt-4 hover:bg-green-200" x-on:click="open = false">
			<svg role="button" class="w-6 h-6 fill-current text-green-500 hover:text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
				<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
				</path>
			</svg>
		</span>
    </div>
</div>
@endif