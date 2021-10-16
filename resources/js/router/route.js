import dataTable from './../components/DataTableComponent'
import createForm from './../components/CreateOrUpdateForm'

const routes = [
    {
        path: '/',
        component: dataTable,
        name: "Campaign"
    },

    {
        path: '/campaign-form',
        component: createForm,
        name: "Campaign form"
    }
];

export default routes;