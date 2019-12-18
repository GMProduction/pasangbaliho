import {
    FETCH_KATEGORI,
    FETCH_PROVINSI,
    FETCH_KOTA
} from '../Actions/type';

import {fetchAPI, postAPI} from '../Controller/APIControll';

export const fetchKategori = () => {
    return async (dispatch) => {
        let resKategori = await fetchAPI('/kategori/request')
        if (resKategori.status === 'success') {
            await dispatch({type: FETCH_KATEGORI, data: resKategori.data.data})
        }
    }
}

export const fetchProvinsi = () => {
    return async (dispatch) => {
        let resProvinsi = await fetchAPI('/lokasi/requestProvinsi')
        if (resProvinsi.status === 'success') {
            await dispatch({type: FETCH_PROVINSI, data: resProvinsi.data.data})
        }
    }
}

export const fetchKota = (id) => {
    return async (dispatch) => {
        let resKota = await fetchAPI('/lokasi/requestKota?id='+id)
        if (resKota.status === 'success') {
            await dispatch({type: FETCH_KOTA, data: resKota.data.data})
        }
    }
}