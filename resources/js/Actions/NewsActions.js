
import {
    FETCH_NEWS,
    FETCH_NEWS_BY_ID,
} from '../Actions/type';

import {mainApi} from '../Controller/APIControll';
import Cookies from 'js-cookie'

export const fetchNews = (status, index) => {
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const config = {
            headers: {
                'content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }
        }

        try{
            let res = await mainApi.get('/news/getNews?index='+index+'&status='+status, config)
            if (res.status === 200) {
                dispatch({type: FETCH_NEWS, data: res.data});
            }
        }catch(error){
            alert('Terjadi Kesalahan Dalam Memuat Data')
            await dispatch({type: FETCH_NEWS, data: []});
        }
    }
}

export const postNews = (data) =>{
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }
        }
        
        try{
            let response = await mainApi.post('/news/addNews', data, config)
            if (response.status === 200) {
                return {status: 'success'}
            }
        }catch (e){
            alert('Terjadi Kesalahan /n'+e);
            return {status: 'failed', message: e}
        }
        
    }
}
export const patchNews = (data) =>{
    return async (dispatch) => {
        const user = JSON.parse(localStorage.getItem('user'));
        const token = user.api_token;
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }
        }
        
        try{
            let response = await mainApi.get('/advertiser/cAdvertiser', configJSON)
            if (response.status === 200) {
                await dispatch({type: FETCH_QTY_ADVERTISER, data: response.data});
            }
        }catch (e){
            alert('Terjadi Kesalahan /n'+e);
        }
        
    }
}