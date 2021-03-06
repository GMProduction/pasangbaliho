import {
    FETCH_MEDIA_IKLAN,
    FETCH_MEDIA_IKLAN_BY_ID,
    FETCH_IMAGE_BY_ID,
    FETCH_MEDIA_USED,
    FETCH_QTY_MEDIA_IKLAN,
} from '../Actions/type';


import {mainApi} from '../Controller/APIControll';
import Cookies from 'js-cookie'

export const fetchMedia = (status, index) => {
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
            let resMedia = await mainApi.get('/mediaiklan/request?status='+stat+'&index='+index, configJSON);
            if (resMedia.status === 200) {
                dispatch({type: FETCH_MEDIA_IKLAN, data: resMedia.data.result})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_MEDIA_IKLAN, data: []})
        }
        
    }
}

export const fetchMediaByID = (status, id) => {
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
            let resMedia = await mainApi.get('/mediaiklan/requestById?status='+stat+'&id='+id, configJSON)
            if (resMedia.status === 200) {
                await dispatch({type: FETCH_MEDIA_IKLAN_BY_ID, data: resMedia.data, dataFound: true})
            }else{
                alert(resMedia.data.message)
                await dispatch({type: FETCH_MEDIA_IKLAN_BY_ID, data: null, dataFound: false})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            await dispatch({type: FETCH_MEDIA_IKLAN_BY_ID, data: null, dataFound: false})
        }
    }
}

export const fetchQtyMedia = () => {
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
            let response = await mainApi.get('/mediaiklan/cMedia', configJSON)
            if (response.status === 200) {
                dispatch({type: FETCH_QTY_MEDIA_IKLAN, data: response.data});
            }
        }catch (e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_QTY_MEDIA_IKLAN, data: 0});
        }
        
    }
}

export const postMedia = (data, filter) => {
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
        let url = '/mediaiklan/addMedia';
        if (filter === 'patch') {url = '/mediaiklan/patchMedia';}
        try{
            
            let response = await mainApi.post(url, data, configJSON)
            if (response.status === 200) {
                return {status: 'success', data: response.data}
            }else{
                return {status: 'failed', message: response.data}
            }
        }catch(e){
            alert('Terjadi Kesalahan./n'+e);
            return {status: 'failed', message: e}
        }
    }
}

export const uploadImage = (data) => {
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const configFORM = {
            headers: {
                'content-type': 'multipart/form-data',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            }   
        }
        try{
            let resImg = await mainApi.post('/mediaiklan/uploadImage', data, configFORM)
            if(resImg.status === 200){
                return {status: 'success', message: 'uploaded'}
            }else{
                return {status: 'failed', message: 'Failed To Upload'}
            }
        }catch(e){
            alert('Terjadi Kesalahan Dalam Melakukan Upload Image./n'+e);
            return {status: 'failed', message: e}
        }
        

    }
}

export const deleteMedia = (id) => {
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const configURLEncode = {
            headers: {
                'content-type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            },
        }
        try{
            let response = await mainApi.delete('/mediaiklan/delete/'+id, configURLEncode)
            if (response.status === 200) {
                return {status: 'success'}
            }else{
                return {status: 'failed',}
            }

        }catch(e){
            alert('Terjadi Kesalahan Dalam./n'+e);
            return {status: 'failed', message: e}
        }
    }
}

export const deleteImage = (id) =>{
    return async (dispatch) => {
        const user = JSON.parse(Cookies.get('user'));
        const token = user.api_token;
        const configURLEncode = {
            headers: {
                'content-type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+token
            },
        }
        try{
            let response = await mainApi.delete('/mediaiklan/deleteImage/'+id, configURLEncode)
            if (response.status === 200) {
                return {status: 'success'}
            }else{
                return {status: 'failed',}
            }

        }catch(e){
            alert('Terjadi Kesalahan Dalam./n'+e);
            return {status: 'failed', message: e}
        }
    }
}


export const fetchImageById = (id) => {
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
            let res = await mainApi.get('/mediaiklan/requestImageById?id='+id, configJSON);
            if (res.status === 200) {
                dispatch({type: FETCH_IMAGE_BY_ID, data: res.data})
            }
        }catch(e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_IMAGE_BY_ID, data: []})
        }
        
    }
}





export const fetchMediaUsedById = (id) => {
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
            let response = await mainApi.get('/mediaiklan/requestMediaUsedById?id='+id, configJSON)
            if (response.status === 200) {
                dispatch({type: FETCH_MEDIA_USED, data: response.data});
            }
        }catch (e){
            alert('Terjadi Kesalahan /n'+e);
            dispatch({type: FETCH_MEDIA_USED, data: []});
        }
    }
}
