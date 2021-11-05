<template>
    <div class="page-content login-page min-vh-100 d-flex" :style="{ 'background-image': 'url(/img/login-bg.jpg)' }">
        <b-container fluid class="m-auto">
            <b-row class="justify-content-center">
                <b-col xl="4" lg="5" md="6" sm="12">
                    <b-card class="auth-card">
                        <b-card-header class="mx-4 mt-2 mb-1 text-center">
                            <a href="/" class="d-block mb-3">
                                <b-img src="/img/logo.png" alt="logo" class="site-logo"></b-img>
                            </a>
                            <h5 class="mb-0">おかえりなさい !</h5>
                        </b-card-header>
                        <b-card-body class="p-4">
                            <b-alert
                                v-if="has_error"
                                show
                                dismissible
                                variant="danger"
                                class="fs-md mx-lg-4 mx-md-2"
                            >
                                メールアドレスかパスワードが正しくありません。
                            </b-alert>
                            <b-form @submit.prevent="login" class="px-lg-4 px-md-2">
                                <b-form-group
                                    label="メールアドレス *"
                                    label-for="email"
                                >
                                    <b-form-input
                                        id="email"
                                        type="text"
                                        class="form-control"
                                        v-model="form.email"
                                    >
                                    </b-form-input>
                                </b-form-group>
                                <b-form-group
                                    label="パスワード *"
                                    label-for="password"
                                >
                                    <b-form-input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        v-model="form.password"
                                    >
                                    </b-form-input>
                                </b-form-group>
                                <b-button
                                    type="submit"
                                    variant="info"
                                    block
                                    class="mt-4"
                                    :disabled="btnLoginDisabled"
                                >
                                    <b-icon icon="arrow-right"></b-icon>
                                    &nbsp;&nbsp;<strong>サインイン</strong>
                                </b-button>
                            </b-form>
                            <p class="mt-3 fs-md text-center">
                                アカウントをお持ちでない方は<b-link href="/register">新規登録</b-link>
                            </p>
                            <hr class="my-4">
                            <div class="footer fs-md text-center">
                                マチアプ Copyright©2021
                            </div>
                        </b-card-body>
                    </b-card>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>
<script>
export default {
    name: 'Login',
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            has_error: false,
            error: '',
            errors: {}
        }
    },
    computed: {
        btnLoginDisabled() {
            return !this.form.email || !this.form.password
        }
    },
    created() {
        if (this.$auth.check()) {
            location.href = '/'
        }
    },
    methods: {
        login() {
            // get the redirect object
            const redirect = this.$auth.redirect()
            const self = this
            this.has_error = false
            this.$auth.login({
                data: self.form,
                success: function() {
                    // handle redirection
                    /* const redirectTo = redirect ? redirect.from.name : 'home'
                    this.$router.push({name: redirectTo}) */
                    location.href = "/"
                },
                error: function(res) {
                    self.has_error = true
                    self.error = res.response.data.error
                    self.errors = res.response.data.errors || {}
                },
                rememberMe: true,
                fetchUser: true
            })
        }
    }
}
</script>
<style lang="scss" scoped>
.site-logo {
    width: 250px;
}
</style>
