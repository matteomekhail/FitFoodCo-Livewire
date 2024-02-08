<div class="{{ $showModal ? 'fixed inset-0 z-50 overflow-y-auto bg-gray-500 bg-opacity-75 transition-opacity' : 'hidden' }}"
    aria-labelledby="modal-title" role="dialog" aria-modal="true" wire:click.self="closeModal">
    @if ($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-500 bg-opacity-75 transition-opacity"
            aria-labelledby="modal-title" role="dialog" aria-modal="true" wire:click.self="closeModal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:items-center sm:p-0">
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    onclick="event.stopPropagation()">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex justify-center items-center"
                                    id="modal-title">
                                    <!-- Dinamically change tab style based on active form -->
                                    <a class="cursor-pointer mx-2 {{ $form === 'login' ? 'text-blue-500' : 'text-gray-400' }}"
                                        wire:click="showForm('login')">Login</a>
                                    <span>|</span>
                                    <a class="cursor-pointer mx-2 {{ $form === 'register' ? 'text-blue-500' : 'text-gray-400' }}"
                                        wire:click="showForm('register')">Register</a>
                                </h3>
                                <div class="mt-2">
                                    @if ($form === 'login')
                                        <!-- Form di login -->
                                        <form wire:submit.prevent="login"
                                            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                            <div class="mb-4">
                                                <label class="block text-gray-700 text-sm font-bold mb-2"
                                                    for="email">Email</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    type="email" id="email" wire:model="email">
                                            </div>
                                            <div class="mb-6">
                                                <label class="block text-gray-700 text-sm font-bold mb-2"
                                                    for="password">Password</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                                    type="password" id="password" wire:model="password">
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <button
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                    type="submit">Login</button>
                                            </div>
                                        </form>
                                    @elseif ($form === 'register')
                                        <!-- Form di registrazione -->
                                        <form wire:submit.prevent="register"
                                            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                            <div class="mb-4">
                                                <label class="block text-gray-700 text-sm font-bold mb-2"
                                                    for="name">Name</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    type="text" id="name" wire:model="name">
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-gray-700 text-sm font-bold mb-2"
                                                    for="email">Email</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    type="email" id="email" wire:model="email">
                                            </div>
                                            <div class="mb-6">
                                                <label class="block text-gray-700 text-sm font-bold mb-2"
                                                    for="password">Password</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                                    type="password" id="password" wire:model="password">
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <button
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                    type="submit">Register</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm"
                            wire:click="closeModal">
                            Chiudi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
