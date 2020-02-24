<template>
    <div id="liveview" class="c-img__form">
        <input type="file" @change="onFileChange($event)" name="pic" class="c-img c-img__input">
        <img :src="imgData || pic" v-if="imgData || pic" class="c-img" v-cloak>
        <input type="hidden" :value="pic" name="old_pic">
    </div>
</template>

<script>
    /*input['file']のライブビュー機能*/
    export default {
        props: ['pic'],
        data(){
            return {
                imgData: '',
            }
        },
        compted: {
            imgData: {
                get(){
                    return this.$props.pic;
                }
            }
        },
        
        methods: {
            onFileChange(e) {
                const files = e.target.files;
                if (files.length > 0) {
                    const file = files[0];
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imgData = e.target.result;
                        this.$emit("change", {pic: this.imgData});
                    };
                    reader.readAsDataURL(file);
                    
                }
            }
        }
    }

</script>
