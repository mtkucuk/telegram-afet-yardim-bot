const API_URL = 'https://telegram-yardim-bot.herokuapp.com/api/v1/';
import axios from "axios";

class Api {
    config;
    token;

    constructor() {
        this.token = localStorage.getItem('token');
        this.config = {
            headers: {Authorization: `Bearer ${this.token}`}
        };
    }

    list($page = 1, $search) {
        return axios.get(API_URL + 'telegram/list', {params: {page: $page, search: $search}});
    }

    detail($id) {
        console.log(API_URL + 'telegram/detail/' + $id)
        return axios.get(API_URL + 'telegram/detail/' + $id);
    }


}

export default new Api();

