<template>
    <div class="list-categories">
        <h2>LIST Category</h2>
        <div class="categories-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date created</th>
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
                            <button class="btn btn-success" @click="editCategory(category)">Edit</button>
                            <button class="btn btn-success" @click="deleteCategory(category,index)">Delete</button>
                        </td>
                        <td v-else>
                            <button class="btn btn-success" @click="updateCategory(category)">Update</button>
                            <button class="btn btn-success" @click="cancelEdit(category)">Cancel</button>
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
        async created() {
            try {
                const result = await CategoryApi.getCategory();
                this.list_categories = result.data;
                this.list_categories.forEach(item => {
                    this.$set(item, 'is_edit', false);
            });
                console.log(this.list_categories);
            } catch (e) {
                this.errors = e.response.data.errors;
            }
        },
        mounted() {
            this.category_cached = {};
        },
        methods: {
            editCategory (category) {
                category.is_edit = true;
                this.category_cached = Object.assign({}, category);
            },
            async updateCategory (category) {
                try {
                    const result = await CategoryApi.update(category);
                    this.category_cached = Object.assign({}, category);
                    category.is_edit= false;
                } catch (e) {
                    this.errors = e.response.data.errors;
                }
            },
            async deleteCategory (category, index) {
                try {
                    await CategoryApi.destroy(category);
                    this.list_categories.splice(index,1);
                } catch (e) {
                    this.errors = e.response.data.errors;
                }
            },
            async cancelEdit (category) {
                category.name = this.category_cached.name;
                category.description = this.category_cached.description;
                category.is_edit= false;
            }
        }
    }
</script>


