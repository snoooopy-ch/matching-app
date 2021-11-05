<template>
    <b-container class="page-content">
        <div class="blog-category-page min-vh-100 pt-2 pb-5">
            <breadcrumb-component :items="breadcrumbs"></breadcrumb-component>
            <b-row>
                <b-col lg="9" md="12" sm="12">
                    <div class="blog-list">
                        <article 
                            v-for="(blog, i) in blogs" 
                            :key="i"
                            class="blog-item"
                        >
                            <b-link :href="'/' + blog.slug + '/' + blog.id" class="d-flex align-items-center">
                                <div class="blog-thumbnail-container">
                                    <b-img :src="blog.thumb_img"></b-img>
                                </div>
                                <div class="blog-info">
                                    <p class="posted-date">
                                        {{ blog.updated_at | formatDate }}&nbsp; | &nbsp;{{ blog.category }}
                                    </p>
                                    <h5 class="blog-title">
                                        {{ blog.title }}
                                    </h5>
                                    <!-- <div class="blog-content" v-html="blog.content">
                                    </div> -->
                                </div>
                            </b-link>
                        </article>
                    </div>
                </b-col>
                <b-col lg="3" md="6" sm="6">
                    <aside 
                        v-for="(blog, i) in recommendBlogs" 
                        :key="i" 
                        class="recommend-blogs"
                    >
                        <article class="recommend-blog-item">
                            <div class="blog-thumbnail-container">
                                <b-img :src="blog.thumb_img"></b-img>
                            </div>
                            <div class="blog-info">
                                <h6 class="blog-title">
                                    {{ blog.title }}
                                </h6>
                                <p class="blog-category">
                                    <span class="badge badge-info">{{ blog.slug }}</span>
                                </p>
                            </div>
                        </article>
                    </aside>
                </b-col>
            </b-row>
        </div>
    </b-container>
</template>
<script>
import BreadcrumbComponent from '../components/BreadcrumbComponent.vue'
export default {
    name: 'BlogCategory',
    components: {
        BreadcrumbComponent
    },
    props: ['categorySlug'],
    data() {
        return {
            blogs: [],
            breadcrumbs: [],
            recommendBlogs: [],
            categoryName: ''
        }
    },
    created() {
        this.getBlogsByCategory(this.categorySlug)
    },
    methods: {
        getBlogsByCategory(categorySlug) {
            axios.post('getBlogsByCategory', { category_slug: categorySlug })
                .then(res => {
                    this.blogs = res.data.blogs
                    this.categoryName = res.data.category.name
                })
                .catch(err => {
                    console.log(err)
                })
        },
        /* goToDetail(categorySlug, blogId) {
            this.$router.push({
                name: 'blog',
                params: { blog_category: categorySlug, id: blogId }
            });
        } */
    }
}
</script>
<style lang="scss" scoped>
@import "./../../sass/_variables.scss";
.blog-list {
    margin-bottom: 30px;
}
.blog-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
article.blog-item {
    background: #fff;
    border-color: #ddd;
    border-style: solid;
    border-width: 1px 1px 0 1px;
    position: relative;
    a {
        padding: 20px;
        color: #212529;
        &:hover {
            text-decoration: none !important;
        }
        @media screen and (max-width: 480px) {
            padding: 5px 12px;
        }
    }
    &:last-child {
        border-bottom-width: 1px;
    }
    .blog-thumbnail-container {
        width: 180px;
        height: 180px;
        min-width: 180px;
        img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 3px;
        }
        @media screen and (max-width: 480px) {
            width: 120px;
            height: 120px;
            min-width: 120px;
        }
    }
    .blog-info {
        padding-left: 6%;
        .posted-date {
            font-size: 14px;
            color: $blog-date-color;
        }
        .blog-title {
            font-weight: bold;
            line-height: 1.5;
            margin-bottom: 15px;
            min-height: 60px;
        }
        /* .blog-content {
            line-height: 1.8;
            min-height: 56px;
        } */
        @media screen and (max-width: 480px) {
            .posted-date {
                font-size: 12px;
            }
            .blog-title {
                line-height: 1.2 !important;
                font-size: 18px !important;
                min-height: 43px !important;
            }
            /* .blog-content {
                line-height: 1.5;
                font-size: 14px !important;
                min-height: 42px;
            } */
        }
    }
}
aside.recommend-blogs {
    .recommend-blog-item {
        cursor: pointer;
    }
    .blog-thumbnail-container {
        img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }
    .blog-info {
        padding: 15px 20px;
        border: 1px solid #ddd;
        background: white;
        .blog-title {
            font-weight: bold;
            line-height: 1.5;
        }
    }
    @media screen and (max-width: 480px) {
        width: 70%;
    }
}
</style>