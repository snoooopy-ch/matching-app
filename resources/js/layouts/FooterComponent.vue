<template>
    <div class="footer-wrapper">
        <b-container>
            <b-row class="justify-content-between mb-4">
                <b-col v-for="(item, i) in footerList" :key="i" lg="2" md="4" sm="6" class="mb-4">
                    <h4 class="footer-title">{{ item.title }}</h4>
                    <ul v-if="item.subLinks && item.subLinks.length > 0" class="footer-list">
                        <li v-for="(subLink, j) in item.subLinks" :key="j" class="mb-2">
                            <a :href="subLink.path" :target="subLink.target ? subLink.target : '_self'">{{ subLink.title }}</a>
                        </li>
                    </ul>
                </b-col>
            </b-row>
            <b-row>
                <b-col lg="12" class="text-center">
                    <h6>マッチングアプリがみつかる&nbsp;&nbsp;|&nbsp;&nbsp;マチアプ Copyright©2021</h6>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>
<script>
export default {
    name: 'FooterComponent',
    data() {
        return {
            footerList: [
                {
                    title: 'マチアプについて',
                    subLinks: [
                        { path: 'https://www.wstyle.co.jp/outline', title: '会社概要', target: '_blank' },
                        { path: '/terms', title: '利用規約' },
                        { path: '/privacy', title: 'プライバシーポリシー' },
                        /* { path: '/media', title: 'メディア掲載情報' },
                        { path: '/reviews', title: '口コミ一覧' },
                        { path: '/operator', title: 'アプリ運営者の皆さま' }, */
                    ],
                },
                {
                    title: 'アプリを探す',
                    subLinks: [
                        { path: '/ranking/scene4', title: 'シーンから探す' },
                        { path: '/ranking/category6', title: 'カテゴリから探す' }
                    ]
                },
                {
                    title: 'ヘルプ',
                    subLinks: [
                        { path: '/blogs', title: 'ブログ' }
                    ]
                }
            ]
        }
    }
}
</script>
<style lang="scss" scoped>
.footer-wrapper {
    padding: 50px 5px;
    background: #e8e8e8;
    .footer-title {
        font-size: 20px;
        margin-bottom: 20px;
        font-weight: 700;
        color: black;
    }
    .footer-list {
        list-style: none;
        padding: 0;
        a {
            color: #131313;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
        }
    }
}
</style>
