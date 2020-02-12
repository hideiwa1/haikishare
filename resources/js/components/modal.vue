<template>
    <div id="modal" class="p-modal">
        <nav class="p-modal-menu">
            <ul v-if="user == ''">
                <li class="p-navmenu__item">
                    <a href='/product' class="c-button u-white">商品検索</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/login' class="c-button u-white">買いたい方</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/store/login' class="c-button u-white">売りたい方</a>
                </li>
            </ul>
            <ul v-if="user == 'user'">
                <li class="p-navmenu__item">
                    <a href='/product' class="c-button u-white">商品検索</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/mypage' class="c-button u-white">マイページ</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/profileEdit' class="c-button u-white">プロフィール編集</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/buylist' class="c-button u-white">購入履歴</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/logout' class="c-button u-white">ログアウト</a>
    </li>
            </ul>
            <ul v-if="user == 'store'">
                <li class="p-navmenu__item">
                    <a href='/product' class="c-button u-white">商品検索</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/store/mypage' class="c-button u-white">ストアマイページ</a>
                </li>
                <li class="p-navmenu__item">
                    <a href='/store/profileEdit' class="c-button u-white">プロフィール編集</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/store/productlist' class="c-button u-white">登録商品一覧</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/store/salelist' class="c-button u-white">販売履歴</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/store/registProduct' class="c-button u-white">新規商品登録</a>
    </li>
                <li class="p-navmenu__item">
                    <a href='/store/logout' class="c-button u-white">ログアウト</a>
    </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    /*スマホ画面用のモーダルメーニュー*/
    const moment = require('moment');
    export default {
        data: function(){
            return{
                /*csrfトークン*/
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
