<template>
    <div class="home">
        <div class="error" v-if="errors.length">
            <span v-for="err in errors">
                {{ err }}
            </span>
            <hr>
        </div>
        <div>
            <header></header>
            <side-bar></side-bar>
        </div>
    </div>
</template>

<script>
    import Sidebar from './common/Sidebar';
    import Header from './common/Header';
    import Category from

    export default {
        data(){
            return {
                errors: [],
            }
        }
    }
</script>
