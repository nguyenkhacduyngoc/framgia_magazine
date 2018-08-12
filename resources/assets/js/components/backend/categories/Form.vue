<template>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-table"></i> Category </h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="index.html"> Admin </a></li>
                    <li><i class="fa fa-table"></i> Category </li>
                    <li><i class="fa fa-th-list"></i> Create Category </li>
                </ol>
            </div>
        </div>
        <form class="create-form form-horizontal">
            <div class="category-name-input form-group">
                <label class="col-sm-3 control-label">Name</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" v-model="category.name">
                </div>
            </div>
            <div class="category-name-input form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" v-model.number="category.description">
                </div>
            </div>
            <div class="create-button">
                <button @click="createCategories(category)" class="col-md-1 col-md-offset-5 btn btn-success">Create</button>
                <router-link :to="{name: 'categories'}" class="col-md-1 col-md-offset-1 btn btn-danger">Cancel</router-link>
            </div>
        </form>
    </div>
</template>

<script>
    import CategoryApi from '../../../api/CategoryApi';

    export default {
        data() {
            return {
                category: {}
            }
        },
        computed() {
            
        },
        methods: {
            async createCategories (category) {
                try {
                    const new_category = await CategoryApi.store(category);
                } catch(e) {
                    this.errors = e.response.data.errors;
                }
            },
        }


    }
</script>


