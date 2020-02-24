<template>
    <div id="attention">
        <button @click="handleShow" class="c-button c-button__submit">
            <slot></slot>
        </button>
        <div v-if="isShow" @click.self="closeModal" class="p-modal p-modal-back" v-cloak>
            <div class="p-modal--center u-center u-p_xl">
                <p class="c-title">本当にキャンセルしますか？</p>
                <button type="submit" @click="handleClick" :id=this.value class="c-button c-button__submit u-w_50 u-m_auto">キャンセルする</button>
            </div>
        </div>
    </div>
</template>

<script>
    /*キャンセル時の確認モーダル*/
    /*isShowフラグでモーダルを操作*/
    const axios = require('axios');
    const moment = require('moment');
    export default {
        props: ['value'],
        data() {
            return {
                isShow: false,
            };
        },
        methods: {
            handleShow() {
                this.isShow = true;
            },
            closeModal() {
                this.isShow = false;
            },
            handleClick(e) {
                this.isShow = false;
                this.$emit('click', e.target.id);
                console.log(e.target.id);
            }
        }
    }






    /*
    import Vue from 'vue';

    Vue.component('button-attend', {
        props: ['isShow'],
        template: 
        `<button @click="modalShow"><slot></slot></button>`,
        methods: {
            modalShow(){
                console.log('kurikku');
                this.$emit('click');
            }
        }

    })
    new Vue({
        el: '#attention',
        data(){
            return {
                isShow: false,
            }
        },
        methods: {
            handleShow(){
                console.log('kurikku');
                this.isShow = true;
            },
            closeModal(){
                this.isShow = false;
            }
        },
    })*/

</script>
