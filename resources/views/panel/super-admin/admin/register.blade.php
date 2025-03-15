<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register User') }}
        </h2>
    </x-slot>
    
    <x-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('super-admin.admins.store') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            @role('super-admin')
                <!-- Role -->
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-label for="role" value="{{ __('Role') }}" />
                    <x-select id="role" name="role" class="mt-1 block w-full" wire:model="role" wireModel="role"
                        onchange="toggleDepartmentField()" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="role" class="mt-2" />
                </div>

                <!-- Department -->
                <div id="department-container" class="col-span-6 sm:col-span-4 mt-4">
                    <x-label for="department_id" value="{{ __('Department') }}" />
                    <x-select id="department_id" name="department_id" class="mt-1 block w-full" wire:model="department_id"
                        wireModel="department_id">
                        <option value="">{{ __('Select a department') }}</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="department_id" class="mt-2" />
                </div>
            @endrole


            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    <!-- JavaScript لإخفاء وإظهار الحقل -->
    <script>
        function toggleDepartmentField() {
            var role = document.getElementById("role").value;
            var departmentContainer = document.getElementById("department-container");

            if (role === "admin") {
                departmentContainer.style.display = "block";
            } else {
                departmentContainer.style.display = "none";
            }
        }

        // تشغيل الوظيفة عند تحميل الصفحة للتأكد من أن الحقل مخفي إذا كان Super Admin محددًا
        document.addEventListener("DOMContentLoaded", function() {
            toggleDepartmentField();
        });
    </script>
</x-app-layout>
