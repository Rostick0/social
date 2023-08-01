import { createStore } from 'vuex';

const URL = location.protocol + '//' + location.host;
export const URL_BACKEND = URL + '/api';
export const URL_AUTH = URL_BACKEND + '/auth';
export const URL_IMAGE = URL + '/storage/upload/image/'
export const authTokenLocal = () => ({
    'Authorization': 'Bearer ' + localStorage.getItem('access_token')
})

export default createStore({
    modules: {

    }
})