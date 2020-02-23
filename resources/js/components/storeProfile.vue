<template>
<div id="storeProfile">
    <form enctype="multipart/form-data" method="post" action="/store/saveProfile" class="p-form">
        <h1 class="c-title u-center u-mb_m">プロフィール編集</h1>
        <input type="hidden" name="_token" :value="csrf">
        
        <div class="u-flex-form u-mb_m">
            <label class="c-form__title">プロフィール画像</label>
            <span>＊ドラッグ＆ドロップまたはクリック後ファイルを選択して下さい</span>
            <Liveview :pic="pic" @change="picChange" class="c-img__profile u-block u-m_auto"/>
            <p v-if="this.errMsg.pic" class="u-error">{{this.errMsg.pic}}</p>
    </div>
        <div  class="u-flex-form u-mb_m">
            <label class="c-form__title">名前<span class="u-require u-inline u-ml_l">＊必須</span></label>
            <input type="text" name='name' v-model="name" class="c-form c-form__text">
            <p v-if="this.errMsg.name" class="u-error">{{this.errMsg.name}}</p>
    </div>
        <div class="u-flex-form u-mb_m">
            <label class="c-form__title">支店名<span class="u-require u-inline u-ml_l">＊必須</span></label>
            <input type="text" name='branch' v-model="branch" class="c-form c-form__text">
            <p v-if="this.errMsg.branch" class="u-error">{{this.errMsg.branch}}</p>
    </div>
        <div class="u-flex-form u-mb_m">
            <label class="c-form__title">
                都道府県<span class="u-require u-inline u-ml_l">＊必須</span>
    </label>
            <select v-model="address1" name="address1" class="c-form c-form__select">
                <option value="" selected>選択してください▼</option>
                <option v-for="val in areaList" :value="val.id">
                    {{val.name}}
    </option>
    </select>
            <p v-if="this.errMsg.address1" class="u-error">{{this.errMsg.address1}}</p>
    </div>
        <div class="u-flex-form u-mb_m">
            <label class="c-form__title" >
                住所
    </label>
            <input type="text" name="address2" v-model="address2"  class="c-form c-form__text">
            <p v-if="this.errMsg.address2" class="u-error">{{this.errMsg.address2}}</p>
    </div>
        <div class="u-flex-form u-mb_m">
            <label class="c-form__title">
                コメント
    </label>
            <input type="text" name="comment" v-model="comment" class="c-form c-form__text">
            <p v-if="this.errMsg.comment" class="u-error">{{this.errMsg.comment}}</p>
    </div>

        <div class="u-flex-form u-mb_xl">
            <label class="c-form__title">
                メールアドレス<span class="u-require u-inline u-ml_l">＊必須</span>
    </label>
            <input type="text" name="email" v-model="email"  class="c-form c-form__text">
            <p v-if="this.errMsg.email" class="u-error">{{this.errMsg.email}}</p>
    </div>
        <p>パスワードを変更する際は、下記に入力してください</p>
        <div class="u-flex-form u-mb_m">
            <label class="c-form__title">現在のパスワード</label>
            <input type="password" name="current_password" v-model="current_password" class="c-form c-form__text">
            <p v-if="this.errMsg.current_password" class="u-error">{{this.errMsg.current_password}}</p>
    </div>
        <div class="u-flex-form u-mb_m">
            <label class="c-form__title">新しいパスワード</label>
            <input type="password" name="new_password" v-model="new_password" class="c-form c-form__text">
            <p v-if="this.errMsg.new_password" class="u-error">{{this.errMsg.new_password}}</p>
    </div>
        <div class="u-flex-form u-mb_xl">
            <label class="c-form__title">新しいパスワード（再入力）</label>
            <input type="password" name="new_password_confirmation" v-model="new_password_confirmation" class="c-form c-form__text" >
            <p v-if="this.errMsg.new_password_confirmation" class="u-error">{{this.errMsg.new_password_confirmation}}</p>
    </div>
        <div>
            <input type="submit" :disabled="isValid" class="c-form c-button c-form__text c-button__link">
    </div>
    </form>
    </div>
</template>


<script>
     /*ストアプロフィールの編集*/
    const axios = require('axios');
    const moment = require('moment');
    //import modalmsg from './modalmsg.vue';
    import Liveview from './liveview.vue';
    export default {
        components: {Liveview},
        data() {
            return {
                /*csrfトークン*/
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                areaList: [],
                name: this.name,
                branch: this.branch,
                address1: this.address1,
                address2: this.address2,
                comment: this.comment,
                email: this.email,
                pic: this.pic,
                current_password: this.current_password,
                new_password: this.new_password,
                new_password_confirmation: this.new_password_confirmation,
            };
        },
        mounted() {
            /*プロフィール情報の取得*/
            axios.get('/store/storeProfile/json')
                .then(response => {
                console.log(response.data);
                this.name = response.data.name;
                this.branch = response.data.branch;
                this.address1 = response.data.address1;
                this.address2 = response.data.address2;
                this.comment = response.data.comment;
                this.email = response.data.email;
                this.pic = response.data.pic;
                this.current_password = '';
                this.new_password = '';
                this.new_password_confirmation = '';
            });
            /*都道府県の取得*/
            axios.get('/arealist/json')
                .then(response => {
                this.areaList = response.data;
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
                /*バリデーション*/
                let isValid = false;
                const errMsgRequire = '入力必須項目です',
                      errMsgInteger = '半角数字で入力してください',
                      errMsgEmail = 'email形式で入力してください',
                      errMsgMax = '190文字以内で入力してください',
                errMsgDiscord = '再入力と一致しません',
                    errMsgMin = '4文字以上で入力してください';
                return{
                    name: (()=>{
                        /*必須、最大文字数*/
                        if(!this.name){
                            return errMsgRequire;
                        }else{
                            if(this.name.length > 190){
                                return errMsgMax;
                            }
                            return '';
                        }
                    })(),
                    branch: (()=>{
                        /*必須、最大文字数*/
                        if(!this.branch){
                            return errMsgRequire;
                        }else{
                            if(this.branch.length > 190){
                                return errMsgMax;
                            }
                            return '';
                        }
                    })(),
                    address1: (()=>{
                        /*必須、数字*/
                        if(!this.address1){
                            return errMsgRequire;
                        }else{
                            if(!(/^\d*$/.test(this.address1))){
                                return errMsgInteger;
                            }else{
                                return '';
                            }}
                    })(),
                    email: (()=>{
                        /*必須、メール系式*/
                        if(!this.email){
                            return errMsgRequire;
                        }else{
                            if(!(/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(this.email))){
                                return errMsgEmail;
                            }else{
                                return '';
                            }}
                    })(),
                    current_password: (() => {
                        if(!this.current_password && this.new_password){
                            return errMsgRequire;
                        }else{
                            return '';
                        }
                    })(),
                    new_password: (() => {
                        if(this.new_password !== this.new_password_confirmation){
                            return errMsgDiscord;
                        }else if(this.new_password.length < 4 && this.new_password.length > 0){
                            return errMsgMin;
                        }else{
                            return '';
                        }
                    })(),
                }
            },
            isValid(){
                /*エラーがなければ送信ボタンをアクティブに*/
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
