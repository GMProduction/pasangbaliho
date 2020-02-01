import {
    FETCH_ADVERTISER,
    FETCH_ADVERTISER_BY_ID,
    FETCH_QTY_ADVERTISER,
    PAGE_REDIRECT,
} from '../Actions/type';

import {mainApi} from '../Controller/APIControll';
import Cookies from 'js-cookie'

export const fetchAdvertiser = (index) => {
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
            let response = await mainApi.get('/advertiser/request?index='+index, configJSON)
            if(response.status === 200){
                await dispatch({type: FETCH_ADVERTISER, data: response.data});
            }
        } catch (error){
            alert('Terjadi Kesalahan Dalam Melakukan Fetch Data./n'+error);
            await dispatch({type: FETCH_ADVERTISER, data: []});
        }
    }
}

export const fetchAdvertiserById = (id) => {
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
            let response = await mainApi.get('/advertiser/requestById?id='+id, configJSON)
            if(response.status === 200){
                await dispatch({type: FETCH_ADVERTISER_BY_ID, data: response.data});
            }else{
                await dispatch({type: FETCH_ADVERTISER_BY_ID, data: null});
            }
        } catch (error){
            alert('Terjadi Kesalahan Dalam Melakukan Fetch Data./n'+error);
            await dispatch({type: FETCH_ADVERTISER_BY_ID, data: null});
        }
    }
}

export const fetchQtyAdvertiser = () => {
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
            let response = await mainApi.get('/advertiser/cAdvertiser', configJSON)
            if (response.status === 200) {
                dispatch({type: FETCH_QTY_ADVERTISER, data: response.data});
            }
        }catch (e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_QTY_ADVERTISER, data: 0});
        }
    }
}

export const postAdvertiser = (data, filter) =>{
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
        let url = '/advertiser/add';
        if (filter === 'edit') {
            url = '/advertiser/edit';
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
export const deleteAdvertiser = (id) => {
    return async (dispatch) => {
        let data = {id: id};
        let response = await deleteAPI('/advertiser/delete', data)
        if (response.status === 'success') {
            alert('Berhasil Menghapus Data.')
        }else{
            alert('Gagal Menghapus Data')
        }
        console.log(response);
    }
}



