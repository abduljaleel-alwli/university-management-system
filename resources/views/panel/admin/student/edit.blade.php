<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <x-authentication-card style="max-width: 700px; min-width: 700px">
        <x-slot name="logo">
            <!-- You can add a logo here if needed -->
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('admin.students.update', $student->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="first_name_ar" value="{{ __('First Name (Arabic)') }}" />
                    <x-input id="first_name_ar" class="block mt-1 w-full" type="text" name="first_name_ar"
                        :value="$student->first_name_ar" required autofocus />
                </div>
                <div>
                    <x-label for="first_name_en" value="{{ __('First Name (English)') }}" />
                    <x-input id="first_name_en" class="block mt-1 w-full" type="text" name="first_name_en"
                        :value="$student->first_name_en" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="father_name_ar" value="{{ __('Father Name (Arabic)') }}" />
                    <x-input id="father_name_ar" class="block mt-1 w-full" type="text" name="father_name_ar"
                        :value="$student->father_name_ar" required />
                </div>
                <div>
                    <x-label for="father_name_en" value="{{ __('Father Name (English)') }}" />
                    <x-input id="father_name_en" class="block mt-1 w-full" type="text" name="father_name_en"
                        :value="$student->father_name_en" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="grandfather_name_ar" value="{{ __('Grandfather Name (Arabic)') }}" />
                    <x-input id="grandfather_name_ar" class="block mt-1 w-full" type="text"
                        name="grandfather_name_ar" :value="$student->grandfather_name_ar" required />
                </div>
                <div>
                    <x-label for="grandfather_name_en" value="{{ __('Grandfather Name (English)') }}" />
                    <x-input id="grandfather_name_en" class="block mt-1 w-full" type="text"
                        name="grandfather_name_en" :value="$student->grandfather_name_en" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="last_name_ar" value="{{ __('Last Name (Arabic)') }}" />
                    <x-input id="last_name_ar" class="block mt-1 w-full" type="text" name="last_name_ar"
                        :value="$student->last_name_ar" required />
                </div>
                <div>
                    <x-label for="last_name_en" value="{{ __('Last Name (English)') }}" />
                    <x-input id="last_name_en" class="block mt-1 w-full" type="text" name="last_name_en"
                        :value="$student->last_name_en" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$student->email"
                        required />
                </div>
                <div>
                    <x-label for="phone_number" value="{{ __('Phone Number') }}" />
                    <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                        :value="$student->phone_number" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="start_date" value="{{ __('Start Date') }}" />
                    <x-input id="start_date"
                        class="block mt-1 w-full {{ $student->status == 'suspended' ? 'disabled' : '' }}"
                        type="date" name="start_date" :value="$student->start_date" required />
                    <small
                        class="text-yellow-600">{{ $student->status == 'suspended' ? __('You cannot change the start date while the student is suspended.') : '' }}</small>
                </div>

                <div>
                    <x-label for="study_type" value="{{ __('Study Type') }}" />
                    <x-select id="study_type" name="study_type" class="block mt-1 w-full" required>
                        <option value="msc" {{ $student->study_type == 'msc' ? 'selected' : '' }}>
                            {{ __('Master') }}</option>
                        <option value="phd" {{ $student->study_type == 'phd' ? 'selected' : '' }}>
                            {{ __('PhD') }}</option>
                    </x-select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="admission_channel" value="{{ __('Admission Channel') }}" />
                    <x-select id="admission_channel" name="admission_channel" class="block mt-1 w-full" required>
                        <option value="private" {{ $student->admission_channel == 'private' ? 'selected' : '' }}>
                            {{ __('Private') }}</option>
                        <option value="public" {{ $student->admission_channel == 'public' ? 'selected' : '' }}>
                            {{ __('Public') }}</option>
                    </x-select>
                </div>

                <div>
                    <x-label for="academic_stage" value="{{ __('Academic Stage') }}" />
                    <x-select id="academic_stage" name="academic_stage" class="block mt-1 w-full" required>
                        <option value="preparatory" {{ $student->academic_stage == 'preparatory' ? 'selected' : '' }}>
                            {{ __('Preparatory Year') }}</option>
                        <option value="research" {{ $student->academic_stage == 'research' ? 'selected' : '' }}>
                            {{ __('Research Year') }}</option>
                    </x-select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="status" value="{{ __('Status') }}" />
                    <x-select id="status" name="status" class="block mt-1 w-full" required>
                        {{-- حالات ما قبل التخرج --}}
                        <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>
                            {{ __('Active') }}
                        </option>
                        <option value="suspended" {{ $student->status == 'suspended' ? 'selected' : '' }}>
                            {{ __('Suspended') }}
                        </option>

                        <option value="pending_review" {{ $student->status == 'pending_review' ? 'selected' : '' }}>
                            {{ __('Pending Review') }}
                        </option>

                        {{-- حالات ما بعد التخرج --}}
                        @if ($hasPostGraduation)
                            <option value="graduate"
                                {{ $student->postGraduationStep->post_graduation_status == 'graduate' ? 'selected' : '' }}>
                                {{ __('Graduate') }}
                            </option>
                            <option value="fail" {{ $student->postGraduationStep->post_graduation_status == 'fail' ? 'selected' : '' }}>
                                {{ __('Failed') }}
                            </option>
                            <option value="pending_review_pg"
                                {{ $student->postGraduationStep->post_graduation_status == 'pending_review' ? 'selected' : '' }}>
                                {{ __('Pending Review (Post Graduation)') }}
                            </option>
                        @endif
                    </x-select>
                </div>

                <div>
                    <x-label for="specialization_type_id" :value="__('Specialization Type')" />
                    <x-select id="specialization_type_id" name="specialization_type_id" class="block mt-1 w-full"
                        required>
                        <option value="">{{ __('Select Specialization Type') }}</option>
                        @foreach ($specializationTypes as $type)
                            <option value="{{ $type->id }}" @selected(old('specialization_type_id', $student->specialization_type_id) == $type->id)>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </x-select>
                </div>
            </div>

            <div>
                <x-label for="notes" value="{{ __('Notes') }}" />
                <x-textarea id="notes" name="notes"
                    class="block mt-1 w-full">{{ $student->notes }}</x-textarea>
            </div>

            {{-- ---------------- --}}
            <div id="extensions-container">
                <x-label for="study_type" class="text-lg font-semibold text-gray-700"
                    value="{{ __('Add Extension') }}" />

                @php
                    $firstAdded = $student->first_extension_date;
                    $secondAdded = $student->second_extension_date;
                @endphp


                @if (!$firstAdded)
                    <div id="first_extension" class="hidden flex items-center gap-2 p-4 bg-gray-100 rounded-lg mt-2">
                        <x-label for="first_extension_date" value="{{ __('First Extension') }}"
                            class="text-gray-600" />
                        <x-input id="first_extension_date" type="checkbox" name="first_extension_date"
                            :value="$firstAdded" class="w-5 h-5" />
                    </div>
                @endif

                @if ($firstAdded && !$secondAdded)
                    <p class="mt-4 text-sm text-green-600">{{ __('First extension has been added') }}</p>
                    <div id="second_extension" class="hidden flex items-center gap-2 p-4 bg-gray-100 rounded-lg mt-2">
                        <x-label for="second_extension_date" value="{{ __('Second Extension') }}" />
                        <x-input id="second_extension_date" type="checkbox" name="second_extension_date"
                            :value="$secondAdded" class="w-5 h-5" />
                    </div>
                @endif

                @if ($firstAdded && $secondAdded)
                    <p class="mt-4 text-sm text-green-600">{{ __('First extension has been added') }}</p>
                    <p class="mt-4 text-sm text-green-600">{{ __('Second extension has been added') }}</p>
                    <p class="mt-4 text-sm text-yellow-600">
                        {{ __('You can no longer add an extension - you have exceeded the limit') }}
                    </p>
                @endif

                <button id="add-extension-btn" type="button"
                    class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md btn-bg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 {{ $student->status == 'suspended' ? 'opacity-60' : '' }}"
                    {{ $student->status == 'suspended' ? 'disabled' : '' }}>
                    {{ !$firstAdded ? __('Add First Extension') : __('Add Second Extension') }}
                </button>
                @if ($student->status == 'suspended')
                    <p class="mt-4 text-sm text-yellow-600">
                        {{ __('You cannot add an extension while the student is suspended.') }}
                    </p>
                @endif
            </div>
            {{-- ------------ --}}

            <div class="flex justify-end mt-4">
                <x-button>
                    {{ __('Update Student') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const firstExtension = document.getElementById("first_extension");
        const secondExtension = document.getElementById("second_extension");
        const addExtensionBtn = document.getElementById("add-extension-btn");

        const btnNames = [
            "{{ __('Add First Extension') }}",
            "{{ __('Add Second Extension') }}"
        ];

        function updateButtonLabel() {
            if (firstExtension && firstExtension.classList.contains("hidden")) {
                addExtensionBtn.textContent = btnNames[0];
            } else if (secondExtension && secondExtension.classList.contains("hidden")) {
                addExtensionBtn.textContent = btnNames[1];
            } else {
                addExtensionBtn.classList.add("hidden");
            }
        }

        addExtensionBtn.addEventListener("click", function() {
            if (firstExtension && firstExtension.classList.contains("hidden")) {
                firstExtension.classList.remove("hidden");
                updateButtonLabel();
            } else if (secondExtension && secondExtension.classList.contains("hidden")) {
                secondExtension.classList.remove("hidden");
                updateButtonLabel();
            }
        });

        updateButtonLabel();
    });
</script>
