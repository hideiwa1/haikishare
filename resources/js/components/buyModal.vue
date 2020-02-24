<template>
    <div id="buyButton">
        <button @click="showModal" class="c-button c-button__submit u-w_50 u-m_auto">{{this.message}}</button>
        <div id="modal" class="p-modal p-modal-back" @click.self="closeModal" v-if="modalShow" v-cloak>
            <form method="post" :action="'/buy/'+url" class="p-modal--center u-center u-p_xl">
                <div class="u-mb_m">
                <input type="hidden" name="_token" :value="csrf">
                <input type="radio" value="today" v-model="day_flg">今日
                <input type="radio" value="after" v-model="day_flg">明日以降
                    <input type="date" name="visit" v-model="visit" v-if="day_flg === 'after'" class="c-form">
                </div>
                <input type="submit" class="c-button c-button__submit u-w_50 u-m_auto">
            </form>
        </div>
    </div>
</template>

<script>
    /*商品購入時の確認モーダル*/
    /*isShowフラグでモーダルを操作*/
    /*購入時に来店予定日を入力してもらう*/
    const moment = require('moment');
    export default {
        data: function() {
            return {
                /*csrfトークン*/
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                url: window.location.pathname.replace('/detail/', ''),
                modalShow: false,
                day_flg: 'today',
                visit: '',
                message: '購入する',
            };
        },
        filters: {
            moment: function(data) {
                return moment(data).format('YY/MM/DD HH:mm');
            }
        },
        computed: {

        },
        methods: {
            showModal(e) {
                console.log('click');
                if (this.modalShow == false) {
                    this.modalShow = !this.modalShow;
                }
            },
            closeModal(e) {
                if (this.modalShow == true) {
                    this.modalShow = !this.modalShow;
                }
            },
            /*stopEvent(){
                event.stopPropagation();
            }*/
        }
    };

</script>
