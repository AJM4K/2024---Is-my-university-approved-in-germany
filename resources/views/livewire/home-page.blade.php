<div class="flex flex-col items-center justify-center m-5">
    {{-- Success is as dangerous as failure. --}}

   {{-- <h1>Hello from livewire homepage</h1> --}} 

    <div class="flex flex-col items-center justify-center m-5">
        <!-- Show form for email/phone number if the user is not verified -->
        @if ($showForm)
        <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">الدخول للمنصة</h1>
        <p class="max-w-2xl mb-4 tracking-tight leading-none md:text-2xl xl:text-3xl dark:text-white">قم بادخال الايميل او رقم الهاتف و لا يحتاج الى انشاء حساب</p>
     
        <div class="space-y-4 w-96 text-right">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ايميل</label>
                <input type="email" wire:model="email" id="email" class="bg-gray-50 border text-right border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="اكتب ايميلك هنا">
                @error('email')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
            </div>
            <div>
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">رقم الهاتف</label>
                <input type="text" wire:model="phone" id="phone" class="bg-gray-50 border text-right border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="اكتب رقمك هنا">
                @error('phone')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
            </div>
            @if ($errorMessage)
                <div class="text-red-600">{{ $errorMessage }}</div>
            @endif
            <button wire:click="submitForm" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">الدخول للمنصة</button>
        </div>
        @else

        <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">اختر</h1>
        <p class="max-w-2xl mb-4 tracking-tight text-center leading-none md:text-2xl xl:text-3xl dark:text-white">قم باختيار المحافظة ثم الجامعة و اضغط على زر التحقق للتاكد من هل جامعتك معترفة ام تحتاج معادلة</p>
     
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
    
    

</div>
