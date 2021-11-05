<template>
    <b-container class="page-content">
        <div class="blog-page min-vh-100 pt-1 pb-5">
            <breadcrumb-component :items="breadcrumbs"></breadcrumb-component>
            <div class="d-flex flex-row">
                <div class="main-area mr-lg-2 mr-0">
                    <section class="blog-header">
                        <div class="d-flex">
                            <div class="thumbnail">
                                <img :src="blog.thumb_img" alt="thumbnail" class="w-100" />
                            </div>
                            <div class="info px-2 px-lg-4 py-3">
                                <h4 class="title">{{ blog.title }}</h4>
                                <p class="update-date mt-2">最終更新日：{{ blog.updated_at | formatDate }}</p>
                            </div>
                        </div>
                    </section>
                    <section class="blog-content my-lg-5 my-3 mx-lg-3 mx-2">
                        <div v-html="blog.content"></div>
                    </section>
                </div>
                <div class="aside-area my-lg-0 my-2">
                    <aside class="title">
                        <h6>人気記事</h6>
                    </aside>
                    <aside class="content">
                        <ul class="blog-list">
                            <li v-for="(blog, i) in popularBlogs" :key="i" class="py-3">
                                <a :href="'/' + blog.slug +'/' + blog.id" class="d-flex">
                                    <img :src="blog.thumb_img" alt="other thumbnail" />
                                    <div class="title pl-2">{{ blog.title }}</div>
                                </a>
                            </li>
                        </ul>
                    </aside>
                    <aside class="title">
                        <h6>新着記事</h6>
                    </aside>
                    <aside class="content">
                        <ul class="blog-list">
                            <li v-for="(blog, i) in newBlogs" :key="i" class="py-3">
                                <a :href="'/' + blog.slug +'/' + blog.id" class="d-flex">
                                    <img :src="blog.thumb_img" alt="other thumbnail" />
                                    <div class="title pl-2">{{ blog.title }}</div>
                                </a>
                            </li>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </b-container>
</template>
<script>
import BreadcrumbComponent from '../components/BreadcrumbComponent.vue'
export default {
    name: 'Blog',
    components: {
        BreadcrumbComponent
    },
    props: ['blogId', 'category'],
    data() {
        return {
            blog: {},
            breadcrumbs: [],
            popularBlogs: [],
            newBlogs: []
        }
    },
    created() {
        this.getBlog(this.blogId)
        this.getOtherBlogs(this.blogId)
        this.updateVisitCount(this.blogId)
        this.getNewBlogs(this.blogId)
    },
    methods: {
        getBlog(id) {
            axios.get(`/blog/${id}`)
                .then(res => {
                    this.blog = res.data
                    this.breadcrumbs.push({
                        name: this.blog.name,
                        slug: this.blog.slug
                    })
                    document.title = res.data.title
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getOtherBlogs(id) {
            axios.post('/other-blogs', { id: id})
                .then(res => {
                    this.popularBlogs = res.data
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getNewBlogs(id) {
            axios.post('/new-blogs', { id: id})
                .then(res => {
                    this.newBlogs = res.data
                })
                .catch(err => {
                    console.log(err)
                })
        },
        updateVisitCount(blogId) {
            axios.post('/update-blog-visit-count', {
                blog_id: blogId
            })
            .then(res => {})
            .catch(err => {})
        }
    }
}
</script>
<style lang="scss" scoped>
.blog-page {
    .main-area {
        max-width: 100%;
        word-break: break-word;
        .blog-header {
            .thumbnail {
                width: 200px;
                flex: none;
            }
            .title {
                min-width: 400px;
                line-height: 1.4;
                font-weight: 700;
            }
            .update-date {
                font-size: 14px;
                color: #666;
            }
        }
    }
    .aside-area {
        min-width: 300px;
        width: 300px;
        .title h6 {
            border-bottom: 2px solid green;
            padding-bottom: 10px;
            font-weight: 700;
        }
        .blog-list {
            list-style: none;
            padding: 0;
            margin: 0;
            height: 400px;
            li {
                border-bottom: 1px solid #ddd;
                img {
                    flex: none;
                    width: 80px;
                }
                .title {
                    font-size: 12px;
                }
            }
        }
    }
    @media screen and (max-width: 992px) {
        & > div {
            flex-wrap: wrap;
        }
    }
    @media screen and (max-width: 769px) {
        .blog-header > div {
            flex-wrap: wrap;
        }
    }
    @media screen and (max-width: 480px) {
        .blog-header {
            div.thumbnail {
                width: 100% !important;
            }
            .title {
                font-size: 1.3rem !important;
                min-width: 300px !important;
            }
        }
        iframe {
            max-width: 340px !important;
        }
    }
}
</style>
