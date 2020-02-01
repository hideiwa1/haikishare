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
})