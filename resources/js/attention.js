import Vue from 'vue';

Vue.component('button-attend', {
    props: ['isShow'],
    template: 
    `<button @click="modalShow" class="c-button c-button__submit u-w_50 u-m_auto"><slot></slot></button>`,
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