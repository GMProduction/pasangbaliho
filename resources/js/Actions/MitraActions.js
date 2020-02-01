import {
    FETCH_MITRA,
    FETCH_MITRA_BY_ID,
    FETCH_QTY_MITRA,
    PAGE_REDIRECT,
} from './type';

import {mainApi} from '../Controller/APIControll';
import Cookies from 'js-cookie'



export const fetchMitra = (index) => {
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const configJSON = {
            headers: {
                'content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }   
        }
        try {
            let response = await mainApi.get('/mitra/request?index='+index, configJSON)
            if(response.status === 200){
                await dispatch({type: FETCH_MITRA, data: response.data});
            }
        } catch (error){
            alert('Terjadi Kesalahan Dalam Melakukan Fetch Data./n'+error);
        }
    }
}
export const fetchRequestMitra = (index) => {
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const configJSON = {
            headers: {
                'content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }   
        }
        try {
            let response = await mainApi.get('/mitra/requestPending?index='+index, configJSON)
            if(response.status === 200){
                await dispatch({type: FETCH_MITRA, data: response.data});
            }
        } catch (error){
            alert('Terjadi Kesalahan Dalam Melakukan Fetch Data./n'+error);
        }
    }
}

export const fetchMitraById = (id) => {
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const configJSON = {
            headers: {
                'content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }   
        }
        try {
            let response = await mainApi.get('/mitra/requestById?id='+id, configJSON)
            if(response.status === 200){
                await dispatch({type: FETCH_MITRA_BY_ID, data: response.data});
            }else{
                await dispatch({type: FETCH_MITRA_BY_ID, data: null});
            }
        } catch (error){
            alert('Terjadi Kesalahan Dalam Melakukan Fetch Data./n'+error);
            await dispatch({type: FETCH_MITRA_BY_ID, data: null});
        }
    }
}

export const fetchQtyMitra = () => {
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const configJSON = {
            headers: {
                'content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }   
        }
        try{
            let response = await mainApi.get('/mitra/cMitra', configJSON)
            if (response.status === 200) {
                dispatch({type: FETCH_QTY_MITRA, data: response.data});
            }
        }catch (e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_QTY_MITRA, data: 0});
        }
    }
}

export const postMitra = (data, filter) => {
    let url = '/mitra/add';
    if (filter === 'edit') {
        url = '/mitra/edit';
    }
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const configJSON = {
            headers: {
                'content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }   
        }
        try{
            let response = await mainApi.post(url, data, configJSON)
            if (response.status === 200) {
                return {status: 'success'}
            }else{
                return {status: 'failed', message: response.data}
            }
        } catch(error) {
            alert('Terjadi Kesalahan Dalam Melakukan Penyimpanan Data./n'+error);
            return {status: 'failed', message: error}
        }
    }
}
export const deleteMitra = (id) => {
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const configJSON = {
            headers: {
                'content-type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            },
        }
        try{
            let response = await mainApi.delete('/mitra/delete/'+id, configJSON)
            if (response.status === 200) {
                return {status: 'success'}
            }else{
                return {status: 'failed', message: response.data}
            }

        }catch(e){
            return {status: 'failed', message: e}
        }
    }
}




