import BackendCategoryList from './components/backend/categories/Index';
import BackendCategoryForm from './components/backend/categories/Form';
import Dashboard from './components/backend/DashBoard';

const routes = [
    {
        path: '/',
        name: 'dashboard',
    },
    {
        path: '/categories',
        name: 'categories',
        component: BackendCategoryList
    },
    {
        path: '/categories/create',
        name: 'create-category',
        component: BackendCategoryForm
    },
];

export default routes;