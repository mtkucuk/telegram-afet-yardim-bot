<template>
    <div class="relative bg-white">
        <div class="mx-auto    px-7 container     text-center">
            <div
                class="flex items-center justify-between border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <router-link :to="{name:'home'}">
                        TELEGRAM DEPREM DESTEK BOTU

                    </router-link>
                </div>
                <div class="-my-2 -mr-2 md:hidden">
                    <button type="button"
                            class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            aria-expanded="false">
                        <span class="sr-only">Open menu</span>
                        <!-- Heroicon name: outline/bars-3 -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                    </button>
                </div>
                <nav class="hidden space-x-10 md:flex ">


                    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">Paylaş</a>

                    <router-link :to="{name:'links'}" class="text-base font-medium text-gray-500 hover:text-gray-900">
                        Yararlı Linkler
                    </router-link>

                    <router-link :to="{name:'kvkk'}" class="text-base font-medium text-gray-500 hover:text-gray-900">
                        Kvkk
                    </router-link>

                </nav>
            </div>
        </div>
        <!--        <div class="absolute inset-x-0 top-0 origin-top-right transform p-2 transition md:hidden">
                    <div class="divide-y-2 divide-gray-50 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                        <div class="px-5 pt-5 pb-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                                </div>
                                <div class="-mr-2">
                                    <button type="button" class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                        <span class="sr-only">Close menu</span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-6">
                                <nav class="grid gap-y-8">
                                    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">Paylaş</a>
                                    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">Yararlı Linkler</a>
                                    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">Kvkk</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>-->
    </div>

</template>

<script>
export default {
    name: "header"
}
</script>

<style scoped>

</style>
