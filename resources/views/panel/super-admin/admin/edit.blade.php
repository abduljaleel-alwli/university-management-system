<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <x-authentication-card>
        <x-slot name="logo">
            <!-- يمكنك إضافة شعار هنا إذا كنت بحاجة إليه -->
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('super-admin.admins.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- حقل الاسم -->
            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>

            <!-- حقل البريد الإلكتروني -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
            </div>

            @role('super-admin')
                <!-- حقل الدور -->
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-label for="role" value="{{ __('Role') }}" />
                    <x-select id="role" name="role" class="mt-1 block w-full" onchange="toggleDepartmentField()" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="role" class="mt-2" />
                </div>

                <!-- حقل القسم -->
                <div id="department-container" class="col-span-6 sm:col-span-4 mt-4" style="{{ $user->hasRole('super-admin') ? 'display: none;' : '' }}">
                    <x-label for="department_id" value="{{ __('Department') }}" />
                    <x-select id="department_id" name="department_id" class="mt-1 block w-full">
                        <option value="">{{ __('Select a department') }}</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="department_id" class="mt-2" />
                </div>
            @endrole

            <!-- حقل كلمة المرور -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('New Password (Optional)') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
            </div>

            <!-- حقل تأكيد كلمة المرور -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
            </div>

            <!-- زر التحديث -->
            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Update') }}
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
