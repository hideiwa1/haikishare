<template>
   <div id="menu">
       <ul class="p-navmenu u-flex" v-if="user == ''">
           <li class="p-navmenu__item">
               <a href='/product' class="c-button c-button__menu">商品検索</a>
            </li>
           <li class="p-navmenu__item">
               <a href='/login' class="c-button c-button__menu">買いたい方</a>
            </li>
           <li class="p-navmenu__item">
               <a href='/store/login' class="c-button c-button__menu">売りたい方</a>
            </li>
    </ul>
    <ul class="p-navmenu u-flex" v-if="user == 'user'">
        <li class="p-navmenu__item">
            <a href='/product' class="c-button c-button__menu">商品検索</a>
        </li>
        <li class="p-navmenu__item">
            <a href='/mypage' class="c-button c-button__menu">マイページ</a>
        </li>
        <li class="p-navmenu__item">
            <form method="post" action="/logout">
                <input type="hidden" name="_token" :value="csrf">
                <input type='submit' class="c-button c-button__menu" value="ログアウト">
            </form>
        </li>
    </ul>
    <ul class="p-navmenu u-flex" v-if="user == 'store'">
        <li class="p-navmenu__item">
            <a href='/product' class="c-button c-button__menu">商品検索</a>
        </li>
        <li class="p-navmenu__item">
            <a href='/store/mypage' class="c-button c-button__menu">ストアマイページ</a>
        </li>
        <li class="p-navmenu__item">
           <form method="post" action="/store/logout">
               <input type="hidden" name="_token" :value="csrf">
               <input type='submit' class="c-button c-button__menu" value="ログアウト">
        </form>
        </li>
    </ul>
       <div class="p-menu-trigger" @click = "toggleModal">
           <span></span>
           <span></span>
           <span></span>
           <modal v-if="modalShow" :user="user" />
    </div>
    </div>
</template>

<script>
    const axios = require('axios');
    const moment = require('moment');
    import Modal from './modal.vue';
    export default {
        components: { Modal },
        data: function() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                modalShow: false,
                user: '',
            };
        },
        mounted() {
            axios.get('/auth/json')
                .then(response => {
                this.user = response.data;
                console.log(response.data);
            });
        },
        filters: {
            moment: function(data) {
                return moment(data).format('YY/MM/DD HH:mm');
            }
        },
        computed: {

        },
        methods: {
            toggleModal(e){
                console.log('this.modalShow'),
                this.modalShow = !this.modalShow
            },
        }
    };

</script>
