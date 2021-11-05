<template>
    <b-container class="page-content">
        <div class="blog-list-page min-vh-100 pb-5">
            <section class="banner" :style="{ 'background-image': 'url(/img/bg-blog.jpg)' }">
                <div class="banner-heading">
                    <h1>ブログ</h1>
                </div>
            </section>
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
                                        {{ blog.updated_at | formatDate }}&nbsp; | &nbsp;<b-link :href="'/' + blog.slug" class="category">{{ blog.category }}</b-link>
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
                    <div class="d-flex justify-content-center mb-5">
                        <b-pagination
                            v-model="currentPage"
                            :total-rows="totalCount"
                            :per-page="perPage"
                            @input="selectPage"
                        ></b-pagination>
                    </div>
                </b-col>
                <b-col lg="3" md="6" sm="12">
                    <aside>
                        <h5 class="title">カテゴリー</h5>
                        <ul class="category-list">
                            <li v-for="(category, i) in categories" :key="i">
                                <a :href="'/' + category.slug">{{ category.name }}</a>
                            </li>
                        </ul>
                    </aside>
                </b-col>
            </b-row>
        </div>
    </b-container>
</template>
<script>
export default {
    name: 'Blogs',
    data() {
        return {
            blogs: [],
            categories: [],
            currentPage: 1,
            perPage: 10,
            totalCount: '',
        }
    },
    created() {
        this.getBlogs();
        this.getCategories();
    },
    methods: {
        getBlogs() {
            axios.post('blogsByPagination', {
                current_page: this.currentPage,
                per_page: this.perPage
            }).then(res => {
                console.log(res.data)
                this.blogs = res.data.blogs
                this.totalCount = res.data.total_count
            })
            .catch(err => {
                console.log(err)
            })
        },
        getCategories() {
            axios.get('blog-categories')
                .then(res => {
                    this.categories = res.data
                })
                .catch(err => {
                    console.log(err)
                })
        },
        selectPage() {
            this.getBlogs()
        },
    }
}
</script>
<style lang="scss" scoped>
@import "./../../sass/_variables.scss";
.banner {
    margin-bottom: 30px;
    background: no-repeat center center;
    background-size: cover;
}
.banner-heading {
    padding: 200px 0;
    text-align: center;
    h1 {
        color: white;
        font-weight: bold;
    }
    @media screen and (max-width: 480px) {
        padding: 150px 0;
    }
}
.blog-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
.blog-list {
    margin-bottom: 30px;
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
            .category {
                color: $blog-date-color !important;
                padding: 0 !important;
            }
        }
        .blog-title {
            font-weight: bold;
            line-height: 1.5;
            margin-bottom: 15px;
            min-height: 60px;
        }
        @media screen and (max-width: 480px) {
            .posted-date {
                font-size: 12px;
            }
            .blog-title {
                line-height: 1.2 !important;
                font-size: 18px !important;
                min-height: 43px !important;
            }
        }
    }
}
aside {
    .title {
        border-bottom: 2px solid green;
        padding-bottom: 10px;
        font-weight: 700;
    }
    .category-list {
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
</style>