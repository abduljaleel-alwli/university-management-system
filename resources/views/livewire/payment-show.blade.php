    @php
        $isSuperAdmin = auth()->user()->hasRole('super-admin');
    @endphp

    <div class="p-6">
        <div id="payment-form" class="bg-white shadow-soft-xl rounded-2xl p-6 space-y-6">
            <div class="inline-block">
                <a href="@role('super-admin') {{ route('super-admin.payments.index') }} @else {{ route('admin.payments.index') }} @endrole"
                    class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    {{ __('Back to List') }}
                </a>
                <h2 id="update-title" class="text-2xl font-bold text-gray-800 hidden">{{ __('Update Payment') }}</h2>
            </div>


            @if (session()->has('message'))
                <div class="p-3 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="p-3 text-sm text-red-700 bg-red-100 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Receipt Number') }}</label>
                <div class="mt-2 p-3 bg-gray-100 text-gray-900 rounded-lg">
                    <p>{{ $receipt_number }}</p>
                </div>
            </div>

            <!-- الحقول الثلاثة في سطر واحد -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- مبلغ الدفع -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Amount') }}</label>
                    <input type="number" wire:model="amount"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        @if ($isSuperAdmin) disabled @endif>
                    @error('amount')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- العملة -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Currency') }}</label>
                    <select wire:model="currency"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        @if ($isSuperAdmin) disabled @endif>
                        <option value="IQD">{{ __('IQD') }}</option>
                        <option value="USD">{{ __('USD') }}</option>
                    </select>
                </div>

                <!-- تاريخ الدفع -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Payment Date') }}</label>
                    <input type="date" wire:model="payment_date"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        @if ($isSuperAdmin) disabled @endif>
                    @error('payment_date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- ملاحظات -->
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Note') }}</label>
                <textarea wire:model="notes"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    @if ($isSuperAdmin) disabled @endif></textarea>
            </div>

            @role('admin')
                @if ($this->receipt_number || $this->amount || $this->currency || $this->payment_date || $this->notes)
                    <div class="hidden" id="update-button">
                        <button wire:click="updatePayment"
                            class="w-full p-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                            {{ __('Update') }}
                        </button>
                    </div>
                @endif
            @endrole
        </div>


        <!-- بيانات الطالب -->
        <div class="bg-white shadow-soft-xl rounded-2xl p-6 mt-6">
            <h2 class="text-2xl font-bold text-gray-800 pb-6">{{ __('Student Details') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $fields = [
                        'first_name_ar' => __('First Name (Arabic)'),
                        'first_name_en' => __('First Name (English)'),
                        'father_name_ar' => __('Father Name (Arabic)'),
                        'father_name_en' => __('Father Name (English)'),
                        'grandfather_name_ar' => __('Grandfather Name (Arabic)'),
                        'grandfather_name_en' => __('Grandfather Name (English)'),
                        'last_name_ar' => __('Last Name (Arabic)'),
                        'last_name_en' => __('Last Name (English)'),
                        'email' => __('Email'),
                        'phone_number' => __('Phone Number'),
                    ];
                @endphp

                @foreach ($fields as $key => $label)
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                        <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                            <p class="text-gray-900">{{ $student->$key }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            @role('admin')
                <div class="flex">
                    <a href="{{ route('admin.students.show', ['student' => $student->id]) }}"
                        class="block bg-blue-600 text-white px-4 py-2 rounded-lg text-center mt-4 hover:bg-blue-700 transition btn-bg">
                        {{ __('View') }}
                    </a>
                    <a href="{{ route('admin.students.edit', ['student' => $student->id]) }}"
                        class="mx-2 block bg-yellow-400 text-white px-4 py-2 rounded-lg text-center mt-4 hover:bg-yellow-500 transition">
                        {{ __('Edit') }}
                    </a>
                </div>
            @elseif('super-admin')
                <a href="{{ route('super-admin.students.show', ['student' => $student->id]) }}"
                    class="block bg-blue-600 text-white px-4 py-2 rounded-lg text-center mt-4 hover:bg-blue-700 transition btn-bg">
                    {{ __('View') }}
                </a>
            @endrole
        </div>
    </div>


    @role('admin')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let form = document.getElementById("payment-form");
                let saveButton = document.getElementById("update-button");
                let updateTitle = document.getElementById("update-title");

                // مراقبة التغييرات داخل الفورم
                form.addEventListener("input", function() {
                    saveButton.classList.remove("hidden"); // إظهار الزر عند حدوث تغيير
                    updateTitle.classList.remove("hidden");
                });

                saveButton.addEventListener("click", function() {
                    setTimeout(() => {
                        saveButton.classList.add("hidden"); // إخفاء الزر بعد الحفظ
                        updateTitle.classList.add("hidden");
                    }, 1000);
                });
            });
        </script>
    @endrole
