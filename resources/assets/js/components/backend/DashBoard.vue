<template>
        <div>
            <page-header></page-header>
            <page-sidebar></page-sidebar>
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <router-view></router-view>
                </section>
            </section>
        </div>
</template>

<script>
    import PageSidebar from './common/PageSidebar';
    import PageHeader from './common/PageHeader';

    export default {
        computed: {
            
        },
        created() {
            
        },
        methods: {

        },
        components: {
            PageSidebar,
            PageHeader
        }
    }
</script>
