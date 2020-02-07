<template>
    <div id="Profile">
        <form enctype="multipart/form-data" method="post" action="/saveProfile" class="p-form">
            <input type="hidden" name="_token" :value="csrf">
            <div>
                <label>名前</label>
                <input type="text" name='name' v-model="name"  class="c-form__text">
            </div>
            <Liveview :pic="pic" @change="picChange" />
            <div>
                <label>
                    都道府県
                </label>
                <select v-model="address1" name="address1">
                    <option v-for="val in areaList" :value="val.id">
                        {{val.name}}
                    </option>
                </select>
            </div>
            <div>
                <label>
                    住所
                </label>
                <input type="text" name="address2" v-model="address2">
                <p v-if="this.errMsg.jan">{{this.errMsg.jan}}</p>
            </div>
            <div>
                <label>
                    コメント
                </label>
                <input type="num" name="comment" v-model="comment">
            </div>

            <div>
                <label>
                    メールアドレス
                </label>
                <input type="text" name="email" v-model="email">
            </div>
            <p>パスワードを変更する際は、下記に入力してください</p>
            <div>
                <label>現在のパスワード</label>
                <input type="password" name="current_password">
            </div>
            <div>
                <label>新しいパスワード</label>
                <input type="password" name="new_password">
            </div>
            <div>
                <label>新しいパスワード（再入力）</label>
                <input type="password" name="new_password_confirmation">
            </div>
            <div>
                <input type="submit" :disabled="isValid">
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
        components: {
            Liveview
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                areaList: [],
                name: this.name,
                address1: this.address1,
                address2: this.address2,
                comment: this.comment,
                email: this.email,
                pic: this.pic,
            };
        },
        mounted() {
            axios.get('/userProfile/json')
                .then(response => {
                    console.log(response.data);
                    this.name = response.data.name;
                    this.address1 = response.data.address1;
                    this.address2 = response.data.address2;
                    this.comment = response.data.comment;
                    this.email = response.data.email;
                    this.pic = response.data.pic;
                });

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
            errMsg() {
                let isValid = false;
                const errMsgRequire = '入力必須項目です',
                    errMsgInteger = '半角数字で入力してください',
                    errMsgEmail = 'email形式で入力してください',
                    errMsgMax = '190文字以内で入力してください';
                return {
                    name: (() => {
                        if (!this.name) {
                            return errMsgRequire;
                        } else {
                            if (this.name.length > 190) {
                                return errMsgMax;
                            }
                            return '';
                        }
                    })(),
                    address1: (() => {
                        if (!this.address1) {
                            return errMsgRequire;
                        } else {
                            if (!(/^\d*$/.test(this.address1))) {
                                return errMsgInteger;
                            } else {
                                return '';
                            }
                        }
                    })(),
                    email: (() => {
                        if (!this.email) {
                            return errMsgRequire;
                        } else {
                            if (!(/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(this.email))) {
                                return errMsgEmail;
                            } else {
                                return '';
                            }
                        }
                    })(),
                }
            },
            isValid() {
                if (Object.values(this.errMsg).filter(value => {
                        return value !== '';
                    }).length === 0) {
                    return false;
                } else {
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
