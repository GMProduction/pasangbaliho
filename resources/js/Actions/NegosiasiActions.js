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

import {mainApi} from '../Controller/APIControll';

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
                if(filter === 'permintaan'){
                    let reslampiran = await postAPI('/negosiasi/sendemail', data2, config);
                    console.log(reslampiran.data);
                }
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
        const user = JSON.parse(localStorage.getItem('user'));
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
        const user = JSON.parse(localStorage.getItem('user'));
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