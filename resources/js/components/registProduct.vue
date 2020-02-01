<template>
    <div id="registProduct">
        <form enctype="multipart/form-data" method="post" :action="'/store/saveJson/' + this.url">
            <input type="hidden" name="_token" :value="csrf">
            <div>
                <label>商品名</label>
                <input type="text" name='name' v-model="name">
            </div>
            <Liveview :pic="pic" @change="picChange" />
            <div>
                <label>
                    JANコード
                </label>
                <input type="num" name="jan" v-model="jan" @change="searchJan">
                <p v-if="this.errMsg.jan">{{this.errMsg.jan}}</p>
            </div>
            <div>
                <label>
                    価格
                </label>
                <input type="num" name="price" v-model="price">
            </div>
            
            <div>
                <label>
                    賞味期限・品質保持期限
                </label>
                <input type="radio" name="limit_flg" value=false v-model="limit_flg">期限なし
                <input type="radio" name="limit_flg" value=true v-model="limit_flg">期限あり
                <input type="datetime-local" name="limit" v-model="limit" v-if="limit_flg !== 'false'">
            </div>
            <div>
                <input type="submit" :disabled="isValid" >
            </div>
        </form>
    </div>
</template>


<script>
    const axios = require('axios');
    const moment = require('moment');
    //import modalmsg from './modalmsg.vue';
    import Liveview from './liveview.vue';
    export default {
        components: {Liveview},
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                url: (window.location.pathname !== '/store/registProduct') ? window.location.pathname.replace('/store/registProduct/', '') : 'new',
                name: this.name,
                jan: this.jan,
                price: this.price,
                limit_flg: 'false',
                limit: this.limit,
                pic: this.pic,
            };
        },
        mounted() {
            if (this.url !== 'new') {
                const param = {
                    id: this.url,
                };
                axios.get('/store/registProductJson', {
                        params: param
                    })
                    .then(response => {
                        console.log(response.data);
                        this.name = response.data.name;
                    this.jan = response.data.jan;
                    this.price = response.data.price;
                    this.limit = moment(response.data.limit).format('YYYY-MM-DDThh:mm');
                    this.limit_flg = this.limit && 'true';
                    this.pic = response.data.pic;
                    });
                
            }
        },
        filters: {
            moment: function(data) {
                return moment(data).format('YY/MM/DD HH:mm');
            }
        },
        computed: {
            errMsg(){
                let isValid = false;
                const errMsgRequire = '入力必須項目です',
                      errMsgInteger = '半角数字で入力してください',
                      errMsgMax = '190文字以内で入力してください';
                return{
                    name: (()=>{
                        if(!this.name){
                            return errMsgRequire;
                        }else{
                            if(this.name.length > 190){
                                return errMsgMax;
                            }
                            return '';
                        }
                    })(),
                    jan: (()=>{
                        if(this.jan && !(/^\d*$/.test(this.jan))){
                            return errMsgInteger;
                        }else{
                            return '';
                        }
                    })(),
                    price: (()=>{
                        if(!this.price){
                            return errMsgRequire;
                        }else{
                           if(!(/^\d*$/.test(this.price))){
                            return errMsgInteger;
                        }else{
                            return '';
                        }}
                    })(),
                    limit: (()=>{
                        if(!this.limit && this.limit_flg === 'true'){
                            return errMsgRequire;
                        }else{
                            return '';
                        }
                    })(),
                    pic: (()=>{
                        if(!this.pic){
                            return errMsgRequire;
                        }else{
                            return '';
                        }
                    })(),
                }
            },
            isValid(){
                if(Object.values(this.errMsg).filter(value => {return value !== '';}).length === 0){
                    return false;
                }else{
                    return true;
                }
            },

        },
        methods: {
            picChange(data) {
                console.log(data);
                this.pic = data.pic;
            },
            searchJan(){
                const param = {
                    jan: this.jan,
                };
                axios.get('/store/searchJan',{
                    params: param,
                })
                .then(response =>{
                    console.log(response.data);
                    if(response.data.length !== 0){
                    this.name = response.data.name;
                    this.price = response.data.price;
                    this.pic = response.data.pic;
                    }
                });
            }
            /*handleSubmit(){
                const param = {
                    id: this.url,
                    name: this.name,
                    jan: this.jan,
                    price: this.price,
                    limit: this.limit,
                    pic: this.pic,
                };
                axios.post('/store/saveJson',param,
                )
                        .then(response => {
                        console.log(response.data);
                })
                
            }*/
        }
    }

</script>
