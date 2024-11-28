<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <div class="mt-5">

            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign up</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                    Already have an account
                    <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500"
                        href="{{ route('login') }}">
                        Sign in here
                    </a>
                </p>
            </div>
            <div
                class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-neutral-500 dark:before:border-neutral-600 dark:after:border-neutral-600">
                Or</div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="grid gap-y-4">
                    <div>
                        <label for="name" class="block text-sm mb-2 dark:text-white">Name</label>
                        <div class="relative">
                            <input type="text" id="name" name="name"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required autofocus autocomplete="name">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>
                        <div class="relative">
                            <input type="email" id="email" name="email"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required autocomplete="username">
                            <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16" aria-hidden="true">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg>
                            </div>
                        </div>
                        <p class="hidden text-xs text-red-600 mt-2" id="email-error">Please include a valid email
                            address so we can get back to you</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required autocomplete="new-password">
                            <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16" aria-hidden="true">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg>
                            </div>
                        </div>
                        <p class="hidden text-xs text-red-600 mt-2" id="password-error">8+ characters required</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm mb-2 dark:text-white">Confirm
                            Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required autocomplete="new-password">
                            <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16" aria-hidden="true">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg>
                            </div>
                        </div>
                        <p class="hidden text-xs text-red-600 mt-2" id="confirm-password-error">Password does not match
                            the password</p>
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="flex items-center">
                        <div class="flex">
                            <input id="terms" name="terms" type="checkbox"
                                class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                required>
                        </div>
                        <div class="ms-3">
                            <label for="terms" class="text-sm dark:text-white">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                    class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500">'.__('Terms
                                    of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                    class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500">'.__('Privacy
                                    Policy').'</a>',
                                ]) !!}
                            </label>
                        </div>
                    </div>
                    @endif

                    <button type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Sign
                        up
                    </button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>