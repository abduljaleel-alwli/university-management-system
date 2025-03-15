<!-- Modal -->
<div id="departmentModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black opacity-50" onclick="closeModal()"></div>

        <div class="bg-white rounded-lg shadow-lg w-full max-w-md relative z-50">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-semibold" id="modal-title">{{ __('Add Department') }}</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <div class="p-4">
                <form id="departmentForm" onsubmit="submitForm(event)">
                    <div class="mb-4">
                        <label for="name_ar" class="block text-sm font-medium text-gray-700">{{ __('Name (Arabic)') }}</label>
                        <input type="text" id="name_ar" name="name_ar"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="name_en" class="block text-sm font-medium text-gray-700">{{ __('Name (English)') }}</label>
                        <input type="text" id="name_en" name="name_en"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div id="alertMessage" class="text-red-500"></div> <!-- رسالة الخطأ -->
                </form>
            </div>

            <div class="flex justify-end p-4 border-t">
                <button type="button"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-200"
                        onclick="closeModal()">
                    {{ __('Cancel') }}
                </button>
                <button type="submit"
                        class="bg-gray-500 btn hover:bg-blue-700 text-white font-bold py-2 px-3 rounded flex items-center gap-1"
                        id="handleSave">
                    {{ __('Save') }}
                </button>
            </div>
        </div>
    </div>
</div>
