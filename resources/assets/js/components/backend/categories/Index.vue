<template>
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
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.description }}</td>
                        <td>{{ category.created_at }}</td>
                    </tr>
                </tbody>    
                        
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
</template>


