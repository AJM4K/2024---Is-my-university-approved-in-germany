<div class="flex flex-col items-center justify-center m-5">
    {{-- Success is as dangerous as failure. --}}

    <h1>Hello from livewire homepage</h1>
    <div>
        <!-- Show form for email/phone number if the user is not verified -->
        @if (!$isUserVerified)
            <div class="space-y-4 text-right w-96">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    البريد الإلكتروني
                </label>
                <input
                    wire:model="email"
                    type="email"
                    id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="ادخل البريد الإلكتروني"
                >
                
                <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    أو رقم الهاتف
                </label>
                <input
                    wire:model="phone_number"
                    type="text"
                    id="phone_number"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="ادخل رقم الهاتف"
                >
    
                @error('contact')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
    
                <button wire:click="verifyUser" class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    ارسال المعلومات
                </button>
            </div>
        @else
            <!-- Governance and University dropdowns shown if user is verified -->
            <div class="space-y-4 text-right w-96">
                <!-- Governance Dropdown -->
                <div>
                    <label for="governance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        المحافظة
                    </label>
                    <select wire:model="selectedGovernance" wire:change="onGovernanceChange($event.target.value)" id="governance"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="">اختر محافظة</option>
                        @foreach ($governances as $governance)
                        <option value="{{ $governance->id }}">{{ $governance->name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <!-- University Dropdown -->
                <div>
                    <label for="university" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الجامعة</label>
                    <select wire:model="selectedUniversity" id="university" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="">اختر الجامعة</option>
                        @foreach ($universities as $university)
                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <button wire:click="checkValidity" type="submit" class="text-white my-8 inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    التحقق من حالة الاعتراف
                </button>
    
                @if($message)
                    <div class="mt-4 p-4 border rounded-md {{ $isUniversityValid == true ? 'bg-green-100 border-green-300 text-green-800' : ($isUniversityValid == false ? 'bg-red-100 border-red-300 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                        {{ $message }}
                    </div>
                @endif
            </div>
        @endif
    </div>
    
    

    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div
            class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5"
        >
            <!-- Modal header -->
            <div
                class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600"
            >
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add Product
                </h3>
                <button
                    type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="defaultModal"
                >
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="#">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Name</label
                        >
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name"
                            required=""
                        />
                    </div>
                    <div>
                        <label
                            for="brand"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Brand</label
                        >
                        <input
                            type="text"
                            name="brand"
                            id="brand"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Product brand"
                            required=""
                        />
                    </div>
                    <div>
                        <label
                            for="price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Price</label
                        >
                        <input
                            type="number"
                            name="price"
                            id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="$2999"
                            required=""
                        />
                    </div>
                    <div>
                        <label
                            for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Category</label
                        >
                        <select
                            id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        >
                            <option selected="">Select category</option>
                            <option value="TV">TV/Monitors</option>
                            <option value="PC">PC</option>
                            <option value="GA">Gaming/Console</option>
                            <option value="PH">Phones</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label
                            for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Description</label
                        >
                        <textarea
                            id="description"
                            rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-primary-500"
                            placeholder="Write product description here"
                        ></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>
