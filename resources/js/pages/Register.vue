<template>
    <div class="page-content register-page min-vh-100 d-flex" :style="{ 'background-image': 'url(/img/login-bg.jpg)' }">
        <b-container fluid class="m-auto">
            <b-row class="justify-content-center">
                <b-col xl="4" lg="5" md="6" sm="12">
                    <b-card class="auth-card">
                        <b-card-header class="mx-4 mt-4 mb-1 text-center">
                            <a href="/" class="d-block mb-3">
                                <b-img src="/img/logo.png" alt="logo" class="site-logo"></b-img>
                            </a>
                            <h5 class="mb-0">新規登録</h5>
                        </b-card-header>
                        <b-card-body class="p-4">
                            <b-form @submit.prevent="register" class="px-lg-4 px-md-2">
                                <b-form-group
                                    label-for="name"
                                >
                                    <b-form-input
                                        id="name"
                                        type="text"
                                        class="form-control"
                                        v-model="form.name"
                                        :state="errors.name"
                                        placeholder="ユーザーネーム"
                                    >
                                    </b-form-input>
                                    <b-form-invalid-feedback id="name-feedback">
                                        {{ errors.name }}
                                    </b-form-invalid-feedback>
                                </b-form-group>
                                <b-form-group
                                    label-for="email"
                                >
                                    <b-form-input
                                        id="email"
                                        type="text"
                                        class="form-control"
                                        v-model="form.email"
                                        :state="('email' in errors) ? false : null"
                                        placeholder="メールアドレス"
                                    >
                                    </b-form-input>
                                    <b-form-invalid-feedback v-if="'email' in errors" id="email-feedback">
                                        {{ errors.email[0] }}
                                    </b-form-invalid-feedback>
                                </b-form-group>
                                <b-form-group
                                    label-for="password"
                                >
                                    <b-form-input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        v-model="form.password"
                                        :state="('password' in errors) ? false : null"
                                        placeholder="パスワード"
                                    >
                                    </b-form-input>
                                    <b-form-invalid-feedback v-if="'password' in errors" id="password-feedback">
                                        {{ errors.password[0] }}
                                    </b-form-invalid-feedback>
                                </b-form-group>
                                <b-form-group
                                    label-for="password_confirmation"
                                >
                                    <b-form-input
                                        id="password_confirmation"
                                        type="password"
                                        class="form-control"
                                        v-model="form.password_confirmation"
                                        placeholder="パスワードを認証する"
                                    >
                                    </b-form-input>
                                </b-form-group>
                                <p class="text-center fs-md">
                                    登録することで<b-link href="/privacy">個人情報保護方針</b-link>及び<b-link href="/terms">MatchingApp基本規約</b-link>に同意したとみなされます。
                                </p>
                                <b-button
                                    type="submit"
                                    variant="info"
                                    block
                                    :disabled="btnRegisterDisabled"
                                >
                                    <b-icon icon="arrow-right"></b-icon>&nbsp;&nbsp;<strong>登録簿</strong>
                                </b-button>
                            </b-form>
                            <p class="mt-3 fs-md text-center">
                                アカウントをお持ちの方は<b-link href="/login">ログイン</b-link>
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
    name: 'Register',
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            error: '',
            errors: {}
        }
    },
    computed: {
        btnRegisterDisabled() {
            return (!this.form.name || !this.form.email || !this.form.password || !this.form.password_confirmation)
        }
    },
    methods: {
        register() {
            const redirect = this.$auth.redirect()
            const self = this
            this.$auth.register({
                data: self.form,
                success: function () {
                    console.log(redirect)
                    const redirectTo = redirect ? redirect.from.name : 'login'
                    this.$router.push({name: redirectTo})
                    /* this.$router.push({
                        name: 'login',
                        params: {
                            successRegistrationRedirect: true
                        }
                    }) */
                },
                error: function (res) {
                    console.log(res.response.data.errors)
                    self.error = res.response.data.error
                    self.errors = res.response.data.errors || {}
                }
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
