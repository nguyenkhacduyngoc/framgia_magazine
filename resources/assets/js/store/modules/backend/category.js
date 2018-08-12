import CategoryApi from '../../../api/CategoryApi';

const GET_CATEGORIES = 'GET_CATEGORIES';
const GET_NEW_CATEGORY = 'GET_NEW_CATEGORY';
const SET_UPDATE_CATEGORY = 'SET_UPDATE_CATEGORY';
const SET_ERROR = 'SET_ERROR';
const DELETE_CATEGORY = 'DELETE_CATEGORY';

const state = {
    error: '',
    categories: [],
};

const getters = {
    CATEGORIES: state => {
        return state.categories;
    }
};

const mutations = {
    [GET_CATEGORIES] (state, categories) {
        state.categories = categories;
    },
    [GET_NEW_CATEGORY] (state, new_category){
        state.categories = [new_category, ...state.categories];
    },
    [SET_UPDATE_CATEGORY] (state, update_category){
        state.categories = state.categories.map((category) => category.id === update_category.id ? 
        { ...category,
            name: update_category.name,
            description: update_category.description
        } : category )
    },
    [DELETE_CATEGORY] (state, destroy_category){
        state.categories =  state.categories.filter((category) => category !== destroy_category.id)
    },
    [SET_ERROR] (state, error) {
        state.error = error;
    },
}

const actions = {
    async getListCategories({commit}) {
        try {
            const categories = await CategoryApi.getCategory();
            commit(GET_CATEGORIES, categories);
        } catch (e) {
            commit(SET_ERROR, e.response.data.message);
        }
    },
    async createCategory({commit, state}, category){
        try {
            const new_category = await CategoryApi.store(category);
            commit(GET_NEW_CATEGORY, new_category);
        } catch (e) {
            commit(SET_ERROR, e.response.data.message);
        }
    },
    async updateCategory({commit}, category){
        try {
            const update_category = await CategoryApi.update(category);
            commit(SET_UPDATE_CATEGORY, update_category);
        } catch (e) {
            commit(SET_ERROR, e.response.data.message);
        }
    },
    async destroyCategory({commit}, category){
        try {
            const destroy_category = await CategoryApi.destroy(category);
            commit(DELETE_CATEGORY, destroy_category);
        } catch (e) {
            commit(SET_ERROR, e.response.data.message);
        }
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}