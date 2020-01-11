import {
    FETCH_KATEGORI,
    FETCH_PROVINSI,
    FETCH_KOTA
} from '../Actions/type';

import {mainApi} from '../Controller/APIControll';

export const fetchKategori = () => {
    return async (dispatch) => {
        const user = JSON.parse(localStorage.getItem('user'));
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
        const user = JSON.parse(localStorage.getItem('user'));
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

export const fetchKota = (id) => {
    return async (dispatch) => {
        const user = JSON.parse(localStorage.getItem('user'));
        const token = user.api_token;
        const configJSON = {
            headers: {
                'content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }   
        }
        try{
            let resKota = await mainApi.get('/lokasi/requestKota?id='+id, configJSON)
            if (resKota.status === 200) {
                await dispatch({type: FETCH_KOTA, data: resKota.data})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            await dispatch({type: FETCH_KOTA, data: []})
        }
        
    }
}