import {
    FETCH_KATEGORI,
    FETCH_PROVINSI,
    FETCH_KOTA
} from '../Actions/type';

import {mainApi} from '../Controller/APIControll';
import Cookies from 'js-cookie'

export const fetchKategori = () => {
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
            let resKategori = await mainApi.get('/kategori/request', configJSON)
            if (resKategori.status === 200) {
                await dispatch({type: FETCH_KATEGORI, data: resKategori.data})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            await dispatch({type: FETCH_KATEGORI, data: []})
        }
    }
}

export const fetchProvinsi = () => {
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
            let resProvinsi = await mainApi.get('/lokasi/requestProvinsi', configJSON)
            if (resProvinsi.status === 200) {
                await dispatch({type: FETCH_PROVINSI, data: resProvinsi.data})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            await dispatch({type: FETCH_PROVINSI, data: []})
        }
    }
}

export const fetchKota = () => {
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
            let resKota = await mainApi.get('/lokasi/requestKota', configJSON)
            if (resKota.status === 200) {
                await dispatch({type: FETCH_KOTA, data: resKota.data})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            await dispatch({type: FETCH_KOTA, data: []})
        }
        
    }
}
export const fetchKotaById = (id) => {
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
            let resKota = await mainApi.get('/lokasi/requestKotaById?id='+id, configJSON)
            if (resKota.status === 200) {
                await dispatch({type: FETCH_KOTA, data: resKota.data})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            await dispatch({type: FETCH_KOTA, data: []})
        }
        
    }
}