<template>
    <div class="profile-page py-5">
        <b-tabs content-class="m-3 m-lg-4">
            <b-tab title="プロフィール更新" active>
                <b-row class="justify-content-start">
                    <b-col lg="6" sm="12">
                        <b-form @submit="onProfileSubmit">
                            <b-form-group
                                id="input-group-email"
                                label="メールアドレス:"
                                label-for="email"
                            >
                                <b-form-input
                                    id="email"
                                    v-model="profile.email"
                                    :state="emailErrorState"
                                ></b-form-input>

                                <b-form-invalid-feedback id="email-feedback">
                                    {{ emailErrorState === false ? errors.email[0] : '' }}
                                </b-form-invalid-feedback>
                            </b-form-group>

                            <b-form-group 
                                id="input-group-username" 
                                label="ユーザーネーム:" 
                                label-for="username"
                            >
                                <b-form-input
                                    id="username"
                                    v-model="profile.name"
                                    :state="nameErrorState"
                                ></b-form-input>

                                <b-form-invalid-feedback id="username-feedback">
                                    {{ nameErrorState === false ? errors.name[0] : '' }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                            <b-button type="submit" variant="info">更新</b-button>
                        </b-form>
                    </b-col>
                </b-row>
            </b-tab>
            <b-tab title="パスワード変更">
                <b-row class="justify-content-start">
                    <b-col lg="6" sm="12">
                        <b-form @submit="onPasswordSubmit">
                            <b-form-group
                                id="input-group-old_password"
                                label="現在のパスワード:"
                                label-for="old_password"
                            >
                                <b-form-input
                                    id="old_password"
                                    v-model="password.old"
                                    type="password"
                                    :state="oldPwdErrorState"
                                ></b-form-input>
                                
                                <b-form-invalid-feedback id="old_password-feedback">
                                    {{ oldPwdErrorState === false ? errors.old[0] : '' }}
                                </b-form-invalid-feedback>
                            </b-form-group>

                            <b-form-group 
                                id="input-group-new_password" 
                                label="新しいパスワード:" 
                                label-for="new_password"
                            >
                                <b-form-input
                                    id="new_password"
                                    v-model="password.new"
                                    type="password"
                                    :state="newPwdErrorState"
                                ></b-form-input>

                                <b-form-invalid-feedback id="new_password-feedback">
                                    {{ newPwdErrorState === false ? errors.new[0] : '' }}
                                </b-form-invalid-feedback>
                            </b-form-group>

                            <b-form-group 
                                id="input-group-confirm_password" 
                                label="パスワードを認証する:" 
                                label-for="confirm_password"
                            >
                                <b-form-input
                                    id="confirm_password"
                                    v-model="password.new_confirmation"
                                    type="password"
                                ></b-form-input>
                            </b-form-group>

                            <b-button type="submit" variant="info">更新</b-button>
                        </b-form>
                    </b-col>
                </b-row>
            </b-tab>
        </b-tabs>
    </div>
</template>
<script>
export default {
    name: 'Profile',
    data() {
        return {
            profile: {
                id: '',
                email: '',
                name: ''
            },
            password: {
                id: '',
                old: '',
                new: '',
                new_confirmation: ''
            },
            errors: {}
        }
    },
    computed: {
        emailErrorState() {
            if('email' in this.errors) {
                return false
            }
            else {
                return null
            }
        },
        nameErrorState() {
            if('name' in this.errors) {
                return false
            }
            else {
                return null
            }
        },
        oldPwdErrorState() {
            if('old' in this.errors) {
                return false
            }
            else {
                return null
            }
        },
        newPwdErrorState() {
            if('new' in this.errors) {
                return false
            }
            else {
                return null
            }
        }
    },
    mounted() {
        this.profile = {
            id: this.$auth.user().id,
            email: this.$auth.user().email,
            name: this.$auth.user().name
        }
        this.password.id = this.$auth.user().id
    },
    methods: {
        onProfileSubmit(e) {
            e.preventDefault()
            this.$http({
                url: 'update-profile',
                method: 'POST',
                data: this.profile
            }).then((res) => {
                if (res.data.status === 'error') {
                    this.errors = res.data.errors
                } else {
                    this.errors = {}
                    this.$bvToast.toast('更新が成功しました', {
                        title: '成功',
                        variant: 'success',
                        solid: true
                    })
                }
            }).catch(err => {
                console.log(err)
            })
        },
        onPasswordSubmit(e) {
            e.preventDefault()
            this.$http({
                url: 'change-password',
                method: 'POST',
                data: this.password
            }).then((res) => {
                if (res.data.status === 'error') {
                    this.errors = res.data.errors
                    console.log(this.errors)
                } else {
                    this.errors = {}
                    this.$bvToast.toast('更新が成功しました', {
                        title: '成功',
                        variant: 'success',
                        solid: true
                    })
                }
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
<style lang="scss" scoped>
::v-deep .nav-tabs {
    .nav-link {
        font-weight: bold;
        font-size: 18px;
    }
}
</style>