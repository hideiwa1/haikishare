<template>
    <div id="attention">
        <button @click="handleShow"><slot></slot></button>
        <div v-if="isShow" @click.self="closeModal">
            本当にキャンセルしますか？
            <button type="submit" @click="handleClick" :id=this.value>キャンセルする</button>
        </div>
    </div>
</template>

<script>
    const axios = require('axios');
    const moment = require('moment');
    export default {
        props: ['value'],
        data(){
            return {
                isShow: false,
            };
        },
        methods: {
            handleShow(){
                this.isShow = true;
            },
            closeModal(){
                this.isShow = false;
            },
            handleClick(e){
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