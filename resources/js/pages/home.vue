<template>
    <div class="p-3 flex items-center">
        <label for="voice-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text"
                   v-model="search"
                   class="bg-gray-50     text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-slate-600	 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Ad soyad.." required>
            <button v-if="search!=null" type="button" class="absolute inset-y-0 right-0 flex items-center pr-3"
                    @click="clearSearch">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

            </button>
        </div>
        <button type="submit"
                @click="inputSearch"

                class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-slate-400	 rounded-lg border   hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-slate-400	 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            ARA
        </button>
    </div>
    <div class="grid lg:grid-cols-4  md:grid-cols-2 sm:grid-cols-1 scrolling-component">

        <div class="p-3" v-for="d of data" :key="d.id">
            <List :data="d" :class="'hero container max-w-screen-lg mx-auto pb-1 h-44'"
                  :videoClass="'w-full aspect-video h-44 md:h-44 lg:h-44 sm:h-64'"></List>
        </div>
    </div>
    <div role="status" v-if="status" class="flex items-center   justify-center text-center">

        <svg aria-hidden="true"
             class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
             viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor"/>
            <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentFill"/>
        </svg>
        <span class="sr-only">yükleniyor...</span>

    </div>
    <div v-if="infoStatus" class="text-center w-full">
        {{ infoMessage }}
    </div>
    <div
        ref="scrollTopButton"
        class="  w-full flex justify-end bottom-0 pb-3 pr-5 transition  right-0 fixed"
    >
        <div
            class="text-white-400 hover:text-blue-400 transition"
        >
            <button @click="scrollToTop">
                YUKARI ÇIK
            </button>
        </div>
    </div>
</template>

<script>

import List from "../components/List.vue";

export default {
    name: "index",
    components: {
        List
    },

    data() {
        return {
            data: [],
            page: 1,
            status: false,
            search: null,
            timeout: null,
            paging: [],
            infoMessage: null,
            infoStatus: false,
            loaderStatus:true

        }
    },
    inject: ['$globalApi'],
    created() {
       /* window.Echo.channel(`telegram.support`)
        .listen('TelegramSupport', ($e) => {
                this.page = 1;
                this.data = [];
                this.search = null;
                this.telegramList();
        });*/
    },
    mounted() {

        window.addEventListener("scroll", this.handleScroll);
        window.addEventListener("scroll", this.loadMore);
        this.status = true;
        this.telegramList();
    },

    beforeUnmount() {
        window.removeEventListener("scroll", this.handleScroll);
        window.removeEventListener("scroll", this.loadMore)


    },
    methods: {
        loadMore(e) {
            const $ref = document.getElementById('general');
            const $bottom = $ref.getBoundingClientRect().bottom;
            const $innerHeight = window.innerHeight;

            if ($bottom < ($innerHeight + 2)) {
                const $page = this.paging.current_page;
                this.page = $page + 1;
                this.status = true;

                console.log("####################################### scroll #######################################  ");
                setTimeout(function () {
                    if (this.loaderStatus) {
                        this.telegramList()
                        this.loaderStatus = false;
                    }
                }.bind(this), 1000)
            } else {
                console.log("<---> else")
                this.loaderStatus = true;
            }
        },
        handleScroll($e) {
            const scrollBtn = this.$refs.scrollTopButton;

            if (window.scrollY > 0) {
                scrollBtn.classList.remove("invisible");
            } else {
                scrollBtn.classList.add("invisible");
            }


        },
        delay(t, v) {
            return new Promise(resolve => setTimeout(resolve, t, v));
        },
        clearSearch() {
            this.search = null;
            this.data = [];
            this.status = true;
            setTimeout(function () {
                console.log("set time out")
                this.isCalculating = false
                this.telegramList();
            }.bind(this), 1000)
        },
        inputSearch($e) {

            this.page = 1;
            this.data = [];
            this.status = true;
            console.log("<-->", this.data, "<--->");
            setTimeout(function () {
                console.log("set time out")
                this.isCalculating = false
                this.telegramList();
            }.bind(this), 1000)
        },
        scrollToTop() {
            window.scrollTo({top: 0, behavior: "smooth"});
        },
        debounce(fn, delay) {
            let timeout

            return (...args) => {
                if (timeout) {
                    clearTimeout(timeout)
                }
                console.log("debo")
                timeout = setTimeout(() => {
                    fn(...args)
                }, delay)
            }
        },
        telegramList() {
            let $data = this.$globalApi.list(this.page, this.search);

            $data.then(({data}) => {
                const $list = data.list;
                this.paging = data.paging;
                const $success = data.success;
                if ($success) {
                    $list.forEach($v => {
                        this.data.push($v);
                    })
                }
                console.log("list")
                this.status = false;
                this.infoStatus = false;
            })
                .catch((error) => {
                    this.infoMessage = error.response.data.message;
                    this.status = false;
                    this.infoStatus = true;
                    return Promise.reject(error)
                });

        }
    }


}
</script>
