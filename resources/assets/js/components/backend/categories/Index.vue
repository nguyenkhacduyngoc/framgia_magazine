<template>
    <div class="list-categories">
        <h2>LIST Category</h2>
        <div class="categories-table">
            <router-link class="btn btn-success" :to="{ name: 'create-category' }">Create</router-link>
            <table class="table table-striped table-advance table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(category, index) in list_categories">
                        <td v-if="!category.is_edit">{{ category.name }}</td>
                        <td v-else>
                            <input type=text v-model="category.name">
                        </td>  
                        <td v-if="!category.is_edit">{{ category.description }}</td>
                        <td v-else>
                            <input type=text v-model="category.description">
                        </td>
                        <td>{{ category.created_at }}</td>
                        <td v-if="!category.is_edit">
                            <button class="btn btn-primary" @click="editCategory(category)">Edit</button>
                            <button class="btn btn-danger" @click="deleteCategory(category,index)">Delete</button>
                        </td>
                        <td v-else>
                            <button class="btn btn-primary" @click="updateCategory(category)">Update</button>
                            <button class="btn btn-danger" @click="cancelEdit(category)">Cancel</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>    
</template>

<script>
    import { mapState } from 'vuex';
    import CategoryApi from '../../../api/CategoryApi';

    export default {
        data() {
            return {
                list_categories: [],
                errors: [],
                category_cached: {}
            }
        },
        
    }
</script>

<style lang="scss">
@import '/css/frontend/dataTables.bootstrap4.min.css';
</style>


// async created() {
//             try {
//                 const result = await CategoryApi.getCategory();
//                 this.list_categories = result.data;
//                 this.list_categories.forEach(item => {
//                     this.$set(item, 'is_edit', false);
//             });
//             } catch (e) {
//                 this.errors = e.response.data.errors;
//             }
//         },
//         mounted() {
//             this.category_cached = {};
//         },
//         methods: {
//             editCategory (category) {
//                 category.is_edit = true;
//                 this.category_cached = Object.assign({}, category);
//             },
//             async updateCategory (category) {
//                 try {
//                     const result = await CategoryApi.update(category);
//                     this.category_cached = Object.assign({}, category);
//                     category.is_edit= false;
//                 } catch (e) {
//                     this.errors = e.response.data.errors;
//                 }
//             },
//             async deleteCategory (category, index) {
//                 try {
//                     var confirm_value = confirm('Do you want to delete this category?');
//                     if(confirm_value) {
//                         await CategoryApi.destroy(category);
//                         this.list_categories.splice(index,1);
//                     }
//                 } catch (e) {
//                     this.errors = e.response.data.errors;
//                 }
//             },
//             async cancelEdit (category) {
//                 category.name = this.category_cached.name;
//                 category.description = this.category_cached.description;
//                 category.is_edit= false;
//             }
//         }