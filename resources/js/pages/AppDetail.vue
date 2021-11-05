<template>
    <b-container class="page-content">
        <div class="detail-page">
            <b-row>
                <b-col lg="9" sm="12">
                    <breadcrumb-component :items="breadcrumbs"></breadcrumb-component>
                    <b-row class="app-header">
                        <b-col lg="3" sm="12">
                            <b-img
                                :src="appInfo.icon"
                                alt="app icon"
                                class="app-icon mb-3"
                            >
                            </b-img>
                        </b-col>
                        <b-col lg="9" sm="12">
                            <h5 class="app-title font-weight-bold">
                                {{ appInfo.title }}
                            </h5>
                            <span class="d-block">{{ appInfo.developer }}</span>
                            <div class="d-flex flex-row align-items-center">
                                <b-badge class="app-type mr-3" variant="success">
                                    Android
                                </b-badge>
                                <div class="app-rating">
                                    <b-form-rating
                                        :value="appInfo.google_score"
                                        inline
                                        readonly
                                        no-border
                                        precision="1"
                                        show-value
                                        class="p-0"
                                        variant="success"
                                    ></b-form-rating>
                                </div>
                                <div class="app-review-info ml-1">
                                    <b-icon icon="person-fill"></b-icon>
                                    <span class="review-count">{{ appInfo.google_ratings }}</span>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <b-badge class="app-type mr-3" variant="info">
                                    iOS
                                </b-badge>
                                <div class="app-rating">
                                    <b-form-rating
                                        :value="appInfo.apple_score"
                                        inline
                                        readonly
                                        no-border
                                        precision="1"
                                        show-value
                                        class="p-0"
                                        variant="info"
                                    ></b-form-rating>
                                </div>
                                <div class="app-review-info ml-1">
                                    <b-icon icon="person-fill"></b-icon>
                                    <span class="review-count">{{ appInfo.apple_ratings }}</span>
                                </div>
                            </div>
                            <div class="d-flex mt-3">
                                <b-link :href="appInfo.google_play_url" target="_blank">
                                    <b-button pill variant='success' class="mr-2" style="font-size: 15px">
                                        Google Playで見る
                                    </b-button>
                                </b-link>
                                <b-link :href="appInfo.apple_store_url" target="_blank">
                                    <b-button pill variant="info" class="mr-2" style="font-size: 15px">
                                        Apple Storeで見る
                                    </b-button>
                                </b-link>
                                <b-link :href="appInfo.web_url" target="_blank">
                                    <b-button pill variant="secondary">WEB版を見る</b-button>
                                </b-link>
                            </div>
                        </b-col>
                    </b-row>
                    <b-row class="editor-comments">
                        <b-col lg="12">
                            <div class="content-title mb-4">
                                <h5>編集部のおすすめポイント</h5>
                            </div>
                            <ul class="comment-list py-2 pr-1" v-html="appInfo.admin_note">
                                <!-- <li>何番線に乗って何番線に着くかなど、細かい所まで教えてくれるから安心</li>
                                <li>早さ・楽さ・安さ、3つのニーズに合うルートをそれぞれ示してくれる</li>
                                <li>検索したルートの一本前、一本後をワンタップで表示できる細かな便利さ</li> -->
                            </ul>
                        </b-col>
                    </b-row>
                    <b-row class="app-details">
                        <b-col lg="12">
                            <div class="content-title mb-4">
                                <h5>詳細情報</h5>
                            </div>
                        </b-col>
                        <b-col lg="6">
                            <swiper :options="swiperOptions" class="mb-2">
                                <swiper-slide v-for="(srcUrl, i) in screenshots" :key="i">
                                    <b-img :src="srcUrl" :alt="'Screenshot' + i" fluid></b-img>
                                </swiper-slide>
                                <div class="swiper-pagination" slot="pagination"></div>
                            </swiper>
                        </b-col>
                        <b-col lg="6">
                            <dl class="other-info py-2">
                                <dt>価格</dt><dd>{{ price }}</dd>
                                <dt>ジャンル</dt><dd>{{ appInfo.genre }}</dd>
                                <dt>開発者</dt><dd>{{ appInfo.developer }}</dd>
                                <dt>インストール</dt><dd>{{ appInfo.google_install_cnt }}</dd>
                                <dt>対象年齢</dt><dd>{{ appInfo.content_rating }}</dd>
                                <!-- <template v-if="appInfo.type === 1">
                                    <dt>更新日</dt><dd>{{ appInfo.update_date | unixFormatDate }}</dd>
                                </template> -->
                                <dt>Android 更新日</dt><dd>{{ appInfo.google_update_date | unixFormatDate }}</dd>
                                <dt>iOS リリース日</dt><dd>{{ appInfo.apple_release_date | unixFormatDate }}</dd>
                                <dt>iOS 更新日</dt><dd>{{ appInfo.apple_update_date | unixFormatDate }}</dd>
                                <dt>Android サイズ</dt><dd>{{ appInfo.android_size }}</dd>
                                <dt>iOS サイズ</dt><dd>{{ appInfo.ios_size }}</dd>
                            </dl>
                        </b-col>
                        <b-col lg="12">
                            <b-card no-body class="mt-3">
                                <b-tabs
                                    pills
                                    justified
                                    card
                                >
                                    <b-tab title="アプリ概要" active class="app-desc">
                                        <b-card-text v-if="appInfo.description" v-html="description"></b-card-text>
                                        <div class="text-center my-2">
                                            <b-button variant="outline-dark" size="sm" @click="toggleDesc">
                                                <template v-if="!fullDesc">
                                                    もっと見る
                                                    <b-icon icon="arrow-down" font-scale="1"></b-icon>
                                                </template>
                                                <template v-else>
                                                    隠す
                                                    <b-icon icon="arrow-up" font-scale="1"></b-icon>
                                                </template>
                                            </b-button>
                                        </div>
                                    </b-tab>
                                    <b-tab title="ストアのレビュー" class="store-reviews">
                                        <b-card-text v-html="appInfo.store_review"></b-card-text>
                                    </b-tab>
                                    <b-tab title="料金システム">
                                        <b-card-text v-html="appInfo.fare_system"></b-card-text>
                                    </b-tab>
                                    <b-tab title="パージョンアップ情報" class="additional-info">
                                        <b-card-text>
                                            <b-row>
                                                <b-col lg="4">
                                                    <dt>Android 現在のバージョン</dt><dd>{{ appInfo.android_version }}</dd>
                                                </b-col>
                                                <b-col lg="4">
                                                    <dt>Android 要件</dt><dd>{{ appInfo.required_android_version }}</dd>
                                                </b-col>
                                                <b-col lg="4">
                                                    <dt>iOS 現在のバージョン</dt><dd>{{ appInfo.ios_version }}</dd>
                                                </b-col>
                                                <b-col lg="4">
                                                    <dt>iOS 要件</dt><dd>{{ appInfo.required_ios_version }}</dd>
                                                </b-col>
                                            </b-row>
                                        </b-card-text>
                                    </b-tab>
                                </b-tabs>
                            </b-card>
                        </b-col>
                    </b-row>
                    <b-row class="user-comments">
                        <b-col lg="12">
                            <div class="content-title mb-4">
                                <h5>ユーザーレビュー&nbsp;&nbsp;({{ rates.length }})</h5>
                            </div>
                        </b-col>
                        <b-col v-if="canComment" lg="12 leave-review">
                            <!-- <p class="review-title">あなたの評価を教えてください！</p> -->
                            <div class="review-area d-flex">
                                <div class="review_user-icon mr-3">
                                    <b-img src="/img/user/default-avatar.jpg" rounded="circle"></b-img>
                                </div>
                                <div class="review-main">
                                    <div v-if="!$auth.check()" class="username">
                                        あなた <b-link href="/login">アカウントをお持ちのかたはこちら</b-link>
                                    </div>
                                    <div class="rating-box">
                                        <p class="mt-2 mb-0">星をタップして評価してください</p>
                                        <b-form-rating
                                            v-model="review.rating"
                                            inline
                                            no-border
                                            variant="warning"
                                            class="px-0"
                                            size="lg"
                                        >
                                        </b-form-rating>
                                    </div>
                                    <div class="review-text">
                                        <p>続けてレビューを書いてみませんか？　※20文字以上</p>
                                        <b-form-textarea
                                            v-model="review.text"
                                            placeholder="例：標準アプリでは満足できないカメラ上級者には特におすすめです。"
                                            rows="3"
                                            :state="review.text.length >= 20"
                                        ></b-form-textarea>
                                        <b-button variant="success" class="mt-2" @click="submitReview">
                                            投稿
                                        </b-button>
                                    </div>
                                </div>
                            </div>
                        </b-col>
                        <b-col lg="12" class="comment-list">
                            <div
                                v-for="(rate, i) in rates"
                                :key="i"
                                class="d-flex flex-row comment"
                            >
                                <div class="comment_user-icon mr-3">
                                    <b-img 
                                        :src="rate.avatar ? rate.avatar : '/img/user/default-avatar.jpg'" 
                                        rounded="circle"
                                    >
                                    </b-img>
                                </div>
                                <div class="comment-area">
                                    <div class="comment-area_top pl-1">
                                        <span class="mr-5">{{ rate.name }}</span>
                                        <span>{{ rate.created_at | formatDate }}</span>
                                    </div>
                                    <div class="review-star">
                                        <b-form-rating
                                            inline
                                            :value="rate.rating"
                                            show-value
                                            no-border
                                            readonly
                                            variant="warning"
                                            class="px-0"
                                            size="sm"
                                        >
                                        </b-form-rating>
                                    </div>
                                    <p class="comment-text mt-2">
                                        {{ rate.comment }}
                                    </p>
                                    <div class="review-reactor d-flex justify-content-between align-items-center w-100">
                                        <a class="review-like" :class="{ 'active': isLiked[i] }" @click="recommend(rate.id)">
                                            <b-img
                                                src="/img/user/icon-like.png"
                                                class="icon-like"
                                            >
                                            </b-img>
                                            <span>{{ rate.likes }}</span>
                                        </a>
                                        <!--ToDo: Report a violation -->
                                        <!-- <a class="review-report">
                                            <b-img
                                                src="/img/user/icon-setting.png"
                                                class="icon-setting"
                                            >
                                            </b-img>
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                        </b-col>
                    </b-row>
                </b-col>
                <b-col lg="3" sm="12">
                    <aside>
                        <h5 class="title">シーンから探す</h5>
                        <ul class="scene-list">
                            <li v-for="(scene, i) in scenes" :key="i">
                                <a :href="'/ranking?scene_id=' + scene.id">{{ scene.name }}</a>
                            </li>
                        </ul>
                        <h5 class="title">カテゴリから探す</h5>
                        <ul class="category-list">
                            <li v-for="(category, i) in categories" :key="i">
                                <a :href="'/ranking?category_id=' + category.id">{{ category.name }}</a>
                            </li>
                        </ul>
                    </aside>
                </b-col>
            </b-row>
        </div>
    </b-container>
