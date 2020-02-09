<template>
    <div id="registProduct">
        
        <form enctype="multipart/form-data" method="post" :action="'/store/saveJson/' + this.url" class="p-form">
            <h1 class="c-title u-center u-mb_m">商品登録・編集</h1>
            <input type="hidden" name="_token" :value="csrf">
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">商品名</label>
                <input type="text" name='name' v-model="name" class="c-form c-form__text">
            </div>
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">商品画像</label>
                <span>＊ドラッグ＆ドロップまたはクリック後ファイルを選択して下さい</span>
            <Liveview :pic="pic" @change="picChange" class="c-img__pic"/>
    </div>
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">カテゴリー</label>
                <select name='category' v-model="category" class="c-form c-form__select u-pl_m">
                    <option value="" selected>選択してください▼</option>
                    <option v-for="val in categoryList" :value="val.id">
                        {{val.name}}
    </option>
    </select>
    </div>
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">
                    JANコード
                </label>
                <input type="num" name="jan" v-model="jan" @change="searchJan" class="c-form c-form__text">
                <p v-if="this.errMsg.jan">{{this.errMsg.jan}}</p>
            </div>
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">
                    価格
                </label>
                <input type="num" name="price" v-model="price" class="c-form c-form__num">円
            </div>
            
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">
                    賞味期限・品質保持期限
                </label>
                <input type="radio" name="limit_flg" value=false v-model="limit_flg">期限なし
                <input type="radio" name="limit_flg" value=true v-model="limit_flg">期限あり
                <input type="datetime-local" name="limit" v-model="limit" v-if="limit_flg !== 'false'">
            </div>
            <div>
                <input type="submit" :disabled="isValid" class="c-form c-button c-form__text c-button__link">
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
                categoryList: [],
                name: "",
                jan: "",
                category: "",
                price: "",
                limit_flg: 'false',
                limit: "",
                pic: "",
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
            
            axios.get('/categorylist/json')
                .then(response => {
                this.categoryList = response.data;
                console.log(response.data);
            });
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
                      errMsgMax = '190文字以内で入力してください',
                      errMsgJan = '13文字で入力してください';
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
                            if(this.jan.length != '13'){
                                return errMsgJan;
                            }
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
                console.log(this.jan.length);
                if(this.jan.length == 13){
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
