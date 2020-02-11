<template>
    <div id="modal" class="p-modal">
        <nav class="p-modal-menu">
            <ul v-if="user == ''">
                <li class="p-navmenu__item">
                    <a href='/product' class="c-button">商品検索</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/login' class="c-button">買いたい方</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/store/login' class="c-button">売りたい方</a>
                </li>
            </ul>
            <ul v-if="user == 'user'">
                <li class="p-navmenu__item">
                    <a href='/product' class="c-button">商品検索</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/mypage' class="c-button">マイページ</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/profileEdit' class="c-button">プロフィール編集</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/buylist' class="c-button">購入履歴</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/logout' class="c-button">ログアウト</a>
    </li>
            </ul>
            <ul v-if="user == 'store'">
                <li class="p-navmenu__item">
                    <a href='/product' class="c-button">商品検索</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/store/mypage' class="c-button">ストアマイページ</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/store/profileEdit' class="c-button">プロフィール編集</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/store/productlist' class="c-button">登録商品一覧</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/store/salelist' class="c-button">販売履歴</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/store/registProduct' class="c-button">新規商品登録</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/store/logout' class="c-button">ログアウト</a>
    </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    const moment = require('moment');
    export default {
        data: function(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            };
        },
        props: ['user'],
        filters: {
            moment: function(data) {
                return moment(data).format('YY/MM/DD HH:mm');
            }
        },
        computed: {

        },
        methods: {

        }
    };

</script>
