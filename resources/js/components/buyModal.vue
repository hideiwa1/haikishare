<template>
    <div id="buyButton">
        <button @click="showModal">{{this.message}}</button>
        <div id="modal" class="p-modal" @click.self="closeModal" v-if="modalShow">
            <form method="post" :action="'/buy/'+url" >
                <input type="hidden" name="_token" :value="csrf">
                <input type="radio" value="today" v-model="day_flg">今日
                <input type="radio" value="after" v-model="day_flg">明日以降
                <input type="date" name="visit" v-model="visit" v-if="day_flg === 'after'">
                <input type="submit">
            </form>
        </div>
    </div>
</template>

<script>
    const moment = require('moment');
    export default {
        data: function() {
            return {
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
