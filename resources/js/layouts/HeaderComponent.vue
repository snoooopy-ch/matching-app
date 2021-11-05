<template>
    <div class="header-wrapper">
        <b-container class="px-0">
            <b-navbar toggleable="sm">
                <b-navbar-brand href="/" class="py-3">
                    <img src="/img/logo.png" alt="logo" class="site-logo">
                </b-navbar-brand>

                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                <b-collapse id="nav-collapse" is-nav>
                    <b-navbar-nav class="ml-auto">
                        <template v-if="!$auth.check()">
                            <b-nav-item href="/register" class="register-item">
                                <b-icon icon="person-plus" class="mr-1"></b-icon>新規会員登録
                            </b-nav-item>
                            <b-nav-item type="dark" href="/login">
                                <b-icon icon="shield-lock" class="mr-1"></b-icon>ログイン
                            </b-nav-item>
                        </template>
                        <template v-else>
                            <b-nav-item type="dark" href="/" right>
                                <img src="/img/user/default-avatar.jpg" alt="avatar" class="user-avatar" />
                            </b-nav-item>
                            <b-nav-item-dropdown :text="$auth.user().name" right>
                                <b-dropdown-item href="/myreviews">
                                    <b-icon icon="pencil-square" class="mr-2"></b-icon>投稿したレビュー
                                </b-dropdown-item>
                                <b-dropdown-item href="/profile">
                                    <b-icon icon="gear-fill" class="mr-2"></b-icon>プロファイル
                                </b-dropdown-item>
                                <b-dropdown-item href="#" @click.prevent="$auth.logout()">
                                    <b-icon icon="box-arrow-right" class="mr-2"></b-icon>ログアウト
                                </b-dropdown-item>
                            </b-nav-item-dropdown>
                        </template>
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>
        </b-container>
    </div>
</template>
<script>
export default {
    name: 'HeaderComponent'
}
</script>
<style lang="scss" scoped>
@import '../../sass/variables.scss';
.header-wrapper {
    position: fixed;
    width: 100%;
    z-index: 1000;
    background: white;
    box-shadow: 0 0.1rem 0.2rem rgb(0 0 0 / 25%);
}
.navbar-brand {
    .site-logo {
        width: 180px;
    }
}
.user-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
}
::v-deep .nav-item {
    &.register-item {
        margin-right: 20px;
    }
    .nav-link {
        font-size: 17px;
        font-weight: 700;
        color: black;
    }
    &.dropdown {
        .dropdown-menu {
            padding: 0;
            margin: 0;
            li {
                padding: 15px 20px;
                &:hover {
                    background-color: #e2e2e2;
                }
                .dropdown-item {
                    font-size: 14px;
                    line-height: 1.5;
                    padding: 0;
                    &:hover {
                        background: none;
                    }
                }
            }
            
        }
    }
}
</style>
