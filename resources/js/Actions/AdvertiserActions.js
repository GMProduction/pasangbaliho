import {
    FETCH_ADVERTISER,
    FETCH_ADVERTISER_BY_ID,
    FETCH_QTY_ADVERTISER,
    PAGE_REDIRECT,
} from '../Actions/type';

import {fetchAPI, deleteAPI, postAPI} from '../Controller/APIControll';

export const fetchAdvertiser = (index) => {
    return async (dispatch) => {
        let response = await fetchAPI('/advertiser/request?index='+index)
        if (response.status === 'success') {
            await dispatch({type: FETCH_ADVERTISER, data: response.data.data});
        }
    }
}

export const fetchAdvertiserById = (id) => {
    return async (dispatch) => {
        let response = await fetchAPI('/advertiser/requestById?id='+id)
        if (response.status === 'success') {
            await dispatch({type: FETCH_ADVERTISER_BY_ID, data: response.data.data});
        }
        console.log(response);
    }
}

export const postAdvertiser = (data, filter) =>{
    return async (dispatch) => {
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        }
        let url = '/advertiser/add';
        if (filter === 'edit') {
            url = '/advertiser/edit';
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

export const fetchQtyAdvertiser = () => {
    return async (dispatch) => {
        let response = await fetchAPI('/advertiser/cMitra')
        if (response.status === 'success') {
            await dispatch({type: FETCH_QTY_ADVERTISER, data: response.data.data});
        }
    }
}

