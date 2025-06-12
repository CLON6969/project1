<style>
    .errors {
        background-color: rgb(141, 2, 2);
    }
</style>

@if(session('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 300)" 
        x-show="show"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="mb-6 p-4 rounded-lg bg-green-600 text-green-100 border border-green-400"
    >
        {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 300)" 
        x-show="show"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="mb-4 p-4 bg-blue-100 text-blue-800 rounded border border-blue-300"
    >
        {{ session('info') }}
    </div>
@endif

@if($errors->any())
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 6000)" 
        x-show="show"
        x-transition:leave="transition ease-in duration-5000"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="mb-6 p-4 rounded border border-red-900 errors text-white"
    >
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
