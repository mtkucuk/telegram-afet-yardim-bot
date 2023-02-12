<template>
    <div
        class="p-4 bg-white border border-gray-500		 rounded-lg shadow-sm dark:bg-zinc-200	 dark:border-gray-500		">
        <div class="items-center justify-between mb-3  flex">
            <time class="mb-1 text-xs font-normal text-black  order-last  mb-0">{{ data.date }}</time>
            <div class="mb-1 text-xs font-normal text-black     mb-0">
                {{ data.hour }}
            </div>
        </div>
        <div class="items-center justify-between mb-3 flex">
            <div class="mb-1 text-xs font-normal text-black   mb-0">
                {{ data.first_name }} {{ data.last_name }}
            </div>
        </div>
        <section :class="class">


            <!-- Text -->
            <div
                class="p-3 text-xs italic font-normal text-black border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:bg-zinc-200 h-44	flex items-center   justify-center text-center					"

                v-if="data.action_type=='text'"
            >
                {{ data.action_value }}
            </div>

            <!-- photo -->
            <a v-if="data.action_type=='photo'" :href="data.action_value" target="_blank">
                <img :src="data.action_value" class="mx-auto  	max-h-full	"
                     src="https://via.placeholder.com/500" alt="">
            </a>

            <!-- video -->
            <video v-if="data.action_type=='video'" controls
                   :class="videoClass"
                    >
                <source
                    :src="data.action_value"
                    type="video/mp4">
            </video>


            <iframe
                v-if="data.action_type=='location'"
                :src="'https://maps.google.com/maps?q='+data.action_value.latitude+','+data.action_value.longitude+'&hl=tr&z=14&amp;output=embed'"
                style="border:0;" allowfullscreen="" loading="lazy"
                class="w-full aspect-video "
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        <!-- Share -->
        <div class="sharing-buttons flex flex-wrap mt-2">
            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-1 rounded text-white border-blue-600 bg-blue-600 hover:bg-blue-700 hover:border-blue-700"
               target="_blank" rel="noopener" :href="'https://facebook.com/sharer/sharer.php?u='+data.share_link"
               aria-label="Share on Facebook">
                <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 512 512" class="w-4 h-4">
                    <title>Facebook</title>
                    <path
                        d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z">
                    </path>
                </svg>
            </a>

            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-1 rounded text-white border-blue-600 bg-blue-600 hover:bg-blue-700 hover:border-blue-700"
               target="_blank" rel="noopener" :href="'https://twitter.com/intent/tweet?url='+data.share_link"
               aria-label="Share on Twitter">
                <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 512 512" class="w-4 h-4">
                    <title>Twitter</title>
                    <path
                        d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "List",
    props:['data','class','videoClass']
}
</script>

<style scoped>

</style>
