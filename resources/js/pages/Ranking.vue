<template>
    <b-container class="page-content">
        <div class="ranking-page">
            <breadcrumb-component :items="breadcrumbs"></breadcrumb-component>
            <b-row class="flex-row px-2">
                <aside v-if="!$isMobile()" class="left-side">
                    <div class="widget">
                        <div class="widget-header d-flex align-items-center justify-content-between">
                            <a href="/ranking" class="d-inline-block">
                                <span class="widget-title m-2">カテゴリから探す</span>
                            </a>
                            <b-icon :icon="categoryGroupShown ? 'chevron-double-down' : 'chevron-double-up'" font-scale="1" class="mr-1" v-b-toggle.collapse-categories></b-icon>
                        </div>
                        <b-collapse visible id="collapse-categories">
                            <b-list-group>
                                <b-list-group-item
                                    v-for="(category, i) in categories"
                                    :key="i"
                                    :href="categoryLink(category.id, category.name)"
                                    :class="{ 'active' : category.id == selectedCategoryId }"
                                >
                                    {{ category.name }}
                                </b-list-group-item>
                            </b-list-group>
                        </b-collapse>
                    </div>
                    <div class="widget">
                        <div class="widget-header d-flex align-items-center justify-content-between">
                            <a href="/ranking" class="d-inline-block">
                                <span class="widget-title m-2">シーンから探す</span>
                            </a>
                            <b-icon :icon="sceneGroupShown ? 'chevron-double-down' : 'chevron-double-up'" font-scale="1" class="mr-1" v-b-toggle.collapse-scenes></b-icon>
                        </div>
                        <b-collapse visible id="collapse-scenes">
                            <b-list-group>
                                <b-list-group-item
                                    v-for="(scene, i) in scenes"
                                    :key="i"
                                    :href="sceneLink(scene.id, scene.name)"
                                    :class="{ 'active' : scene.id == selectedSceneId }"
                                >
                                    {{ scene.name }}
                                </b-list-group-item>
                            </b-list-group>
                        </b-collapse>
                    </div>
                </aside>
                <div class="popular-app-wrapper">
                    <h3 class="title">{{ pageTitle }}</h3>
                    <hr>
                    <h6 v-if="totalCount">
                        該当するアプリ数:&nbsp;<strong>{{ totalCount }} 件</strong>
                    </h6>
                    <b-row>
                        <template v-if="appRankings.length > 0">
                            <b-col v-for="(app, i) in appRankings" :key="i" lg="6" md="12">
                                <div class="box-content" @click="goToDetail(app.id)">
                                    <b-badge pill variant="danger">{{ i + 1 }}</b-badge>
                                    <div class="text-center mb-3">
                                        <img :src="app.icon" class="app-icon" />
                                    </div>
                                    <h5 class="app-title mb-1">
                                        {{ app.title }}
                                    </h5>
                                    <div class="d-flex flex-row justify-content-around align-items-center">
                                        <h2 class="score-text mb-0">{{ parseFloat(app.google_score).toFixed(1) }}</h2>
                                        <div class="reviews">
                                            <b-form-rating
                                                id="rating-readonly"
                                                :value="parseFloat(app.google_score).toFixed(1)"
                                                inline
                                                readonly
                                                no-border
                                                precision="2"
                                            ></b-form-rating>
                                            <div class="reviews">
                                                <b-icon icon="person-fill"></b-icon>
                                                <span class="review-count">{{ app.google_ratings }}&nbsp;件</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </b-col>
                        </template>
                        <template v-else>
                            <b-col>
                                <h6 class="text-center mt-2">登録されたアプリがありません。</h6>
                            </b-col>
                        </template>
                    </b-row>
                    <b-row class="justify-content-center mt-5">
                        <b-pagination
                            v-model="currentPage"
                            :total-rows="totalCount"
                            :per-page="perPage"
                            @input="selectPage"
                        ></b-pagination>
                    </b-row>
                </div>
                <aside class="right-side">
                    <template v-if="!selectedSceneId && !selectedCategoryId">
                        <h5 class="font-weight-bold p-1">新着アプリ</h5>
                        <hr>
                        <div class="list">
                            <div 
                                v-for="(app, i) in newApps" 
                                :key="i" 
                                class="d-flex flex-row box-content"
                                @click="goToDetail(app.id)"
                            >
                                <img :src="app.icon" class="app-icon mr-2" />
                                <div class="d-inline-flex flex-column justify-content-between">
                                    <span class="app-title mb-2">{{ app.title }}</span>
                                    <!-- <b-form-rating
                                        id="rating-readonly"
                                        :value="app.google_score"
                                        inline
                                        readonly
                                        no-border
                                        precision="2"
                                        class="w-50"
                                    ></b-form-rating> -->
                                    <p>
                                        <b-badge class="app-type" variant="success">
                                            Android
                                        </b-badge>
                                        <b-badge class="app-type" :variant="'info'">
                                            iOS
                                        </b-badge>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <h5 class="font-weight-bold p-1">新着コメント</h5>
                        <hr>
                        <div class="list">
                            <div 
                                v-for="(comment, i) in newComments" 
                                :key="i" 
                                class="d-flex flex-row box-content"
                            >
                                <div class="d-inline-flex flex-column justify-content-between">
                                    <span class="app-title d-inline-block">
                                        <b-link :href="'/app/' + comment.app_id">{{ comment.title }}</b-link>
                                        &nbsp;&nbsp;({{ comment.name }})
                                    </span>
                                    <b-form-rating
                                        id="rating-readonly"
                                        :value="comment.rating"
                                        inline
                                        readonly
                                        no-border
                                        precision="2"
                                        class="w-25"
                                    ></b-form-rating>
                                    <div class="comment">{{ comment.comment }}</div>
                                </div>
                            </div>
                        </div>
                    </template>
                </aside>
                <aside v-if="$isMobile()" class="left-side">
                    <div class="widget">
                        <div class="widget-header d-flex align-items-center justify-content-between">
                            <a href="/ranking" class="d-inline-block">
                                <span class="widget-title m-2">カテゴリから探す</span>
                            </a>
                            <b-icon :icon="categoryGroupShown ? 'chevron-double-down' : 'chevron-double-up'" font-scale="1" class="mr-1" v-b-toggle.collapse-categories></b-icon>
                        </div>
                        <b-collapse visible id="collapse-categories">
                            <b-list-group>
                                <b-list-group-item
                                    v-for="(category, i) in categories"
                                    :key="i"
                                    href="#"
                                    :class="{ 'active' : category.id == selectedCategoryId }"
                                    @click="selectCategory(category.id, category.name)"
                                >
                                    {{ category.name }}
                                </b-list-group-item>
                            </b-list-group>
                        </b-collapse>
                    </div>
                    <div class="widget">
                        <div class="widget-header d-flex align-items-center justify-content-between">
                            <a href="/ranking" class="d-inline-block">
                                <span class="widget-title m-2">シーンから探す</span>
                            </a>
                            <b-icon :icon="sceneGroupShown ? 'chevron-double-down' : 'chevron-double-up'" font-scale="1" class="mr-1" v-b-toggle.collapse-scenes></b-icon>
                        </div>
                        <b-collapse visible id="collapse-scenes">
                            <b-list-group>
                                <b-list-group-item
                                    v-for="(scene, i) in scenes"
                                    :key="i"
                                    href="#"
                                    :class="{ 'active' : scene.id == selectedSceneId }"
                                    @click="selectScene(scene.id, scene.name)"
                                >
                                    {{ scene.name }}
                                </b-list-group-item>
                            </b-list-group>
                        </b-collapse>
                    </div>
                </aside>
            </b-row>
        </div>
    </b-container>
