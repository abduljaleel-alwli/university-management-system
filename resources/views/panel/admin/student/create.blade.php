<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Student') }}
        </h2>
    </x-slot>

    <x-authentication-card style="max-width: 700px; min-width: 700px">
        <x-slot name="logo">
            <!-- You can add a logo here if needed -->
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('admin.students.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="first_name_ar" value="{{ __('First Name (Arabic)') }}" />
                    <x-input id="first_name_ar" class="block mt-1 w-full" type="text" name="first_name_ar"
                        :value="old('first_name_ar')" required autofocus />
                </div>
                <div>
                    <x-label for="first_name_en" value="{{ __('First Name (English)') }}" />
                    <x-input id="first_name_en" class="block mt-1 w-full" type="text" name="first_name_en"
                        :value="old('first_name_en')" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="father_name_ar" value="{{ __('Father Name (Arabic)') }}" />
                    <x-input id="father_name_ar" class="block mt-1 w-full" type="text" name="father_name_ar"
                        :value="old('father_name_ar')" required />
                </div>
                <div>
                    <x-label for="father_name_en" value="{{ __('Father Name (English)') }}" />
                    <x-input id="father_name_en" class="block mt-1 w-full" type="text" name="father_name_en"
                        :value="old('father_name_en')" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="grandfather_name_ar" value="{{ __('Grandfather Name (Arabic)') }}" />
                    <x-input id="grandfather_name_ar" class="block mt-1 w-full" type="text"
                        name="grandfather_name_ar" :value="old('grandfather_name_ar')" required />
                </div>
                <div>
                    <x-label for="grandfather_name_en" value="{{ __('Grandfather Name (English)') }}" />
                    <x-input id="grandfather_name_en" class="block mt-1 w-full" type="text"
                        name="grandfather_name_en" :value="old('grandfather_name_en')" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="last_name_ar" value="{{ __('Last Name (Arabic)') }}" />
                    <x-input id="last_name_ar" class="block mt-1 w-full" type="text" name="last_name_ar"
                        :value="old('last_name_ar')" required />
                </div>
                <div>
                    <x-label for="last_name_en" value="{{ __('Last Name (English)') }}" />
                    <x-input id="last_name_en" class="block mt-1 w-full" type="text" name="last_name_en"
                        :value="old('last_name_en')" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required />
                </div>
                <div>
                    <x-label for="phone_number" value="{{ __('Phone Number') }}" />
                    <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                        :value="old('phone_number')" required />
                </div>
            </div>



            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="start_date" value="{{ __('Start Date') }}" />
                    <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                        :value="old('start_date')" required />
                </div>
                <div>
                    <x-label for="study_type" value="{{ __('Study Type') }}" />
                    <x-select id="study_type" name="study_type" class="block mt-1 w-full" required>
                        <option value="msc">{{ __('Master') }}</option>
                        <option value="phd">{{ __('PhD') }}</option>
                    </x-select>
                </div>
                {{-- <div>
                    <x-label for="study_end_date" value="{{ __('Study End Date') }}" />
                    <x-input id="study_end_date" class="block mt-1 w-full" type="date" name="study_end_date" :value="old('study_end_date')" required />
                </div> --}}
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="admission_channel" value="{{ __('Admission Channel') }}" />
                    <x-select id="admission_channel" name="admission_channel" class="block mt-1 w-full" required>
                        <option value="private">{{ __('Private') }}</option>
                        <option value="public">{{ __('Public') }}</option>
                    </x-select>
                </div>

                <div>
                    <x-label for="academic_stage" value="{{ __('Academic Stage') }}" />
                    <x-select id="academic_stage" name="academic_stage" class="block mt-1 w-full" required>
                        <option value="preparatory">{{ __('Preparatory Year') }}</option>
                        <option value="research">{{ __('Research Year') }}</option>
                    </x-select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="status" value="{{ __('Status') }}" />
                    <x-select id="status" name="status" class="block mt-1 w-full" required>
                        <option value="active">{{ __('Active') }}</option>
                        <option value="suspended">{{ __('Suspended') }}</option>
                        <option value="pending_review">{{ __('Pending Review') }}</option>
                    </x-select>
                </div>
                <div>
                    <x-label for="specialization_type" value="{{ __('Specialization Type') }}" />
                    <x-select id="specialization_type" name="specialization_type" class="block mt-1 w-full" required>
                        <option value="graduation_project">{{ __('Graduation Project') }}</option>
                        <option value="pure_sciences">{{ __('Pure Sciences') }}</option>
                        <option value="teaching_methods">{{ __('Teaching Methods') }}</option>
                    </x-select>
                </div>
            </div>

            <div>
                <x-label for="notes" value="{{ __('Notes') }}" />
                <x-textarea id="notes" name="notes" class="block mt-1 w-full">{{ old('notes') }}</x-textarea>
            </div>

            <div class="flex justify-end mt-4">
                <x-button>
                    {{ __('Add Student') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>
