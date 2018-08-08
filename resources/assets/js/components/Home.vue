<template>
    <div class="home">
        <div class="error" v-if="errors.length">
            <span v-for="err in errors">
                {{ err }}
            </span>
            <hr>
        </div>
        <div class="create-form">
            <div class="category-name-input">
                <input type="text" v-model="category.name">
            </div>
            <div class="category-name-input">
                <input type="text" v-model.number="category.description">
            </div>
            <div class="create-button">
                <button @click="createCategories">Create</button>
            </div>
        </div>
        <div class="list-categories">
           <h2>LIST Category</h2>
           <div class="categories-table">
               <table class="table table-bordered">
                   <thead>
                       <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Description</th>
                           <th>Date created</th>
                       </tr>
                   </thead>
                    <tbody>
                        <tr v-for="(category,index) in list_categories">

                            
                            <td v-if="!category.isEdit">{{ category.name }}</td>
                            <td v-else>
                                <input type=text v-model="category.name">
                            </td>  
                            <td v-if="!category.isEdit">{{ category.description }}</td>
                            <td v-else>
                                <input type=text v-model="category.description">
                            </td>
                            <td>{{ category.created_at }}</td>
                            <td v-if="!category.isEdit">
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
    </div>
</template>

<script>
    import moment from 'moment';
    export default {  
        data() {
            return {
                category: {
                    name: '',
                    description: ''
                },
                errors: [],
                list_categories: [],
            }
        },
        created() {
           this.getListCategories()
        },
        mounted(){
            this.cachedCategory = {};
        },
        methods: {
            getListCategories(){
                axios.get('/admin/categoriesApi')
                .then(response => {
                    this.list_categories = response.data;
                    this.list_categories.forEach(item => {
                        Vue.set(item, 'isEdit', false)
                    });
                }).catch(error => {
                    this.errors = []
                    if(error.response.data.errors.name){
                        this.errors.push(error.response.data.errors.name)
                    }
                    if(error.response.data.erorrs.description){
                        this.errors.push(error.response.data.errors.description)
                    }
                })
            },
            createCategories(){
                axios.post('/admin/categoriesApi', {
                    name: this.category.name, 
                    description: this.category.description
                }).then(response => {

                    console.log(response.data);
                    console.log( this.list_categories);
                    this.list_categories.push({
                        id: response.data.id,
                        name: response.data.name,
                        description: response.data.description,
                        created_at: response.data.created_at,
                        isEdit: false
                    });
                    this.category = []
                }).catch(error => {
                    this.errors = []
                    if(error.response.data.errors.name) {
                        this.errors.push(error.response.data.errors.name)
                    }
                    if(error.response.data.errors.price) {
                        this.errors.push(error.response.data.errors.price)
                    }
                })
            },
            updateCategory(category){
                axios.put('/admin/categoriesApi/'+category.id, {
                    name: category.name,
                    description: category.description,
                }).then(response => {
                    console.log(response.data)
                    this.cachedCategory = Object.assign({}, category)
                    category.isEdit = false
                }).catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            editCategory(category){
                this.cachedCategory = Object.assign({}, category)
                category.isEdit = true
            },
            cancelEdit(category){
                category.name = this.cachedCategory.name
                category.description = this.cachedCategory.description
                category.isEdit = false
            },
            deleteCategory(category, index){
                axios.delete('/admin/categoriesApi/'+category.id)
                .then(response => {
                    this.list_categories.splice(index, 1)
                }).catch(error => {
                    this.errors = error.response.data.errors.name
                })
            }
        }
    }    
</script>
