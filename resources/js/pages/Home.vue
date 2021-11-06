<template>
    <b-container class="page-content home-page">
        <section class="banner">
            <b-img src="/img/banner.png"></b-img>
        </section>
        <section class="scene">
                <b-row class="justify-content-center">
                    <h2 class="title">シーンを選択</h2>
                </b-row>
                <b-row>
                    <b-col lg="12">
                        <swiper :options="sceneSwiperOptions">
                            <swiper-slide v-for="(scene, i) in scenes" :key="i">
                                <!-- <b-card no-body :header="scene.name">
                                    <b-list-group flush>
                                        <b-list-group-item href="#">Cras justo odio</b-list-group-item>
                                        <b-list-group-item href="#">Dapibus ac facilisis in</b-list-group-item>
                                        <b-list-group-item href="#">Vestibulum at eros</b-list-group-item>
                                    </b-list-group>

                                    <b-card-body>
                                        <b-button href="/scene" variant="outline-info">アプリを探す</b-button>
                                    </b-card-body>
                                </b-card> -->
                                <b-card
                                    :title="scene.name"
                                    :img-src="scene.thumb_img"
                                    img-alt="Image"
                                    img-top
                                    tag="article"
                                    class="scene-card m-2 mb-lg-4 text-left"
                                >
                                    <b-button :href="'/ranking?scene_id='+ scene.id" variant="outline-info">アプリを探す</b-button>
                                </b-card>
                            </swiper-slide>
                            <div class="swiper-pagination" slot="pagination"></div>
                        </swiper>
                    </b-col>
                </b-row>
        </section>
        <section class="blog">
            <b-row class="justify-content-center">
                <h2 class="title">ブログ</h2>
            </b-row>
            <b-row>
                <b-col lg="12">
                    <swiper :options="blogSwiperOptions">
                        <swiper-slide v-for="(blog, i) in blogs" :key="i">
                            <a :href="blog.slug" class="blog-category"><b-badge variant="info">{{ blog.category }}</b-badge></a>
                            <b-card
                                :img-src="blog.thumb_img"
                                img-alt="Blog"
                                img-top
                                class="m-3 mb-lg-3"
                                footer-tag="footer"
                            >
                                <b-card-text>
                                    {{ blog.title }}
                                </b-card-text>
                                <template #footer>
                                    <b-link :href="'/' + blog.slug + '/' + blog.id" class="card-link">
                                        もっと読む
                                    </b-link>
                                </template>
                            </b-card>
                        </swiper-slide>
                        <div class="swiper-pagination" slot="pagination"></div>
                    </swiper>
                </b-col>
            </b-row>
        </section>
    </b-container>
</template>
<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
import "swiper/css/swiper.css"

export default {
    name: 'Home',
    components: {
        Swiper,
        SwiperSlide
    },
    data() {
        return {
            scenes: [],
            blogs: [],
            sceneSwiperOptions: {
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    }
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                }
            },
            blogSwiperOptions: {
                autoplay: false,
                breakpoints: {
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    }
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                }
            }
        }
    },
    mounted() {
        this.getScenes();
        this.getBlogs();
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
        getBlogs() {
            axios.get('/blogs')
            .then(res => {
                this.blogs = res.data
            })
            .catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
<style lang="scss" scoped>
section {
    .title {
        color: #086ad8;
        font-weight: 700;
        line-height: 1.5;
        border-bottom: 3px solid #086ad8;
        margin-bottom: 30px;
    }
    &.banner {
        img {
            width: 100%;
            max-height: 500px;
        }
    }
    &.scene {
        padding: 50px 5px;
        .card {
            transition: all .3s cubic-bezier(.645,.045,.355,1);
            border-radius: 5px;
            box-shadow: 5px 5px 5px rgba(51,51,51,.13);
            &:hover {
                box-shadow: 0px 1px 1px 1px rgb(0 0 0 / 6%);
            }
            .card-title {
                font-size: 1.3rem !important;
            }
            .card-img-top {
                width: 100%;
                height: 220px;
                min-height: 200px;
                object-fit: cover;
            }
        }
    }
    &.blog {
        padding: 0 5px 50px;
        .card {
            border-radius: 10px;
            box-shadow: 0px 3px 13px 1px rgb(0 0 0 / 12%);
            transition: .3s all ease-in-out;
            &:hover {
                box-shadow: 0px 1px 1px 1px rgb(0 0 0 / 6%);
            }
            .card-title {
                font-size: 1.3rem !important;
            }
            .card-img-top {
                width: 100%;
                height: 250px;
                min-height: 200px;
                object-fit: cover;
            }
            .card-text {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                min-height: 48px;
            }
        }
        .swiper-slide {
            width: 35%;
            .blog-category {
                position: absolute;
                top: 25px;
                left: 30px;
                z-index: 1000;
                span {
                    font-size: 85% !important;
                    font-weight: 400;
                }
            }
           /*  @media screen and (max-width: 992px) {
                wi
            } */
        }
    }
}
</style>
