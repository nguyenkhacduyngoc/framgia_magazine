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
                       <tr v-for="category in list_categories">
                           <td>{{ category.id }}</td>
                           <td>{{ category.name }}</td>
                           <td>{{ category.description }}</td>
                           <td>{{ category.created_at }}</td>
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
        methods: {
            getListCategories(){
                axios.get('/admin/categoriesApi')
                .then(response => {
                    this.list_categories = response.data
                    // console.log(list_categories);
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
                    console.log(response.data)
                    this.list_categories.push({
                        id: response.data.id,
                        name: response.data.name,
                        description: response.data.description,
                        created_at: response.data.created_at,
                        // created_at: moment().format('YYYY-MM-DD HH:mm:ss')
                    })
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


        }
    }    
</script>