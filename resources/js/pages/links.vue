<template>
    <div class="w-full">

        <h2 class="mb-2 text-2xl mt-5 font-semibold text-gray-900 dark:text-black">Yararlı Linkler</h2>
        <ul class="  space-y-1 mt-7 text-gray-500 list-disc list-inside dark:text-gray-400 list-none w-full">
            <li v-for="(linkVal,linkKey) of links" :key="linkKey"
                class="w-full border border-slate-400 mb-33 radius rounded-md">
                <a class="text-black flex text-md  		w-full	p-2" :href="linkVal.link" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-4 h-4 mt-1 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                    </svg>

                    {{ linkVal.title }}
                </a>
            </li>

        </ul>

    </div>
</template>

<script>
export default {
    name: "links",
    data() {
        return {
            'links': [
                {
                    'title': 'Afet Bilgi Sitesi',
                    'link': 'https://www.afetbilgi.com'
                }, {
                    'title': 'Afet Çözüm - Tüm Yardım Linkleri',
                    'link': 'https://afetcozum.com'
                },
                {
                    'title': 'Afet Destek',
                    'link': 'https://afetdestek.com/index.asp'
                },
                {
                    'title': 'Afet Haritası',
                    'link': 'https://afetharita.com'
                },
                {
                    'title': 'Ahbap',
                    'link': 'https://twitter.com/ahbap'
                },
                {
                    'title': 'Deprem Enkaz Haritası',
                    'link': 'https://depremenkaz.xyz'
                },
                {
                    'title':'Deprem Güvenli Bölgeler Haritası',
                    'link':'https://www.google.com/maps/d/viewer?mid=1aQ0TJi4q_46XAZiSLggkbTjPzLGkTzQ&ll=37.06301742072887%2C37.28739713964324&z=9'
                },
                {
                    'title':'Enkaz Dinleme Uygulaması',
                    'link':'https://web.itu.edu.tr/sariero/dinleme.html?fbclid=PAAabbvVvqgKsFHaaPV8b1RjzuerCq1hwvEubQkyvzFjt8T71AleGIwpflHrs'
                },
                {
                    'title':'Ev İlanları',
                    'link':'https://misafirol.org/?fbclid=PAAabqZsyepBcJ0WaBhEn8erCckSG9Bo5alcRIQvxMH8dh_nnrA6RtuCReeMs'
                },
                {
                    'title':'İhtiyaç Haritası',
                    'link':'https://twitter.com/ihtiyacharitasi'
                },
                {
                    'title':'T.C. İçişleri Bakanlığı Afet ve Acil Durum Yönetimi Başkanlığı (AFAD) Resmi Hesabıdır',
                    'link':'https://twitter.com/AFADBaskanlik'
                },
                {
                    'title':'Ücretsiz Hoteller',
                    'link':'https://www.otelz.com/tr/gecmisolsunturkiyem'
                },
                {
                    'title':'Yakınımı Bul - Hastane Listesi',
                    'link':'https://yakinimibul.net/'
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
