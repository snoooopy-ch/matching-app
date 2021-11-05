<template>
    <b-breadcrumb class="px-0">
        <b-breadcrumb-item href="/">
            <b-icon icon="house-fill" scale="1.25" shift-v="1.25" aria-hidden="true" class="mr-2"></b-icon>
            Home
        </b-breadcrumb-item>
        <b-breadcrumb-item 
            v-for="(item, i) in items" 
            :key="i" 
            :href="'/' + item.slug"
        >
            {{ item.name }}
        </b-breadcrumb-item>
    </b-breadcrumb>
</template>
<script>
export default {
    name: "Breadcrumb",
    props: {
        items: {
            type: Array,
            default: [{
                name: '',
                slug: '#'
            }]
        }
    }
}
</script>
<style lang="scss" scoped>
</style>