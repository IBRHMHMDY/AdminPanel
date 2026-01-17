<div class="flex flex-col items-start justify-center">
    {{-- اسم التطبيق الرئيسي --}}
    <div class="text-xl font-bold tracking-tight text-primary-500">
        {{ config('app.name') }}
    </div>
    {{-- اسم المطعم (يظهر فقط إذا كان المستخدم يملك مطعماً) --}}
    @if(auth()->check() && auth()->user()->restaurant)
        <div class="text-s text-gray-500 dark:text-gray-400">
            {{ auth()->user()->restaurant->name }}
        </div>
    @elseif(auth()->check() && auth()->user()->hasRole('Super Admin'))
        {{-- اختياري: نص يظهر للسوبر أدمن --}}
        <div class="text-s text-gray-500 dark:text-gray-400">
           Dashboard
        </div>
    @endif

</div>