</template>
<script>
export default {
    name: 'Ranking',
    props: ['sceneId', 'categoryId', 'sceneName', 'categoryName'],
    data() {
        return {
            selectedSceneId: this.sceneId,
            selectedSceneName: this.sceneName,
            selectedCategoryId: this.categoryId,
            selectedCategoryName: this.categoryName,
            scenes: [],
            categories: [],
            currentPage: 1,
            perPage: 8,
            totalCount: '',
            appRankings: [],
            newApps: [],
            newComments: [],
            sceneGroupShown: true,
            categoryGroupShown: true
        }
    },
    computed: {
        pageTitle() {
            if (this.selectedSceneId && !this.selectedCategoryId) {
                return this.selectedSceneName + 'アプリランキング' 
            } else if(this.selectedSceneId && this.selectedCategoryId) {
                return this.selectedSceneName + ' ' + this.selectedCategoryName + 'ランキング'
            } else if(!this.selectedSceneId && this.selectedCategoryId) {
                return this.selectedCategoryName + 'ランキング'
            } else {
                return '人気アプリランキング'
            }
        },
        breadcrumbs() {
            const name = this.pageTitle
            let slug = 'ranking'
            if (this.selectedSceneId) {
                slug = 'ranking?scene_id=' + this.selectedSceneId
            } else if(this.selectedCategoryId) {
                slug = 'ranking?category_id=' + this.selectedCategoryId
            }
            return [{
                name: name,
                slug: slug
            }]
        }
    },
    created() {
        this.getScenes()
        this.getCategories()
        this.getAppList()
        if (this.selectedSceneId || this.selectedCategoryId) {
            this.getNewComments()
        } else {
            this.getNewApps()
        }
    },
    mounted() {
        this.$root.$on('bv::collapse::state', (collapseId, isJustShown) => {
            if (collapseId == 'collapse-scenes') {
                this.sceneGroupShown = isJustShown
            } else {
                this.categoryGroupShown = isJustShown
            }
        })
    },
    methods: {
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
        goToDetail(appId) {
            location.href = '/app/' + appId
        },
        selectScene(sceneId, sceneName) {
            this.selectedSceneId = sceneId
            this.selectedSceneName = sceneName
            this.selectedCategoryId = null
            this.selectedCategoryName = null
            /* if (this.selectedCategoryId) {
                location.href = '/ranking?scene_id=' + this.selectedSceneId + '&' + 'category_id=' + this.selectedCategoryId
            } else {
                location.href = '/ranking?scene_id=' + this.selectedSceneId
            } */
            location.href = '/ranking/scene' + this.selectedSceneId
        },
        selectCategory(categoryId, categoryName) {
            this.selectedCategoryId = categoryId
            this.selectedCategoryName = categoryName
            this.selectedSceneId = null
            this.selectedSceneName = null
            /* if (this.selectedSceneId) {
                location.href = '/ranking?scene_id=' + this.selectedSceneId + '&' + 'category_id=' + this.selectedCategoryId
            } else {
                location.href = '/ranking?category_id=' + this.selectedCategoryId
            } */
            location.href = '/ranking/category' + this.selectedCategoryId
        },
        categoryLink(categoryId, categoryName) {
            return '/ranking/category' + this.selectedCategoryId;
        },
        sceneLink(sceneId, sceneName) {
            return '/ranking/scene' + this.selectedSceneId;
        },
        selectPage() {
            this.getAppList()
        },
        getAppList() {
            axios.post('/app-list', {
                scene_id: this.selectedSceneId,
                category_id: this.selectedCategoryId,
                current_page: this.currentPage,
                per_page: this.perPage
            }).then(res => {
                this.totalCount = res.data.total_count
                this.appRankings = res.data.popular_apps
            }).catch(err => {
                console.log(err)
            })
        },
        getNewComments() {
            axios.post('/get-new-comments', {
                scene_id: this.selectedSceneId,
                category_id: this.selectedCategoryId
            }).then(res => {
                this.newComments = res.data.new_comments
            }).catch(err => {
                console.log(err)
            })
        },
        getNewApps() {
            axios.get('/get-new-apps')
            .then(res => {
                this.newApps = res.data.new_apps
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
<style lang="scss" scoped>
.ranking-page {
    padding: 20px 10px;
    .left-side {
        flex: 0;
        min-width: 225px;
        .widget {
            margin-bottom: 20px;
            .widget-header {
                .b-icon {
                    cursor: pointer;
                    &:focus {
                        outline: none;
                    }
                }
            }
            .widget-title {
                display: block;
                font-size: 20px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }
            .list-group {
                margin-left: 10px;
                font-size: 14px;
            }
        }
    }
    .right-side {
        flex: 0;
        min-width: 235px;
        .app-icon {
            width: 80px;
            height: 80px;
            border-radius: 3px;
        }
        .app-title {
            font-size: 15px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            max-height: 45px;
            max-width: 220px;
        }
        .comment {
            font-size: 14px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            max-height: 63px;
            max-width: 220px;
        }
    }
    .popular-app-wrapper {
        flex: 1;
        padding: 0 30px;
        min-width: 360px;
        .title {
            color: #086ad8;
            font-weight: bold;
        }
        .box-content {
            .app-icon {
                max-width: 60%;
                border-radius: 5px;
            }
            .review-count {
                letter-spacing: 0.6px;
                font-weight: 400;
                font-size: 15px;
            }
            .app-title {
                font-size: 16px;
                line-height: 20px;
                font-weight: 500;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                max-height: 48px;
                min-height: 40px;
            }
        }
    }
    .box-content {
        cursor: pointer;
        background: white;
        padding: 10px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 5px 15px 10px -5px rgba(51,51,51,.1);
        position: relative;
        margin-bottom: 30px;
    }
    .b-rating {
        font-size: 0.7rem;
        border: none;
        padding: 0;
    }
    hr {
        border-top: 3px solid black;
    }
    @media screen and (max-width: 1400px) {
        .popular-app-wrapper {
            .score-text {
                font-size: 35px;
            }
            .b-rating {
                font-size: 0.7rem;
            }
        }
        .right-side {
            .app-icon {
                width: 100px;
            }
            .app-title {
                min-width: 130px;
            }
        }
    }
    @media screen and (max-width: 768px) {
        .left-side {
            flex: 1;
            .list-group {
                margin-left: 0 !important;
            }
        }
        .popular-app-wrapper {
            min-width: 340px !important;
            padding: 10px 20px 20px 5px !important;
            .title {
                font-size: 1.5rem;
            }
        }
        .right-side {
            flex: 1;
        }
    }
}
</style>
