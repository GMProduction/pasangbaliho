import {
    FETCH_NEGOSIASI,
    FETCH_NEGOSIASI_BY_ID,
    PREPARE_MOUNT,
    ON_MOUNTED,
    PAGE_PROGRESS,
    PREPARE_SEARCH,
    ON_SEARCHED,
    ON_CHANGE,
    PREPARE_SUBMIT,
    ON_SUBMITED,
    PAGE_REDIRECT,
} from './type';

import {fetchAPI, postAPI} from '../Controller/APIControll';

export const prepareMount = () => {
    return (dispatch) => {
        dispatch({type: PREPARE_MOUNT, status: 'Mohon Tunggu Sebentar'})
        dispatch({type: PAGE_PROGRESS, progress: 30, status: 'Fetching Data...'})
    }
}

export const onMounted = () => {
    return (dispatch) => {
        dispatch({type: ON_MOUNTED, title: 'Negosiasi'})
    }
}

export const onUnMounted = () => {
    return (dispatch) => {
        dispatch({type: PAGE_REDIRECT, redirect: false})
    }
}

export const prepareSearch = () => {
    return async (dispatch) => {
        await dispatch({type: PREPARE_SEARCH})   
    }
}

export const onSearched = () => {
    return async (dispatch) => {
        await dispatch({type: ON_SEARCHED})
    }
}

export const prepareSubmit = () => {
    return async (dispatch) => {
        dispatch({type: PREPARE_SUBMIT, status: 'Proses Penymipanan Data..'})
    }
}
export const onSubmit = () => {
    return async (dispatch) => {
        dispatch({type: ON_SUBMITED})
    }
}

export const postNegosiasi = (data, data2, filter) => {
    return async (dispatch) => {
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
          }
          let url = '/negosiasi/postPrice'
        let res = await postAPI(url, data, config);
        if (res.status === 'success') {
            if (res.data.data.status === 'ok') {
                // if(filter === 'permintaan'){
                //     let reslampiran = await postAPI('/negosiasi/sendemail', data2, config);
                //     console.log(reslampiran.data);
                // }
                dispatch({type: PAGE_REDIRECT, redirect: true})
                console.log(res.data)
            }else{
                dispatch({type: PAGE_REDIRECT, redirect: true})
                console.log(res.data);
            }
        }else{
            dispatch({type: PAGE_REDIRECT, redirect: false})
        }
    }
}

export const fetchNegosiasi = (status, index) => {
    return async (dispatch) => {
        let stat = ''
        if (status !== 'all') {
            stat = status
        }
        let resNego = await fetchAPI('/negosiasi/request?status='+stat+'&index='+index);
        if (resNego.status === 'success') {
           dispatch({type: FETCH_NEGOSIASI, data: resNego.data.data})
        }
    }
}

export const fetchNegosiasiById = (status, id) => {
    return async (dispatch) => {
        let stat = ''
        if (status !== 'all') {
            stat = status
        }
        let resNego = await fetchAPI('/negosiasi/requestById?status='+stat+'&id='+id);
        if (resNego.status === 'success') {
            if (resNego.data.data !== ''){
                dispatch({type: FETCH_NEGOSIASI_BY_ID, data: resNego.data.data, dataFound: true})
            }else {
                dispatch({type: FETCH_NEGOSIASI_BY_ID, data: null, dataFound: false})
            }
        }
    }
}