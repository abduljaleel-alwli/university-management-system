

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <form action="{{ route('super-admin.departments.store') }}" method="POST">
        @csrf
        <div>
            <label for="name_ar" class="p-3">اسم القسم (عربي)</label>
            <input type="text" id="name_ar" name="name_ar" required>
        </div>

        <div>
            <label for="name_en" class="p-3">اسم القسم (إنجليزي)</label>
            <input type="text" id="name_en" name="name_en" required>
        </div>

        <button type="submit">انشاء القسم</button>
    </form>

</x-app-layout>
