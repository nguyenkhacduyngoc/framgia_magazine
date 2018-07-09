<template>
    <div class="api-call-category">
        <div class="error" v-if="errors.length">
            <span v-for="err in errors">
                {{ err }}
            </span>
            <hr>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class= 'col-sm-3 control-label' for="name"> Name </label>
                <div class="col-sm-7">
                    <input type="text" v-model="category.name">
                </div>
            </div>
            <div class="form-group">
                <label class= 'col-sm-3 control-label' for="name"> Description </label>
                <div class="col-sm-7">
                    <input type="text" v-model="category.description">
                </div>
            </div>
            <div class="form-group">
                <button @click="createCategory" class ='col-md-1 col-md-offset-5 btn btn-primary'>Create</button>
                <a class="col-md-1 col-md-offset-1 btn btn-danger"
                    href="{{ route('admin.categories.index') }}"> {!! 'Cancel' !!} </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                category: {
                    name: '',
                    description: '',
                },
                errors: [],
            }
        },
        methods: {
            createCategory() {
                axios.post('', {
                    name: this.category.name,
                    description: this.category.description
                    }).then(response => {
                        console.log(response.data.result)
                    }).catch(error => {
                        this.errors = error.response.data.errors.name
                    })
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>