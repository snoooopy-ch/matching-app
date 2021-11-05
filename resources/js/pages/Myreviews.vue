<template>
    <div class="myreviews-page py-2 py-md-5">
        <h5 class="page-title">投稿したレビュー&nbsp;({{ myreviews.length }})</h5>
        <div 
            v-for="(review, i) in myreviews"
            :key="i" 
            class="review-list"
        >
            <div class="review d-flex flex-row">
                <div class="review-icon mr-2 mr-md-3">
                    <a :href="'/app/' + review.app_id" class="d-block">
                        <img :src="review.icon" class="app-icon">
                    </a>
                    <b-badge class="app-type" variant="info">
                        {{ review.type === 1 ? 'Android' : 'iOS' }}
                    </b-badge>
                </div>
                <div class="review-content">
                    <h6 class="app-title">
                        <a :href="'/app/' + review.app_id">
                            {{ review.title }}
                        </a>
                    </h6>
                    <p>
                        <b-form-rating
                            :value="review.rating"
                            inline
                            readonly
                            no-border
                            precision="0"
                            show-value
                            size="sm"
                            class="p-0 mr-2"
                            variant="warning"
                        ></b-form-rating>
                        <span class="posted-date">{{ review.created_at | formatDate }}</span>
                    </p>
                    <p class="app-comment">
                        {{ review.comment }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Myreviews',
    data() {
        return {
            myreviews: []
        }
    },
    created() {
        this.getMyReviews()
    },
    methods: {
        getMyReviews() {
            this.$http({
                url: 'get-my-reviews',
                method: 'POST',
                data: {
                    user_id: this.$auth.user().id
                }
            }).then((res) => {
                this.myreviews = res.data.my_reviews
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
<style lang="scss" scoped>
.page-title {
    font-weight: 600;
    padding-bottom: 10px;
    border-bottom: 2px solid #000;
}
.review {
    padding: 10px;
    margin-bottom: 20px;
    background: #e0e0e0;
    border-radius: 5px;
    .app-icon {
        width: 70px;
        border-radius: 5px;
        margin-bottom: 5px;
    }
    .app-type {
        width: 100%;
    }
    .posted-date {
        font-size: 15px;
        font-weight: 500;
        display: inline-block;
        vertical-align: text-bottom;
    }
}
</style>