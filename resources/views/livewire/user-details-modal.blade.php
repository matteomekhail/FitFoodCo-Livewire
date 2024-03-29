<div>
    @if ($isOpen)
        <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-gray-50 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">First
                                Name:</label>
                            <p class="text-gray-700 text-lg">{{ $user->first_name }}</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">Last Name:</label>
                            <p class="text-gray-700 text-lg">{{ $user->last_name }}</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email:</label>
                            <p class="text-gray-700 text-lg">{{ $user->email }}</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2"
                                for="membership">Membership:</label>
                            @if ($user->membership === null)
                                <p class="text-gray-700 text-lg">Not Subscribed to any membership</p>
                            @else
                                <p class="text-gray-700 text-lg">{{ $user->membership }}</p>
                            @endif
                        </div>
                        <!-- Aggiungi qui altri campi se necessario -->
                        <button type="button" wire:click="$set('isOpen', false)"
                            class="absolute top-0 right-0 text-red-500 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center ">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="absolute bottom-0 right-0 m-4">
                            <button wire:click="logout"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