</template>
<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
import "swiper/css/swiper.css"

export default {
    name: 'AppDetail',
    components: {
        Swiper,
        SwiperSlide
    },
    props: ['appId'],
    created() {
        this.getAppDetail()
        this.canLeaveComment()
        this.getScenes()
        this.getCategories()
    },
    computed: {
        description() {
            if (this.fullDesc) {
                return this.appInfo.description
            } else {
                return this.appInfo.description.slice(0, 300)
            }
        },
        price() {
            if (this.appInfo.is_free) {
                return 'Free'
            } else {
                return 'Not Free'
            }
        },
        screenshots() {
            if (this.appInfo.screenshots) {
                return this.appInfo.screenshots.split(',')
            } else {
                return []
            }
        }
    },
    data() {
        return {
            fullDesc: false,
            appInfo: {},
            swiperOptions: {
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                }
            },
            rates: [],
            review: {
                rating: 1,
                text: ''
            },
            canComment: true,
            isLiked: [],
            breadcrumbs: [{
                name: 'ランキング',
                slug: 'ranking'
            }],
            scenes: [],
            categories: []
        }
    },
    methods: {
        setPageTitle(appTitle) {
            document.title = appTitle
        },
        toggleDesc() {
            this.fullDesc = !this.fullDesc
        },
        getAppDetail() {
            axios.get(`/get-app-detail/${this.appId}`)
                .then(res => {
                    this.appInfo = res.data.app_info
                    this.setPageTitle(this.appInfo.title)
                    this.rates = res.data.rates
                    for (let i = 0; i < this.rates.length; i++) {
                        this.isLiked.push(false)
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        },
        submitReview() {
            if (!this.$auth.check()) {
                location.href = '/login'
            }
            if (this.review.text.length < 20) {
                return
            }
            this.$http({
                url: 'submit-review',
                method: 'POST',
                data: {
                    app_id: parseInt(this.appId),
                    user_id: parseInt(this.$auth.user().id),
                    rating: parseInt(this.review.rating),
                    comment: this.review.text
                }
            }).then((res) => {
                this.canComment = false
                this.rates = res.data.rates
            }).catch(err => {
                console.log(err)
            })
        },
        canLeaveComment() {
            if (this.$auth.check()) {
                this.$http({
                    url: 'can-leave-comment',
                    method: 'POST',
                    data: {
                        user_id: parseInt(this.$auth.user().id),
                        app_id: parseInt(this.appId),
                    }
                }).then((res) => {
                    if (res.data.can_leave) {
                        this.canComment = true
                    } else {
                        this.canComment = false
                    }
                }).catch(err => {

                })
            }
        },
        recommend(rateId) {
            const rateIndex = this.rates.findIndex(item => item.id === rateId)
            console.log(rateIndex)
            this.isLiked[rateIndex] = !this.isLiked[rateIndex]
            if (this.isLiked[rateIndex]) {
                this.rates[rateIndex].likes += 1
            } else {
                this.rates[rateIndex].likes -= 1
            }
            axios.post('recommend', {
                rate_id: rateId,
                likes: this.rates[rateIndex].likes
            }).then(() => {
            }).catch((err) => {
                console.log(err)
            })
        },
        getScenes() {
            axios.get('/scenes')
            .then(res => {
                this.scenes = res.data
            })
            .catch(err => {
                console.log(err)
            })
        },
        getCategories() {
            axios.get('/categories')
            .then(res => {
                this.categories = res.data
            })
            .catch(err => {
                console.log(err)
            })
        },
    }
}
</script>
<style lang="scss" scoped>
.detail-page {
    padding: 20px 15px;
    .row {
        margin-bottom: 40px;
    }
    hr {
        border: 1px solid #7693ff;
    }
    .content-title {
        border-bottom: 2px solid #7693ff;
        margin-bottom: 25px;
    }
    .app-header {
        .app-icon {
            width: 150px;
            height: 150px;
            border-radius: 5px;
        }
        .app-title {
            line-height: 1.4;
        }
        .badge {
            min-width: 60px;
        }
    }
    .editor-comments {
        ul {
            background: #e6e6e6;
            border-radius: 5px;
            margin-bottom: 0;
            li {
                margin-bottom: 10px;
            }
        }
    }
    .app-details {
        dl.other-info {
            display: flex;
            flex-flow: row;
            flex-wrap: wrap;
            dt {
                font-weight: 500;
                flex: 0 0 40%;
                text-align: right;
            }
            dd {
                flex: 0 0 60%;
                padding-left: 10%;
                text-align: left;
            }
        }
        .store-reviews {
            h6 {
                font-weight: 600;
                border-left: 6px solid #00a6c9;
                padding: 4px 0px 5px 10px;
            }
            ul {
                padding: 5px 30px;
                list-style: none;
                li {
                    margin-bottom: 5px;
                    &:before {
                        content: '✓';
                        margin-right: 10px;
                    }
                }
            }
        }
        .additional-info {
            dt {
                margin-bottom: 5px;
            }
        }
    }
    .user-comments {
        .leave-review {
            .review-title {
                display: inline-block;
                margin-bottom: 7px;
                padding: 4px 10px;
                line-height: 1.6;
                border-radius: 1px 14px 14px 10px;
                background: #eceef1;
                color: #232b39;
            }
            .review-area {
                padding: 14px;
                background: #eceef1;
                .review_user-icon {
                    img {
                        width: 35px;
                        height: 35px;
                    }
                }
                .review-main {
                    flex: 1;
                }
            }
        }
        .comment {
            border-bottom: 1px solid #ddd;
            padding: 15px 10px 10px 5px;
            .comment_user-icon {
                flex: 0;
                img {
                    width: 35px;
                    height: 35px;
                }
            }
            .comment-area {
                flex: 1;
                .review-like {
                    overflow: hidden;
                    height: 16px;
                    color: #000 !important;
                    display: inline-block;
                    font-size: 13px;
                    line-height: 1.1;
                    cursor: pointer;
                    .icon-like {
                        vertical-align: top;
                        margin-top: -18px;
                        margin-right: 6px;
                        width: 16px;
                        height: 33px;
                    }
                    &:hover {
                        text-decoration: none;
                    }
                    &.active {
                        .icon-like {
                            margin-top: 1px !important;
                        }
                    }
                }
                .review-report {
                    cursor: pointer;
                }
            }
        }
    }
    @media (max-width: 480px) {
        .app-header {
            .app-icon {
                width: 100px;
                height: 100px;
            }
            .app-title {
                font-size: 1rem !important;
            }
        }
    }
    aside {
        margin-top: 20px;
        .title {
            border-bottom: 2px solid green;
            padding-bottom: 10px;
            font-weight: 700;
        }
        .scene-list, .category-list {
            list-style: none;
            padding: 10px 5px;
            a {
                color: black;
                display: inline-block;
                margin: 5px 0px;
                &:hover {
                    // text-decoration: none;
                    opacity: 0.8;
                }
            }
        }
    }
}
</style>
