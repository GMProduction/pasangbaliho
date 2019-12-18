import {
    FETCH_MEDIA_IKLAN,
    FETCH_MEDIA_IKLAN_BY_ID,
    FETCH_QTY_MEDIA_IKLAN,
    PAGE_REDIRECT,
} from '../Actions/type';


import {fetchAPI, postAPI, deleteAPI} from '../Controller/APIControll';



export const postMedia = (data, filter) => {
    return async (dispatch) => {
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
          }
          let url = '/mediaiklan/addmedia';
          if (filter === 'update') {
            url = '/mediaiklan/konfirmmedia';
          }
        let res = await postAPI(url, data, config);
        if (res.status === 'success') {
            if (res.data.data.status === 'ok') {
                dispatch({type: PAGE_REDIRECT, redirect: true})
                alert('Berhasil Menyimpan Data')
            }else{
                dispatch({type: PAGE_REDIRECT, redirect: false})
                alert('Gagal Menyimpan Data')
            }
        }
    }
}

export const deleteMitra = (id) => {
    return async (dispatch) => {
        let data = {id: id};
        let response = await deleteAPI('/mediaiklan/delete', data)
        if (response.status === 'success') {
            alert('Berhasil Menghapus Data.')
        }else{
            alert('Gagal Menghapus Data')
        }
        console.log(response);
    }
}
export const ChangeStatusMedia = (data) => {
    return async (dispatch) => {
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
          }
        let url = '/mediaiklan/updateStatus';
        let res = await postAPI(url, data, config);
        if (res.status === 'success') {
            if (res.data.data.status === 'ok') {
                alert('Berhasil Menyimpan Data')
            }else{
                alert('Gagal Menyimpan Data')
            }
        }
    }
}


export const fetchMedia = (status, index) => {
    return async (dispatch) => {
        let stat = ''
        if (status !== 'all') {
            stat = status
            let resMedia = await fetchAPI('/mediaiklan/request?status='+stat+'&index='+index);
            if (resMedia.status === 'success') {
            dispatch({type: FETCH_MEDIA_IKLAN, data: resMedia.data.data})
            }
        }else{
            let resMedia = await fetchAPI('/mediaiklan/request?index='+index);
            if (resMedia.status === 'success') {
            dispatch({type: FETCH_MEDIA_IKLAN, data: resMedia.data.data})
            }
        }
        
    }
}

export const fetchMediaByID = (status, id) => {
    return async (dispatch) => {
        let stat = ''
        if (status !== 'all') {
            stat = status
        }
        let resMedia = await fetchAPI('/mediaiklan/requestById?status='+stat+'&id='+id)
        if (resMedia.status === 'success') {
            if (resMedia.data.data !== '') {
                await dispatch({type: FETCH_MEDIA_IKLAN_BY_ID, data: resMedia.data.data, dataFound: true})
            }else {
                await dispatch({type: FETCH_MEDIA_IKLAN_BY_ID, data: null, dataFound: false})
            }
        }
    }
}

export const fetchQtyMedia = () => {
    return async (dispatch) => {
        let response = await fetchAPI('/mediaiklan/cMedia')
        if (response.status === 'success') {
            await dispatch({type: FETCH_QTY_MEDIA_IKLAN, data: response.data.data});
        }
    }
}
