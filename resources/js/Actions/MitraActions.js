import {
    FETCH_MITRA,
    FETCH_MITRA_BY_ID,
    FETCH_QTY_MITRA,
    PAGE_REDIRECT,
} from './type';

import {fetchAPI, deleteAPI, postAPI} from '../Controller/APIControll';

export const fetchMitra = (index) => {
    return async (dispatch) => {
        let response = await fetchAPI('/mitra/request?index='+index)
        if (response.status === 'success') {
            await dispatch({type: FETCH_MITRA, data: response.data.data});
        }
    }
}

export const fetchMitraById = (id) => {
    return async (dispatch) => {
        let response = await fetchAPI('/mitra/requestById?id='+id)
        if (response.status === 'success') {
            await dispatch({type: FETCH_MITRA_BY_ID, data: response.data.data});
        }
    }
}

export const postMitra = (data, filter) =>{
    return async (dispatch) => {
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        }
        let url = '/mitra/add';
        if (filter === 'edit') {
            url = '/mitra/edit';
          }
        let res = await postAPI(url, data, config);
        if (res.status === 'success') {
            if (res.data.data.sqlResponse === true) {
                alert('berhasil')
                dispatch({type: PAGE_REDIRECT, redirect: true})
                console.log(res.data.data);
            }else{
                alert('gagal')
                dispatch({type: PAGE_REDIRECT, redirect: false})
                console.log(res.data.data);
            }
        }
    }
}
export const deleteMitra = (id) => {
    return async (dispatch) => {
        let data = {id: id};
        let response = await deleteAPI('/mitra/delete', data)
        if (response.status === 'success') {
            alert('Berhasil Menghapus Data.')
        }else{
            alert('Gagal Menghapus Data')
        }
        console.log(response);
    }
}

export const fetchQtyMitra = () => {
    return async (dispatch) => {
        let response = await fetchAPI('/mitra/cMitra')
        if (response.status === 'success') {
            await dispatch({type: FETCH_QTY_MITRA, data: response.data.data});
        }
    }
}


