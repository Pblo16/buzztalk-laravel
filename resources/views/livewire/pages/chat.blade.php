<div class="dark:text-white">
    <div class="grid grid-cols-[350px_1fr]">
        <div class="border-r-2 h-full">
            <div class="overflow-y-auto h-[calc(100vh-58px)]">
                <div class="flex items-center gap-3 p-3 cursor-pointer">
                    <div class="w-12 h-12 rounded-full bg-gray-300"></div>
                    <div class="flex-1">
                        <h3 class="font-medium">Contact</h3>
                        <p class="text-sm text-gray-500 truncate">Last message...</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col h-full ">
            <div class="p-4 flex items-center gap-3">
                <h2 class="font-black text-4xl">Current Chat</h2>
            </div>

            <div class="flex-1 overflow-y-auto p-4 space-y-4">
                <div class="flex justify-start">
                    <div class="message message-in">
                        Hello! How are you?
                    </div>
                </div>
                <div class="flex justify-end">
                    <div class="message message-out">
                        I&apos;m doing great, thanks for asking!
                    </div>
                </div>
            </div>

            <div class="p-4">
                <div class="flex gap-2">
                    <div class="flex-grow space-y-3">
                        <input type="text"
                            class="py-3 px-5 block w-full border-gray-200 rounded-full text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Input text">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>