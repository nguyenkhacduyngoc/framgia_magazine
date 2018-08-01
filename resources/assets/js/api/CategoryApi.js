import axios from 'axios';

export default class CategoryApi {
    
    /**
     */
    static getCategory() {
        return axios.get('/admin/categoriesApi');
    }

    /**
     * @param  {} category
     */
    static store(category){
        return axios.post('/admin/categoriesApi', {
            name: category.name,
            description: category.description
        });
    }

    /**
     * @param  {} id
     */
    static findById(id){
        return axios.get('/admin/categoriesApi/' + id);
    }

    /**
     * @param  {} category
     */
    static update(category){
        return axios.put('/admin/categoriesApi/' + category.id, {
            name: category.name,
            description: category.description
        });
    }

    /**
     * @param  {} category
     */
    static destroy(category){
        return axios.delete('/admin/categoriesApi/' + category.id);
    }
    
}