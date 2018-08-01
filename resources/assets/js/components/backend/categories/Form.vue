<template>
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
</template>



