import {
    FETCH_NEGOSIASI,
    FETCH_NEGOSIASI_BY_ID,
    PREPARE_MOUNT,
    ON_MOUNTED,
    PAGE_PROGRESS,
    PREPARE_SEARCH,
    ON_SEARCHED,
} from './type';

import {mainApi} from '../Controller/APIControll';
import Cookies from 'js-cookie'

export const patchNegosiasi = (data) => {
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
            let response = await mainApi.post('/negosiasi/patchTransaksi', data, configJSON)
            if (response.status === 200) {
                return {status: 'success'}
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);

            return {status: 'failed'}
        }
    }
}

export const fetchNegosiasi = (status, index) => {
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
        let stat = ''
        if (status !== 'all') {stat = status}
        try{
            let response = await mainApi.get('/negosiasi/request?status='+stat+'&index='+index, configJSON)
            if (response.status === 200) {
                dispatch({type: FETCH_NEGOSIASI, data: response.data})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_NEGOSIASI, data: []})
        }
    }
}

export const fetchNegosiasiById = (status, id) => {
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
        let stat = ''
        if (status !== 'all') {
            stat = status
        }
        try{
            let resNego = await mainApi.get('/negosiasi/requestById?status='+stat+'&id='+id, configJSON);
            if (resNego.status === 200) {
                dispatch({type: FETCH_NEGOSIASI_BY_ID, data: resNego.data, dataFound: true})
            }else {
                dispatch({type: FETCH_NEGOSIASI_BY_ID, data: null, dataFound: false})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_NEGOSIASI_BY_ID, data: null, dataFound: false})
        }
        
    }
}
export const fetchNegosiasiAndSaldoById = (id) => {
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
            let resNego = await mainApi.get('/payment/requestSaldoById?id='+id, configJSON);
            if (resNego.status === 200) {
                dispatch({type: FETCH_NEGOSIASI_BY_ID, data: resNego.data, dataFound: true})
            }else {
                dispatch({type: FETCH_NEGOSIASI_BY_ID, data: null, dataFound: false})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_NEGOSIASI_BY_ID, data: null, dataFound: false})
        }
        
    }
}