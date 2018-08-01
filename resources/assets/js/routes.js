import BackendCategoryList from './components/backend/categories/Index';
import BackendCategoryForm from './components/backend/categories/Form';
import Dashboard from './components/backend/DashBoard';

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            accessedBy: ''
        }
    },
    {
        path: '/categories',
        name: 'categories',
        component: BackendCategoryList,
        meta: {
            accessedBy: ''
        }
    },
    {
        path: '/categories/create',
        name: 'create-category',
        component: BackendCategoryForm,
        meta: {
            accessedBy: ''
        }
    },
    {
        path: '/categories/edit/:id',
        name: 'edit-category',
        component: BackendCategoryForm,
        meta: {
            accessedBy: ''
        }
    },
];

export default routes;