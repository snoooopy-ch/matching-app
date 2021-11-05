<template>
    <div class="page-wrapper" :class="{ blog : curRouteName === 'blog' }">
        <header-component></header-component>
        <b-container class="page-content">
            <router-view />
        </b-container>
        <footer-component></footer-component>
    </div>
</template>
<script>
export default {
    name: 'Main',
    data() {
        return {
            curRouteName: ''
        }
    },
    mounted() {
        this.curRouteName = this.$router.currentRoute.name;
    }
}
</script>
<style lang="scss" scoped>
@import "./../../sass/_variables.scss";
.page-wrapper {
    background: $bg-color;
    .page-content {
        padding-top: 84px;
        min-height: 650px;
    }
}
</style>
